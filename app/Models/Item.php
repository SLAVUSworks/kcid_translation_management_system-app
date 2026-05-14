<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'item_id',
        'item_code',
        'title_jp',
        'title_en',
        'description_jp',
        'description_en',
    ];

    protected $casts = [
        'item_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Scope untuk mengurutkan berdasarkan item_id
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('item_id', 'asc');
    }
}