<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\BlogPostController as AdminBlogPostController;
use App\Http\Controllers\Frontend\BlogPostController as FrontendBlogPostController;



// Frontend routes
Route::get('/', [FrontendBlogPostController::class, 'index'])->name('frontend.blogposts.index');
Route::get('/blogposts/{blogpost}', [FrontendBlogPostController::class, 'show'])->name('frontend.blogposts.show');

Route::get('admin/login', [AuthController::class, 'login'])->name('login');
Route::post('admin/login', [AuthController::class,'dashboard'])->name('login.post');

Route::group(['prefix' => 'admin','middleware' => ['auth'],'as' =>'admin.'],function() {
    Route::resource('blogposts', AdminBlogPostController::class);
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
