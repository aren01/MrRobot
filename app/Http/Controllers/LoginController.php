<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kreait\Laravel\Firebase\Facades\Firebase;

class LoginController extends Controller
{
    public function index()
    {
        return view("login");
    }

    public function login(Request $request)
    {
        $validator = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            $firebaseAuth = Firebase::auth();
            $signInResult = $firebaseAuth->signInWithEmailAndPassword($request->email, $request->password);

            $user = $signInResult->data();

            return view('home', ['user' => $user]);
        } catch (\Exception $e) {
            Session()->flash('error', 'Login failed. Please try again.');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/register');
    }
}
