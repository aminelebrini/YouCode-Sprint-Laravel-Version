<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'show'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('role:admin')->group(function () {
    Route::get('/admindash', [AdminController::class, 'index'])->name('admindash');
    Route::post('/admin/users', [AdminController::class, 'Create'])->name('admin.store');
    Route::post('/admin/sprints', [AdminController::class, 'addSprint'])->name('admin.sprint');

});

Route::middleware(['role:formateur'])->group(function () {
    Route::get('/formateurdash', fn() => view('formateurdash'))->name('formateurdash');
});

Route::middleware(['role:etudiant'])->group(function () {
    Route::get('/etudiantdash', fn() => view('etudiantdash'))->name('etudiantdash');
});

