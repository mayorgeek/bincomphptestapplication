<?php

use App\Http\Controllers\PollingUnitController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
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

//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});

Route::get('/', [PollingUnitController::class, 'index'])->name('polling_unit.index');
Route::get('/polling-unit/{uniqueid}/results', [PollingUnitController::class, 'show'])->name('polling_unit.show');
Route::get('/polling-unit/create', [PollingUnitController::class, 'create'])->name('polling_unit.create');
Route::post('/polling-unit', [PollingUnitController::class, 'store'])->name('polling_unit.store');
Route::get('/total-lga-results', [PollingUnitController::class, 'sumOfPollingUnitResults'])->name('polling_unit.sumOfPollingUnitResults');
Route::post('/total-lga-results', [PollingUnitController::class, 'sumOfPollingUnitResults'])->name('polling_unit.sumOfPollingUnitResults');



Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
