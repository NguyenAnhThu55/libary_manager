<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
session_start();
use App\Models\Message;  
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Pusher\Pusher;

class ChatController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
    }

    // show all groups that User is Follow
    public function index()
    {
        $auth = $this->AuthLogin();
    // select all Users + count how many message are unread from the selected user
        $user = DB::select("select user_id, user_name, user_email, count(is_read) as unread 
        from tbl_users LEFT  JOIN  messages ON user_id = messages.from and is_read = 0 and messages.to = " . Session::get('admin_id') . "
        where user_id != " . Session::get('admin_id') . " 
        group by user_id, user_name, user_email");

        // $user = DB::select('tbl_users')->join('tbl_users','tbl_users.user_id','=','messages.id');
        // $users = User::all();

        return view('home', ['user' => $user]);
        
    }
    // get all Messages
    public function getMessage($user_id)
    {
    $my_id = Auth::id();

    // Make read all unread message sent
    Message::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);

    // Get all message from selected user
    $messages = Message::where(function ($query) use ($user_id, $my_id) {
    $query->where('from', $user_id)->where('to', $my_id);
    })->oRwhere(function ($query) use ($user_id, $my_id) {
     $query->where('from', $my_id)->where('to', $user_id);
    })->get();

    return view('messages.index', ['messages' => $messages]);
    }
   
   // send new message
    public function sendMessage(Request $request)
    {
        $from = Auth::id();
        $to = $request->receiver_id;
        $message = $request->message;

        $data = new Message();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0; // message will be unread when sending message
        $data->save();

        return $this->sendRequest($from, $message, $to);
    }
    public function sendRequest($from, $message, $to){	
        $users = DB::select("SELECT * FROM messages WHERE messages.to = " . Auth::id() . " ");
        if(isset($users)){
            foreach ($users as $p) {
                $Data = $p->to;
            }}
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true
            );
        $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'), 
                $options
            );
        // notification
        $data = ['from' => $from, 'to' => $to]; 
        $notify = 'notify-channel';
        $pusher->trigger($notify, 'App\\Events\\Notify', $data);
    }
  }
