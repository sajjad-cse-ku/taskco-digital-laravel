<?php

use App\Http\Controllers\Api\BlogPostApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('blog-posts')->controller(BlogPostApiController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('{blogpost}', 'show');
});
