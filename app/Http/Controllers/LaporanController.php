<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Penyewaan::query();

        // Filter tanggal sewa jika ada
        if ($request->filled('tanggal_mulai')) {
            $query->where('tanggal_sewa', '>=', $request->tanggal_mulai);
        }

        if ($request->filled('tanggal_selesai')) {
            $query->where('tanggal_sewa', '<=', $request->tanggal_selesai);
        }

        $penyewaan = $query->with('pelanggan')->orderBy('tanggal_sewa', 'desc')->paginate(15);

        return view('admin.laporan.index', compact('penyewaan'));
    }

    public function exportCsv(Request $request): StreamedResponse
    {
        $filename = 'laporan_penyewaan_' . date('Ymd_His') . '.csv';

        $query = Penyewaan::query();

        if ($request->filled('tanggal_mulai')) {
            $query->where('tanggal_sewa', '>=', $request->tanggal_mulai);
        }
        if ($request->filled('tanggal_selesai')) {
            $query->where('tanggal_sewa', '<=', $request->tanggal_selesai);
        }

        $penyewaan = $query->with('pelanggan')->orderBy('tanggal_sewa', 'desc')->get();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['Kode Sewa', 'Nama Pelanggan', 'Tanggal Sewa', 'Total Bayar'];

        $callback = function () use ($penyewaan, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($penyewaan as $item) {
                fputcsv($file, [
                    $item->kode_sewa,
                    $item->pelanggan->nama ?? '-',
                    $item->tanggal_sewa,
                    number_format($item->total_bayar, 2, ',', '.'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
