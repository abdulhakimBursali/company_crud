<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PersonelController;

// Company Routes
Route::get('/', function () {  return view('add_new_company'); })->name('company.add');
Route::get('/company-add', function () {  return view('add_new_company'); })->name('company.add');
Route::post('/company-add',[CompanyController::class, 'addCompany'])->name('company.post.add');
Route::post('/company-update',[CompanyController::class, 'updateCompanyData'])->name('company.update');
Route::post('/company-adress-delete',[CompanyController::class, 'deleteAdress'])->name('company.adressDelete');
Route::post('/company-delete',[CompanyController::class, 'deleteCompany'])->name('company.delete');
Route::get('/company-update-delete',[CompanyController::class, 'updateDeletePage'])->name('company.updateDelete');
Route::get('/company-update/{id}',[CompanyController::class, 'updatePage'])->name('company.updatePage');

// Personel Routes
Route::get('/personel-add', [PersonelController::class, 'personelAddPage'])->name('personel.add');
Route::post('/personel-add', [PersonelController::class, 'personelAdd'])->name('personel.post.add');
Route::get('/personel-update-delete', [PersonelController::class, 'personelUpdateDelete'])->name('personel.updateDelete');
Route::post('/personel-delete', [PersonelController::class, 'personelDelete'])->name('personel.delete');
Route::get('/personel-update/{id}', [PersonelController::class, 'personelUpdatePage'])->name('personel.updatePage');
Route::post('/personel-update', [PersonelController::class, 'personelUpdate'])->name('personel.update');




