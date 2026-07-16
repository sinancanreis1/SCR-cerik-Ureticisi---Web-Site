<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderLink extends Model
{
    use HasFactory;

    protected $fillable = ['label', 'url', 'icon', 'sort_order', 'is_active', 'is_dynamic_page', 'page_template', 'page_title', 'page_description'];

    protected $casts = [
        'is_active' => 'boolean',
        'is_dynamic_page' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function dynamicItems()
    {
        return $this->hasMany(DynamicItem::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}
