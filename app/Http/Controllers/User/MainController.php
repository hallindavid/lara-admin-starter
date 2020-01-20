<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MainController extends Controller
{

    public function dashboard() {
        return view('user.dashboard');
    }


    public function get_started() {
        return view('user.get_started');
    }

}
