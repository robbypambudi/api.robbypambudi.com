<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UrlShortenerController;
use App\Http\Controllers\VisitorController;

Route::get('hello', function () {
    return response()->json();
});

// Visitor
Route::get('/visitor', [VisitorController::class, 'visitor']);
Route::post('/visitor', [VisitorController::class, 'createVisitor']);

// Shortener URL
Route::post('/create_url', [UrlShortenerController::class, 'createUrl']);
Route::get('/get_url', [UrlShortenerController::class, 'getUrl']);

// User
Route::post('/create_user', [UserController::class, 'createUser']);
Route::post('/login_user', [UserController::class, 'loginUser']);

Route::middleware(['iam'])->group(
    function () {
        Route::get('test', function(){
            return response()->json([
                "success" => true
            ]);
        });
    }
);
    
Route::middleware(['iam', 'admin'])->group(
    function () {
    }
);