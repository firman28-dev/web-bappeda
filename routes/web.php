<?php

use App\Http\Controllers\Admin\Banner_Controller;
use App\Http\Controllers\Admin\Bidang_Controller;
use App\Http\Controllers\Admin\Dashboard_Controller;
use App\Http\Controllers\Admin\Image_Controller;
use App\Http\Controllers\Admin\List_Link_Controller;
use App\Http\Controllers\Admin\Menu_Public_Controller;
use App\Http\Controllers\Admin\News_Controller;
use App\Http\Controllers\Admin\Page_System_Controller;
use App\Http\Controllers\Admin\Pejabat_Controller;
use App\Http\Controllers\Admin\User_Controller;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Guest\Guest_News_Controller;
use App\Http\Controllers\Guest\Guest_Page_System_Controller;
use App\Http\Controllers\Guest\Guest_Profile_Controller;
use App\Http\Controllers\Guest\Home_Controller;
use App\Http\Controllers\Kabid\News_Kabid_Controller;
use App\Http\Controllers\Operator\News_Operator_Controller;
use App\Http\Controllers\UploadController;
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
Route::group(['middleware' => ['guest']], function () {
    Route::get('/', [Home_Controller::class, 'index'])->name('guest.index');
    Route::get('/detail-realisasi', [Home_Controller::class, 'detailRealisasi'])->name('guest.detail-realisai');
    Route::get('/get-category-bidang/{id}', [Guest_News_Controller::class, 'getAllCategory'])->name('guest.get-category');
    Route::get('/show-news/{id}', [Guest_News_Controller::class, 'news'])->name('guest.news');
    Route::get('/pages/{id}', [Guest_Page_System_Controller::class, 'show'])->name('guest.page-system');
    Route::get('/ppid/{id}', [Guest_Page_System_Controller::class, 'showPpid'])->name('guest.showPpid');
    Route::get('/profile/profile-pejabat', [Guest_Profile_Controller::class, 'index'])->name('guest.pejabat');

    
    Route::get('/login', [LoginController::class, 'show'])->name('login.show');
    Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/unauthorized', function () {
        return view('error_page.error_403');
    })->name('unauthorized');

    Route::get('/logout', [LogoutController::class, 'perform'])->name('logout.perform');
    Route::get('/dashboard', [Dashboard_Controller::class, 'index'])->name('dashboard.index');

    Route::get('/profile', [User_Controller::class, 'profile'])->name('user.profile');
    Route::get('/profile/update', [User_Controller::class, 'editProfile'])->name('user.editProfile');
    Route::put('/profile/update-profile', [User_Controller::class, 'updateProfile'])->name('user.updateProfile');
    Route::put('/profile/update-password', [User_Controller::class, 'updatePassword'])->name('user.updatePassword');

    Route::post('/upload-image-information', [Page_System_Controller::class, 'uploadImage'])->name('upload.imageInformation');
    Route::post('/upload-image-news', [News_Controller::class, 'uploadImage'])->name('upload.imageNews');


    Route::group(['middleware' => ['superadmin']], function () {
        Route::resource('user', User_Controller::class);
        Route::patch('/user/{id}/reset-password', [User_Controller::class, 'resetPassword'])->name('user.resetPassword');

        Route::resource('menu-public', Menu_Public_Controller::class);
        Route::resource('list-link', List_Link_Controller::class);
        Route::resource('bidang', Bidang_Controller::class);
        Route::resource('banner', Banner_Controller::class);
        Route::resource('news', News_Controller::class);
        Route::post('/upload-image', [UploadController::class, 'store']);

        Route::resource('page-system', Page_System_Controller::class);
        Route::resource('pejabat', Pejabat_Controller::class);

    });

    Route::group(['middleware' => ['operator']], function () {
        Route::resource('op-news', News_Operator_Controller::class);
        Route::post('/op-upload-image', [News_Operator_Controller::class, 'uploadImage'])->name('op-upload.image');

        
    });

    Route::group(['middleware' => ['kabid']], function () {
        Route::resource('k-news', News_Kabid_Controller::class);
        Route::get('/k-news/data', [News_Kabid_Controller::class, 'getData'])->name('k-news.data');
    });
    
    
});


Route::get('/link-storage', function () {
    // Menjalankan perintah storage:link
    Artisan::call(command: 'storage:link');
    
    // Menampilkan pesan sukses
    return 'Storage linked successfully!';
});
