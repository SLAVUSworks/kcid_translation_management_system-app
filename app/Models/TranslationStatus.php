<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TranslationStatus extends Model
{
    protected $fillable = [
        'type',
        'reference_id',
        'status',
    ];
}

