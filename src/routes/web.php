<?php

use App\Http\Controllers\AssetGeneratorController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\HasUser;
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

Route::get('/', function () {
    return Inertia::render('Dashboard', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->middleware(['auth', 'verified'])->middleware(HasUser::class);

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/apphider', function () {
    return Inertia::render('AppHider');
})->middleware(['auth', 'verified'])->name('apphider');

Route::get('/apphider', function () {
    return Inertia::render('AppHider');
})->middleware(['auth', 'verified'])->name('apphider');

Route::get('/panelhider', function () {
    return Inertia::render('PanelHider');
})->middleware(['auth', 'verified'])->name('panelhider');

Route::get('/casaos-toolbox.css', [AssetGeneratorController::class, 'getCSS']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
