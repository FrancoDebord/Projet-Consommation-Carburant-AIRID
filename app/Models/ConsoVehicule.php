<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConsoVehicule extends Model
{
    //

protected $guarded = ["created_at","updated_at"];

public function missions() { return $this->hasMany(ConsoMission::class, 'vehicule_id'); }

/**
 * Get the typeCarburant that owns the ConsoVehicule
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
public function typeCarburant(): BelongsTo
{
    return $this->belongsTo(ConsoTypeCarburant::class, 'type_carburant_id', 'id');
}
}
