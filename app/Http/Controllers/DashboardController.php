<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // --- 1. DATA UNTUK STAT CARDS ---
        $totalPegawai = Pegawai::count();
        $pegawaiAktif = Pegawai::where('status', 'Aktif')->count();
        
        // Mencari pendidikan terbanyak
        $pendidikanTerbanyak = Pegawai::select('pendidikan_terakhir')
            ->groupBy('pendidikan_terakhir')
            ->orderByRaw('COUNT(*) DESC')
            ->first();
        $topPendidikan = $pendidikanTerbanyak ? $pendidikanTerbanyak->pendidikan_terakhir : '-';
        $topPendidikanCount = $pendidikanTerbanyak ? Pegawai::where('pendidikan_terakhir', $topPendidikan)->count() : 0;

        // --- 2. DATA UNTUK PIE CHART GENDER ---
        $lakiLaki = Pegawai::where('jenis_kelamin', 'Laki-laki')->count();
        $perempuan = Pegawai::where('jenis_kelamin', 'Perempuan')->count();

        // --- 3. DATA UNTUK PIE CHART STATUS ---
        $statusData = Pegawai::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        // --- 4. DATA UNTUK BAR CHART PENDIDIKAN ---
        $eduData = Pegawai::selectRaw('pendidikan_terakhir, count(*) as total')
            ->groupBy('pendidikan_terakhir')
            ->pluck('total', 'pendidikan_terakhir');

        // --- 5. DATA UNTUK LINE CHART USIA ---
        $usiaData = [
            '< 25 Thn' => 0, '25-34 Thn' => 0, '35-44 Thn' => 0, '45-54 Thn' => 0, '> 55 Thn' => 0
        ];
        foreach (Pegawai::all() as $p) {
            $umur = Carbon::parse($p->tanggal_lahir)->age;
            if ($umur < 25) $usiaData['< 25 Thn']++;
            elseif ($umur <= 34) $usiaData['25-34 Thn']++;
            elseif ($umur <= 44) $usiaData['35-44 Thn']++;
            elseif ($umur <= 54) $usiaData['45-54 Thn']++;
            else $usiaData['> 55 Thn']++;
        }

        return view('dashboard', compact(
            'totalPegawai', 'pegawaiAktif', 'topPendidikan', 'topPendidikanCount',
            'lakiLaki', 'perempuan', 'statusData', 'eduData', 'usiaData'
        ));
    }
}