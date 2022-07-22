<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
class AuthController extends Controller
{
    //
    public function register()
    {
        return view('auth.register');
    }

    public function handleRegister(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'password' => 'required|string|max:50|min:5',
        ]);

        // Create new Row in Database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // login
        Auth::login($user);

        return redirect( route('books.index'));
    }


    public function login()
    {
        return view('auth.login');
    }

    public function handleLogin(Request $request)
    {
        // Validation
        $request->validate([
            'email' => 'required|email|max:100',
            'password' => 'required|string|max:50|min:5',
        ]);

        // Check data in the database first
        Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        //Check data in the database first
        $is_login = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        // dd($is_login);

        if(! $is_login)
        {
            return back();
        }

        return redirect( route('books.index'));

    }

    public function logout()
    {
        Auth::logout();

        return back();
    }

    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();
        // dd($user);
        // $user->token;
        $email = $user->email ;
        $db_user = User::where('email', '=', $email)->first();
        if($db_user == null)
        {
            $registered_User = User::create([
                'name' => $user->nickname,
                'email' => $user->email,
                'password' => Hash::make('123456'),
                'oauth_token' => $user->token,

            ]);

            // then store this user in session
            Auth::login($registered_User);
        }
        else
        {
            Auth::login($db_user);
        }

        return redirect( route('books.index') );
    }
}
