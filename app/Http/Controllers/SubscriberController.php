<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Subscriber;

class SubscriberController extends Controller
{
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('welcome');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255'
        ]);

        // генеруємо унікальний URL
        $uniqueLink = Str::uuid()->toString();

        $subscriber = new Subscriber([
            'id' => $uniqueLink,
            'name' => $request->name,
            'email' => $request->email,
            'added_on' => Carbon::now(Subscriber::TIMEZONE),
            'expires_at' => Carbon::now(Subscriber::TIMEZONE)->addMonths(Subscriber::EXPIRED_MONTHS)
        ]);
        $subscriber->save();
        

        return view('welcome')->with([
              'subscribed' => TRUE,
              'uniqueLink' => $uniqueLink
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        return view('page_a');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        Subscriber::where('id', '=', $id)
        ->update(['revoked' => 1]);

        return view('unsubscribed');
    }
}
