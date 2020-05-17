<?php

use Illuminate\Support\Facades\Route;

view()->addNamespace('Ods\Announcement', app_path('ods/announcement/presenter/views'));

Route::namespace('App\Ods\Announcement\Presenter\Controllers\View')->prefix('view/')->name('view.')->group(function (){
    Route::get('list', 'AdminController@list')->name('announcement.list');
    Route::get('show', 'AdminController@show')->name('announcement.show');
});

Route::namespace('App\Ods\Announcement\Presenter\Controllers\Web')->prefix('admin/')->name('admin.')->middleware(['web', 'login'])->group(function (){
    Route::post('create', 'AdminAnnouncementController@create')->name('announcement.create');
    Route::get('list', 'AdminAnnouncementController@list')->name('announcement.list');
    Route::get('show/{announcementID}', 'AdminAnnouncementController@show')->name('announcement.show');
    Route::post('delete', 'AdminAnnouncementController@delete')->name('announcement.delete');
});

Route::namespace('')->prefix('api')->middleware(['api'])->group(function () {

});

Route::namespace('Web')->middleware(['web'])->group(function () {
    Route::get("admin-list", function(){
        return view('Ods\Announcement::admin.list');
    });

    Route::get("member-list", function(){
        return view('Ods\Announcement::member.list');
    });
});

