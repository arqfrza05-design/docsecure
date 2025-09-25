<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route('documents.index');
});

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
