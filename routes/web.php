<?php

use App\Http\Controllers\BasicController;
use App\Http\Controllers\WaktuController;
use App\Http\Controllers\JamController;
use App\Http\Controllers\RuanganController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\AdminController;
use App\Models\Dosen;
use App\Http\Controllers\Auth\LoginController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\HariController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SchedulerController;
use App\Http\Controllers\HomeController;

Route::post('/scheduler', [SchedulerController::class, 'store'])->name('scheduler.store');
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

Route::resource('jam', JamController::class);


Route::middleware(['auth', 'isSuperAdmin'])->group(function () {
    // Rute-rute yang hanya bisa diakses oleh Super Admin
    Route::resource('basic', BasicController::class);
});

Route::post('/users', [BasicController::class, 'store'])->name('basic.store');
Route::resource('basic', BasicController::class)->middleware('auth');

Route::delete('/jadwal/delete-all', [JadwalController::class, 'deleteAll'])
    ->middleware(['auth']) // Sesuaikan middleware jika perlu
    ->name('jadwal.deleteAll');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('matakuliah', MatakuliahController::class);
    Route::resource('ruangan', RuanganController::class);
    Route::resource('dosen', DosenController::class);
    Route::resource('periode', PeriodeController::class);
    Route::resource('jadwal', JadwalController::class);
    Route::resource('hari', HariController::class);
    Route::resource('jam', JamController::class);
    Route::resource('scheduler', SchedulerController::class);
});
// Route::middleware(['auth', 'role:Super Admin'])->group(function () {
//     Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
// });
Route::post('/admin/store', [BasicController::class, 'store'])->name('admin.store');

// Route yang hanya bisa diakses oleh Super Admin
Route::middleware(['auth', 'isSuperAdmin'])->group(function() {
    // Route untuk mengelola pengguna (Hanya Super Admin yang bisa mengakses)
    Route::resource('basic.index', BasicController::class);

});
// Route yang hanya bisa diakses oleh Admin
Route::middleware(['auth', 'isAdmin'])->group(function() {
    // Route untuk mengelola admin dan menu lainnya

});
// Mendefinisikan rute untuk menampilkan jadwal (index)');

Route::get('/schedule', [SchedulerController::class, 'schedule'])->name('schedule');

// Pastikan rute mengarah ke method yang benar di controller
Route::get('/scheduler', [SchedulerController::class, 'index'])->name('scheduler.index');

Route::get('/scheduler', [SchedulerController::class, 'schedule'])->name('scheduler.index');

Route::resource('/jadwal', JadwalController::class);
Route::delete('/jadwal/delete-all', [JadwalController::class, 'deleteAll'])->name('jadwal.deleteAll');


Route::resource('hari', HariController::class);


Route::resource('periode', PeriodeController::class);


Route::get('/', function () {
    return view('welcome');
});

Route::controller(RuanganController::class)->prefix('ruangan')->group(function(){
    Route::get('', 'index')->name('ruangan');
});

// Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');

Route::controller(MatakuliahController::class)->prefix('matakuliah')->group(function() {
    Route::get('', 'index')->name('matakuliah');
});

Route::controller(MatakuliahController::class)->prefix('jam')->group(function() {
    Route::get('', 'index')->name('jam');
});

// JAM
Route::get('/jam', [JamController::class, 'index'])->name('jam.index');
Route::get('/jam/create', [JamController::class, 'create'])->name('jam.create');
Route::post('/jam/store', [JamController::class, 'store'])->name('jam.store');
Route::get('/jam/{id}/edit', [JamController::class, 'edit'])->name('jam.edit');
Route::delete('/jam/{id}', [JamController::class, 'destroy'])->name('jam.destroy');
Route::put('/jam/{id}', [JamController::class, 'update'])->name('jam.update');

// Route::resource('datajadwal', DataJadwalController::class);


// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/blank', 'BlankController@index')->name('blank');
// Route::get('/ruangan', 'RuanganController@index')->name('ruangan.index');
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

// UNTUK DOSEN
Route::get('/dosen/create', [DosenController::class, 'create'])->name('dosen.create');
Route::post('/dosen', [DosenController::class, 'store'])->name('dosen.store');
Route::get('/dosen/{id}/edit', [DosenController::class, 'edit'])->name('dosen.edit');
Route::put('/dosen/{id}', [DosenController::class, 'update'])->name('dosen.update');

// HARI
Route::get('/hari', [HariController::class, 'index'])->name('hari.index');
Route::get('/hari/create', [HariController::class, 'create'])->name('hari.create');
Route::post('/hari', [HariController::class, 'store'])->name('hari.store');
Route::get('/hari/{id}/edit', [HariController::class, 'edit'])->name('hari.edit');
Route::put('/hari/{id}', [HariController::class, 'update'])->name('hari.update');
Route::delete('/hari/{id}', [HariController::class, 'destroy'])->name('hari.destroy');


//jadwal
// routes/web.php
Route::get('/jadwal', 'JadwalController@index')->name('jadwal.index');

// untuk matakuliah
Route::post('/matakuliah', [MatakuliahController::class, 'store'])->name('matakuliah.store');
Route::get('/matakuliah/{id}/edit', [MatakuliahController::class, 'edit'])->name('matakuliah.edit');
Route::put('/matakuliah/{id}', [MatakuliahController::class, 'update'])->name('matakuliah.update');
Route::delete('/matakuliah/{id}', [MatakuliahController::class, 'destroy'])->name('matakuliah.destroy');





Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/blank', function () {
    return view('blank');
})->name('blank');

Route::middleware('auth')->group(function() {
    Route::resource('basic', BasicController::class);
    Route::resource('ruangan', RuanganController::class);
    Route::resource('matakuliah', MatakuliahController::class);
    Route::resource('dosen', DosenController::class);
    Route::resource('jams', JamController::class);
    
});
Route::post('/logout', function () {
    Auth::logout(); // Logout user
    return redirect('/login'); // Redirect ke halaman login
})->name('logout');


// Route untuk menampilkan halaman edit pengguna
Route::get('basic/{user}/edit', [BasicController::class, 'edit'])->name('edit.basic');
Route::put('basic/{user}', [BasicController::class, 'update'])->name('basic.update');
Route::get('/basic/{user}/edit', [BasicController::class, 'edit'])->name('basic.edit');


// Route untuk melihat daftar pengguna
// Route::get('basic', [BasicController::class, 'index'])->name('basic.index');

// Route untuk membuat pengguna baru
// Route::get('basic/create', [BasicController::class, 'create'])->name('basic.create');
// Route::post('basic', [BasicController::class, 'store'])->name('basic.store');

// Route untuk mengedit pengguna
Route::get('basic/{basic}/edit', [BasicController::class, 'edit'])->name('edit.basic');
Route::put('basic/{basic}', [BasicController::class, 'update'])->name('basic.update');

// Route untuk menghapus pengguna
Route::delete('basic/{basic}', [BasicController::class, 'destroy'])->name('basic.destroy');
Route::delete('user/{user}', [BasicController::class, 'destroy'])->name('basic.destroy');

// Route untuk menghapus user
Route::delete('basic/{user}', [BasicController::class, 'destroy'])->name('basic.destroy');

// Route::middleware(['auth', 'role:superadmin'])->group(function () {
//     Route::get('/user', [BasicController::class, 'index'])->name('basic.index');
// });
Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/users', [BasicController::class, 'index'])->name('basic');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');
    // Tambahkan route lainnya untuk admin
});
Route::middleware(['auth'])->group(function () {
    Route::get('/user', [BasicController::class, 'index'])->name('basic.index');
});

Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/basic', [BasicController::class, 'index'])->name('basic.index');
});

Route::resource('basic', BasicController::class)->except(['show']);



Route::middleware(['auth'])->group(function () {
    Route::resource('waktu', WaktuController::class);
});

Route::get('/export-schedule', [SchedulerController::class, 'exportToExcel'])->name('export.schedule');

// Route::get('/export-excel', [SchedulerController::class, 'exportToExcel'])->name('export.excel');
// Route::get('/export-jadwal', [SchedulerController::class, 'exportToExcel'])->name('export.jadwal');
Route::get('export-schedule', [SchedulerController::class, 'exportToExcel'])->name('scheduler.export');
Route::get('export-schedule-pdf', [SchedulerController::class, 'exportToPdf'])->name('scheduler.export.pdf');