<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use Auth;
use Illuminate\Support\Carbon;
use App\User;
use Exception;
use Illuminate\Support\Facades\Log;

class SocialAuthGoogleController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        try {
    
            $user = Socialite::driver('google')->user();
            // Log::debug('Google Login Successful', ['user'=>$user]);
            
            $finduser = User::where('google_id', $user->id)->first();
            
            if ($finduser == null)
            {
                $find_other_user = User::where('email', $user->email)->whereNotNull('email_verified_at')->first();
                if ($find_other_user) {
                    $find_other_user->update(['google_id'=>$user->id]);
                    $finduser = User::where('google_id', $user->id)->first();
                }
            }


            if($finduser){
                //Update from Google Settings
                $finduser->update([
                    'first_name'=>$user->user['given_name'],
                    'last_name'=>$user->user['family_name'],
                    'picture'=>$user->user['picture']
                ]);

                Auth::login($finduser);
    
                return redirect('/dashboard');
     
            }else{
                //Check to see if it's a user who's already verified via email
                
                

                $newUser = User::create([
                    'first_name'=>$user->user['given_name'],
                    'last_name'=>$user->user['family_name'],
                    'picture'=>$user->user['picture'],
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => encrypt('123456dummy')
                ]);

                 $newUser->email_verified_at = Carbon::now();
                 $newUser->save();

                Auth::login($newUser);
     
                return redirect('/set_preferences');
            }
    
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
