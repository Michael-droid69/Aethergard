<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EquipmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth']);
Route::get('/equipment', [App\Http\Controllers\EquipmentController::class, 'index'])
    ->middleware(['auth']);
Route::get('/equipment', [EquipmentController::class, 'index'])->middleware(['auth']);
Route::get('/equipment/{category}', [EquipmentController::class, 'category'])->middleware(['auth']);
Route::get('/home', function () {
    return view('home');
})->middleware(['auth']);
Route::get('/companions', function () {
    return view('companions.index');
})->middleware(['auth']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
