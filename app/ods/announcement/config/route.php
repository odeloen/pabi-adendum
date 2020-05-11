<?php

use Illuminate\Support\Facades\Route;

view()->addNamespace('Ods\Announcement\Member', app_path('ods/announcement/member/views/'));
view()->addNamespace('Ods\Announcement\Admin', app_path('ods/announcement/admin/views/'));

Route::namespace('App\Ods\Announcement\Presenter\Controllers\Web')->prefix('admin/')->name('admin.')->group(function (){
    Route::post('create', 'AdminAnnouncementController@create')->name('create');
    Route::get('list', 'AdminAnnouncementController@list')->name('list');
    Route::get('show/{announcementID}', 'AdminAnnouncementController@show')->name('show');
    Route::post('delete', 'AdminAnnouncementController@delete')->name('delete');
});

Route::namespace('')->prefix('api')->middleware(['api'])->group(function () {

});
