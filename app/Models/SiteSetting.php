<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'about_values'   => 'array',
        'about_services' => 'array',
        'home_quiz_questions' => 'array',
        'home_features' => 'array',
        'home_steps' => 'array',
        'home_stats' => 'array',
        'home_faqs' => 'array',
        'home_selected_blogs' => 'array',
        'home_selected_products' => 'array',
    ];
}
