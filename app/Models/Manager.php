<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'phone', 'email', 'stars', 'supplier_id'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function managerReviews()
    {
        return $this->hasMany(ManagerReview::class);
    }
}
