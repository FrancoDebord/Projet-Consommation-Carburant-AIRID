<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsoMission extends Model
{
    //

    protected $table="conso_missions";

    protected $guarded = ["created_at","updated_at"];

    public function vehicule()
    {
        return $this->belongsTo(ConsoVehicule::class);
    }
    public function chefMission()
    {
        return $this->belongsTo(Conso_Personnels::class,"chef_mission");
    }
    public function chauffeurMission()
    {
        return $this->belongsTo(Conso_Personnels::class,"chauffeur");
    }
    public function carburants()
    {
        return $this->hasMany(ConsoCarburantMission::class, 'mission_id')->orderBy("date_remise");
    }
    public function finMission()
    {
        return $this->hasOne(ConsoPointsFinsMission::class, 'mission_id');
    }
}
