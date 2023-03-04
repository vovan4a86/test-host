<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller {

    public function showIndex() {
        return view('welcome');
    }

    public function showGoogleApi() {
        return view('google-api-view');
    }

    public function showTest1() {
        return view('test1');
    }

    public function showTest2() {
        return view('test2');
    }
}
