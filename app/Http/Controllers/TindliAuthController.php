<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Validator;

class TindliAuthController extends Controller
{
    public function login(Request $request)
    {
        $data['email']    = $request->input("email");
        $data['password'] = $request->input("password");

        # Check the general inputs\
        # Using the validator trait as it provides more validation flexibility
        $validator = Validator::make($request->all(), [
            "password" => "required|min:8",
            "email"    => "required|email|exists:users,email",
        ]);

        # validate the user against the database entries
        $validator->after(function ($validator) use ($data) {
            # attempt a login: on failure create an error message
            if (!Auth::attempt(['email' => $data['email'], 'password' => $data['password'], "active" => '1'])) {
                $validator->errors()->add('email', 'Invalid Email-id / Password');
            }
        });

        # if the validation fails then redirect to the login page with errors
        if ($validator->fails()) {
            # in case the validation fails. flash the current email in the session
            if ($request->session()->has('email')) {
                $request->session()->forget('email');
                $request->session()->put('email', $data['email']);
            } else {
                $request->session()->put('email', $data['email']);
            }
            # and redirect to the login form with the error messages.
            return redirect()->route('login')->withErrors($validator)->withInput();
        } else {
            # if the validation above is succesfull Attaempt to login
            Auth::attempt(['email' => $data['email'], 'password' => $data['password'], "active" => '1'], true);
            if (Auth::check()) {
                # if the user is logged in successfully, lets show him the dashboard
                if($request->session()->has('search_order_num')){
                    return redirect()->route('get_order',['order_name'=>$request->session()->get('search_order_num')]);
                }
                return redirect()->route('dashboard');
            } else {
                # write a logic here to redirect to the error page showing login error.
                # not needed right away
            }
        }
    }

    public function logout(Request $request)
    {
        # first delete the current session
        Auth::logout();
        $request->session()->flush();
        $cookieParams = session_get_cookie_params();
        setcookie(session_name(), '', 0, $cookieParams['path'], $cookieParams['domain'], $cookieParams['secure'], $cookieParams['httponly']);
        $_SESSION = array();
        # redirect to the home page.
        return redirect()->route('home');
    }
}
