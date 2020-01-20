<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use App\User;
use Illuminate\Http\Request;

class UpdatePreferencesController extends Controller
{
    public function index() {
        return view('user.preferences');
    }

    public function update_preferences(Request $request) 
    {   
        $validated = $request->validate([
            'state'=>['required','string', 'max:255','min:1'],
            'country' =>['required','string', 'max:255','min:1'],
            'timezone'=>['required','string','max:255','min:1']
        ]);
        
        $user = Auth::user();

        $user->fill($validated);
        $user->save();

        return "Success";
    }

    public function set_initial_preferences() {
        return view('user.first_set_preferences');
    }
}
