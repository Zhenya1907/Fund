<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentImportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/users', [UserController::class, 'index'])->name('users');

Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile/{user}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');


Route::get('/profile/{user}/send-notification', [NotificationController::class, 'index']);
Route::post('/profile/{user}/send-notification', [NotificationController::class, 'sendEmailNotification'])
    ->name('profile.send-notification');



Route::get('/importPayments', [PaymentImportController::class, 'showForm'])->name('importPayments.form');
Route::post('/importPayments', [PaymentImportController::class, 'import'])->name('importPayments');


