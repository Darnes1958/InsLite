<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/createmains', function () {
        return view('backend.createmain');
    })->name('createmains');
    Route::get('/createbanks', function () {
        return view('backend.createbank');
    })->name('createbanks');
  Route::get('/inpkst', function () {
    return view('backend.Aksat.inpkst');
  })->name('inpkst');
  Route::get('/reports/{rep}', function () {
    return view('backend.reports')->with(['rep']);
  })->name('reports');
});

Route::controller(PdfController::class)->group(function (){
  route::get('/pdfbanksum/{By}', 'PdfBankSum')->name('pdfbanksum') ;
});

