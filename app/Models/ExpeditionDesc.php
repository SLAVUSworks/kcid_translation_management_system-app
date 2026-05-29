<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpeditionDesc extends Model
{
    protected $fillable = [
        'expedition_desc_code',
        'title_jp',
        'title_en',
        'description_jp',
        'description_en',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function translationStatus()
    {
        return $this->hasOne(
            TranslationStatus::class, 'reference_id'
        )->where('type', 'expedition_desc');
    }

    /**
     * Scope untuk mengurutkan berdasarkan expedition_desc_id
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('id', 'asc');
    }
}
