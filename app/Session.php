<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    public $timestamps = false;
    public $guarded = [];

    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id');
    }

    public static function isConflictTime($session_id, $place_id, $start, $end): bool
    {
        if (!is_null($session_id)) {
            if (
                Session::where('place_id', $place_id)->where('start', '>=', $start)->where('end', '>=', $end)->where('start', '<=', $end)->first() ||
                Session::where('place_id', $place_id)->where('start', '>=', $start)->where('end', '<=', $end)->first() ||
                Session::where('place_id', $place_id)->where('start', '<=', $start)->where('end', '>=', $end)->first() ||
                Session::where('place_id', $place_id)->where('start', '<=', $start)->where('end', '<=', $end)->where('end', '>=', $start)->first()
            ) {
                return true;
            }
        } elseif (
            Session::where('idn', $session_id)->where('place_id', $place_id)->where('start', '>=', $start)->where('end', '>=', $end)->where('start', '<=', $end)->first() ||
            Session::where('idn', $session_id)->where('place_id', $place_id)->where('start', '>=', $start)->where('end', '<=', $end)->first() ||
            Session::where('idn', $session_id)->where('place_id', $place_id)->where('start', '<=', $start)->where('end', '>=', $end)->first() ||
            Session::where('idn', $session_id)->where('place_id', $place_id)->where('start', '<=', $start)->where('end', '<=', $end)->where('end', '>=', $start)->first()
        ) {
            return true;
        }
        return false;
    }
}
