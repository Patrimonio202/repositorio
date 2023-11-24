<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;


class AuthController extends Controller
{
    public function redirect(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callback(){     
        $user = Socialite::driver('facebook')->stateless()->user();
       
        // $user= User::create([
        //     'name'=>$user-> getName(),
        //     'email'=>$user->getEmail()
        // ]);
        //busca con el email, si encuentra el registro devuelve el objeto, y si no, lo crea en el sistema
        $user=User::firstOrCreate([
            'email'=>$user->getEmail(),
        ],[
            'name'=>$user-> getName(),
            'email_verified_at'=> Carbon::now()->format('Y/m/d H:i:s')
        ]);

        auth()->login($user);

        return redirect()->to('/');

    }

    public function redirectg(){
        return Socialite::driver('google')->redirect();
    }

    public function callbackg(){
        $user = Socialite::driver('google')->stateless()->user();       
        //busca con el email, si encuentra el registro devuelve el objeto, y si no, lo crea en el sistema
        
        $user=User::firstOrCreate([
            'email'=>$user->getEmail(),
        ],[
            'name'=>$user-> getName(),
            'email_verified_at'=>Carbon::now()->format('Y/m/d H:i:s')
        ]);

       
        auth()->login($user);

        return redirect()->to('/');
    }


}
