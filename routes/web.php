<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\PakHistoryController;
use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/pak-histories/create', [PakHistoryController::class, 'create'])->name('pak-histories.create');
Route::post('/pak-histories', [PakHistoryController::class, 'store'])->name('pak-histories.store');
Route::get('/pak-histories/{pakHistory}/edit', [PakHistoryController::class, 'edit'])->name('pak-histories.edit');
Route::put('/pak-histories/{pakHistory}', [PakHistoryController::class, 'update'])->name('pak-histories.update');
Route::post('/pak-histories/{pakHistory}/finalize', [PakHistoryController::class, 'finalize'])->name('pak-histories.finalize');
Route::get('/pak-histories/export/excel', [PakHistoryController::class, 'exportExcel'])->name('pak-histories.export.excel');
Route::get('/pak-histories/export/pdf', [PakHistoryController::class, 'exportPdfRekap'])->name('pak-histories.export.pdf');
Route::get('/pak-histories/{pakHistory}/pdf', [PakHistoryController::class, 'exportPdf'])->name('pak-histories.pdf');
Route::get('/pak-histories/pegawai/{nip}', [PakHistoryController::class, 'history'])->name('pak-histories.history');
Route::post('/pak-histories/pegawai/{nip}/generate-next-draft', [PakHistoryController::class, 'generateNextDraft'])->name('pak-histories.generate-next-draft');

Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
Route::get('/pegawai/{nip}/edit', [PegawaiController::class, 'edit'])->name('pegawai.edit');
Route::get('/pegawai/create', [PegawaiController::class, 'create'])->name('pegawai.create');
Route::post('/pegawai', [PegawaiController::class, 'store'])->name('pegawai.store');
Route::put('/pegawai/{nip}', [PegawaiController::class, 'update'])->name('pegawai.update');
Route::delete('/pegawai/{nip}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');

Route::get('/master-data', [MasterDataController::class, 'index'])->name('master-data.index');
Route::get('/master-data/golongan', [MasterDataController::class, 'golonganIndex'])->name('master-data.golongan.index');
Route::get('/master-data/jf', [MasterDataController::class, 'jfIndex'])->name('master-data.jf.index');
Route::get('/master-data/unit-kerja', [MasterDataController::class, 'unitKerjaIndex'])->name('master-data.unit-kerja.index');
Route::post('/master-data/seed-defaults', [MasterDataController::class, 'seedDefaults'])->name('master-data.seed-defaults');
Route::post('/master-data/golongan', [MasterDataController::class, 'storeGolongan'])->name('master-data.golongan.store');
Route::post('/master-data/jf', [MasterDataController::class, 'storeJf'])->name('master-data.jf.store');
Route::post('/master-data/unit-kerja', [MasterDataController::class, 'storeUnitKerja'])->name('master-data.unit-kerja.store');
Route::delete('/master-data/golongan/{masterGolongan}', [MasterDataController::class, 'destroyGolongan'])->name('master-data.golongan.destroy');
Route::delete('/master-data/jf/{masterJf}', [MasterDataController::class, 'destroyJf'])->name('master-data.jf.destroy');
Route::delete('/master-data/unit-kerja/{masterUnitKerja}', [MasterDataController::class, 'destroyUnitKerja'])->name('master-data.unit-kerja.destroy');
