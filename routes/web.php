<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\frontend\categoryController;
use App\Http\Controllers\frontend\ContactUsController;
use App\Http\Controllers\Frontend\NewsSubscriberController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group([
    'as' => 'frontend.'
], function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::post('news_subscribe', [NewsSubscriberController::class, 'store'])->name('news.subscribe');
    Route::get('/category/{slug}', categoryController::class)->name('category.posts');
    Route::get('post/{slug}', [PostController::class, 'show'])->name('post.show');
    Route::get('post/comments/{slug}', [PostController::class, 'getAllComments'])->name('post.getAllComments');
    Route::post('post/comments/store', [PostController::class, 'saveComment'])->name('post.comments.store');
    Route::get('contact-us', [ContactUsController::class, 'index'])->name('contactus.index');
    Route::post('contact/store', [ContactUsController::class, 'store'])->name('contactus.store');
});
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
