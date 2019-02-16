<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
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

        // генеруємо унікальний URL
        $uniqueLink = Str::uuid()->toString();

        $subscriber = new Subscriber([
            'id' => $uniqueLink,
            'name' => $request->name,
            'email' => $request->email,
            'revoked' => ($request->unsubscribed ? 1 : 0),
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

        Subscriber::where('id', '=', $id)
        ->update([
            'revoked' => ($request->unsubscribed ? 1 : 0),
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
        Subscriber::where('id', '=', $id)
        ->delete();

        return redirect('/admin');
    }
}
