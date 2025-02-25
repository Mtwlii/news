<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\frontend\SearchControler;
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
    Route::post('/news_subscribe', [NewsSubscriberController::class, 'store'])->name('news.subscribe');
    Route::get('/category/{slug}', categoryController::class)->name('category.posts');

    // Post Routes
    Route::controller(PostController::class)->name('post.')->prefix('post')->group(function () {
        Route::get('/{slug}',  'show')->name('show');
        Route::get('/comments/{slug}', 'getAllComments')->name('getAllComments');
        Route::post('/comments/store',  'saveComment')->name('comments.store');
    });

    // Contact Us Routes
    Route::controller(ContactUsController::class)->name('contactus.')->prefix('contact-us')->group(function () {
        Route::get('/',  'index')->name('index');
        Route::post('/store',  'store')->name('store');
    });
    Route::match(['get', 'post'], '/search', SearchControler::class)->name('search');
});
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
