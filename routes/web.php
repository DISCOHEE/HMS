<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
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


Route::get('/', [HomeController::class, 'index']);


Route::get('/home', [HomeController::class, 'redirect'])->middleware('auth','verified');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/add_doctor_view', [AdminController::class, 'addview']);

Route::post('/upload_doctor', [AdminController::class, 'upload']);

Route::post('/appointment', [HomeController::class, 'appointment']);

Route::get('/myappointment', [HomeController::class, 'myappointment']);

Route::get('/cancel_appoint/{id}', [HomeController::class, 'cancel_appoint']);

Route::get('/showappointment', [AdminController::class, 'showappointment']);

Route::get('/approved/{id}', [AdminController::class, 'approved']);

Route::get('/cancelled/{id}', [AdminController::class, 'cancelled']);

Route::get('/showdoctor', [AdminController::class, 'showdoctor']);

Route::get('/delete_doctor/{id}', [AdminController::class, 'delete_doctor']);

Route::get('/updatedoctor/{id}', [AdminController::class, 'updatedoctor']);

Route::post('/editdoctor/{id}', [AdminController::class, 'editdoctor']);

Route::get('/emailview/{id}', [AdminController::class, 'emailview']);

Route::post('/sendemail/{id}', [AdminController::class, 'sendemail']);

Route::get('/add_staff', [AdminController::class, 'add_staff']);

Route::post('/upload_staff', [AdminController::class, 'upload_staff']);

Route::get('/show_staff', [AdminController::class, 'show_staff']);

Route::get('/delete_staff/{id}', [AdminController::class, 'delete_staff']);

Route::get('/updatestaff/{id}', [AdminController::class, 'updatestaff']);

Route::post('/editstaff/{id}', [AdminController::class, 'editstaff']);