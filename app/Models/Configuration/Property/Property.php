<?php

namespace App\Models\Configuration\Property;

use App\Models\Configuration\Configuration;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Property extends Model
{
    use HasFactory;

    public function configuration(): BelongsTo {
        return $this->belongsTo(Configuration::class);
    }
}
