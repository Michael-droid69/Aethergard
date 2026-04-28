<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| All routes that belong to the public part of the site are defined here.
| Auth‑protected routes are wrapped in a middleware group.
*/

/* -----------------------------------------------------------------
 *  PUBLIC ROUTES
 * ----------------------------------------------------------------- */
Route::get('/', fn () => view('welcome'));

/* -----------------------------------------------------------------
 *  AUTH‑PROTECTED ROUTES
 * ----------------------------------------------------------------- */
Route::middleware('auth')->group(function () {

    /* ---- Dashboard ------------------------------------------------ */
    // “verified” is added only here, because the original file used it.
    Route::get('/dashboard', fn () => view('dashboard'))
        ->middleware('verified')
        ->name('dashboard');

    /* ---- Home (list of active borrowings) ------------------------ */
    Route::get('/home', function () {
        $activeBorrowings = auth()->user()
            ->activeBorrowings()
            ->with('equipment')
            ->get();

        return view('home', compact('activeBorrowings'));
    })->name('home');

    /* ---- Equipment ------------------------------------------------ */
    Route::get('/equipment', [EquipmentController::class, 'index'])
        ->name('equipment.index');

    Route::get('/equipment/{category}', [EquipmentController::class, 'category'])
        ->name('equipment.category');

    /* ---- Borrowing actions ---------------------------------------- */
    Route::post('/borrow/{equipment}', [BorrowingController::class, 'borrow'])
        ->name('borrow');

    Route::post('/borrowings/{borrowing}/return', [BorrowingController::class, 'return'])
        ->name('borrowing.return');

    Route::post('/borrowings/{borrowing}/extend', [BorrowingController::class, 'extend'])
        ->name('borrowing.extend');

    Route::get('/borrowings/{borrowing}', [BorrowingController::class, 'show'])
        ->name('borrowing.show');

    /* ---- Profile -------------------------------------------------- */
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    /* ---- Companions (example static page) ----------------------- */
    Route::get('/companions', fn () => view('companions.index'))
        ->name('companions.index');
});

/* -----------------------------------------------------------------
 *  AUTH ROUTES (Laravel Breeze / Jetstream / Fortify, etc.)
 * ----------------------------------------------------------------- */
require __DIR__.'/auth.php';
