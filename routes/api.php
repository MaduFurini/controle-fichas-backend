<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventProductController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderProductController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserCommunityController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('throttle:60,1')->group(function () {
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/generateToken', [LoginController::class, 'generateToken']);
    Route::post('/validateToken', [LoginController::class, 'validateToken']);
});

Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {
    Route::prefix('/communities')->group(function () {
        Route::get('/', [CommunityController::class, 'index']);
        Route::post('/', [CommunityController::class, 'store']);
        Route::patch('/{id}', [CommunityController::class, 'update']);
        Route::delete('/{id}', [CommunityController::class, 'destroy']);
        Route::get('/{id}', [CommunityController::class, 'show']);
    });

    Route::prefix('/users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/', [UserController::class, 'store']);
        Route::patch('/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
        Route::get('/{id}', [UserController::class, 'show']);
    });

    Route::prefix('/userCommunities')->group(function () {
        Route::get('/', [UserCommunityController::class, 'index']);
        Route::post('/', [UserCommunityController::class, 'store']);
        Route::patch('/{id}', [UserCommunityController::class, 'update']);
        Route::delete('/{id}', [UserCommunityController::class, 'destroy']);
        Route::get('/{id}', [UserCommunityController::class, 'show']);
    });

    Route::prefix('/equipments')->group(function () {
        Route::get('/', [EquipmentController::class, 'index']);
        Route::post('/', [EquipmentController::class, 'store']);
        Route::patch('/{id}', [EquipmentController::class, 'update']);
        Route::delete('/{id}', [EquipmentController::class, 'destroy']);
        Route::get('/{id}', [EquipmentController::class, 'show']);
    });

    Route::prefix('/categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::patch('/{id}', [CategoryController::class, 'update']);
        Route::delete('/{id}', [CategoryController::class, 'destroy']);
        Route::get('/{id}', [CategoryController::class, 'show']);
    });

    Route::prefix('/events')->group(function () {
        Route::get('/', [EventController::class, 'index']);
        Route::post('/', [EventController::class, 'store']);
        Route::patch('/{id}', [EventController::class, 'update']);
        Route::delete('/{id}', [EventController::class, 'destroy']);
        Route::get('/{id}', [EventController::class, 'show']);
    });

    Route::prefix('/reports')->group(function () {
        Route::get('/', [ReportController::class, 'index']);
        Route::post('/', [ReportController::class, 'store']);
        Route::patch('/{id}', [ReportController::class, 'update']);
        Route::delete('/{id}', [ReportController::class, 'destroy']);
        Route::get('/{id}', [ReportController::class, 'show']);
    });

    Route::prefix('/sessions')->group(function () {
        Route::get('/', [SessionController::class, 'index']);
        Route::post('/', [SessionController::class, 'store']);
        Route::patch('/{id}', [SessionController::class, 'update']);
        Route::delete('/{id}', [SessionController::class, 'destroy']);
        Route::get('/{id}', [SessionController::class, 'show']);
    });

    Route::prefix('/products')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::post('/', [ProductController::class, 'store']);
        Route::patch('/{id}', [ProductController::class, 'update']);
        Route::delete('/{id}', [ProductController::class, 'destroy']);
        Route::get('/{id}', [ProductController::class, 'show']);
    });

    Route::prefix('/eventProducts')->group(function () {
        Route::get('/', [EventProductController::class, 'index']);
        Route::post('/', [EventProductController::class, 'store']);
        Route::patch('/{id}', [EventProductController::class, 'update']);
        Route::delete('/{id}', [EventProductController::class, 'destroy']);
        Route::get('/{id}', [EventProductController::class, 'show']);
    });

    Route::prefix('/paymentTypes')->group(function () {
        Route::get('/', [PaymentTypeController::class, 'index']);
        Route::post('/', [PaymentTypeController::class, 'store']);
        Route::patch('/{id}', [PaymentTypeController::class, 'update']);
        Route::delete('/{id}', [PaymentTypeController::class, 'destroy']);
        Route::get('/{id}', [PaymentTypeController::class, 'show']);
    });

    Route::prefix('/order')->group(function () {
        Route::get('/', [OrderController::class, 'index']);
        Route::post('/', [OrderController::class, 'store']);
        Route::patch('/{id}', [OrderController::class, 'update']);
        Route::delete('/{id}', [OrderController::class, 'destroy']);
        Route::get('/{id}', [OrderController::class, 'show']);
    });

    Route::prefix('/orderProducts')->group(function () {
        Route::get('/', [OrderProductController::class, 'index']);
        Route::post('/', [OrderProductController::class, 'store']);
        Route::patch('/{id}', [OrderProductController::class, 'update']);
        Route::delete('/{id}', [OrderProductController::class, 'destroy']);
        Route::get('/{id}', [OrderProductController::class, 'show']);
    });
});
