<?php

namespace App\Http\Controllers\Api;

use App\Area;
use App\Campaign;
use App\Citizen;
use App\Http\Resources\AreaRS;
use App\Http\Resources\Campaign_ticketRS;
use App\Http\Resources\CampaignRS;
use App\Http\Resources\RegistrationRS;
use App\Organizer;
use App\Registration;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function campaigns()
    {
        $campaign = Campaign::where('date', '>', Carbon::now())->get();
        return response()->json(
            [
                'campaigns' => CampaignRS::collection($campaign),
            ], 200);
    }

    public function campaignsDetail(Request $request)
    {
        $organizer = Organizer::where('slug', $request['oSlug'])->first();
        if (is_null($organizer)) {
            return \response()->json(
                ['message' => 'Organizer not found']
                , 404);
        };

        $campaign = Campaign::where('organizer_id', $organizer->id)->where('slug', $request['cSlug'])->first();
        if (is_null($campaign)) {
            return \response()->json(
                ['message' => 'Campaign not found']
                , 404);
        };

        return \response()->json(
            [
                'id' => $campaign->id,
                'name' => $campaign->name,
                'slug' => $campaign->slug,
                'date' => $campaign->date,
                'areas' => AreaRS::collection($campaign->area),
                'tickets' => Campaign_ticketRS::collection($campaign->ticket),
            ], 200);

    }

    public function login(Request $request)
    {
        $citizen = Citizen::where('lastname', $request['lastname'])->where('registration_code', $request['registration_code'])->first();
        if (is_null($citizen)) {
            return \response()->json([
                'message' => 'Invalid login',
            ], 401);
        }
        $citizen['login_token'] = md5($citizen['username']);
        $citizen->update();

        return \response()->json(
            [
                'firstname' => $citizen['firstname'],
                'lastname' => $citizen['lastname'],
                'username' => $citizen['username'],
                'email' => $citizen['email'],
                'token' => $citizen['login_token']
            ], 200);
    }

    public function logout(Request $request)
    {
        $citizen = Citizen::where('login_token', $request['token'])->first();

        if (is_null($citizen)) {
            return \response()->json([
                'message' => 'Invalid token',
            ], 401);
        }

        $citizen['login_token'] = '';
        $citizen->update();

        return \response()->json(['message' => 'Logout success']);
    }

    public function getRegistrations(Request $request)
    {
        $citizen = Citizen::where('login_token', $request['token'])->first();

        if (is_null($citizen)) {
            return \response()->json([
                'message' => 'Invalid token',
            ], 401);
        }

        return \response()->json([
            'registrations' => RegistrationRS::collection($citizen->registration),
        ], 200);
    }
}
