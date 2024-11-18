<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Hash;
use App\Models\User;

class RegisterController extends Controller
{
    private $firebaseAuth;
    public function __construct()
    {
        $this->firebaseAuth = Firebase::auth();
    }

    public function index()
    {
        return view('register');
    }

    public function register(Request $request)
    { {
            $validator = $request->validate([
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
            ]);

            $email = $request->input('email');
            $password = $request->input('password');

            try {
                $createdUser = $this->firebaseAuth->createUserWithEmailAndPassword($email, $password);
                Session::flash('success', 'Registration successful!');
            } catch (\Exception $e) {
                Session::flash('error', 'Registration failed. Please try again');
            }
            return redirect()->route('register.index');
        }
    }
}
