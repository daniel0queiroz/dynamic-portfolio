<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class LinkPageSetting extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = ['profile_name', 'profile_bio'];

    protected $fillable = ['profile_name', 'profile_bio', 'default_locale', 'profile_image'];
}
