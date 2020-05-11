<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

view()->addNamespace('Ods\Core', app_path('ods/core/views/'));

Route::prefix('iuran')
     ->namespace('App\Ods\Iuran\Controllers')
     ->group(base_path('app/ods/iuran/config/route.php'));

Route::prefix('user')
     ->namespace('App\Ods\Auth\Controllers')
     ->group(base_path('app/ods/auth/config/route.php'));

Route::prefix('elearning')->group(base_path('app/ods/elearning/core/config/route.php'));

Route::prefix('quiz')->group(base_path('app/ods/elearning/quiz/presenter/config/route.php'));

Route::prefix('announcement')->group(base_path('app/ods/announcement/config/route.php'));

Route::get('sl/images/{filename}', function($filename){
     $path = storage_path('app\\public\\'.$filename);
     $path = str_replace("\\", "/", $path);
     // dd($path);

     if (!File::exists($path)) {
         abort(404);
     }

     $file = File::get($path);
     $type = File::mimeType($path);

     $response = Response::make($file, 200);
     $response->header("Content-Type", $type);

     return $response;
})->where('filename', '(.*)')->name('sl.file.images');
