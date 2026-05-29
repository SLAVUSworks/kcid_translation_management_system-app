<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
    protected $fillable = [
        'quest_id',
        'quest_code',
        'title_jp',
        'title_en',
        'description_jp',
        'description_en',
    ];

    protected $casts = [
        'quest_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function translationStatus()
    {
        return $this->hasOne(
            TranslationStatus::class, 'reference_id'
        )->where('type', 'quest');
    }

    /**
     * Scope untuk mengurutkan berdasarkan quest_id
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('quest_id', 'asc');
    }
}