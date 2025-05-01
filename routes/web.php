<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobPostingController;


Route::get('/', function () {
    return view('welcome');
});



Route::prefix('job-postings')->group(function () {
    
    // index()
    Route::get('/', [JobPostingController::class, 'index'])->name('job-postings.index');
    
    // create()
    Route::get('/create', [JobPostingController::class, 'create'])->name('job-postings.create');
    
    // store()
    Route::post('/', [JobPostingController::class, 'store'])->name('job-postings.store');
    
    // edit()
    Route::get('/{jobPosting}/edit', [JobPostingController::class, 'edit'])->name('job-postings.edit');
    
    // update()
    Route::put('/{jobPosting}', [JobPostingController::class, 'update'])->name('job-postings.update');
    
    // destroy()
    Route::delete('/{jobPosting}', [JobPostingController::class, 'destroy'])->name('job-postings.destroy');
});