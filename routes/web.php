<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkshopController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});


Route::get('/showcase', [WorkshopController::class, 'showcase'])->name('public.showcase');

Route::get('/details/{id}', [WorkshopController::class, 'show'])->name('public.details');

Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');


Route::middleware(['auth', 'verified'])->group(function () {


    Route::get('/dashboard', [WorkshopController::class, 'index'])->name('dashboard');

    Route::prefix('workshops')->name('workshops.')->group(function () {
        Route::post('/', [WorkshopController::class, 'store'])->name('store');
        Route::put('/{workshop}', [WorkshopController::class, 'update'])->name('update');
        Route::delete('/{workshop}', [WorkshopController::class, 'destroy'])->name('destroy');
    });


    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

  
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
