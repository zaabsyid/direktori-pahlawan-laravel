<?php

use App\Http\Controllers\PahlawanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/pahlawans', [PageController::class, 'pahlawans']);

Route::get('/pahlawans', [PahlawanController::class, 'index'])->name('pahlawans');

Route::get('/pahlawans/export-pdf', [PahlawanController::class, 'exportPdf'])->name('pahlawans.exportPdf');
