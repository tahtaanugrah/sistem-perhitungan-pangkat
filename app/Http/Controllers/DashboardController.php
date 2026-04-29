<?php

namespace App\Http\Controllers;

use App\Models\PakHistory;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if (! Schema::hasTable('pegawai')) {
            return view('dashboard', [
                'summary' => [
                    'pegawaiCount' => 0,
                    'pakCount' => 0,
                    'draftCount' => 0,
                    'finalCount' => 0,
                    'unitKerjaCount' => 0,
                    'latestPeriod' => null,
                ],
                'recentPakHistories' => collect(),
            ]);
        }

        $pegawaiCount = Pegawai::query()->count();
        $pakCount = PakHistory::query()->count();
        $draftCount = PakHistory::query()->where('input_status', 'draft')->count();
        $finalCount = PakHistory::query()->where('input_status', 'final')->count();
        $unitKerjaCount = Pegawai::query()
            ->whereNotNull('uk')
            ->where('uk', '!=', '')
            ->distinct('uk')
            ->count('uk');
        $latestPeriod = PakHistory::query()->max('periode_tahun');

        $recentPakHistories = PakHistory::query()
            ->with('pegawai')
            ->latest('periode_tahun')
            ->latest('id')
            ->limit(5)
            ->get();

        return view('dashboard', [
            'summary' => [
                'pegawaiCount' => $pegawaiCount,
                'pakCount' => $pakCount,
                'draftCount' => $draftCount,
                'finalCount' => $finalCount,
                'unitKerjaCount' => $unitKerjaCount,
                'latestPeriod' => $latestPeriod,
            ],
            'recentPakHistories' => $recentPakHistories,
        ]);
    }
}
