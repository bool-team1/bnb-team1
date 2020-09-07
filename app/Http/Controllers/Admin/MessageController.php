<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Message;
use App\Apartment;
use App\User;
use Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::User();
        $messages = $user->apartments()->with("messages")->get()->pluck("messages")->flatten();


        $data = [ 
                "messages" => $messages, 
                "user" => $user
                ];

        return view("admin.messages.index", $data);
    }

   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::find($id);
        $apartment = Apartment::find($message->apartment_id);

        $data = [
            "message" => $message,
            "apartment" => $apartment
        ];

        return view("admin.messages.show", $data);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = Message::find($id);
        if($message) {
            $message->delete();
            return redirect()->route("admin.message.index");
        } else {
            return abort("404");
        };
    }
}
