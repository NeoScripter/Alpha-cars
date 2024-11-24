<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'name',
        'stars',
        'emails',
        'phones',
        'website',
        'platform_address',
        'unload_address',
        'legal_entity',
        'itn',
        'rrc',
        'rating',
        'carType',
        'carSubtype',
        'carMake',
        'workTerms',
        'supervisor',
        'dkp',
        'image_spec',
        'signees',
        'warantees',
        'payWithoutPTC',
    ];

    protected $casts = [
        'stars' => 'float',              // Ensure stars is always a float
        'emails' => 'array',             // Convert JSON to array
        'phones' => 'array',             // Convert JSON to array
        'carSubtype' => 'array',         // Convert JSON to array
        'carMake' => 'array',            // Convert JSON to array
        'dkp' => 'boolean',              // Boolean flag
        'image_spec' => 'boolean',       // Boolean flag
        'warantees' => 'boolean',        // Boolean flag
        'payWithoutPTC' => 'boolean',    // Boolean flag
    ];
}
