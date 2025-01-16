<?php

use App\Http\Controllers\Backend\DeleteFormulirController;
use App\Http\Controllers\Backend\DeleteLetterController;
use App\Http\Controllers\Datatable\FundApplicationDatatableController;
use App\Http\Controllers\Datatable\LetterDatatableController;
use Illuminate\Support\Facades\Route;

Route::get('/daftar-surat', [LetterDatatableController::class, 'getLetters'])->name('letter.list');
Route::get('/daftar-formulir', [FundApplicationDatatableController::class, 'getFormulirs'])->name('form.list');


// Delete 

Route::delete('/hapus-surat/{id}', [DeleteLetterController::class, 'deleteLetter'])->name('letter.delete');
Route::delete('/hapus-formulir/{id}', [DeleteFormulirController::class, 'deleteFormulir'])->name('form.delete');