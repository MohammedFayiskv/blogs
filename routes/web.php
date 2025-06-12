<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DasboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\FrondendController;


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

Route::get('/', function () {
    return view('frondend.blogs');
});

Route::get('/blogs/view', [FrondendController::class, 'displayBlogs'])->name('allBlogs');
Route::get('/blogs/view/{id}', [FrondendController::class, 'singleblog'])->name('blogs.detailView');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::post('blogs/fetch', [BlogController::class, 'fetchBlogs'])->name('blogs.fetch');
Route::post('/blogs/publish', [BlogController::class, 'publish'])->name('blogs.publish');
 






     Route::get('/index',[BlogController::class,'dashboard']);
    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);
    Route::resource('blogs', BlogController::class);
});

require __DIR__.'/auth.php';
