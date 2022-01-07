<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status_id',
        'name',
        'document',
    ];

    const NEW_STATUS = "New";

    /*================================================================================================================*/
    /*==================== RELATIONSHIPS =============================================================================*/
    /*================================================================================================================*/

    /** * @return \Illuminate\Database\Eloquent\Relations\BelongsTo */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function numbers()
    {
        return $this->hasMany(Number::class);
    }
}
