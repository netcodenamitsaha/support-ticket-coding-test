<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\TicketController;

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

Route::resource('users', UserController::class)->only(['index', 'update']);
Route::resource('tickets', TicketController::class)->only(['index', 'create', 'store']);
Route::resource('responses', ResponseController::class)->only(['index', 'store']);

Route::get('update-admin/{id}/{status}', [UserController::class, 'update'])->name('makeAdmin');
Route::get('close-ticket/{id}', [TicketController::class, 'closeTicket'])->name('closeTicket');
Route::get('responses/create/{ticket}', [ResponseController::class, 'create'])->name('createResponse');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
