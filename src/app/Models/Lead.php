<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    public function servicePage()
    {
        return $this->belongsTo(ServicePage::class);
    }

    public function answers()
    {
        return $this->hasMany(LeadAnswer::class)->with('field');
    }
}
