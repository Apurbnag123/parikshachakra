<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FeeAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_fee',
        'concession',
        'notes',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'total_fee' => 'decimal:2',
            'concession' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(FeePayment::class);
    }

    public function payableAmount(): float
    {
        return max(0.0, (float) $this->total_fee - (float) $this->concession);
    }

    public function paidAmount(): float
    {
        // Avoid loading all payments if we already have a payments_sum in query.
        if (array_key_exists('payments_sum_amount', $this->attributes)) {
            return (float) ($this->attributes['payments_sum_amount'] ?? 0);
        }

        return (float) $this->payments()->sum('amount');
    }

    public function pendingAmount(): float
    {
        return max(0.0, $this->payableAmount() - $this->paidAmount());
    }
}

