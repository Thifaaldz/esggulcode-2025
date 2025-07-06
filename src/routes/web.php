<?php

use App\Http\Controllers\CourseController;
use App\Livewire\About;
use App\Livewire\Course;
use App\Livewire\HomePage;
use App\Livewire\Pengajar;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

/* NOTE: Do Not Remove
/ Livewire asset handling if using sub folder in domain
*/
Livewire::setUpdateRoute(function ($handle) {
    return Route::post(config('app.asset_prefix') . '/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(config('app.asset_prefix') . '/livewire/livewire.js', $handle);
});
/*
/ END
*/
//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', HomePage::class)->name('home');
Route::get('/about', About::class)->name('about');
Route::get('/course', Course::class)->name('course');
Route::get('/pengajar', Pengajar::class)->name('pengajar');
Route::get('/courses', [CourseController::class, 'index']);
