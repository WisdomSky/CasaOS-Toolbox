<?php

use App\Http\Controllers\AppsController;
use App\Http\Controllers\PanelsController;
use App\Http\Controllers\SettingsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/apps', [AppsController::class, 'getAppsList']);
Route::post('/app/hide', [AppsController::class, 'hideApp']);

Route::get('/panels', [PanelsController::class, 'getPanelsList']);
Route::post('/panel/update', [PanelsController::class, 'updatePanelVisibility']);

Route::get('/settings', [SettingsController::class, 'getSettings']);
Route::post('/settings/clean', [SettingsController::class, 'cleaner'])->name('settings.clean');
Route::post('/settings', [SettingsController::class, 'saveSettings'])->name('settings.update');
Route::get('/settings/base_url', [SettingsController::class, 'getBaseUrl']);
Route::get('/settings/current_version', [SettingsController::class, 'getCurrentVersion']);
Route::get('/settings/latest_version', [SettingsController::class, 'getLatestVersion']);
