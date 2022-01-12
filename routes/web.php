<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChallengeController;


// 入力->確認->登録
Route::get('/', [ChallengeController::class, 'index'])->name('index');
Route::get('/confirm', [ChallengeController::class, 'confirm'])->name('confirm');
Route::post('/register', [ChallengeController::class, 'register'])->name('register');

// システム管理
Route::get('/system', [ChallengeController::class, 'system'])->name('system');
Route::post('/find', [ChallengeController::class, 'find'])->name('find');
Route::post('/delete', [ChallengeController::class, 'delete'])->name('delete');