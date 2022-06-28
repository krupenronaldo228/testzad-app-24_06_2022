<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});

Route::get('/get-catalogs', [ApiController::class, 'getCatalogs'])->name('get-catalogs');
Route::post('/create-catalog', [ApiController::class, 'createCatalog'])->name('create-catalog');
Route::put('/update-catalog', [ApiController::class, 'updateCatalog'])->name('update-catalog');
Route::delete('/delete-catalog', [ApiController::class, 'deleteCatalog'])->name('delete-catalog');


