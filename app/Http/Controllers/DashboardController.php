<?php

namespace App\Http\Controllers;

use App\Models\Kebaya;
use App\Models\Penyewaan;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKebaya = Kebaya::count();
        $totalPenyewaan = Penyewaan::count();
        $totalPelanggan = Pelanggan::count();

        $penyewaanPerBulan = Penyewaan::select(
            DB::raw("DATE_FORMAT(tanggal_sewa, '%Y-%m') as bulan"),
            DB::raw('count(*) as total')
        )
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->pluck('total', 'bulan')
        ->toArray();

        $penyewaanTerbaru = Penyewaan::with('pelanggan')
            ->orderBy('tanggal_sewa', 'desc')
            ->take(10)
            ->get();

        // ================================
        // Tambahan untuk kebaya favorit
        // ================================
        // Kebaya favorit diambil dari tabel penyewaan langsung
$kebayaFavorit = Penyewaan::select(
    'kebaya_id',
    DB::raw('COUNT(*) as total_sewa')
)
->groupBy('kebaya_id')
->orderByDesc('total_sewa')
->limit(5)
->get();

$kebayaIds = $kebayaFavorit->pluck('kebaya_id')->toArray();
$kebayas = Kebaya::whereIn('id', $kebayaIds)->get()->keyBy('id');

$labels = [];
$data = [];
foreach ($kebayaFavorit as $item) {
    $labels[] = $kebayas[$item->kebaya_id]->nama ?? 'Tidak Diketahui';
    $data[] = $item->total_sewa;
}

        // ================================

        return view('admin.dashboard.index', compact(
            'totalKebaya',
            'totalPenyewaan',
            'totalPelanggan',
            'penyewaanPerBulan',
            'penyewaanTerbaru',
            'labels',    // data chart kebaya favorit
            'data'       // data chart kebaya favorit
        ));
    }
}
