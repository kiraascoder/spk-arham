<?php

use Illuminate\Support\Facades\Route;


Route::view('/', 'home');
Route::view('/login', 'auth.login');
Route::view('/register', 'auth.register');

// Admin
Route::view('/admin/dashboard', 'admin.dashboard')->name('admin.dashboard');
Route::view('/admin/criteria', 'admin.criteria.index')->name('admin.criteria');
Route::view('/admin/training', 'admin.training.index')->name('admin.training');

// User
Route::view('/user/dashboard', 'user.dashboard')->name('user.dashboard');
Route::view('/user/classification', 'user.classification.create')->name('user.classification');
Route::view('/user/history', 'user.history.index')->name('user.history');
Route::view('/user/profile', 'user.profile')->name('user.profile');
