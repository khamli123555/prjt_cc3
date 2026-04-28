<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AppointmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/lang/{locale}', function ($locale) {
    abort_unless(in_array($locale, ['en', 'fr', 'ar'], true), 404);
    session(['locale' => $locale]);
    return back();
})->name('locale.switch');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/appointments/search', [AppointmentController::class, 'search'])->name('appointments.search');
    Route::resource('appointments', AppointmentController::class)->except('show');
});
Route::get('doctors', [App\Http\Controllers\DoctorController::class, 'index'])->name('doctors.index');
Route::get('patients', [App\Http\Controllers\PatientController::class, 'index'])->name('patients.index');
Route::get('patients/{user}/history', [App\Http\Controllers\PatientController::class, 'history'])->name('patients.history');
require __DIR__.'/auth.php';

require __DIR__.'/auth.php';
