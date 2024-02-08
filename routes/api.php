<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CppController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SiteController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\ScoreController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\SignatureController;
use App\Http\Controllers\Api\EntrepriseController;
use App\Http\Controllers\Api\HistoriqueController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\CompteurgazController;
use App\Http\Controllers\Api\ContactCppsController;
use App\Http\Controllers\Api\CompteurelecController;
use App\Http\Controllers\Api\SiteContactsController;
use App\Http\Controllers\Api\CahierchargeController;
use App\Http\Controllers\Api\UserEntreprisesController;
use App\Http\Controllers\Api\UserHistoriquesController;
use App\Http\Controllers\Api\EntrepriseSitesController;
use App\Http\Controllers\Api\EntrepriseScoresController;
use App\Http\Controllers\Api\SiteCompteurgazsController;
use App\Http\Controllers\Api\ContactSignaturesController;
use App\Http\Controllers\Api\SiteCompteurelecsController;
use App\Http\Controllers\Api\SiteCahierchargesController;
use App\Http\Controllers\Api\EntrepriseHistoriquesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('users', UserController::class);

        // User Entreprises
        Route::get('/users/{user}/entreprises', [
            UserEntreprisesController::class,
            'index',
        ])->name('users.entreprises.index');
        Route::post('/users/{user}/entreprises', [
            UserEntreprisesController::class,
            'store',
        ])->name('users.entreprises.store');

        // User Historiques
        Route::get('/users/{user}/historiques', [
            UserHistoriquesController::class,
            'index',
        ])->name('users.historiques.index');
        Route::post('/users/{user}/historiques', [
            UserHistoriquesController::class,
            'store',
        ])->name('users.historiques.store');

        Route::apiResource('compteurelecs', CompteurelecController::class);

        Route::apiResource('compteurgazs', CompteurgazController::class);

        Route::apiResource('contacts', ContactController::class);

        // Contact Cpps
        Route::get('/contacts/{contact}/cpps', [
            ContactCppsController::class,
            'index',
        ])->name('contacts.cpps.index');
        Route::post('/contacts/{contact}/cpps', [
            ContactCppsController::class,
            'store',
        ])->name('contacts.cpps.store');

        // Contact Signatures
        Route::get('/contacts/{contact}/signatures', [
            ContactSignaturesController::class,
            'index',
        ])->name('contacts.signatures.index');
        Route::post('/contacts/{contact}/signatures', [
            ContactSignaturesController::class,
            'store',
        ])->name('contacts.signatures.store');

        Route::apiResource('scores', ScoreController::class);

        Route::apiResource('sites', SiteController::class);

        // Site Contacts
        Route::get('/sites/{site}/contacts', [
            SiteContactsController::class,
            'index',
        ])->name('sites.contacts.index');
        Route::post('/sites/{site}/contacts', [
            SiteContactsController::class,
            'store',
        ])->name('sites.contacts.store');

        // Site Compteurelecs
        Route::get('/sites/{site}/compteurelecs', [
            SiteCompteurelecsController::class,
            'index',
        ])->name('sites.compteurelecs.index');
        Route::post('/sites/{site}/compteurelecs', [
            SiteCompteurelecsController::class,
            'store',
        ])->name('sites.compteurelecs.store');

        // Site Compteurgazs
        Route::get('/sites/{site}/compteurgazs', [
            SiteCompteurgazsController::class,
            'index',
        ])->name('sites.compteurgazs.index');
        Route::post('/sites/{site}/compteurgazs', [
            SiteCompteurgazsController::class,
            'store',
        ])->name('sites.compteurgazs.store');

        // Site Cahiercharges
        Route::get('/sites/{site}/cahiercharges', [
            SiteCahierchargesController::class,
            'index',
        ])->name('sites.cahiercharges.index');
        Route::post('/sites/{site}/cahiercharges', [
            SiteCahierchargesController::class,
            'store',
        ])->name('sites.cahiercharges.store');

        Route::apiResource('cahiercharges', CahierchargeController::class);

        Route::apiResource('signatures', SignatureController::class);

        Route::apiResource('cpps', CppController::class);

        Route::apiResource('entreprises', EntrepriseController::class);

        // Entreprise Sites
        Route::get('/entreprises/{entreprise}/sites', [
            EntrepriseSitesController::class,
            'index',
        ])->name('entreprises.sites.index');
        Route::post('/entreprises/{entreprise}/sites', [
            EntrepriseSitesController::class,
            'store',
        ])->name('entreprises.sites.store');

        // Entreprise Scores
        Route::get('/entreprises/{entreprise}/scores', [
            EntrepriseScoresController::class,
            'index',
        ])->name('entreprises.scores.index');
        Route::post('/entreprises/{entreprise}/scores', [
            EntrepriseScoresController::class,
            'store',
        ])->name('entreprises.scores.store');

        // Entreprise Historiques
        Route::get('/entreprises/{entreprise}/historiques', [
            EntrepriseHistoriquesController::class,
            'index',
        ])->name('entreprises.historiques.index');
        Route::post('/entreprises/{entreprise}/historiques', [
            EntrepriseHistoriquesController::class,
            'store',
        ])->name('entreprises.historiques.store');
    });
