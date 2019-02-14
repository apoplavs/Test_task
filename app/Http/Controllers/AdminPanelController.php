<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscriber;
use Carbon\Carbon;

class AdminPanelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscribers = Subscriber::all();

        return view('admin_panel')->with([
              'subscribers' => $subscribers
            ]);

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
            'email' => 'required|string|email|max:255',
            'unsubscribed' => 'string|nullable',
            'expires' => 'required|date'
        ]);

        $revoked = ($request->unsubscribed ? 1 : 0);

        // генеруємо унікальний URL
        $uniqueLink = uniqid(str_random(32));

        $subscriber = new Subscriber([
            'name' => $request->name,
            'email' => $request->email,
            'url_token' => $uniqueLink,
            'revoked' => $revoked,
            'added_on' => Carbon::now(Subscriber::TIMEZONE),
            'expires_at' => $request->expires
        ]);
        $subscriber->save();

        return redirect('/admin');
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
        $request->validate([
            'unsubscribed' => 'string|nullable',
            'expires' => 'required|date'
        ]);

        $revoked = ($request->unsubscribed ? 1 : 0);

        Subscriber::where('url_token', '=', $id)
        ->update([
            'revoked' => $revoked,
            'expires_at' => $request->expires
        ]);

        return redirect('/admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        Subscriber::where('url_token', '=', $id)
        ->delete();

        return redirect('/admin');
    }
}
