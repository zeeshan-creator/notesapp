<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SharedNotesController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::prefix('notes')->group(function () {
        Route::get('/', [NotesController::class, 'index'])->name('notes.index');
        Route::get('/view/{id}', [NotesController::class, 'show'])->name('notes.show');
        Route::post('/create', [NotesController::class, 'store'])->name('notes.create');
        Route::get('/edit/{id}', [NotesController::class, 'edit'])->name('notes.edit');
        Route::post('/update/{id}', [NotesController::class, 'update'])->name('notes.update');
        Route::get('/delete/{id}', [NotesController::class, 'destroy'])->name('notes.destroy');
    });

    Route::prefix('shared-notes')->group(function () {
        Route::get('/', [SharedNotesController::class, 'index'])->name('shared.notes.index');
        Route::post('/create', [SharedNotesController::class, 'store'])->name('shared.notes.create');
    });

    Route::get('/get-users', [HomeController::class, 'GetUsers'])->name('getusers');

    Route::prefix('')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';
