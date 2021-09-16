<?php

namespace App\Http\Controllers;

use App\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $campaigns = Campaign::where('organizer_id', Auth::user()->id)->get();
        return view('campaigns.index', ['campaigns' => $campaigns]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('campaigns.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required',
                'slug' => 'required|regex:/[a-zA-Z0-9\-]/',
                'date' => 'required'
            ],
            ['']
        );

        $isUsedSlug = Campaign::where('slug', $data['slug'])->first();
        if ($isUsedSlug) {
            return back()->withInput()->withErrors(['slug']);
        }

        $data['organizer_id'] = Auth::user()->id;
        $campaign = Campaign::create($data);

        return redirect()->route('campaign.show', $campaign->id)->with(['success' => 'Campaign successfully created']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        return view('campaigns.detail', ['campaign' => $campaign]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign)
    {
        return view('campaigns.edit', ['campaign' => $campaign]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campaign $campaign)
    {
        $data = $request->validate(
            [
                'name' => 'required',
                'slug' => 'required|regex:/[a-zA-Z0-9\-]/',
                'date' => 'required'
            ],
            ['']
        );
        $isUsedSlug = Campaign::where('id', '<>', $campaign->id)->where('slug', $data['slug'])->first();
        if ($isUsedSlug) {
            return back()->withInput()->withErrors(['slug']);
        }
        $campaign->update($data);

        return redirect()->route('campaign.show', $campaign->id)->with(['success' => 'Campaign successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        //
    }
}
