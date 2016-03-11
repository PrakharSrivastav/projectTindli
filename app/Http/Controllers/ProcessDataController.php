<?php

namespace App\Http\Controllers;

use App\Application;
use App\Message;
use App\Order;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Validator;
use Session;

class ProcessDataController extends Controller
{
    public function search(Request $request)
    {
        # get all the variables from the request
        $data['source_location'] = $request->input('source_location');
        $data['source_location_id'] = $request->input('source_location_hidden');
        $data['destination_location_id'] = $request->input('destination_location_hidden');
        $data['destination_location'] = $request->input('destination_location');
        // $data['size'] = $request->input('size');
        $sender_or_carrier = $request->input('sender_or_carrier');
        $data['travel_date'] = $request->input('travel_date');

        if (empty($sender_or_carrier)) {
            $data['sender_or_carrier'] = 'sender';
        } elseif ($sender_or_carrier == 'on') {
            $data['sender_or_carrier'] = 'carrier';
        }
        # setup the validation rules
        $validator = Validator::make($request->all(), [
            'source_location' => 'required',
            'destination_location' => 'required',
            'travel_date' => 'required',
            // 'size' => 'required',
        ]);

        # if the values exist in the session then reset them.
        # else set it in session
        $session_data = [];
        $session_data ['source_location'] = $data['source_location'];
        $session_data ['source_location_hidden'] = $data['source_location_id'];
        $session_data ['destination_location_hidden'] = $data['destination_location_id'];
        $session_data ['destination_location'] = $data['destination_location'];
        $session_data ['sender_or_carrier' ] =  $sender_or_carrier;
        // $session_data [] = ['size' => $data['size';
        $session_data ['travel_date'] = $data['travel_date'];
        $this->addToSession($session_data,$request);

        # and redirect to the homepage with the error messages.
        # if the validation fails
        if ($validator->fails()) {
            return redirect()->route('home')->withErrors($validator)->withInput();
        } else {
            // return $request->all();
            # if all is good so far check whether the user intends to be a carrier or sender
            # if the user is a sender
            if ($data['sender_or_carrier'] == 'sender') {
                $this->addToSession(['order_num' => str_random(10).date('YmdHHIISS').str_random(10)],$request);
                // print_r($request->session());
                return view('public.sender-order');
            } elseif ($data['sender_or_carrier'] = 'carrier') {
                $orders = Order::where('to_city_id', $data['destination_location_id'])
                    ->orderBy('travel_date', 'desc')
                    ->get();

                return view('public.carrier-results', compact('orders'));
            } else {
                return redirect()->route('home')->withInput();
            }
        }
    }
    /**
     * adds data to the current session.
     *
     * @param [array] $session_data array containing the session data as key and value
     */
    private function addToSession($session_data, Request $request)
    {
        if (is_array($session_data) && !empty($session_data)) {
            foreach ($session_data as $key => $value) {
                if ($request->session()->has($key)) {
                    $request->session()->forget($key);
                }
                $request->session()->put($key, $value);
            }
        }
    }

    public function prepareOrder(Request $request)
    {
        if (!$request->session()->has('register_sender_order')) {
            # get the order details from the submitted form
            $data['order_description'] = $request->input('order_description');
            $data['order_type'] = $request->input('order_type');
            $data['order_price'] = $request->input('order_price');
            $data['size'] = $request->input('size');
            # set the values in the session
            // $session_data = [];
            // $session_data[] = ['order_description' => $request->input('order_description')];
            // $session_data[] = ['order_type' => $request->input('order_type')];
            // $session_data[] = ['order_price' => $request->input('order_price')];
            $this->addToSession($data,$request);
        }

        # if the user is not authorized then ask for login
        if (Auth::check()) {
            if ($request->session()->has('register_sender_order')) {
                $request->session()->forget('register_sender_order');
            }
            $this->register_order($request);

            return redirect()->route('orders');
        } else {
            $this->addToSession(['register_sender_order' => true],$request);

            return redirect()->route('login');
        }
    }

    private function register_order(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $order = new Order();
            $order->order_name = $request->session()->get('order_num', str_random(10).date('YMDHIS').str_random(10));
            $order->sender_id = $user->id;
            $order->from_city = $request->session()->get('source_location');
            $order->from_city_id = $request->session()->get('source_location_hidden');
            $order->to_city = $request->session()->get('destination_location');
            $order->to_city_id = $request->session()->get('destination_location_hidden');
            $order->status = '0';
            $order->description = $request->session()->get('order_description');
            $order->type = $request->session()->get('order_type');
            $order->size = $request->session()->get('size');
            $order->price = $request->session()->get('order_price');
            $order->travel_date = $request->session()->get('travel_date');
            $order->save();
        }
    }

    public function getOrders()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $orders = Order::where('sender_id', $user->id)->get();

            return view('members.orders', compact('orders'));
        }
    }

    public function getOrder(Request $request, $order_name)
    {
        if (Auth::check()) {
            if ($request->session()->has('search_order_num')) {
                $request->session()->forget('search_order_num');
            }
            $order = Order::where('order_name', $order_name)->get();
            $order = $order[0];
            $user = User::findOrFail($order->sender_id);

            return view('members.order-details', compact('order', 'user'));
        } else {
            $this->addToSession([['search_order_num' => $order_name]],$request);

            return redirect()->route('login');
        }
    }

    public function messages()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $first = Message::where('from', $user->id)->select('sender_img', 'sender_name as s_navn', 'sender', 'reader_name', 'id', 'from as my_id', 'from_name as my_name', 'message', 'to as sender_id', 'to_name as sender_name', 'created_at', 'read', 'reader');
            $all = Message::where('to', $user->id)->select('sender_img', 'sender_name as s_navn', 'sender', 'reader_name', 'id', 'to as my_id', 'to_name as my_name', 'message', 'from as sender_id', 'from_name as sender_name', 'created_at', 'read', 'reader')->union($first)->orderBy('created_at', 'desc')->get();
            $all_data = [];
            $count = 0;
            $sender_id = '';
            $id = '';
            $first_sender = '';

            foreach ($all as $senders) {
                $temp = [];
                if ($count == 0 || $id != $senders->sender_id) {
                    $sender_name = $senders->sender_name;
                    $id = $senders->sender_id;
                    if ($count == 0) {
                        $first_sender['name'] = str_replace(' ', '_', $sender_name);
                        $first_sender['id'] = $senders->sender_id;
                    }
                    $temp['from'] = $senders->my_id;
                    $temp['from_name'] = $senders->my_name;
                    $temp['message'] = $senders->message;
                    $temp['sender_id'] = $senders->sender_id;
                    $temp['sender_name'] = $senders->sender_name;
                    $temp['created_at'] = $senders->created_at;
                    $temp['read'] = $senders->read;
                    $temp['reader'] = $senders->reader;
                    $temp['id'] = $senders->id;
                    $temp['r_navn'] = $senders->reader_name;
                    $temp['s_id'] = $senders->sender;
                    $temp['s_navn'] = $senders->s_navn;
                    $temp['s_img'] = $senders->sender_img;

                    $all_data[$sender_name][] = $temp;
                } else {
                    $temp['from'] = $senders->my_id;
                    $temp['from_name'] = $senders->my_name;
                    $temp['message'] = $senders->message;
                    $temp['sender_id'] = $senders->sender_id;
                    $temp['sender_name'] = $senders->sender_name;
                    $temp['created_at'] = $senders->created_at;
                    $temp['read'] = $senders->read;
                    $temp['reader'] = $senders->reader;
                    $temp['id'] = $senders->id;
                    $temp['r_navn'] = $senders->reader_name;
                    $temp['s_id'] = $senders->sender;
                    $temp['s_navn'] = $senders->s_navn;
                    $temp['s_img'] = $senders->sender_img;
                    $all_data[$sender_name][] = $temp;
                }
                ++$count;
            }

            return view('members.messages', compact('all_data', 'user', 'first_sender'));
        } else {
            return redirect()->route('login');
        }
    }

    public function getUnreadMessages()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $message = Message::where(['read' => '1', 'reader' => $user->id])->get();
            # get the unread messages for current user
            $result = [];
            foreach ($message as $msg) {
                $temp = [];
                $temp['id'] = $msg->id;
                $temp['read'] = $msg->read;
                $temp['reader'] = $msg->reader;
                $result[] = $temp;
            }

            return $result;
        }
    }

    public function applyForOrder(Request $request, $order_id)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $order = Order::findOrFail($order_id);
            $user_to = User::findOrFail($order->sender_id);
            $message = new Message();

            #check if the current user has already sent a request for this order
            $old_app = Application::where(['order_id' => $order_id, 'applier_id' => $user->id, 'status' => '0'])->count();
            if ($old_app > 0) {
                return ['message' => 'applied'];
            } else {
                # save the application
                $application = new Application();
                $application->order_id = $order_id;
                $application->applier_id = $user->id;
                $application->owner_id = $user_to->id;
                $application->status = '0';
                $application->save();

                # send a message
                $message->from = $user->id;
                $message->to = $user_to->id;
                $message->message = 'Request to carry from : '.$user->fname;
                $message->order_id = $order_id;
                $message->type = '0';
                $message->from_name = $user->fname;
                $message->to_name = $user_to->fname;
                $message->reader = $user_to->id;
                $message->read = '1';
                $message->sender = $user->id;
                $message->sender_name = $user->fname;
                $message->sender_img = $user->img_path;
                $message->reader_name = $user_to->fname;
                $message->save();

                return ['message' => 'success'];
            }
        }

        return ['message' => 'fail'];
    }

    public function cancelApplication(Request $request, $order_id)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $application = Application::where(['order_id' => $order_id, 'applier_id' => $user->id, 'status' => '0'])->get();
            if ($application->count() > 0) {
                Application::where(['order_id' => $order_id, 'applier_id' => $user->id, 'status' => '0'])
                    ->update(['status' => 2]);

                $order = Order::findOrFail($order_id);
                $user_to = User::findOrFail($order->sender_id);
                $message = new Message();

                # send a message
                $message->from = $user->id;
                $message->to = $user_to->id;
                $message->message = 'Request withdrawn by : '.$user->fname;
                $message->order_id = $order_id;
                $message->type = '2'; // withdrawl
                $message->from_name = $user->fname;
                $message->to_name = $user_to->fname;
                $message->reader = $user_to->id;
                $message->read = '1';
                $message->sender = $user->id;
                $message->sender_name = $user->fname;
                $message->sender_img = $user->img_path;
                $message->reader_name = $user_to->fname;
                $message->save();

                return ['message' => 'success'];
            }

            return ['message' => 'no_message'];
        }

        return ['message' => 'fail'];
    }

    public function getRequests(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $appls = Application::where(['owner_id' => $user->id, 'status' => '0'])->get();
            $required = [];
            foreach ($appls as $appl) {
                $temp = [];
                $order = Order::findOrFail($appl->order_id);
                $applier = User::findOrFail($appl->applier_id);
                $temp['order_name'] = $order->order_name;
                $temp['applier'] = $applier->fname;
                $temp['status'] = $appl->status;
                $temp['created_at'] = $appl->created_at->format('Y-m-d');
                $temp['from'] = $order->from_city;
                $temp['to'] = $order->to_city;
                $temp['travel_date'] = $order->travel_date->format('Y-m-d');
                $required[] = $temp;
            }

            return view('members.requests', compact('required'));
        }
    }
    public function markAsRead(Request $request)
    {
        // return $request->all();
        if (Auth::check()) {
            $user = Auth::user();
            $id = $request->input('message_id');
            $msg = Message::findOrFail($id);
            $msg->read = '0';
            $msg->save();

            $message = Message::where(['read' => '1', 'reader' => $user->id])->get();
            # get the unread messages for current user
            $result = [];
            foreach ($message as $msg) {
                $temp = [];
                $temp['id'] = $msg->id;
                $temp['read'] = $msg->read;
                $temp['reader'] = $msg->reader;
                $result[] = $temp;
            }

            return $result;
        }
    }
    public function sendMessage(Request $request)
    {
        if (Auth::check()) {
            $currentUser = Auth::user();
            $targetId = $request->input('to');
            $targetUser = User::findOrFail($targetId);
            $text = $request->input('text');
            $message = new Message();
            $message->from = $currentUser->id;
            $message->from_name = $currentUser->fname;
            $message->to = $targetUser->id;
            $message->to_name = $targetUser->fname;
            $message->type = '1'; // this is normal converastion
            $message->read = '1';
            $message->reader = $targetUser->id;
            $message->reader_name = $targetUser->fname;
            $message->sender = $currentUser->id;
            $message->sender_name = $currentUser->fname;
            $message->sender_img = $currentUser->img_path;
            $message->message = $text;
            if ($message->save()) {
                $status = ['code' => 100, 'message' => 'Message sent'];

                return die(json_encode($status));
            } else {
                $status = ['code' => 101, 'message' => 'There was error sending the message.<br>Please try after sometime'];

                return die(json_encode($status));
            }
        }
        $status = ['code' => 101, 'message' => 'You are not authorized to send this message.<br>Please login and try again'];

        return die(json_encode($status));
    }
}
