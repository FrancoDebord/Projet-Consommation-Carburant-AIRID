<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsoVehicule extends Model
{
    //

protected $guarded = ["created_at","updated_at"];

public function missions() { return $this->hasMany(ConsoMission::class, 'vehicule_id'); }
}
