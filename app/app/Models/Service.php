<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $description
 * @property integer $status
 * @property float $price
 */
class Service extends Model
{
    use HasFactory;

    public const STATUS_ACTIVE = 1;
    public const STATUS_DISABLE = 0;

    protected $fillable = [
        'name',
        'description',
        'status',
        'price',
    ];

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
