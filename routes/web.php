<?php
// Route profil user
Route::middleware('auth')->group(function () {
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});

// use Illuminate\Support\Facades\Route; // Sudah di-import sebelumnya


use App\Http\Controllers\DocumentController;
// use Illuminate\Support\Facades\Auth; // Sudah di-import sebelumnya

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route khusus admin
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/documents', [\App\Http\Controllers\DocumentController::class, 'adminIndex'])->name('admin.documents.index');
    Route::get('/dashboard', [\App\Http\Controllers\KeyManagementController::class, 'index'])->name('admin.dashboard');

    // Contoh fitur tambahan: manajemen user (hanya admin)
    Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->name('admin.users.index');
    Route::post('/users/{id}/approve', [\App\Http\Controllers\UserController::class, 'approve'])->name('admin.users.approve');
    Route::delete('/users/{id}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('admin.users.destroy');
});

Route::get('/', function () {
    return redirect()->route('documents.index');
});

// Aktifkan kembali register
Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create');
    Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');
    Route::get('/documents/{id}', [DocumentController::class, 'show'])->name('documents.show');
    Route::get('/documents/{id}/edit', [DocumentController::class, 'edit'])->name('documents.edit');
    Route::put('/documents/{id}', [DocumentController::class, 'update'])->name('documents.update');
    Route::delete('/documents/{id}', [DocumentController::class, 'destroy'])->name('documents.destroy');
    Route::post('/documents/{id}/download', [DocumentController::class, 'download'])->name('documents.download');
    Route::get('/documents/encrypted', [DocumentController::class, 'encrypted'])->name('documents.encrypted');
    Route::get('/documents/{id}/download-encrypted', [DocumentController::class, 'downloadEncrypted'])->name('documents.downloadEncrypted');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
