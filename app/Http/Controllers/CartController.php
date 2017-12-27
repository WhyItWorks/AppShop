<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use App\Mail\newOrder;
use Mail;

class CartController extends Controller
{
    public function update(){
        $client = auth()->user();
        $cart = $client->cart;
        $cart->status = "Pending";
        $cart->order_date = Carbon::now();
        $cart->save();
        
        $admins = User::where('admin', true)->get();

        Mail::to($admins)->send(new NewOrder($client, $cart));

        $notification = "Tu pedido ha sido registrado correctamente. Pronto te contactaremos via mail";
        return back()->with(compact('notification'));
    }
}

