<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CppController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SignatureController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CompteurgazController;
use App\Http\Controllers\CompteurelecController;
use App\Http\Controllers\CahierchargeController;

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

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', function () {
        return view('dashboard');
    })
    ->name('dashboard');

Route::prefix('/')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('users', UserController::class);
        Route::resource('compteurelecs', CompteurelecController::class);
        Route::resource('compteurgazs', CompteurgazController::class);
        Route::resource('contacts', ContactController::class);
        Route::resource('scores', ScoreController::class);
        Route::resource('sites', SiteController::class);
        Route::resource('cahiercharges', CahierchargeController::class);
        Route::resource('signatures', SignatureController::class);
        Route::resource('cpps', CppController::class);
        Route::resource('entreprises', EntrepriseController::class);
    });
