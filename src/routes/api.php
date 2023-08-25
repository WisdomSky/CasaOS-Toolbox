<?php

use App\Http\Controllers\AppsController;
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

Route::get('/settings', [SettingsController::class, 'getSettings']);
Route::post('/settings', [SettingsController::class, 'saveSettings']);
Route::get('/settings/base_url', [SettingsController::class, 'getBaseUrl']);
Route::get('/settings/current_version', [SettingsController::class, 'getCurrentVersion']);
