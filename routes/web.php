<?php

use App\Http\Controllers\absenController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\dataController;
use App\Http\Controllers\dataGuruController;
use App\Http\Controllers\dataNilaiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MutasiSiswaController;
use App\Http\Controllers\siswaController;
use App\Http\Controllers\skController;
use App\Http\Controllers\soalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\TemplateController;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route untuk Admin, hanya admin yang bisa mengakses
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    Route::get('soal', [soalController::class, 'index'])->name('admin.soal.index');
    Route::get('soal/create', [soalController::class, 'create'])->name('admin.soal.create');
    Route::post('soal', [soalController::class, 'store'])->name('admin.soal.store');
    Route::get('soal/{id}/edit', [soalController::class, 'edit'])->name('admin.soal.edit');
    Route::put('soal/{id}', [soalController::class, 'update'])->name('admin.soal.update');
    Route::delete('soal/{id}', [soalController::class, 'destroy'])->name('admin.soal.destroy');

    Route::get('absen', [absenController::class, 'index'])->name('admin.absen.index');
    Route::get('absen/create', [absenController::class, 'create'])->name('admin.absen.create');
    Route::post('absen', [AbsenController::class, 'store'])->name('admin.absen.store');
    Route::get('absen/{id}/edit', [AbsenController::class, 'edit'])->name('admin.absen.edit');
    Route::put('absen/{id}', [AbsenController::class, 'update'])->name('admin.absen.update');
    Route::delete('absen/{id}', [absenController::class, 'destroy'])->name('admin.absen.destroy');
    Route::get('template/absensi', [absenController::class, 'downloadTemplate'])->name('absensi.downloadTemplate');
    Route::post('/import-absensi', [absenController::class, 'import'])->name('import.absensi');

    Route::get('siswa', [SiswaController::class, 'index'])->name('admin.siswa.index');
    Route::get('siswa/create', [SiswaController::class, 'create'])->name('admin.siswa.create');
    Route::post('siswa/store', [SiswaController::class, 'store'])->name('admin.siswa.store');
    Route::get('siswa/{id}/edit', [SiswaController::class, 'edit'])->name('admin.siswa.edit');
    Route::put('siswa/{id}', [SiswaController::class, 'update'])->name('admin.siswa.update');
    Route::delete('siswa/{id}', [SiswaController::class, 'destroy'])->name('admin.siswa.destroy');
    Route::post('siswa/import', [SiswaController::class, 'import'])->name('admin.siswa.import');
    Route::get('/admin/siswa/export', [SiswaController::class, 'export'])->name('admin.siswa.export');


    Route::get('mutasi-siswa', [MutasiSiswaController::class, 'index'])->name('admin.mutasiSiswa.index');
    Route::get('mutasi-siswa/create', [MutasiSiswaController::class, 'create'])->name('admin.mutasiSiswa.create');

    Route::get('sk', [skController::class, 'index'])->name('admin.sk.index');
    Route::get('sk/create', [skController::class, 'create'])->name('admin.sk.create');
    Route::post('/admin/sk/store', [SkController::class, 'store'])->name('sk.store');
    Route::get('sk/{id}/edit', [SkController::class, 'edit'])->name('admin.sk.edit');
    Route::put('sk/{id}', [SkController::class, 'update'])->name('admin.sk.update');
    Route::delete('sk/{id}', [SkController::class, 'destroy'])->name('admin.sk.destroy');

    Route::get('data-nilai', [dataNilaiController::class, 'index'])->name('admin.dataNilai.index');
    Route::get('data-nilai/create', [dataNilaiController::class, 'create'])->name('admin.dataNilai.create');
    Route::post('data-nilai/store', [dataNilaiController::class, 'store'])->name('admin.dataNilai.store');
    Route::get('data-nilai/{id}/edit', [dataNilaiController::class, 'edit'])->name('admin.dataNilai.edit');
    Route::put('data-nilai/{id}', [dataNilaiController::class, 'update'])->name('admin.dataNilai.update');
    Route::delete('data-nilai/{id}', [dataNilaiController::class, 'destroy'])->name('admin.dataNilai.destroy');

    Route::get('data-guru', [dataGuruController::class, 'index'])->name('admin.dataGuru.index');
    Route::get('data-guru/create', [dataGuruController::class, 'create'])->name('admin.dataGuru.create');
    Route::post('data-guru', [dataGuruController::class, 'store'])->name('admin.dataGuru.store');
    Route::get('data-guru/{id}/edit', [DataGuruController::class, 'edit'])->name('admin.dataGuru.edit');
    Route::put('data-guru/{id}', [DataGuruController::class, 'update'])->name('admin.dataGuru.update');
    Route::delete('data-guru/{id}', [DataGuruController::class, 'destroy'])->name('admin.dataGuru.destroy');
    Route::post('data-guru/import', [DataGuruController::class, 'import'])->name('admin.dataGuru.import');


    Route::get('/template', [TemplateController::class, 'index'])->name('template.index');
    Route::get('/template/download/{type}', [TemplateController::class, 'download'])->name('template.download');
});

// Route untuk User, hanya user yang bisa mengakses
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('pribadi', [UserController::class, 'index'])->name('pribadi.index');
    
    Route::get('data', [dataController::class, 'index'])->name('data.index');
    Route::get('data/create', [dataController::class, 'create'])->name('data.create');
    Route::get('/data/{id}', [dataController::class, 'show'])->name('user.data.detail');

    Route::get('surat-keterangan', [skController::class, 'index1'])->name('user.sk.index');
    
    Route::get('bank-soal', [soalController::class, 'index1'])->name('user.soal.index');

Route::get('/change-password', [UserController::class, 'showChangePasswordForm'])->name('password.change');
Route::put('/change-password', [UserController::class, 'changePassword'])->name('password.update');


});

Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');

