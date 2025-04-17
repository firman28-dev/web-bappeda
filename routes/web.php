<?php

use App\Http\Controllers\Admin\Banner_Controller;
use App\Http\Controllers\Admin\Bidang_Controller;
use App\Http\Controllers\Admin\Image_Controller;
use App\Http\Controllers\Admin\List_Link_Controller;
use App\Http\Controllers\Admin\Menu_Public_Controller;
use App\Http\Controllers\Admin\News_Controller;
use App\Http\Controllers\Admin\Page_System_Controller;
use App\Http\Controllers\Guest\Guest_News_Controller;
use App\Http\Controllers\Guest\Guest_Page_System_Controller;
use App\Http\Controllers\Guest\Home_Controller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', function () {
    return view('partials.admin.index');
});

//menu public
Route::resource('menu-public', Menu_Public_Controller::class);
Route::resource('list-link', List_Link_Controller::class);
Route::resource('bidang', Bidang_Controller::class);
Route::resource('banner', Banner_Controller::class);
Route::resource('news', News_Controller::class);

Route::post('/upload-image', [Page_System_Controller::class, 'uploadImage'])->name('upload.image');
Route::resource('page-system', Page_System_Controller::class);


//guest
Route::get('/', [Home_Controller::class, 'index'])->name('guest.index');
Route::get('/detail-realisasi', [Home_Controller::class, 'detailRealisasi'])->name('guest.detail-realisai');
Route::get('/get-category-bidang/{id}', [Guest_News_Controller::class, 'getAllCategory'])->name('guest.get-category');
Route::get('/show-news/{id}', [Guest_News_Controller::class, 'news'])->name('guest.news');
Route::get('/pages/{id}', [Guest_Page_System_Controller::class, 'show'])->name('guest.page-system');

Route::get('/link-storage', function () {
    // Menjalankan perintah storage:link
    Artisan::call(command: 'storage:link');
    
    // Menampilkan pesan sukses
    return 'Storage linked successfully!';
});
