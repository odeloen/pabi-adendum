<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

view()->addNamespace('Ods\Elearning\Core', app_path('ods/elearning/core/views'));
view()->addNamespace('Ods\Elearning\General', app_path('ods/elearning/general/views/'));
view()->addNamespace('Ods\Elearning\Lecturer', app_path('ods/elearning/lecturer/views/'));
view()->addNamespace('Ods\Elearning\Member', app_path('ods/elearning/member/views/'));
view()->addNamespace('Ods\Elearning\Admin', app_path('ods/elearning/admin/views/'));

Route::prefix('admin')
     ->namespace('App\Ods\Elearning\Admin\Controllers')
     ->group(base_path('app/ods/elearning/admin/config/route.php'));

Route::prefix('lecturer')
     ->namespace('App\Ods\Elearning\Lecturer\Controllers')
     ->group(base_path('app/ods/elearning/lecturer/config/route.php'));

Route::prefix('member')
     ->namespace('App\Ods\Elearning\Member\Controllers')
     ->group(base_path('app/ods/elearning/member/config/route.php'));

Route::prefix('public')
     ->namespace('App\Ods\Elearning\General\Controllers')
     ->group(base_path('app/ods/elearning/general/config/route.php'));
