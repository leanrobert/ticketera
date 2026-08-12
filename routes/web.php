<?php

use App\Http\Controllers\Admin\TicketController as AdminTicketController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

/* CLIENTE */
Route::middleware(['auth', 'role:client'])->prefix('tickets')->group(function () {
    Route::get('/', [TicketController::class, 'index'])->name('ticket.index');
    Route::get('/create', [TicketController::class, 'create'])->name('ticket.create');
});

/* TICKET DETAIL (shared across roles, authorized via TicketPolicy::view) */
Route::middleware(['auth'])->prefix('tickets')->group(function () {
    Route::get('/{ticket}', [TicketController::class, 'show'])->name('ticket.show');
});

/* ADMIN */
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/tickets', [AdminTicketController::class, 'index'])->name('admin.tickets');
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users');
});

require __DIR__.'/settings.php';
