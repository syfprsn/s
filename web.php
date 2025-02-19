<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/', function (){
    return view('auth.login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])-> name('login');
Route::post('/login', [AuthController::class, 'login'])-> name('login.post');

Route::get('/logout', [AuthController::class, 'logout'])-> name('logout');

Route::get('/register', [AuthController::class, 'showregisterForm'])-> name('register');
Route::post('/register', [AuthController::class, 'login'])-> name('register.post');

Route::middleware(['auth'])->group(function() {
    Route::get('/user', [UserController::class, 'index'])->name('user.index');

    Route::get('/admins', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas.index');

    // // route crud buku
    // Route::get('/adminss', [BukuController::class, 'index'])-> name('admin.buku'); // menampilkan daftar buku
    // Route::get('/buku/creatte', [BukuController::class, 'create'])-> name('buku.create'); // form tambah buku
    // Route::post('/buku', [BukuController::class, 'store'])-> name('buku.store'); // simpan buku baru

    // Route::get('/buku/{id}/edit', [BukuController::class, 'edit'])-> name('buku.edit'); // form edit buku
    // Route::put('/buku/{id}', [BukuController::class, 'update'])-> name('buku.update'); // update data buku

    // Route::delete('/buku/{id}', [BukuController::class, 'destroy'])-> name('buku.destroy'); // hapus buku
});
