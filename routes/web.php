<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;

Route::get('/', fn() => view('welcome'))->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/menu/create', [MenuController::class, 'create'])->name('menu.create');
    Route::post('/menu', [MenuController::class, 'store'])->name('menu.store');
    Route::get('/menu/{id}/edit', [MenuController::class, 'edit'])->name('menu.edit');
    Route::put('/menu/{id}', [MenuController::class, 'update'])->name('menu.update');
    Route::delete('/menu/{id}', [MenuController::class, 'delete'])->name('menu.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/orders/create/{food_id}', [OrdersController::class, 'create'])->name('orders.create');
    Route::post('/orders/store/{food_id}', [OrdersController::class, 'store'])->name('orders.store');

    Route::get('/orders/pay/{order_id}', [OrdersController::class, 'pay'])->name('orders.pay');
    Route::post('/orders/process/{order_id}', [OrdersController::class, 'processPayment'])->name('orders.process');
});

Route::middleware('auth')->group(function () {
    Route::get('/rate-food/{food_id}', [SurveyController::class, 'create'])->name('survey.create');
    Route::post('/rate-food/{food_id}', [SurveyController::class, 'store'])->name('survey.store');

    Route::get('/comment/{food_id}', [CommentController::class, 'create'])->name('comment.create');
    Route::post('/comment/{food_id}', [CommentController::class, 'store'])->name('comment.store');
});

Route::post('/apply-discount/{code}', [DiscountController::class, 'apply'])
    ->middleware('auth')
    ->name('discount.apply');

Route::prefix('admin/reports')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [ReportController::class, 'index'])->name('admin.reports');
    Route::get('/orders', [ReportController::class, 'orders'])->name('admin.reports.orders');
    Route::get('/payments', [ReportController::class, 'payments'])->name('admin.reports.payments');
    Route::get('/surveys', [ReportController::class, 'surveys'])->name('admin.reports.surveys');
    Route::get('/users', [ReportController::class, 'users'])->name('admin.reports.users');
    Route::get('/popular', [ReportController::class, 'popular'])->name('admin.reports.popular');
    Route::get('/comments', [ReportController::class, 'comments'])->name('admin.reports.comments');
});
