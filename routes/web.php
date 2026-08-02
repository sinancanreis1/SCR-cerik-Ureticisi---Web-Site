<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/icerikler', [FrontendController::class, 'icerikler'])->name('icerikler');
Route::get('/icerikler/{slug}', [FrontendController::class, 'icerikDetay'])->name('icerik.detay');
Route::get('/projelerim', [FrontendController::class, 'projelerim'])->name('projelerim');
Route::get('/projelerim/{slug}', [FrontendController::class, 'projeDetay'])->name('proje.detay');
Route::get('/hakkimda', [FrontendController::class, 'hakkimda'])->name('hakkimda');
Route::get('/iletisim', [FrontendController::class, 'iletisim'])->name('iletisim');
Route::post('/iletisim', [\App\Http\Controllers\Frontend\ContactController::class, 'send'])->name('iletisim.send');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/giris', [\App\Http\Controllers\Frontend\AuthController::class, 'showLogin'])->name('login');
    Route::post('/giris', [\App\Http\Controllers\Frontend\AuthController::class, 'login']);
    Route::get('/kayit', [\App\Http\Controllers\Frontend\AuthController::class, 'showRegister'])->name('register');
    Route::post('/kayit', [\App\Http\Controllers\Frontend\AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/cikis', [\App\Http\Controllers\Frontend\AuthController::class, 'logout'])->name('logout');
    
    // Profile
    Route::get('/profilim', [\App\Http\Controllers\Frontend\ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profilim', [\App\Http\Controllers\Frontend\ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::get('/icerik-gonder', [\App\Http\Controllers\Frontend\ProfileController::class, 'createPost'])->name('profile.create_post');
    Route::post('/icerik-gonder', [\App\Http\Controllers\Frontend\ProfileController::class, 'storePost'])->name('profile.store_post');
    
    // Interactions
    Route::post('/blog/{id}/like', [\App\Http\Controllers\Frontend\InteractionController::class, 'toggleLike'])->name('blog.like');
    Route::post('/blog/{id}/comment', [\App\Http\Controllers\Frontend\InteractionController::class, 'storeComment'])->name('blog.comment');
    Route::post('/project/{id}/like', [\App\Http\Controllers\Frontend\InteractionController::class, 'toggleProductLike'])->name('product.like');
    Route::post('/project/{id}/comment', [\App\Http\Controllers\Frontend\InteractionController::class, 'storeProductComment'])->name('product.comment');
});
// Sitemap
Route::get('/sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');

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