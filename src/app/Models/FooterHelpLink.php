<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class FooterHelpLink extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = ['name'];
}
