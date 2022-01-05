<?php

namespace App\Models;

class Status extends BaseModel
{
    protected $fillable = [
        'description',
        'color',
        'allow_customers',
        'allow_numbers',
    ];
}
