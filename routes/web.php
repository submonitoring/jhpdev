<?php

use App\Http\Controllers\BpExportController;
use Illuminate\Support\Facades\Route;

Route::get('pdf/{bp}', BpExportController::class)->name('pdf');

// Route::get('/', function () {
//     return view('welcome');
// });
