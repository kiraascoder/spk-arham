<?php

use App\Http\Controllers\Admin\CriterionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TrainingSampleController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\ClassificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\DashboardController as UserDashboardController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/criteria', [CriterionController::class, 'index'])->name('criteria.index');
    Route::get('/criteria/create', [CriterionController::class, 'create'])->name('criteria.create');
    Route::post('/criteria', [CriterionController::class, 'store'])->name('criteria.store');
    Route::get('/criteria/{criterion}/edit', [CriterionController::class, 'edit'])->name('criteria.edit');
    Route::put('/criteria/{criterion}', [CriterionController::class, 'update'])->name('criteria.update');
    Route::delete('/criteria/{criterion}', [CriterionController::class, 'destroy'])->name('criteria.destroy');

    Route::get('/training', [TrainingSampleController::class, 'index'])->name('training.index');
    Route::get('/training/create', [TrainingSampleController::class, 'create'])->name('training.create');
    Route::post('/training', [TrainingSampleController::class, 'store'])->name('training.store');
    Route::get('/training/{trainingSample}/edit', [TrainingSampleController::class, 'edit'])->name('training.edit');
    Route::put('/training/{trainingSample}', [TrainingSampleController::class, 'update'])->name('training.update');
    Route::delete('/training/{trainingSample}', [TrainingSampleController::class, 'destroy'])->name('training.destroy');
});

Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    Route::get('/classification', [ClassificationController::class, 'create'])->name('classification.create');
    Route::post('/classification', [ClassificationController::class, 'store'])->name('classification.store');
    Route::get('/classification/result/{id}', [ClassificationController::class, 'result'])->name('classification.result');

    Route::get('/history', [ClassificationController::class, 'history'])->name('history.index');
    Route::view('/profile', 'user.profile')->name('profile');
});
