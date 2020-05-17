<?php

use Illuminate\Support\Facades\Route;

view()->addNamespace('Ods\Announcement', app_path('ods/announcement/presenter/views'));


Route::namespace('App\Ods\Announcement\Presenter\Controllers\Web')->prefix('admin/')->name('admin.')->middleware(['web', 'login'])->group(function (){
    Route::post('create', 'AdminAnnouncementController@create')->name('announcement.create');
    Route::get('list', 'AdminAnnouncementController@list')->name('announcement.list');
    Route::get('show/{announcementID}', 'AdminAnnouncementController@show')->name('announcement.show');
    Route::post('delete', 'AdminAnnouncementController@delete')->name('announcement.delete');
});

Route::namespace('App\Ods\Announcement\Presenter\Controllers\Web')->prefix('member/')->name('member.')->middleware(['web', 'login'])->group(function (){
    Route::get('list', 'MemberAnnouncementController@list')->name('announcement.list');
    Route::get('show/{announcementID}', 'MemberAnnouncementController@show')->name('announcement.show');
});

Route::namespace('')->prefix('api')->middleware(['api'])->group(function () {

});


