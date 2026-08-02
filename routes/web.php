<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('accounts', AccountController::class);
});

Route::prefix('transactions')->name('transactions.')->group(function () {
    Route::get('/', [TransactionController::class, 'index'])->name('index');

    Route::get('/create', [TransactionController::class, 'chooseType'])->name('choose');
    Route::get('/create/income', [TransactionController::class, 'createIncome'])->name('create.income');
    
    Route::post('/create/income', [TransactionController::class, 'storeIncome'])->name('store.income');
    Route::get('/create/expense', [TransactionController::class, 'createExpense'])->name('create.expense');
    Route::get('/create/transfer', [TransactionController::class, 'createTransfer'])->name('create.transfer');
});

require __DIR__.'/auth.php';
