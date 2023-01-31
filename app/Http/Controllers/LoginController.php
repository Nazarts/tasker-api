<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
 
        try {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
            if (Auth::guard('web')->attempt($credentials)) {
                $request->session()->regenerate();
     
                return response()->json(['status' => true], 201);
            }
            return response()->json(['status' => false, 'errors' => 'Incorrect email or password'], 400);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'errors' => $th->getMessage()], 400);
        }
    }
}
