<?php

namespace App\Models;

class Number extends BaseModel
{
    protected $fillable = [
        'customer_id',
        'status_id',
        'number',
    ];

    const NEW_STATUS = "Active";

    /*================================================================================================================*/
    /*==================== RELATIONSHIPS =============================================================================*/
    /*================================================================================================================*/
    /** * @return \Illuminate\Database\Eloquent\Relations\BelongsTo */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /** * @return \Illuminate\Database\Eloquent\Relations\BelongsTo */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
