<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ServicePage extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = ['title', 'subtitle', 'form_title', 'form_subtitle', 'cta_label', 'form_success_message'];

    public function faqs()
    {
        return $this->hasMany(ServicePageFaq::class)->orderBy('sort_order');
    }

    public function leadFormFields()
    {
        return $this->hasMany(LeadFormField::class)->orderBy('sort_order');
    }

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }
}
