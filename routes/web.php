<?php

use App\Livewire\Dashboard\Dashboard;
use App\Livewire\Letter\Assignment;
use App\Livewire\Letter\AssignmentModify;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', Dashboard::class)->name('dashboard');

Route::prefix('surat')->group(function(){
    Route::get('/tugas', Assignment::class)->name('letter.assignment');
    Route::get('/tugas/{id}/modify', AssignmentModify::class)->name('letter.modify-assignment');
});
