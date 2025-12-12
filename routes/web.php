<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RecruiterController;
use App\Http\Controllers\ClientController;

// ======================
// USER ROUTES
// ======================
Route::prefix('users')->group(function () {
    Route::get('/view', [UserController::class, 'index'])->name('users.index');
    Route::get('/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/store', [UserController::class, 'store'])->name('users.store');
});

// ======================
// ADMIN DASHBOARD
// ======================
Route::prefix('admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('adminpannel.dashboard');
    })->name('admin.dashboard');

    // ======================
    // RECRUITER ROUTES
    // ======================
    Route::prefix('recruiters')->group(function () {
        Route::get('/', [RecruiterController::class, 'index'])->name('admin.recruiters');
        Route::get('/edit/{id}', [RecruiterController::class, 'edit'])->name('admin.recruiters.edit');
        Route::put('/update/{id}', [RecruiterController::class, 'update'])->name('admin.recruiters.update');
        Route::delete('/delete/{id}', [RecruiterController::class, 'destroy'])->name('admin.recruiters.delete');
    });

    // ======================
    // CANDIDATE ROUTES
    // ======================
    Route::prefix('candidates')->group(function () {
        Route::get('/add', [CandidateController::class, 'create'])->name('admin.candidates.add');
        Route::post('/store', [CandidateController::class, 'store'])->name('admin.candidates.store');
        Route::get('/', [CandidateController::class, 'index'])->name('admin.candidates');
    });

    // ======================
    // CLIENT ROUTES
    // ======================
    Route::prefix('clients')->group(function() {
        Route::get('/', [ClientController::class, 'index'])->name('admin.clients');        // List clients
        Route::get('/create', [ClientController::class, 'create'])->name('admin.clients.create'); // Add client form
        Route::post('/store', [ClientController::class, 'store'])->name('admin.clients.store');  // Save client
        Route::get('/{id}/edit', [ClientController::class, 'edit'])->name('admin.clients.edit');  // Edit client
        Route::put('/{id}', [ClientController::class, 'update'])->name('admin.clients.update');   // Update client
        Route::delete('/{id}', [ClientController::class, 'destroy'])->name('admin.clients.destroy'); // Delete client
    });
});
