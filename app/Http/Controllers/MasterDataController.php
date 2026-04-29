<?php

namespace App\Http\Controllers;

use Database\Seeders\MasterDataSeeder;
use App\Models\MasterGolongan;
use App\Models\MasterJf;
use App\Models\MasterUnitKerja;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MasterDataController extends Controller
{
    public function index()
    {
        return redirect()->route('master-data.golongan.index');
    }

    public function golonganIndex()
    {
        return view('master-data.golongan', [
            'items' => MasterGolongan::query()->orderBy('nama')->get(),
        ]);
    }

    public function jfIndex()
    {
        return view('master-data.jf', [
            'items' => MasterJf::query()->orderBy('nama')->get(),
        ]);
    }

    public function unitKerjaIndex()
    {
        return view('master-data.unit-kerja', [
            'items' => MasterUnitKerja::query()->orderBy('nama')->get(),
        ]);
    }

    public function storeGolongan(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:50', 'unique:master_golongan,nama'],
        ]);

        MasterGolongan::create([
            'nama' => $validated['nama'],
            'is_active' => true,
        ]);

        return redirect()->route('master-data.golongan.index')->with('success', 'Master golongan berhasil ditambahkan.');
    }

    public function storeJf(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255', 'unique:master_jf,nama'],
        ]);

        MasterJf::create([
            'nama' => $validated['nama'],
            'is_active' => true,
        ]);

        return redirect()->route('master-data.jf.index')->with('success', 'Master JF berhasil ditambahkan.');
    }

    public function storeUnitKerja(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100', 'unique:master_unit_kerja,nama'],
        ]);

        MasterUnitKerja::create([
            'nama' => $validated['nama'],
            'is_active' => true,
        ]);

        return redirect()->route('master-data.unit-kerja.index')->with('success', 'Master unit kerja berhasil ditambahkan.');
    }

    public function destroyGolongan(MasterGolongan $masterGolongan): RedirectResponse
    {
        $masterGolongan->delete();

        return redirect()->route('master-data.golongan.index')->with('success', 'Master golongan berhasil dihapus.');
    }

    public function destroyJf(MasterJf $masterJf): RedirectResponse
    {
        $masterJf->delete();

        return redirect()->route('master-data.jf.index')->with('success', 'Master JF berhasil dihapus.');
    }

    public function destroyUnitKerja(MasterUnitKerja $masterUnitKerja): RedirectResponse
    {
        $masterUnitKerja->delete();

        return redirect()->route('master-data.unit-kerja.index')->with('success', 'Master unit kerja berhasil dihapus.');
    }

    public function seedDefaults(): RedirectResponse
    {
        abort_unless(app()->environment('local'), 403);

        app(MasterDataSeeder::class)->run();

        return redirect()->route('master-data.golongan.index')->with('success', 'Seed master data default berhasil dijalankan.');
    }
}
