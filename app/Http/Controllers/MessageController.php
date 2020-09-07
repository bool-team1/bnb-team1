<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Message;
use App\Apartment;
use App\User;
use Auth;

class MessageController extends Controller
{
       /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $apartment = Apartment::find($id);
        

        return view("guest.messages.create", compact("apartment"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $new_message = new Message();
        $new_message->fill($request->all());
        $new_message->save();

        $user_id = Apartment::find($request->apartment_id)->user_id;
        $request['user_email'] = User::find($user_id)->email;

        $request->validate([
            'sender' => 'required|max:30',
            'sender_email' => 'required|email|max:50',
            'object' => 'required|max:80',
            'body' => 'required'
        ]);

        Mail::raw(request("body"), function($message) {
            $message->to(request("user_email"))
                ->from(request("sender_email"))
                ->subject(request("object"));
        });

        return redirect('/');
    }

}
