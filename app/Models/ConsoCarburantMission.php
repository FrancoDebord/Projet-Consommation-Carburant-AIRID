<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsoCarburantMission extends Model
{
    //

    protected $table="conso_carburants_mission";
    protected $guarded = ["created_at", "updated_at"];


    public function mission()
    {
        return $this->belongsTo(ConsoMission::class, 'mission_id');
    }
    public function quiARemis()
    {
        return $this->belongsTo(Conso_Personnels::class, 'remis_par');
    }
}
