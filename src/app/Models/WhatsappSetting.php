<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class WhatsappSetting extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = ['message'];

    /**
     * Pre-filled message for the given locale, falling back to whichever
     * language was filled in first (en, then es, then pt) if this locale is blank.
     */
    public function getMessageForLocale(string $locale): ?string
    {
        foreach (array_unique([$locale, 'en', 'es', 'pt']) as $fallbackLocale) {
            $value = $this->getTranslation('message', $fallbackLocale, false);
            if ($value) {
                return $value;
            }
        }

        return null;
    }
}
