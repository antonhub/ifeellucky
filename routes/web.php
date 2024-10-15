<?php

use App\Livewire\LuckyGame;
use App\Livewire\LuckyRegister;
use Illuminate\Support\Facades\Route;

Route::get('/', LuckyRegister::class)->name('lucky-index');
Route::get('/lucky-game/{hash}', LuckyGame::class)->name('lucky-game');

require __DIR__ . '/auth.php';
