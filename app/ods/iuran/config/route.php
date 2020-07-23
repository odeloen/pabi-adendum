<?php
use Illuminate\Support\Facades\Route;

view()->addNamespace('Ods\Iuran', app_path('ods/iuran/views'));

Route::namespace('Web')->middleware(['web', 'login'])->group(function () {

    Route::group(['middleware'=> ['member']], function(){
        Route::get('member/list', "MemberWebController@getTuitionListPage")->name('member.tuition.list');
        Route::post('member/list/transaksi/buat', 'MemberWebController@createTuitionTransaction')->name('member.tuition.pay');
        Route::post('member/list/transaksi/ubah', 'MemberWebController@updateTuitionTransaction')->name('member.tuition.update');
        Route::post('member/list/transaksi/unggah', 'MemberWebController@uploadReceipt')->name('member.tuition.upload');
    });

    Route::group(['middleware'=> ['admin']], function(){
        Route::get('admin/verifikasi', 'VerificationController@getTuitionVerificationPage')->name('admin.tuition.verification.list');
        Route::post('admin/verifikasi/terima', 'VerificationController@acceptTuitionVerification')->name('admin.tuition.verification.accept');
        Route::post('admin/verifikasi/tolak', 'VerificationController@declineTuitionVerification')->name('admin.tuition.verification.decline');

        Route::get('admin/master', 'TuitionController@getTuitionMasterPage')->name('admin.master.list');
        Route::post('admin/master/buat', 'TuitionController@createTuition')->name('admin.master.create');
        Route::post('admin/master/ubah', 'TuitionController@updateTuition')->name('admin.master.update');

        Route::get('admin/riwayat', 'TuitionController@getHistoryPage')->name('admin.tuition.history');

        Route::post('admin/tac/ubah', 'TACController@updateTAC')->name('admin.tac.update');
    });
});

Route::namespace('Api')->prefix('api')->middleware(['web', 'api'])->group(function () {
    Route::get('member', 'MemberAPIController@getTuitionList');

    Route::get('member/status', 'MemberAPIController@getStatus');

    Route::get('transaksi/{transactionID}', 'TransactionController@show');

    Route::get('tac', 'MemberAPIController@getTAC');

    Route::get('member/accounts', 'AccountController@getAccount');
    Route::get('member/payment-methods', 'PaymentMethodController@getPaymentMethods');
});

Route::namespace('Api')->prefix('api')->middleware(['api'])->group(function () {
    Route::post('member/transaksi/buat', 'MemberAPIController@createTuitionTransaction');
    Route::post('member/transaksi/ubah', 'MemberAPIController@updateTuitionTransaction');
    Route::post('member/transaksi/unggah', 'MemberAPIController@uploadReceipt');

    Route::post('midtrans', 'MidtransController@handleNotification');
});
