<?php


namespace App\Ods\Announcement\Presenter\Controllers\View;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function list(){
        return view('Ods\Announcement::dummy');
    }

    public function show(){
        echo "View Admin Show";
    }

    public function createPage(){

    }
}
