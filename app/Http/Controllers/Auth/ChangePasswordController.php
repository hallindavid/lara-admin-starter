<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Rules\MatchOldPassword;
use App\Rules\StrongPassword;
use Illuminate\Support\Facades\Hash;


class ChangePasswordController extends Controller
{
    public function index()
    {
        $breadcrumbs = [['name'=>'Dashboard', 'link'=>'/'], ['name'=>'Change Password']];
        return view('auth.passwords.change_password')->with('breadcrumbs', $breadcrumbs);
    }

    public function store(Request $request)
    {
        $request->validate([
            'current_password'=> ['required', new MatchOldPassword],
            'new_password'=>['required','confirmed', new StrongPassword],
        ]);
        auth()->user()->update(['password'=> Hash::make($request->new_password)]);

        Auth::logout();
        return redirect('/login');
    }
}
