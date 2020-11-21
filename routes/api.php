<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Compant
Route::get('/company-update-delete',[\App\Http\Controllers\ApiController::class, 'updateDeletePage'])->name('company.updateDelete');
Route::post('/company-add',[\App\Http\Controllers\ApiController::class, 'addCompany']);
Route::get('/company-data/{id}',[\App\Http\Controllers\ApiController::class, 'getCompanyData']);
Route::post('/delete-adress',[\App\Http\Controllers\ApiController::class, 'deleteAdress']);
Route::post('/company-update',[\App\Http\Controllers\ApiController::class, 'companyUpdate']);
Route::post('/company-delete',[\App\Http\Controllers\ApiController::class, 'deleteCompany']);








// Personel
Route::get('/personel-add',[\App\Http\Controllers\ApiController::class, 'getPersonelAdd']);
Route::post('/personel-add',[\App\Http\Controllers\ApiController::class, 'postPersonelAdd']);
Route::get('/personel-update-delete',[\App\Http\Controllers\ApiController::class, 'getPersonelUpdateDelete']);
Route::get('/personel-delete/{id}',[\App\Http\Controllers\ApiController::class, 'personelDelete']);
Route::get('/personel-data/{id}',[\App\Http\Controllers\ApiController::class, 'personelData']);
Route::post('/update-personel',[\App\Http\Controllers\ApiController::class, 'personelUpdate']);


