<?php

use App\Http\Controllers\Student\TimetableController;
use App\Http\Controllers\Teacher\TimetableController as TeacherTimetable;
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

Route::view('/', 'welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::middleware('role:student')
        ->prefix('student')
        ->name('student.')
        ->group(function () {
            Route::get('timetable', [TimetableController::class, 'index'])->name('timetable');
        });

    Route::middleware('role:teacher')
        ->prefix('teacher')
        ->name('teacher.')
        ->group(function () {
            Route::get('timetable', [TeacherTimetable::class, 'index'])->name('timetable');
        });

        
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
