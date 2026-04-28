<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductAdminController;
use App\Http\Controllers\Admin\DevisController;
use App\Http\Controllers\Admin\ClientController;

// Page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Produits
Route::get('/produits', [ProductController::class, 'index'])->name('products.index');
Route::get('/produits/recherche', [ProductController::class, 'search'])->name('products.search');
Route::get('/produits/{product}', [ProductController::class, 'show'])->name('products.show');

// Catégories
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

// Pages statiques
Route::get('/a-propos', function () {
    return view('pages.about');
})->name('about');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// ===== ADMIN =====
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/produits', [ProductAdminController::class, 'index'])->name('products');
    Route::get('/produits/{product}/edit', [ProductAdminController::class, 'edit'])->name('products.edit');
    Route::put('/produits/{product}', [ProductAdminController::class, 'update'])->name('products.update');
    Route::get('/produits/create', [ProductAdminController::class, 'create'])->name('products.create');
    Route::post('/produits', [ProductAdminController::class, 'store'])->name('products.store');
    Route::get('/devis', [DevisController::class, 'index'])->name('devis');
    Route::patch('/devis/{devis}/statut', [DevisController::class, 'updateStatut'])->name('devis.statut');
    Route::get('/devis/{devis}', [DevisController::class, 'show'])->name('devis.show');
    Route::get('/clients', [ClientController::class, 'index'])->name('clients');
    Route::get('/categories', [App\Http\Controllers\Admin\CategoryAdminController::class, 'index'])->name('categories');
});

// Auth Breeze
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/produits/create', [ProductAdminController::class, 'create'])->name('products.create');
Route::post('/produits', [ProductAdminController::class, 'store'])->name('products.store');
Route::delete('/admin/produits/{product}', [ProductAdminController::class, 'destroy'])->name('admin.products.destroy');

require __DIR__.'/auth.php';