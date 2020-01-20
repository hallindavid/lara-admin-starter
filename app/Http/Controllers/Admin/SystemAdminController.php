<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Request as FacadesRequest;

class SystemAdminController extends Controller
{
    public function index()
    {
        return view('admin.system');
    }

    public function reset_system(Request $request) 
    {
        Artisan::call('migrate:refresh', ['--seed' => true]);
        return redirect('/login');
    }
}
