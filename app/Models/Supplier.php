<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'stars' => 'float',
        'emails' => 'array',
        'phones' => 'array',
        'carSubtype' => 'array',
        'carMake' => 'array',
        'carType' => 'array',
        'dkp' => 'boolean',
        'image_spec' => 'boolean',
        'warantees' => 'boolean',
        'payWithoutPTC' => 'boolean',
    ];

    public function managers()
    {
        return $this->hasMany(Manager::class);
    }

    public function supplierReviews()
    {
        return $this->hasMany(SupplierReview::class);
    }

    public function scopeSearch($query, array $filters = [])
    {
        foreach ($filters as $field => $values) {
            if (is_array($values)) {
                $query->where(function ($subQuery) use ($field, $values) {
                    foreach ($values as $value) {
                        if (in_array($field, ['carType', 'carSubtype', 'carMake'])) {
                            $subQuery->orWhereJsonContains($field, $value);
                        } else {
                            $subQuery->orWhere($field, $value);
                        }
                    }
                });
            } else {
                $query->where($field, 'like', "%{$values}%");
            }
        }
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
        $suppliers = self::select(['name'])->get();
        $criteria = Criteria::first();

        return [
            'carTypes' => $criteria->carTypes,
            'carSubtypes' => $criteria->carSubtypes,
            'carMakes' => $criteria->carMakes,
            'names' => $suppliers->pluck('name')->unique()->sort()->values(),
            'ratings' => $criteria->rating,
            'workTerms' => $criteria->workTerms,
        ];
    }
}
