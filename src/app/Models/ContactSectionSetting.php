<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ContactSectionSetting extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = ['title', 'sub_title'];

    protected $fillable = ['title', 'sub_title'];
}
