<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ServicePage extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = ['title', 'subtitle', 'video_url', 'form_title', 'form_subtitle', 'cta_label', 'form_success_message', 'whatsapp_message'];

    /**
     * Video URL for the given locale, falling back to whichever language
     * was filled in first (en, then es, then pt) if this locale is blank.
     */
    public function getVideoUrlForLocale(string $locale): ?string
    {
        foreach (array_unique([$locale, 'en', 'es', 'pt']) as $fallbackLocale) {
            $value = $this->getTranslation('video_url', $fallbackLocale, false);
            if ($value) {
                return $value;
            }
        }

        return null;
    }

    /**
     * WhatsApp pre-filled message for the given locale, falling back to whichever
     * language was filled in first (en, then es, then pt) if this locale is blank.
     */
    public function getWhatsappMessageForLocale(string $locale): ?string
    {
        foreach (array_unique([$locale, 'en', 'es', 'pt']) as $fallbackLocale) {
            $value = $this->getTranslation('whatsapp_message', $fallbackLocale, false);
            if ($value) {
                return $value;
            }
        }

        return null;
    }

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
