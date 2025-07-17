<?php

use App\Http\Controllers\Admin\Banner_Controller;
use App\Http\Controllers\Admin\Bidang_Controller;
use App\Http\Controllers\Admin\Category_Controller;
use App\Http\Controllers\Admin\Dashboard_Controller;
use App\Http\Controllers\Admin\FAQ_Controller;
use App\Http\Controllers\Admin\Image_Controller;
use App\Http\Controllers\Admin\List_Link_Controller;
use App\Http\Controllers\Admin\MaintenanceController;
use App\Http\Controllers\Admin\Menu_Public_Controller;
use App\Http\Controllers\Admin\News_Controller;
use App\Http\Controllers\Admin\Page_System_Controller;
use App\Http\Controllers\Admin\Pejabat_Controller;
use App\Http\Controllers\Admin\SosialMedia_Controller;
use App\Http\Controllers\Admin\User_Controller;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Guest\API_Edatabase_Controller;
use App\Http\Controllers\Guest\Guest_Category_Controller;
use App\Http\Controllers\Guest\Guest_News_Controller;
use App\Http\Controllers\Guest\Guest_Page_System_Controller;
use App\Http\Controllers\Guest\Guest_Profile_Controller;
use App\Http\Controllers\Guest\Home_Controller;
use App\Http\Controllers\IndikatorMakroController;
use App\Http\Controllers\IndikatorMakroSurveyController;
use App\Http\Controllers\Kabid\News_Kabid_Controller;
use App\Http\Controllers\Operator\News_Operator_Controller;
use App\Http\Controllers\UploadController;
use App\Http\Middleware\MaintenanceMode;
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
// Route::group(['middleware' => ['guest']], function () {
    
// });

Route::get('/', [Home_Controller::class, 'index'])->name('guest.index');
Route::get('/home/detail-realisasi', [Home_Controller::class, 'detailRealisasi'])->name('guest.detail-realisai');
Route::get('/home/get-category-bidang/{id}', [Guest_News_Controller::class, 'getAllCategory'])->name('guest.get-category');
Route::get('/home/show-news/{id}', [Guest_News_Controller::class, 'news'])->name('guest.news');
Route::get('/home/pages/{id}', [Guest_Page_System_Controller::class, 'show'])->name('guest.page-system');
Route::get('/home/ppid/{id}', [Guest_Page_System_Controller::class, 'showPpid'])->name('guest.showPpid');
Route::get('/profile/profile-pejabat', [Guest_Profile_Controller::class, 'index'])->name('guest.pejabat');
Route::get('/home/category/{id}', [Guest_Category_Controller::class, 'index'])->name('guest.category-news');
Route::get('/makro/{jenis}/{id?}', [API_Edatabase_Controller::class, 'curlListMakro']);

Route::get('/management', [LoginController::class, 'show'])->name('login.show');
Route::post('/management', [LoginController::class, 'login'])->name('login.perform');


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

    // Route::post('/upload-image-news', [News_Controller::class, 'uploadImage'])->name('upload.imageNews');
    Route::post('/upload-file-information', [Page_System_Controller::class, 'uploadFileEditor'])->name('page-system.uploadFileEditor');
    Route::post('/upload-file-news', [News_Controller::class, 'uploadFileEditor'])->name('news.uploadFileEditor');



    Route::group(['middleware' => ['superadmin']], function () {
        Route::resource('user', User_Controller::class);
        Route::patch('/user/{id}/reset-password', [User_Controller::class, 'resetPassword'])->name('user.resetPassword');

        Route::resource('menu-public', Menu_Public_Controller::class);
        // Route::resource('sosial-media', SosialMedia_Controller::class);
        Route::get('/sosial-media', [SosialMedia_Controller::class, 'index'])->name('sosial-media.index');
        Route::get('/sosial-media/{id}/edit', [SosialMedia_Controller::class, 'edit'])->name('sosial-media.edit');
        Route::put('/sosial-media/{id}', [SosialMedia_Controller::class, 'update'])->name('sosial-media.update');


        Route::resource('list-link', List_Link_Controller::class);
        // Route::resource('bidang', Bidang_Controller::class);
        Route::get('/bidang', [Bidang_Controller::class, 'index'])->name('bidang.index');

        Route::resource('banner', Banner_Controller::class);
        Route::resource('news', News_Controller::class);
        Route::post('/upload-image', [UploadController::class, 'store']);

        Route::resource('page-system', Page_System_Controller::class);
        Route::resource('pejabat', Pejabat_Controller::class);
        Route::resource('category', Category_Controller::class);
        Route::resource('faq', FAQ_Controller::class);


        Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance.index');
        Route::post('/maintenance/toggle', [MaintenanceController::class, 'toggleMaintenance'])->name('maintenance.toggle');

        Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance.index');

        Route::resource('indikator', IndikatorMakroSurveyController::class);

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
