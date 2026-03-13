<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PrivacyPolicy extends Model
{
    use HasTranslations;

    public array $translatable = ['title', 'description'];

    protected $fillable = ['title', 'description'];
}
