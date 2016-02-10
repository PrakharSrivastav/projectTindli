<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Validator;

class ProcessDataController extends Controller
{
    public function search(Request $request)
    {
        # get all the variables from the request
        $data['source_location']         = $request->input('source_location');
        $data['source_location_id']      = $request->input('source_location_hidden');
        $data['destination_location_id'] = $request->input('destination_location_hidden');
        $data['destination_location']    = $request->input('destination_location');
        $data['size']                    = $request->input('size');
        $sender_or_carrier               = $request->input('sender_or_carrier');
        $data['travel_date']             = $request->input('travel_date');

        if (empty($sender_or_carrier)) {
            $data['sender_or_carrier'] = "sender";
        } else if ($sender_or_carrier == "on") {
            $data['sender_or_carrier'] = "carrier";
        }
        # setup the validation rules
        $validator = Validator::make($request->all(), [
            'source_location'      => 'required',
            'destination_location' => 'required',
            'travel_date'          => 'required',
            'size'                 => 'required',
        ]);

        # if the values exist in the session then reset them.
        # else set it in session
        # 1- source_location
        if ($request->session()->has('source_location')) {
            $request->session()->forget('source_location');
            $request->session()->put('source_location', $data['source_location']);
        } else {
            $request->session()->put('source_location', $data['source_location']);
        }
        # 2-Source_location_hidden (id)
        if ($request->session()->has('source_location_hidden')) {
            $request->session()->forget('source_location_hidden');
            $request->session()->put('source_location_hidden', $data['source_location_id']);
        } else {
            $request->session()->put('source_location_hidden', $data['source_location_id']);
        }
        # 3 destination_location_hidden
        if ($request->session()->has('destination_location_hidden')) {
            $request->session()->forget('destination_location_hidden');
            $request->session()->put('destination_location_hidden', $data['destination_location_id']);
        } else {
            $request->session()->put('destination_location_hidden', $data['destination_location_id']);
        }
        # 4 destination_location
        if ($request->session()->has('destination_location')) {
            $request->session()->forget('destination_location');
            $request->session()->put('destination_location', $data['destination_location']);
        } else {
            $request->session()->put('destination_location', $data['destination_location']);
        }
        # sender_or_carrier
        if ($request->session()->has('sender_or_carrier')) {
            $request->session()->forget('sender_or_carrier');
            $request->session()->put('sender_or_carrier', $sender_or_carrier);
        } else {
            $request->session()->put('sender_or_carrier', $sender_or_carrier);
        }
        # size
        if ($request->session()->has('size')) {
            $request->session()->forget('size');
            $request->session()->put('size', $data['size']);
        } else {
            $request->session()->put('size', $data['size']);
        }
        #travel_date
        if ($request->session()->has('travel_date')) {
            $request->session()->forget('travel_date');
            $request->session()->put('travel_date', $data['travel_date']);
        } else {
            $request->session()->put('travel_date', $data['travel_date']);
        }
        # and redirect to the homepage with the error messages.
        # if the validation fails
        if ($validator->fails()) {
            return redirect()->route('home')->withErrors($validator)->withInput();
        } else {
            // return $request->all();
            # if all is good so far check whether the user intends to be a carrier or sender
            # if the user is a sender
            if ($data['sender_or_carrier'] == "sender") {
                if ($request->session()->has('order_num')) {
                    $request->session()->put('order_num', str_random(10) . date("YmdHHIISS") . str_random(10));
                } else {
                    $request->session()->put('order_num', str_random(10) . date("YmdHHIISS") . str_random(10));
                }
                return view("public.sender-order");
            } else if ($data['sender_or_carrier'] = "carrier") {
            	$orders = Order::where('to_city_id',$data['destination_location_id'])
            				->orderBy('travel_date', 'desc')
            				->get();
            	// print_r($orders);
				return view("public.carrier-results",compact("orders"));            	
            } else {
                return redirect()->route('home')->withInput();
            }
        }
    }

    public function prepareOrder(Request $request)
    {
        # get the order details from the submitted form
        $data['order_description'] = $request->input('order_description');
        $data['order_type']        = $request->input('order_type');
        $data['order_price']       = $request->input('order_price');

        # set the values in the session
        if ($request->session()->has('order_description')) {
            $request->session()->put('order_description', $data['order_description']);
        } else {
            $request->session()->put('order_description', $data['order_description']);
        }

        if ($request->session()->has('order_type')) {
            $request->session()->put('order_type', $data['order_type']);
        } else {
            $request->session()->put('order_type', $data['order_type']);
        }

        if ($request->session()->has('order_price')) {
            $request->session()->put('order_price', $data['order_price']);
        } else {
            $request->session()->put('order_price', $data['order_price']);
        }

        # if the user is not authorized then ask for login
        if (Auth::check()) {
            $this->register_order($request);
            return redirect()->route("orders");
        } else {
            return redirect()->route('login');
        }

        # else forward the control to the next view
    }

    private function register_order(Request $request)
    {
        if (Auth::check()) {
            $user                = Auth::user();
            $order               = new Order();
            $order->order_name   = $request->session()->get('order_num', str_random(10) . date("YMDHIS") . str_random(10));
            $order->sender_id    = $user->id;
            $order->from_city    = $request->session()->get('source_location');
            $order->from_city_id = $request->session()->get('source_location_hidden');
            $order->to_city      = $request->session()->get('destination_location');
            $order->to_city_id   = $request->session()->get('destination_location_hidden');
            $order->status       = '0';
            $order->description  = $request->session()->get('order_description');
            $order->type         = $request->session()->get('order_type');
            $order->size         = $request->session()->get('size');
            $order->price        = $request->session()->get('order_price');
            $order->travel_date  = $request->session()->get('travel_date');
            $order->save();
        }
    }

    public function getOrders(){
    	if(Auth::check()){
    		$user = Auth::user();
    		$orders = Order::where('sender_id',$user->id)->get();
    		return view("members.orders",compact("orders"));
    	}
    }

    public function getOrder(Request $request, $order_name){
    	if(Auth::check()){
    		if($request->session()->has('search_order_num')){
    			$request->session()->forget('search_order_num');
    		}
    		$order = Order::where('order_name',$order_name)->get();
    		$order = $order[0];
    		$user = User::findOrFail($order->sender_id);
    		return view("members.order-details",compact("order","user"));
    	}
    	else{
    		if($request->session()->has('search_order_num')){
    			$request->session()->forget('search_order_num');
    			$request->session()->put('search_order_num', $order_name);
    		}
    		else {
    			$request->session()->put('search_order_num', $order_name);
    		}
    		return redirect()->route('login');
    	}
    }

    public function messages(){
    	if(Auth::check()){
    		return view("members.messages");
    	}
    	else{
    		return redirect()->route('login');
    	}
    }

}
