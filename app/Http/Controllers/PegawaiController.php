<?php

namespace App\Http\Controllers;

use App\Models\MasterGolongan;
use App\Models\MasterJf;
use App\Models\MasterUnitKerja;
use App\Models\PakHistory;
use App\Models\Pegawai;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        $filters = [
            'q' => trim((string) $request->query('q', '')),
            'uk' => $request->query('uk'),
            'gol' => $request->query('gol'),
            'jf' => $request->query('jf'),
        ];

        if (! Schema::hasTable('pegawai')) {
            return view('pegawai.index', [
                'pegawaiList' => collect(),
                'filters' => $filters,
                'unitKerjaOptions' => collect(),
                'golonganOptions' => collect(),
                'jfOptions' => collect(),
            ]);
        }

        $pegawaiQuery = Pegawai::query()->with('latestPakHistory');

        if ($filters['q'] !== '') {
            $pegawaiQuery->where(function ($query) use ($filters) {
                $query->where('nip', 'like', '%' . $filters['q'] . '%')
                    ->orWhere('nama', 'like', '%' . $filters['q'] . '%');
            });
        }

        if (! empty($filters['uk'])) {
            $pegawaiQuery->where('uk', $filters['uk']);
        }

        if (! empty($filters['gol'])) {
            $pegawaiQuery->where('gol', $filters['gol']);
        }

        if (! empty($filters['jf'])) {
            $pegawaiQuery->where('jf', $filters['jf']);
        }

        $pegawaiList = $pegawaiQuery->orderBy('nama')->get();

        return view('pegawai.index', [
            'pegawaiList' => $pegawaiList,
            'filters' => $filters,
            'unitKerjaOptions' => $this->unitKerjaOptions(),
            'golonganOptions' => $this->golonganOptions(),
            'jfOptions' => $this->jfOptions(),
        ]);
    }

    public function create()
    {
        return view('pegawai.create', [
            'golonganOptions' => $this->golonganOptions(),
            'jfOptions' => $this->jfOptions(),
            'unitKerjaOptions' => $this->unitKerjaOptions(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nip' => ['required', 'string', 'max:50', Rule::unique('pegawai', 'nip')],
            'nama' => ['required', 'string', 'max:255'],
            'jf' => ['required', 'string', 'max:255'],
            'gol' => ['required', 'string', 'max:50'],
            'uk' => ['required', 'string', 'max:100'],
        ]);

        Pegawai::create($validated);

        return redirect()
            ->route('dashboard', ['uk' => $validated['uk']])
            ->with('success', 'Pegawai baru berhasil ditambahkan.');
    }

    public function edit(string $nip)
    {
        $pegawai = Pegawai::query()->where('nip', $nip)->firstOrFail();

        return view('pegawai.edit', [
            'pegawai' => $pegawai,
            'golonganOptions' => $this->golonganOptions(),
            'jfOptions' => $this->jfOptions(),
            'unitKerjaOptions' => $this->unitKerjaOptions(),
        ]);
    }

    public function update(Request $request, string $nip): RedirectResponse
    {
        $pegawai = Pegawai::query()->where('nip', $nip)->firstOrFail();

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'jf' => ['required', 'string', 'max:255'],
            'gol' => ['required', 'string', 'max:50'],
            'uk' => ['required', 'string', 'max:100'],
        ]);

        $pegawai->update($validated);

        return redirect()
            ->route('dashboard', ['uk' => $validated['uk']])
            ->with('success', 'Data pegawai berhasil diperbarui.');
    }

    public function destroy(string $nip): RedirectResponse
    {
        $pegawai = Pegawai::query()->where('nip', $nip)->firstOrFail();
        $unitKerja = $pegawai->uk;

        DB::transaction(function () use ($pegawai, $nip) {
            PakHistory::query()->where('nip', $nip)->delete();
            $pegawai->delete();
        });

        return redirect()
            ->route('dashboard', ['uk' => $unitKerja])
            ->with('success', 'Data pegawai dan riwayat PAK terkait berhasil dihapus.');
    }

    private function golonganOptions()
    {
        if (Schema::hasTable('master_golongan')) {
            return MasterGolongan::query()->where('is_active', true)->orderBy('nama')->pluck('nama');
        }

        return Pegawai::query()
            ->whereNotNull('gol')
            ->where('gol', '!=', '')
            ->select('gol')
            ->distinct()
            ->orderBy('gol')
            ->pluck('gol');
    }

    private function jfOptions()
    {
        if (Schema::hasTable('master_jf')) {
            return MasterJf::query()->where('is_active', true)->orderBy('nama')->pluck('nama');
        }

        return Pegawai::query()
            ->whereNotNull('jf')
            ->where('jf', '!=', '')
            ->select('jf')
            ->distinct()
            ->orderBy('jf')
            ->pluck('jf');
    }

    private function unitKerjaOptions()
    {
        if (Schema::hasTable('master_unit_kerja')) {
            return MasterUnitKerja::query()->where('is_active', true)->orderBy('nama')->pluck('nama');
        }

        return Pegawai::query()
            ->whereNotNull('uk')
            ->where('uk', '!=', '')
            ->select('uk')
            ->distinct()
            ->orderBy('uk')
            ->pluck('uk');
    }
}
