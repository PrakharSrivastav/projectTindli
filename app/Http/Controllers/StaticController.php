<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Mail;
use Validator;

class StaticController extends Controller
{
    public function home()
    {
        return view('public.homepage');
    }

    public function login()
    {
        return view('public.login');
    }

    public function register(Request $request)
    {

        return view('public.register');
    }

    public function termsAndCondition()
    {
        return view("public.terms-and-conditions");
    }

    public function store(Request $request)
    {
        $fname      = $request->input("fname");
        $lname      = $request->input("lname");
        $password   = $request->input("password");
        $c_password = $request->input("c_password");
        $email      = $request->input("email");
        $tnc        = $request->input("tnc");

        $validator = Validator::make($request->all(), [
            "fname"      => "required|min:3",
            "lname"      => "required|min:3",
            "password"   => "required|min:8",
            "c_password" => "required|min:8|same:password",
            "email"      => "required|email|unique:users,email",
            "tnc"        => "required",
        ]);

        if ($validator->fails()) {
            $request->session()->flush();
            $request->session()->put('fname', $fname);
            $request->session()->put('lname', $lname);
            $request->session()->put('email', $email);
            return redirect()->route('register')->withErrors($validator)->withInput();
        } else {
            $request->session()->flush();
            # create new user
            $user = User::create([
                'fname'              => $fname,
                'lname'              => $lname,
                'email'              => $email,
                'active'             => '0',
                'tnc'                => '1',
                'password'           => bcrypt($password),
                'registration_token' => str_random(40),
            ]);
            # create the activation url
            $user->activation_url = route('registered', ["token" => $user->id . "|" . $user->registration_token]);
            # send an email with activation url
            $this->sendEmail($user);
            return view("public.register-success-page");
        }
    }

    private function sendEmail($user)
    {
        Mail::send("public.register-success-email", ["user" => $user], function ($message) use ($user) {
            $message->from("hello@prakharsrivastav.com", "Tindli Admin");
            $message->sender("hello@prakharsrivastav.com", "Tindli Admin");
            $message->to($user->email, $user->name);
            $message->replyTo("hello@prakharsrivastav.com", "Tindli Admin");
            $message->subject("Tindli : Account Activation");
            $message->getSwiftMessage();
        });
    }

    public function registrationSuccess($token)
    {
        # split the token on the delimiter "|"
        $token_arr = explode("|", $token);
        # get the first character of the token. Thats userid
        $user_id = $token_arr[0];
        # get the rest of the characters thats actual token
        $actual_token = substr($token, strlen($token_arr[0]) + 1);
        # get the user details from the database matching this criteria.
        $users = User::where(["id" => $user_id, "active" => "0"])->get();
        # if user found redirect to the registrasuccess page.
        foreach ($users as $user) {
            if ($user->active == "0") {
                if (trim($user->registration_token) == trim($actual_token)) {
                    $user->registration_token = "";
                    $user->active             = "1";
                    $user->save();
                    // return view("public.register-success-page");
                    $status_message = "Your Account has been activated successfully";
                    return view("public.register-warning", compact("status_message"));
                } else {
                    $status_message = "Wrong authentication Token. Please try again.";
                    return view("public.register-warning", compact("status_message"));
                }

            }
            # if active == 1 , customer already activated
            elseif ($user->active == "1") {
                $status_message = "Your account is already active. Please login to continue.";
                return view("public.register-warning", compact("status_message"));
            }
            # someone hacking
            else {
                $status_message = "Invalid user token OR your account has been arady activated.<br>Please check and try again";
                return view("public.register-warning", compact("status_message"));
            }
        }
        return view("public.register-success-page");
    }

    public function getLocationsApi(Request $request)
    {
        $google_api_key   = "AIzaSyAqxa3breHK-zqDQAY4oTQgaQKSTMjCTJE";
        $location         = trim($request->input('city'));
        $location         = strip_tags($location);
        $location         = stripslashes($location);
        $location         = $this->clean($location);
        $google_end_point = "https://maps.googleapis.com/maps/api/place/autocomplete/json?input=" . $location . "&types=(cities)&key=" . $google_api_key;

        # initialize curl
        $ch      = curl_init();
        $message = "";
        # set curl parameter
        curl_setopt($ch, CURLOPT_URL, $google_end_point);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 6);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        # get output from the endpoint
        $output = curl_exec($ch);

        # validate the message
        if ($output === false) {
            $message = [
                "status"  => 100,
                "errono"  => curl_errno($ch),
                "message" => curl_error($ch),
            ];
        } else {
            # transform the message from the api here if needed. (nothing for now)
            // $message = json_encode(simplexml_load_string($output));
            $message = $output;
        }
        curl_close($ch);
        return $message;
    }

    private function clean($string)
    {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

    public function howItWorks(){
        return view("public.how-it-works");
    }
}
