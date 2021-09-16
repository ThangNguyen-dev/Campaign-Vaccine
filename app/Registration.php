<?php

namespace App;

use App\Http\Resources\Campaign_ticketRS;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    public $timestamps = false;
    public $guarded = [];

    public function ticket()
    {
        return $this->belongsTo(Campaign_ticket::class, 'ticket_id');
    }
}

