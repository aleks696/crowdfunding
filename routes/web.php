<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CardController;

Route::get('/', [ProjectController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ProjectController::class, 'index'])->name('dashboard');
    Route::get('/auth/profile', [AuthController::class, 'profile'])->name('auth.profile');
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/completed', [ProjectController::class, 'completed'])->name('projects.completed');
    Route::get('/projects/mine', [ProjectController::class, 'mine'])->name('projects.mine');
    Route::get('/projects/mine/incomplete', [ProjectController::class, 'mineIncomplete'])->name('projects.mineIncomplete');
    Route::get('/projects/{project}/report', [ProjectController::class, 'report'])->name('projects.report');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::post('/projects/{project}/comments', [ProjectController::class, 'addComment'])->name('projects.addComment');
    Route::post('/projects/{project}/pay', [PaymentController::class, 'store'])->name('projects.pay');
    Route::get('/card/add', [CardController::class, 'create'])->name('card.create');
    Route::post('/card/store', [CardController::class, 'store'])->name('card.store');
});
