<?php

use App\Http\Controllers\Backend\DeleteLetterController;
use App\Http\Controllers\Datatable\LetterDatatableController;
use Illuminate\Support\Facades\Route;

Route::get('/daftar-surat', [LetterDatatableController::class, 'getLetters'])->name('letter.list');


// Delete 

Route::delete('/hapus-surat/{id}', [DeleteLetterController::class, 'deleteLetter'])->name('letter.delete');