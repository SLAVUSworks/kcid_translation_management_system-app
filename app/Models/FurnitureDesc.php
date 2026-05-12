<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FurnitureDesc extends Model
{
    protected $fillable = [
        'furniture_desc_id',
        'furniture_desc_code',
        'title_jp',
        'title_en',
        'description_jp',
        'description_en',
    ];

    protected $casts = [
        'furniture_desc_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Scope untuk mengurutkan berdasarkan furniture_desc_id
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('furniture_desc_id', 'asc');
    }
}
