<?php

namespace App\Models\MicrosoftTenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MicrosoftTenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tenant_id',
        'application_id',
        'secret',
    ];

}
