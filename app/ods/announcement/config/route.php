<?php

use Illuminate\Support\Facades\Route;

view()->addNamespace('Ods\Announcement', app_path('ods/announcement/presenter/views'));

Route::namespace('App\Ods\Announcement\Presenter\Controllers\View')->prefix('view/')->name('view.')->group(function (){
    Route::get('list', 'AdminController@list')->name('list');
    Route::get('show', 'AdminController@show')->name('show');
});

Route::namespace('App\Ods\Announcement\Presenter\Controllers\Web')->prefix('admin/')->name('admin.')->group(function (){
    Route::post('create', 'AdminAnnouncementController@create')->name('create');
    Route::get('list', 'AdminAnnouncementController@list')->name('list');
    Route::get('show/{announcementID}', 'AdminAnnouncementController@show')->name('show');
    Route::post('delete', 'AdminAnnouncementController@delete')->name('delete');
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

