<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PortfolioItem extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = ['title', 'description', 'client'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
