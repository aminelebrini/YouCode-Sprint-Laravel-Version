<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormateurController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'show'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admindash', [AdminController::class, 'index'])->name('admindash');
    Route::post('/admin/users', [AdminController::class, 'Create'])->name('admin.store');
    Route::post('/admin/sprints', [AdminController::class, 'addSprint'])->name('admin.sprint');
    Route::post('/admin/classe', [AdminController::class, 'addClass'])->name('admin.classe');
    Route::post('/admin/assigner', [AdminController::class, 'assignation'])->name('admin.assiner');
    Route::post('/admin/competences', [AdminController::class, 'addCompetence'])->name('admin.skills');


});

Route::middleware(['auth', 'role:formateur'])->group(function () {
    Route::get('/formateurdash', [FormateurController::class, 'index'])->name('formateurdash');
    Route::post('/formateurdash/brief',[FormateurController::class, 'creer_brief'])->name('formateur.createBrief');
    Route::post('/formateurdash/assignement', [FormateurController::class, 'assign_students'])->name('formateur.assign_students');
});

Route::middleware(['auth', 'role:etudiant'])->group(function () {
    Route::get('/etudiantdash', fn() => view('etudiantdash'))->name('etudiantdash');
});

