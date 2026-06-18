<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadAnswer extends Model
{
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function field()
    {
        return $this->belongsTo(LeadFormField::class, 'field_id');
    }
}
