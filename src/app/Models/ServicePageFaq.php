<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ServicePageFaq extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = ['question', 'answer'];

    public function servicePage()
    {
        return $this->belongsTo(ServicePage::class);
    }
}
