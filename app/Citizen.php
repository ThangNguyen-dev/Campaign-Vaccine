<?php

namespace App;

use App\Http\Resources\RegistraionRS;
use Illuminate\Database\Eloquent\Model;

class Citizen extends Model
{
    public $timestamps = false;
    public $guarded = [];

    public function registration()
    {
        return $this->hasMany(Registration::class, 'citizen_id');
    }
}
