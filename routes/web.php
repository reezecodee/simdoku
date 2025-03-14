<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\Preview\LetterPreviewController;
use App\Livewire\Archive\ListFiles;
use App\Livewire\Archive\UploadFile;
use App\Livewire\Dashboard\Dashboard;
use App\Livewire\Document\ModifyProposal;
use App\Livewire\Document\ModifyReport;
use App\Livewire\Document\Proposal;
use App\Livewire\Document\Report;
use App\Livewire\Form\Formulir;
use App\Livewire\Form\ModifyFormulir;
use App\Livewire\Letter\Assignment;
use App\Livewire\Letter\ModifyAssignment;
use App\Livewire\Profile\Profile;
use App\Livewire\Signature\Signature;
use Illuminate\Support\Facades\Route;


Route::get('/', Dashboard::class)->name('dashboard');

Route::prefix('surat')->group(function () {
    Route::get('tugas', Assignment::class)->name('letter.index');
    Route::get('tugas/{id}/modify', ModifyAssignment::class)->name('letter.modify');
    Route::get('tugas/{id}/preview', [LetterPreviewController::class, 'preview'])->name('letter.preview');
});

Route::prefix('proposal')->group(function () {
    Route::get('kegiatan', Proposal::class)->name('proposal.index');
    Route::get('kegiatan/{id}/modify', ModifyProposal::class)->name('proposal.modify');
});

Route::prefix('laporan')->group(function () {
    Route::get('kegiatan', Report::class)->name('report.index');
    Route::get('kegiatan/{id}/modify', ModifyReport::class)->name('report.modify');
});

Route::prefix('formulir')->group(function () {
    Route::get('pengajuan', Formulir::class)->name('form.index');
    Route::get('pengajuan/{id}/modify', ModifyFormulir::class)->name('form.modify');
});

Route::prefix('tanda-tangan')->group(function () {
    Route::get('/', Signature::class)->name('signature.index');
});

Route::prefix('arsip')->group(function () {
    Route::get('/', ListFiles::class)->name('archive.index');
    Route::get('/upload', UploadFile::class)->name('archive.upload');
});

Route::prefix('profile-saya')->group(function () {
    Route::get('/', Profile::class)->name('profile.index');
});

Route::get('/data', [DataController::class, 'getDummyData']);

require __DIR__ . '/datatable.php';

Route::get('test-proposal', function () {
    return view('pdf.proposal');
});
