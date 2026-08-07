<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\DashboardController;

Route::redirect('/', '/login');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
    
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('accounts', AccountController::class);
});

Route::prefix('transactions')->name('transactions.')->group(function () {
    Route::get('/', [TransactionController::class, 'index'])->name('index');

    Route::get('/income', [TransactionController::class, 'createIncome'])->name('create.income');
    Route::post('/income', [TransactionController::class, 'storeIncome'])->name('store.income');

    Route::get('/expense', [TransactionController::class, 'createExpense'])->name('create.expense');
    Route::post('/expense', [TransactionController::class, 'storeExpense'])->name('store.expense');

    Route::get('/transfer', [TransactionController::class, 'createTransfer'])->name('create.transfer');
    Route::post('/transfer', [TransactionController::class, 'storeTransfer'])->name('store.transfer');
});

Route::get('/history', [HistoryController::class, 'index'])->name('history.index');

require __DIR__.'/auth.php';
