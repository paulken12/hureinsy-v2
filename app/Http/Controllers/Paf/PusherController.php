<?php

namespace App\Http\Controllers\Paf;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Pusher\Pusher;

class PusherController extends Controller
{
    public function sendNotification()
    {
        //Remember to change this with your cluster name.
        $options = array(
            'cluster' => 'ap1', 
            'encrypted' => true
        );
 
       //Remember to set your credentials below.
        $pusher = new Pusher(
            '04e1a04d1bdb280bb48d',
            'dc2c3e4680b9c173979f',
            '636112',
            $options
        );
        
        $message= "Hello User";
        
        //Send a message to notify channel with an event name of notify-event
        $pusher->trigger('notify', 'notify-event', $message);  
    }
}
