<?php

use App\Http\Controllers\Datatable\LetterDatatableController;
use Illuminate\Support\Facades\Route;

Route::get('/daftar-surat', [LetterDatatableController::class, 'getLetters'])->name('letter.list');