<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/icerikler', [FrontendController::class, 'icerikler'])->name('icerikler');
Route::get('/projelerim', [FrontendController::class, 'projelerim'])->name('projelerim');
Route::get('/hakkimda', [FrontendController::class, 'hakkimda'])->name('hakkimda');
Route::get('/iletisim', [FrontendController::class, 'iletisim'])->name('iletisim');

// Admin Panel Category Redirects
Route::get('admin/icerikler/{category}', function($category) {
    if ($category === 'tablo') {
        abort(404);
    }
    $map = [
        'sektorden-notlar' => 'Sektörden Notlar',
        'bilimden-notlar' => 'Bilimden Notlar',
        'yapay-zeka' => 'Yapay Zeka',
    ];
    $catName = $map[$category] ?? 'Yapay Zeka';
    return redirect('admin/icerikler-tablosu?tableFilters[category][value]=' . urlencode($catName));
});

Route::get('admin/projelerim/{category}', function($category) {
    if ($category === 'tablo') {
        abort(404);
    }
    $map = [
        'yazilim' => 'Yazılım',
        'yapay-zeka' => 'Yapay Zeka',
        'tasarim' => 'Tasarım',
    ];
    $catName = $map[$category] ?? 'Yazılım';
    return redirect('admin/projeler-tablosu?tableFilters[category][value]=' . urlencode($catName));
});