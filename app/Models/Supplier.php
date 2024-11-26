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
        'carType' => 'array',
        'dkp' => 'boolean',              // Boolean flag
        'image_spec' => 'boolean',       // Boolean flag
        'warantees' => 'boolean',        // Boolean flag
        'payWithoutPTC' => 'boolean',    // Boolean flag
    ];

    public function managers()
    {
        return $this->hasMany(Manager::class);
    }

    public function scopeSearch($query, array $filters = [])
    {
        collect($filters)->filter()->each(function ($values, $field) use ($query) {
            if (is_array($values)) {
                // Handle JSON fields
                if (in_array($field, ['carType', 'carSubtype', 'carMake'])) {
                    $query->where(function ($subQuery) use ($field, $values) {
                        foreach ($values as $value) {
                            $subQuery->orWhereJsonContains($field, $value);
                        }
                    });
                } else {
                    // Handle plain string fields like rating and workTerms
                    $query->where(function ($subQuery) use ($field, $values) {
                        foreach ($values as $value) {
                            $subQuery->orWhere($field, $value);
                        }
                    });
                }
            } else {
                // Handle single string inputs
                $query->where($field, 'like', "%{$values}%");
            }
        });

    }

    /**
     * Scope for filtering suppliers by distinct values for dropdowns and checkboxes.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return array
     */
    public static function preloadFilters()
    {
        // Fetch unique values for JSON fields and regular string fields
        $suppliers = self::select(['carType', 'carSubtype', 'carMake', 'name', 'rating', 'workTerms'])->get();

        return [
            'carTypes' => $suppliers->pluck('carType')->flatten()->unique()->sort()->values(),
            'carSubtypes' => $suppliers->pluck('carSubtype')->flatten()->unique()->sort()->values(),
            'carMakes' => $suppliers->pluck('carMake')->flatten()->unique()->sort()->values(),
            'names' => $suppliers->pluck('name')->unique()->sort()->values(),
            'ratings' => $suppliers->pluck('rating')->unique()->sort()->values(),
            'workTerms' => $suppliers->pluck('workTerms')->unique()->sort()->values(),
        ];
    }

}
