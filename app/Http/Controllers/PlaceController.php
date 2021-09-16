<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
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
        return view('places.create', ['campaign' => $campaign]);
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
                'area_id' => 'required',
                'capacity' => 'required',
            ]
        );

        $place = new Place();
        $place->name = $data['name'];
        $place->area_id = $data['area_id'];
        $place->capacity = $data['capacity'];
        $place->save();


        return redirect()->route('campaign.show', $campaign->id)->with(['success' => 'Place successfully created']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Place $place
     * @return \Illuminate\Http\Response
     */
    public function show(Place $place)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Place $place
     * @return \Illuminate\Http\Response
     */
    public function edit(Place $place)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Place $place
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Place $place)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Place $place
     * @return \Illuminate\Http\Response
     */
    public function destroy(Place $place)
    {
        //
    }
}
