<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Campaign_ticket;
use Illuminate\Http\Request;

class Campaign_ticketController extends Controller
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
        return view('tickets.create', ['campaign' => $campaign]);
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
                'name' => 'required',
                'cost' => 'required',
            ]
        );

        if ($request['valid_until'] == 'amount') {
            $request->validate(
                ['amount' => 'required']
            );
            $data['special_validity'] = Campaign_ticket::setSpecialValidity($request['valid_until'], $request['amount']);
        } elseif ($request['valid_until'] == 'date') {
            $data['special_validity'] = Campaign_ticket::setSpecialValidity($request['valid_until'], $request['date']);
        }

        $data['campaign_id'] = $campaign->id;
        Campaign_ticket::create($data);

        return redirect()->route('campaign.show', $campaign->id)->with(['success' => 'Campaign ticket successfully created']);


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Campaign_ticket $campaign_ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign_ticket $campaign_ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Campaign_ticket $campaign_ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign_ticket $campaign_ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Campaign_ticket $campaign_ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campaign_ticket $campaign_ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Campaign_ticket $campaign_ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign_ticket $campaign_ticket)
    {
        //
    }
}
