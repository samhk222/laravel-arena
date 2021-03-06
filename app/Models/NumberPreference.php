<?php

namespace App\Models;

class NumberPreference extends BaseModel
{
    protected $fillable = [
        'number_id',
        'name',
        'value',
    ];

    /*================================================================================================================*/
    /*==================== RELATIONSHIPS =============================================================================*/
    /*================================================================================================================*/
    /** * @return \Illuminate\Database\Eloquent\Relations\BelongsTo */
    public function number()
    {
        return $this->belongsTo(Number::class);
    }
}
