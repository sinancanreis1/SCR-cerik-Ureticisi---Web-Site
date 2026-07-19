<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/icerikler', [FrontendController::class, 'icerikler'])->name('icerikler');
Route::get('/projelerim', [FrontendController::class, 'projelerim'])->name('projelerim');
Route::get('/hakkimda', [FrontendController::class, 'hakkimda'])->name('hakkimda');
Route::get('/iletisim', [FrontendController::class, 'iletisim'])->name('iletisim');
