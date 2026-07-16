<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DynamicItem extends Model
{
    protected $fillable = [
        'header_link_id',
        'title',
        'slug',
        'image',
        'short_description',
        'content',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function headerLink()
    {
        return $this->belongsTo(HeaderLink::class);
    }
    
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id', 'desc');
    }
}
