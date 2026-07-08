<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Pengajar;
use App\Http\Controllers\Peserta;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

// ============================================
// PUBLIC ROUTES
// ============================================
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/catalog', [PublicController::class, 'catalog'])->name('catalog');

// ============================================
// AUTH ROUTES
// ============================================
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Password Reset
    Route::get('/password/reset', [PasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/email', [PasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [PasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [PasswordController::class, 'reset'])->name('password.update');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// ============================================
// ADMIN ROUTES
// ============================================
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');

    // Categories
    Route::resource('categories', Admin\CategoryController::class);
    Route::post('categories/{id}/toggle', [Admin\CategoryController::class, 'toggleStatus'])->name('categories.toggle');

    // Courses
    Route::resource('courses', Admin\CourseController::class);

    // Users
    Route::get('/users', [Admin\UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [Admin\UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [Admin\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [Admin\UserController::class, 'update'])->name('users.update');
    Route::post('/users/{id}/toggle', [Admin\UserController::class, 'toggleStatus'])->name('users.toggle');

    // Payments
    Route::get('/payments', [Admin\PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/{order}', [Admin\PaymentController::class, 'show'])->name('payments.show');
    Route::post('/payments/{order}/verify', [Admin\PaymentController::class, 'verify'])->name('payments.verify');
    Route::post('/payments/{order}/reject', [Admin\PaymentController::class, 'reject'])->name('payments.reject');

    // Reports
    Route::get('/reports', [Admin\ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/daily', [Admin\ReportController::class, 'dailySales'])->name('reports.daily');
    Route::get('/reports/monthly', [Admin\ReportController::class, 'monthlySales'])->name('reports.monthly');
    Route::get('/reports/yearly', [Admin\ReportController::class, 'yearlySales'])->name('reports.yearly');
    Route::get('/reports/customers', [Admin\ReportController::class, 'customerData'])->name('reports.customers');
    Route::get('/reports/revenue', [Admin\ReportController::class, 'totalRevenue'])->name('reports.revenue');

    // Profile
    Route::get('/profile', [Admin\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [Admin\ProfileController::class, 'update'])->name('profile.update');
});

// ============================================
// PENGAJAR ROUTES
// ============================================
Route::prefix('pengajar')->name('pengajar.')->middleware(['auth', 'role:pengajar'])->group(function () {
    Route::get('/dashboard', [Pengajar\DashboardController::class, 'index'])->name('dashboard');

    // Courses
    Route::resource('courses', Pengajar\CourseController::class);

    // Materials
    Route::prefix('courses/{course}')->group(function () {
        Route::get('/materials', [Pengajar\MaterialController::class, 'index'])->name('courses.materials.index');
        Route::get('/materials/create', [Pengajar\MaterialController::class, 'create'])->name('courses.materials.create');
        Route::post('/materials', [Pengajar\MaterialController::class, 'store'])->name('courses.materials.store');
        Route::get('/materials/{material}/edit', [Pengajar\MaterialController::class, 'edit'])->name('courses.materials.edit');
        Route::put('/materials/{material}', [Pengajar\MaterialController::class, 'update'])->name('courses.materials.update');
        Route::delete('/materials/{material}', [Pengajar\MaterialController::class, 'destroy'])->name('courses.materials.destroy');
        Route::post('/materials/reorder', [Pengajar\MaterialController::class, 'reorder'])->name('courses.materials.reorder');
    });

    // Reviews
    Route::get('/reviews', [Pengajar\ReviewController::class, 'index'])->name('reviews.index');
    Route::get('/reviews/{course}', [Pengajar\ReviewController::class, 'show'])->name('reviews.show');

    // Private Sessions (Sangar tier)
    Route::resource('private-sessions', Pengajar\PrivateSessionController::class);
    Route::post('private-sessions/{privateSession}/complete', [Pengajar\PrivateSessionController::class, 'complete'])->name('private-sessions.complete');

    // Profile
    Route::get('/profile', [Pengajar\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [Pengajar\ProfileController::class, 'update'])->name('profile.update');
});

// ============================================
// PESERTA ROUTES
// ============================================
Route::prefix('peserta')->name('peserta.')->middleware(['auth', 'role:peserta'])->group(function () {
    Route::get('/dashboard', [Peserta\DashboardController::class, 'index'])->name('dashboard');

    // Catalog
    Route::get('/catalog', [Peserta\CatalogController::class, 'index'])->name('catalog.index');
    Route::get('/catalog/category/{categorySlug}', [Peserta\CatalogController::class, 'category'])->name('catalog.category');
    Route::get('/catalog/{slug}', [Peserta\CatalogController::class, 'show'])->name('catalog.show');

    // Learning
    Route::get('/learning', [Peserta\LearningController::class, 'index'])->name('learning.index');
    Route::get('/learning/{slug}', [Peserta\LearningController::class, 'course'])->name('learning.course');
    Route::get('/learning/{slug}/materials/{material}', [Peserta\LearningController::class, 'material'])->name('learning.material');
    Route::post('/learning/{slug}/materials/{material}/complete', [Peserta\LearningController::class, 'markComplete'])->name('learning.complete');

    // Checkout & Orders
    Route::get('/pricing', [Peserta\CheckoutController::class, 'pricing'])->name('pricing');
    Route::get('/checkout/{tier}', [Peserta\CheckoutController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/process', [Peserta\CheckoutController::class, 'process'])->name('checkout.process');
    Route::post('/orders/{order}/upload-proof', [Peserta\CheckoutController::class, 'uploadProof'])->name('orders.upload-proof');
    Route::get('/orders', [Peserta\OrderController::class, 'index'])->name('orders.index');

    // Profile
    Route::get('/profile', [Peserta\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [Peserta\ProfileController::class, 'update'])->name('profile.update');

    // Reviews
    Route::get('/reviews/create/{slug}', [Peserta\ReviewController::class, 'create'])->name('review.create');
    Route::post('/reviews/{slug}', [Peserta\ReviewController::class, 'store'])->name('review.store');

    // Certificates
    Route::get('/certificates', [Peserta\CertificateController::class, 'index'])->name('certificates.index');
    Route::get('/certificates/generate/{slug}', [Peserta\CertificateController::class, 'generate'])->name('certificates.generate');
    Route::get('/certificates/download/{certificateNumber}', [Peserta\CertificateController::class, 'download'])->name('certificates.download');
    Route::get('/certificates/{certificate}', [Peserta\CertificateController::class, 'show'])->name('certificates.show');
});
