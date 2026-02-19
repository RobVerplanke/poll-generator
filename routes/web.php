<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Poll;
use App\Http\Controllers\PollController;

// Homepage - Where active and previous polls are displayed and can be sorted
Route::get('/', [PollController::class, 'index'])->name('home');

// Create - Display form for creating new poll
Route::post('/polls', [PollController::class, 'store'])->name('polls.store');

// Create - Send new poll data to database
Route::get('/polls/create', [PollController::class, 'create'])->name('polls.create');

// Details - View with details of selected poll (active or closed)
Route::get('/show/{id}', [PollController::class, 'show']);