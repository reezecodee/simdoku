<?php

use App\Http\Controllers\Backend\DeleteFormulirController;
use App\Http\Controllers\Backend\DeleteLetterController;
use App\Http\Controllers\Backend\DeleteProposalController;
use App\Http\Controllers\Backend\DeleteReportController;
use App\Http\Controllers\Datatable\FundApplicationDatatableController;
use App\Http\Controllers\Datatable\LetterDatatableController;
use App\Http\Controllers\Datatable\ProposalDatatableController;
use App\Http\Controllers\Datatable\ReportDatatableController;
use Illuminate\Support\Facades\Route;

Route::get('/daftar-surat', [LetterDatatableController::class, 'getLetters'])->name('letter.list');
Route::get('/daftar-formulir', [FundApplicationDatatableController::class, 'getFormulirs'])->name('form.list');
Route::get('/daftar-proposal', [ProposalDatatableController::class, 'getProposals'])->name('proposal.list');
Route::get('/daftar-laporan', [ReportDatatableController::class, 'getReports'])->name('report.list');


// Delete 

Route::delete('/hapus-surat/{id}', [DeleteLetterController::class, 'deleteLetter'])->name('letter.delete');
Route::delete('/hapus-formulir/{id}', [DeleteFormulirController::class, 'deleteFormulir'])->name('form.delete');
Route::delete('/hapus-proposal/{id}', [DeleteProposalController::class, 'deleteProposal'])->name('proposal.delete');
Route::delete('/hapus-laporan/{id}', [DeleteReportController::class, 'deleteReport'])->name('report.delete');