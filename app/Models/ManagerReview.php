<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagerReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'responseSpeedStars',
        'priceStars',
        'keepsWordStars',
        'content',
        'user_id',
        'manager_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function manager()
    {
        return $this->belongsTo(Manager::class);
    }
}
