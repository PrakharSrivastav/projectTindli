<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Auth;

class MembersController extends Controller
{
    public function dashboard(){
    	if(Auth::check()){
    		$users = User::all();
            return view("members.dashboard",compact("users"));
    	}
    	else{
    		echo "You are not authorized to view this page";
    	}
    }
}
