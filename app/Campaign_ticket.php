<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use function GuzzleHttp\Psr7\_parse_request_uri;
use function GuzzleHttp\Psr7\str;

class Campaign_ticket extends Model
{
    public $timestamps = false;
    public $guarded = [];

    public static function setSpecialValidity($type, $value)
    {
        return json_encode(
            [
                'type' => $type,
                $type => $value,
            ]
        );
    }

    public function campagin()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }

    public function registration()
    {
        return $this->hasMany(Registration::class, 'ticket_id');
    }


    public function getDescription()
    {
        if ($this->special_validity != NULL) {
            $specialValidity = json_decode($this->special_validity);
            if ($specialValidity->type == 'amount') {
                if ($specialValidity->amount >= $this->registration->count()) {
                    return [
                        'description' => $specialValidity->amount . ' ticket available',
                        'available' => true,
                    ];
                } else {
                    return [
                        'description' => $specialValidity->amount . ' ticket available',
                        'available' => false,
                    ];
                }
            }
            if ($specialValidity->type == 'date') {
                if (date($specialValidity->date) >= Carbon::now()) {
                    return [
                        'description' => 'Available until ' . date('F d, Y', strtotime($specialValidity->date)),
                        'available' => true,
                    ];
                } else {
                    return [
                        'description' => 'Available until ' . date('F d, Y', strtotime($specialValidity->date)),
                        'available' => false,
                    ];
                }
            }
        } else {
            return [
                'description' => '',
                'available' => true,
            ];
        }
    }
}
