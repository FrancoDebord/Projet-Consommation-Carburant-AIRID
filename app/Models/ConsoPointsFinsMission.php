<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsoPointsFinsMission extends Model
{
    //

protected $guarded = ["created_at","updated_at"];
public function mission() { return $this->belongsTo(ConsoMission::class, 'mission_id'); }
}
