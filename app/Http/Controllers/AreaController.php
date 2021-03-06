<?php

namespace App\Http\Controllers;

use App\Area;
use App\Campaign;
use Illuminate\Http\Request;

class AreaController extends Controller
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
        return view('areas.create', ['campaign' => $campaign]);
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
            ['name' => 'required']
        );

        $data['campaign_id'] = $campaign->id;

        Area::create($data);

        return redirect()->route('campaign.show', $campaign->id)->with(['success' => 'Area successfully created']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Area $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Area $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Area $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Area $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        //
    }
}
