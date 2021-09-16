<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    public $timestamps = false;
    public $guarded = false;

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function session()
    {
        return $this->hasMany(Session::class, 'place_id');
    }


}
