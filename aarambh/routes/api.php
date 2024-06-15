<?php

use App\Http\Controllers\Api\ApiAdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {

    Route::post('/user_check', [ApiAdminController::class, 'user_check']);
    Route::post('/sign_up', [ApiAdminController::class, 'sign_up']);
    Route::post('/pages', [ApiAdminController::class, 'pages']);
    Route::post('/login', [ApiAdminController::class, 'login']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('admin')->group(function () {
        // Route::post('/logout', [ApiAdminController::class, 'logout']);
        Route::post('/change_password', [ApiAdminController::class, 'change_password']);
        Route::post('/home_banner', [ApiAdminController::class, 'home_banner']);
        Route::post('/news', [ApiAdminController::class, 'news']);
        Route::post('/categories', [ApiAdminController::class, 'categories']);
        Route::post('/sub_categories', [ApiAdminController::class, 'sub_categories']);
        Route::post('/subjects', [ApiAdminController::class, 'subjects']);
        Route::post('/default_selection', [ApiAdminController::class, 'default_selection']);
        Route::post('/subscription', [ApiAdminController::class, 'subscription']);
        Route::post('/profile_update', [ApiAdminController::class, 'profile_update']);
    });
});
