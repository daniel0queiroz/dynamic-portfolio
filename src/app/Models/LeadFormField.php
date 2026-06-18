<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class LeadFormField extends Model
{
    use HasTranslations;

    public array $translatable = ['label', 'placeholder'];

    public function servicePage()
    {
        return $this->belongsTo(ServicePage::class);
    }

    public function getDecodedOptions(): array
    {
        return $this->options ? json_decode($this->options, true) : [];
    }

    public function getOptionLabel(string $value, string $locale): string
    {
        foreach ($this->getDecodedOptions() as $option) {
            if ($option['value'] === $value) {
                return $option['label'][$locale] ?? $option['label']['en'] ?? $value;
            }
        }
        return $value;
    }
}
