<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CetakController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\TukangController;
use App\Models\Production;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('auth/login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->resource('/admin', AdminController::class);
Route::middleware(['auth'])->resource('/tukang', TukangController::class);
Route::middleware(['auth'])->resource('/client', ClientController::class);
Route::middleware(['auth'])->resource('/bahan', ToolController::class);
Route::middleware(['auth'])->resource('/production', ProductionController::class);
Route::middleware(['auth'])->resource('/payment', PaymentController::class);
Route::middleware(['auth'])->resource('/cetak', CetakController::class);
Route::get('order/{id}', [LinkController::class, 'show'])->name('order');

Route::get('error', [ErrorController::class, 'error404'])->middleware(['auth'])->name('error.404');

Route::get('preview/{id}', [CetakController::class, 'preview'])->middleware(['auth'])->name('cetak.preview');
Route::get('print/{id}', [CetakController::class, 'print'])->middleware(['auth'])->name('cetak.print');

Route::get('bayar/{id}', [PaymentController::class, 'bayar'])->middleware(['auth'])->name('payment.bayar');
Route::post('bayarStore/{id}', [PaymentController::class, 'bayarStore'])->middleware(['auth'])->name('payment.store');
Route::get('/history', [PaymentController::class, 'history'])->middleware(['auth'])->name('payment.history');


Route::get('/dashboard', DashboardController::class)->middleware(['auth'])->name('dashboard');
Route::get('/bahan-habis', [ToolController::class, 'bahanHabis'])->middleware(['auth'])->name('bahan.habis');

Route::get('/proses-tukang', [ProductionController::class, 'prosesTukang'])->middleware(['auth'])->name('production.prosesTukang');
Route::get('/proses', [ProductionController::class, 'proses'])->middleware(['auth'])->name('production.proses');
Route::post('ubah-proses/{id}', [ProductionController::class, 'ubahProses'])->middleware(['auth'])->name('production.ubah-proses');
Route::post('pindah-proses/{id}', [ProductionController::class, 'ubahProsesTukang'])->middleware(['auth'])->name('production.pindah-proses');
Route::get('production-tool/{id}', [ProductionController::class, 'productionTool'])->middleware(['auth'])->name('production.tool');
Route::get('production-user/{id}', [ProductionController::class, 'productionUser'])->middleware(['auth'])->name('production.user');
//Route::post('tambah-bahan/{id}', [ProductionController::class, 'tambahBahan'])->middleware(['auth'])->name('tambah.bahan');
Route::match(['get', 'post'], 'tambah-tukang/{production_id}/{tukang_id}', [ProductionController::class, 'tambahTukang'])->middleware(['auth'])->name('tambah.tukang');
Route::match(['get', 'post'], 'tambah-bahan/{production_id}/{bahan_id}', [ProductionController::class, 'tambahBahan'])->middleware(['auth'])->name('tambah.bahan');
Route::get('production-user/{id}', [ProductionController::class, 'productionUser'])->middleware(['auth'])->name('production.user');
Route::post('submit-bahan/{id}', [ProductionController::class, 'submitBahan'])->middleware(['auth'])->name('submit.bahan');
Route::post('submit-user/{id}', [ProductionController::class, 'submitUser'])->middleware(['auth'])->name('submit.user');

Route::get('/profile', [ProfileController::class, 'profile'])->middleware(['auth'])->name('profile');
Route::post('/profile', [ProfileController::class, 'change_profile'])->middleware(['auth'])->name('profile.change');
Route::get('/change-password', [ProfileController::class, 'password'])->middleware(['auth'])->name('change_password');
Route::post('/change-password', [ProfileController::class, 'change_password'])->middleware(['auth'])->name('change-password.change');



Route::match(['get', 'delete'], 'delete-bahan/{production_id}/{production_tool_id}', [ProductionController::class, 'deleteBahan'])->middleware(['auth'])->name('production-tool.destroy');
Route::match(['get', 'delete'], 'delete-user/{production_id}/{production_user_id}', [ProductionController::class, 'deleteUser'])->middleware(['auth'])->name('production-user.destroy');
Route::delete('admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
Route::delete('tukang/{id}', [TukangController::class, 'destroy'])->name('tukang.destroy');
Route::delete('client/{id}', [ClientController::class, 'destroy'])->name('client.destroy');
Route::delete('bahan/{id}', [ToolController::class, 'destroy'])->name('bahan.destroy');
Route::delete('production/{id}', [ProductionController::class, 'destroy'])->name('production.destroy');
Route::delete('payment/{id}', [PaymentController::class, 'destroy'])->name('payment.destroy');


require __DIR__ . '/auth.php';
