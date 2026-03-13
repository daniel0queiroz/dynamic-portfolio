<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class FooterInfo extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = ['info', 'copy_right'];

    protected $fillable = ['info', 'copy_right', 'powered_by'];
}
