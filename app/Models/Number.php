<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Number extends BaseModel
{
    use HasFactory;

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

    /** * @return \Illuminate\Database\Eloquent\Relations\HasMany */
    public function number_preferences()
    {
        return $this->hasMany(NumberPreference::class);
    }
}
