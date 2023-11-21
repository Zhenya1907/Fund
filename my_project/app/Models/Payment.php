<?php

namespace App\Models;

use App\Events\NewPaymentEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public int $user_id;
    public float $payment;

    protected $fillable = [
        'user_id',
        'amount',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->user_id = $attributes['user_id'] ?? 0;
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function boot(): void
    {
        parent::boot();

        static::created(function () {
            event(new NewPaymentEvent());
        });
    }
}
