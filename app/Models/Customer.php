<?php

namespace App\Models;

class Customer extends BaseModel
{
    protected $fillable = [
        'user_id',
        'status_id',
        'name',
        'document',
    ];

    /*================================================================================================================*/
    /*==================== RELATIONSHIPS =============================================================================*/
    /*================================================================================================================*/

    /** * @return \Illuminate\Database\Eloquent\Relations\BelongsTo */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}