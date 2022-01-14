<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChallengeController;


// お問い合わせフォーム
Route::get('/', [ChallengeController::class, 'form'])->name('form');
Route::get('/confirm', [ChallengeController::class, 'confirm'])->name('confirm');
Route::post('/register', [ChallengeController::class, 'register'])->name('register');

// システム管理
Route::get('/system', [ChallengeController::class, 'system'])->name('system');
Route::post('/find', [ChallengeController::class, 'find'])->name('find');
Route::post('/delete/{$id}', [ChallengeController::class, 'delete'])->name('delete');