<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginCon;
use App\Http\Controllers\DashboardCon;
use App\Http\Controllers\RegisterCon;
use App\Http\Controllers\UserCon;
use App\Http\Controllers\ProdukCon;
use App\Http\Controllers\PembelianCon;
use Inertia\Inertia;

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

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/produk', function () {
    return view('produk');
});

Route::get('/pembelian', function () {
    return view('pembelian');
});




Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', [produkCon::class, 'home'])->name('homeproduk');

Route::get('/login', [LoginCon::class, 'login'])->name('login');
Route::post('actionlogin', [LoginCon::class, 'actionlogin'])->name('actionlogin');
Route::get('dashboard', [DashboardCon::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('actionlogout', [LoginCon::class, 'actionlogout'])->name('actionlogout')->middleware('auth');
Route::get('register', [RegisterCon::class, 'register'])->name('register');
Route::post('register/action', [RegisterCon::class, 'actionregister'])->name('actionregister');

Route::get('/user/tampil', [UserCon::class, 'index'])->name('indexUser')->middleware('auth');
Route::get('/user/input', [UserCon::class, 'input'])->name('inputUser')->middleware('auth');
Route::post('/user/storeinput', [UserCon::class, 'storeinput'])->name('storeInputUser')->middleware('auth');
Route::get('/user/update/{id}', [UserCon::class, 'update'])->name('updateUser')->middleware('auth');
Route::post('/user/storeupdate', [UserCon::class, 'storeupdate'])->name('storeUpdateUser')->middleware('auth');
Route::get('/user/delete/{id}', [UserCon::class, 'delete'])->name('deleteUser')->middleware('auth');

Route::get('/produk/tampil', [produkCon::class, 'index'])->name('indexproduk')->middleware('auth');
Route::get('/produk/input', [produkCon::class, 'input'])->name('inputproduk')->middleware('auth');
Route::post('/produk/storeinput', [produkCon::class, 'storeinput'])->name('storeInputproduk')->middleware('auth');
Route::get('/produk/update/{id}', [produkCon::class, 'update'])->name('updateproduk')->middleware('auth');
Route::post('/produk/storeupdate', [produkCon::class, 'storeupdate'])->name('storeUpdateproduk')->middleware('auth');
Route::get('/produk/delete/{id}', [produkCon::class, 'delete'])->name('deleteproduk')->middleware('auth');
Route::get('/produk/upload', [produkCon::class, 'upload'])->name('upload')->middleware('auth');
Route::post('/produk/uploadproses', [produkCon::class, 'uploadproses'])->name('uploadproses')->middleware('auth');

Route::get('/pembelian/tampil', [pembelianCon::class, 'index'])->name('indexpembelian')->middleware('auth');
Route::get('/pembelian/input', [pembelianCon::class, 'input'])->name('inputpembelian')->middleware('auth');
Route::post('/pembelian/storeinput', [pembelianCon::class, 'storeinput'])->name('storeInputpembelian')->middleware('auth');
Route::get('/pembelian/update/{id}', [pembelianCon::class, 'update'])->name('updatepembelian')->middleware('auth');
Route::post('/pembelian/storeupdate', [pembelianCon::class, 'storeupdate'])->name('storeUpdatepembelian')->middleware('auth');
Route::get('/pembelian/delete/{id}', [pembelianCon::class, 'delete'])->name('deletepembelian')->middleware('auth');