<?php

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

Route::group(['middleware'=>['site-info','access-log']],function(){
    Route::get('/','WebController@index');
    Route::get('gallery','WebController@gallery');
    Route::get('page/{id}','WebController@single_page');
    Route::get('promo/{slug}','WebController@single_promo');
    Route::get('news/{slug}','WebController@single_news');
    Route::get('event/{slug}','WebController@single_event');
    Route::get('subscribe','WebController@subscribe');


    Route::get('list-carousel','WebController@list_carousel');
    Route::get('list-menu','WebController@list_menu');
    Route::get('list-founder','KidsController@list_founder');
    Route::get('list-video-profile','KidsController@list_video_profile');
    Route::get('list-fasilitas','KidsController@list_fasilitas');
    Route::get('list-promo','KidsController@list_promo');
    Route::get('list-testimoni','KidsController@list_testimoni');
    Route::get('latest-news','KidsController@latest_news');
    Route::get('list-event','KidsController@list_event');
    Route::get('list-gallery','KidsController@list_gallery');
    Route::get('list-gallery-file','KidsController@list_gallery_file');
    Route::get('list-newsletter','KidsController@list_newsletter');
    Route::post('upload-file-ckfinder','KidsController@upload_file_ckfinder');
});

Route::post('/simpan-info','WebController@simpan_info');

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'data','middleware'=>'auth'],function(){
    /**================================= User */
    Route::resource('users','User\UserController');
    Route::get('user','User\UserController@login_info');
    Route::post('update-foto','User\UserController@update_foto');
    Route::post('update-info','User\UserController@update_info');
    Route::resource('roles','User\RoleController');
    Route::get('list-role','User\RoleController@list_role');
    Route::resource('permissions','User\PermissionController');
    Route::get('list-permission','User\PermissionController@list_permission');
    Route::post('save-permission-role/{id}','User\PermissionController@save_permission_role');
    Route::get('list-role-with-permission/{id}','User\RoleController@list_role_with_permission');
    Route::get('list-role-user','User\UserController@list_role');
    Route::post('save-role-user','User\UserController@save_role_user');
    Route::post('hapus-role-user','User\UserController@hapus_role_user');
    Route::post('change-password','User\UserController@change_password');
    Route::post('users/{user}/follow', 'User\UserController@follow')->name('follow');
    Route::delete('users/{user}/unfollow', 'User\UserController@unfollow')->name('unfollow');
    Route::get('notifications', 'User\UserController@notifications');
    Route::get('status-user/{id}','User\UserController@status_user');
    Route::post('update-role-user/{id}','User\UserController@update_role_user');
    /**================================== End User */

    /**================================== Instansi */
    Route::get('info','Backend\InfoController@index');
    Route::post('info','Backend\InfoController@save_info');
    Route::resource('fasilitas','Kids\FasilitasController');
    Route::resource('video','Kids\VideoController');
    Route::resource('kontak','Kids\KontakController');

    /**================================== CMS */
    Route::resource('post','Backend\PostController');
    Route::get('list-post','Backend\PostController@list_data');
    Route::get('info','Backend\InfoController@index');
    Route::post('info','Backend\InfoController@save_info');
    Route::resource('category','Backend\CategoryController');
    Route::get('sub-category-by-id/{id}','Backend\CategoryController@list_sub_category');
    Route::get('list-category','Backend\CategoryController@list_category');
    Route::get('list-artikel','Backend\PostController@list_artikel');
    Route::resource('modul','Backend\ModulController');
    Route::resource('event','Backend\EventController');
    Route::get('list-event','Backend\EventController@list_event');
    Route::resource('promo','Backend\PromoController');
    Route::resource('newsletter','Backend\NewsletterController');
    Route::resource('gallery','Backend\GalleryController');
    Route::resource('program','Backend\ProgramController');
    Route::resource('calendar','Backend\CalendarController');
    Route::get('detail-gallery/{id}','Backend\GalleryController@detail_gallery');
    Route::post('save-file-gallery/{id}','Backend\GalleryController@save_file_gallery');
    Route::delete('delete-file-gallery/{id}','Backend\GalleryController@detele_file_gallery');
    Route::resource('menu','Backend\MenuController');
    Route::get('list-menu','Backend\MenuController@list_menu');
    Route::get('status-menu/{id}','Backend\MenuController@status_menu');
    Route::resource('page','Backend\PageController');
    Route::delete('post-file/{id}','Backend\PageController@delete_post_file');

    Route::resource('headline','Backend\HeadlineController');
    Route::resource('testimoni','Backend\TestimoniController');
    Route::get('list-headline','Backend\HeadlineController@list_headline');
    Route::resource('tag','Backend\TagController');
    Route::get('list-tag','Backend\TagController@list_tag');
    Route::get('list-tags','Backend\TagController@list_tags');
    Route::get('list-sosmed','Backend\SosmedController@list_sosmed');
    Route::get('list-instansi-sosmed','Backend\SosmedController@index');
    Route::post('sosmed','Backend\SosmedController@store');
    Route::resource('carousel','Backend\CarouselController');
    Route::get('carousel-overlay','Backend\CarouselController@overlay');
    Route::post('carousel-overlay','Backend\CarouselController@store_overlay');

    /**================================== KIDS */
    Route::resource('jabatan','Kids\JabatanController');
    Route::get('list-jabatan','Kids\JabatanController@list_jabatan');
    Route::resource('posisi','Kids\PosisiController');
    Route::get('list-posisi','Kids\PosisiController@list_posisi');
    Route::resource('founder','Kids\FounderController');
    Route::resource('pengurus','Kids\PengurusController');
});