<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\pages\HomePage;
use App\Http\Controllers\pages\Page2;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\pages\MentorshipApplications;
use App\Http\Controllers\api\MoodleController;

// locale
Route::get('/lang/{locale}', [LanguageController::class, 'swap']);
Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');

// authentication
Route::get('/auth/login', [Login::class, 'index'])->name('auth-login');
Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/mentorship/applications', [MentorshipApplications::class, 'index'])->name('mentorship-applications');
    Route::get('/mentorship/applications/{id}', [MentorshipApplications::class, 'show'])->name('mentorship-view-application');

    Route::post('/moodle/enroll/{id}', [MoodleController::class, 'enroll'])->name('moodle.enroll');
});
