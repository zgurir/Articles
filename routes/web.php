<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RatingController;

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
Route::get('/add-rating', [RatingController::class, 'add'])->name('add-rating');
Route::post('/add-rating', [RatingController::class, 'add']);;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/majmdp', [HomeController::class, 'majmdp'])->name('home.majmdp');
Route::patch('/majmdp', [HomeController::class, 'updatePassword']);
Route::get('/profile', [HomeController::class, 'profile'])->name('home.profile');
Route::put('/profile', [HomeController::class, 'updateProfile']);

Route::resource('/admin/posts', AdminController::class)->except('show')->names('admin.posts');
Route::get('/admin/posts/SortBy', [AdminController::class, 'postsBySortBy'])->name('posts.sortBy');
Route::delete('/admin/posts', [AdminController::class, 'deleteAll'])->name('suppTt');

Route::resource('/posts', PostController::class)->names('posts')->only(['index', 'show']);
Route::get('/categories/{category}', [PostController::class, 'postsByCategory'])->name('posts.byCategory');
Route::get('/tags/{tag}', [PostController::class, 'postsByTag'])->name('posts.byTag');
Route::post('/{post}/comment', [PostController::class, 'comment'])->name('posts.comment');
//Route::get('/home', [HomeController::class, 'index'])->name('home');

