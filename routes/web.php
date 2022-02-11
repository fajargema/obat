<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MedicineController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('cari-obat', [MedicineController::class, 'cariObat'])->name('cari.obat')->middleware('auth');

Route::middleware(['auth:sanctum', 'verified'])->name('admin-page.')->prefix('admin-page')->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('index');

        Route::resource('category', CategoryController::class);
        Route::resource('user', UserController::class);

        Route::resource('medicine', MedicineController::class);
        Route::get('/tambah-stok', [MedicineController::class, 'tambahStok'])->name('medicine.tambah');
        Route::post('/tambah-stok', [MedicineController::class, 'simpan'])->name('medicine.tambah-stok');
        Route::post('/import-obat', [MedicineController::class, 'importExcel'])->name('medicine.import-obat');

        Route::resource('transaction', TransactionController::class);
        Route::get('/cari-transaksi', [TransactionController::class, 'cariTransaksi'])->name('transaction.cari');
        Route::post('/laporan-transaksi', [TransactionController::class, 'reportFind'])->name('transaction.laporan');
        Route::post('/laporan-transaksi/excel', [TransactionController::class, 'reportExcel'])->name('transaction.report-excel');
        Route::post('/laporan-transaksi/pdf', [TransactionController::class, 'reportPDF'])->name('transaction.report-pdf');
        Route::post('/laporan-transaksi/print-pdf', [TransactionController::class, 'reportPrintPDF'])->name('transaction.report-print-pdf');
    });
});

Route::middleware(['auth:sanctum', 'verified'])->name('pegawai.')->prefix('pegawai')->group(function () {
    Route::middleware(['user'])->group(function () {
        Route::get('/', [App\Http\Controllers\User\DashboardController::class, 'index'])->name('index');

        Route::get('/stok-obat', [App\Http\Controllers\User\MedicineController::class, 'index'])->name('obat.stok');
        Route::get('/tambah', [App\Http\Controllers\User\MedicineController::class, 'tambah'])->name('obat.tambah');
        Route::post('/tambah-stok', [App\Http\Controllers\User\MedicineController::class, 'simpan'])->name('obat.tambah-stok');

        Route::resource('transaction', App\Http\Controllers\User\TransactionController::class);
    });
});
