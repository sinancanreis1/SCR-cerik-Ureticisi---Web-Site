<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FooterLink extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeQuickLinks($query)
    {
        return $query->where('column', 'quick_links');
    }

    public function scopeServices($query)
    {
        return $query->where('column', 'services');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}
