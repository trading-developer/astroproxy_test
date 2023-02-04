<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $comment
 * @property integer $status
 * @property integer $payment_method
 * @property boolean $is_autopay
 * @property float $total
 */
class Payment extends Model
{
    use HasFactory;

    public const STATUS_NEW = 1;
    public const STATUS_SUCCESS = 2;
    public const STATUS_FAILED = 3;

    public const PAYMENT_METHOD_VISA = 1;
    public const PAYMENT_METHOD_CASH = 2;
    public const PAYMENT_METHOD_CRIPTO = 3;

    protected $fillable = [
        'name',
        'comment',
        'status',
        'payment_method',
        'is_autopay',
        'total',
        'user_id',
        'service_id',
    ];

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param integer $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStatus($query, int $status)
    {
        return $query->where('status', $status);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function getStatusName(): string
    {
        return match ($this->status) {
            self::STATUS_NEW => 'Новый платеж',
            self::STATUS_SUCCESS => 'Оплачено',
            self::STATUS_FAILED => 'Произошла ошибка',
        };
    }
}
