<?php

namespace App\Models\Configuration;

use App\Models\Configuration\Property\Property;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Configuration extends Model
{
    use HasFactory;

    public function configurationTemplate(): BelongsTo {
        return $this->belongsTo(ConfigurationTemplate::class);
    }

    public function properties(): HasMany {
        return $this->hasMany(Property::class);
    }
}
