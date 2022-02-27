<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('/admin')->group(function () {
    Route::post('/login', [App\Http\Controllers\Admin\AuthController::class,'authentificate']);
    Route::middleware('auth:sanctum',"abilities:admin")->group(function () {
        Route::get('/home', [App\Http\Controllers\Admin\HomeController::class,'index']);
        Route::prefix('problemes')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\ProblemeController::class,'index']);
            Route::post('/add', [App\Http\Controllers\Admin\ProblemeController::class,'store']);
            Route::post('/update/{problem:id}', [App\Http\Controllers\Admin\ProblemeController::class,'update']);
            Route::post('/delete/{problem:id}', [App\Http\Controllers\Admin\ProblemeController::class,'delete']);
        });
        Route::prefix('deppartments')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\DeppartmentController::class,'index']);
            Route::post('/add', [App\Http\Controllers\Admin\DeppartmentController::class,'store']);
            Route::post('/update/{user:id}', [App\Http\Controllers\Admin\DeppartmentController::class,'update']);
            Route::post('/delete/{user:id}', [App\Http\Controllers\Admin\DeppartmentController::class,'delete']);
        });
        Route::prefix('/categories')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\CategoryController::class,'index']);
            Route::post('/add', [App\Http\Controllers\Admin\CategoryController::class,'store']);
            Route::post('/update/{category:id}', [App\Http\Controllers\Admin\CategoryController::class,'update']);
            Route::post('/delete/{category:id}', [App\Http\Controllers\Admin\CategoryController::class,'delete']);
        });
        Route::prefix('/repports')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\RepportController::class,'index']);
            Route::post('/add', [App\Http\Controllers\Admin\RepportController::class,'store']);
            Route::post('/update/{repport:id}', [App\Http\Controllers\Admin\RepportController::class,'update']);
            Route::post('/delete/{repport:id}', [App\Http\Controllers\Admin\RepportController::class,'delete']);
        });
        Route::prefix('/app')->group(function () {
            Route::get('/get-token', [App\Http\Controllers\Admin\AuthController::class,'getAppToken']);
        });
    });
});

Route::prefix('/deppartment')->group(function () {
    Route::post('/login', [App\Http\Controllers\Deppartment\AuthController::class,'authentificate']);
    Route::middleware('auth:sanctum',"abilities:deppartment")->group(function () {
        Route::get('/home', [App\Http\Controllers\Deppartment\HomeController::class,'index']);
        Route::prefix('/repports')->group(function () {
            Route::get('/', [App\Http\Controllers\Deppartment\RepportController::class,'index']);
            Route::get('/solved/{repport:id}', [App\Http\Controllers\Deppartment\RepportController::class,'solved']);
        });
    });
});


Route::prefix('/app')->group(function () {
    Route::middleware(['auth:sanctum', 'abilities:application'])->group(function () {
        Route::prefix('/problems')->group(function () {
            Route::get('/', [App\Http\Controllers\Application\ProblemeController::class,'index']);
        });
        Route::prefix('/centers')->group(function () {
            Route::get('/', [App\Http\Controllers\Application\DeppartmentController::class,'index']);
        });
        Route::prefix('/categories')->group(function () {
            Route::get('/', [App\Http\Controllers\Application\CategoryController::class,'index']);
        });
        Route::prefix('/reports')->group(function () {
            Route::get('/', [App\Http\Controllers\Application\RepportController::class,'index']);
            Route::post('/send', [App\Http\Controllers\Application\RepportController::class,'report']);
        });
        Route::prefix('/contact')->group(function () {
            Route::get('/send', [App\Http\Controllers\Application\ContactController::class,'send']);
        });
        Route::prefix('/files')->group(function () {
            Route::get('/', [App\Http\Controllers\Application\ResourcesController::class,'index']);
        });
    });
});
