<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChismeController;
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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/chismes', [ChismeController::class, 'index'])->name('chismes');
    Route::get('/chismes/form', [ChismeController::class, 'create'])->name('chismes.create');
    Route::post('/chismes', [ChismeController::class, 'store'])->name('chismes.store');
    Route::get('/chismes/{id}', [ChismeController::class, 'show'])->name('chismes.show');
    Route::post('/chismes/comments', [ChismeController::class, 'comment'])->name('chismes.comments.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
