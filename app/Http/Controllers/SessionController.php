<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Campaign_ticket;
use App\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Campaign $campaign)
    {
        return view('sessions.create', ['campaign' => $campaign]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Campaign $campaign, Request $request)
    {
        $data = $request->validate(
            [
                'type' => 'required',
                'title' => 'required',
                'vaccinator' => 'required',
                'place_id' => 'required',
                'cost' => 'required',
                'start' => 'required',
                'end' => 'required',
                'description' => 'required'
            ]
        );
        if (Session::isConflictTime('', $data['place_id'], $data['start'], $data['end'])) {
            return back()->withErrors(['start' => 'This time is already booking', 'end' => 'This time is already booking']);
        };

        Session::create($data);

        return redirect()->route('campaign.show', $campaign->id)->with(['success' => 'Session successfully created']);

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Session $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Session $session
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Session $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $session)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Session $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session)
    {
        //
    }
}
