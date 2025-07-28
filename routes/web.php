<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\BlogPostController as AdminBlogPostController;
use App\Http\Controllers\Frontend\BlogPostController as FrontendBlogPostController;

// Admin routes group (add auth middleware as needed)
Route::prefix('admin')->name('admin.')->group(function() {
    Route::resource('blogposts', AdminBlogPostController::class);
});

// Frontend routes
Route::get('/', [FrontendBlogPostController::class, 'index'])->name('frontend.blogposts.index');
Route::get('/blogposts/{blogpost}', [FrontendBlogPostController::class, 'show'])->name('frontend.blogposts.show');

