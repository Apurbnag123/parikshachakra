<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FeePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'fee_account_id',
        'receipt_no',
        'amount',
        'paid_on',
        'payment_mode',
        'transaction_id',
        'reference_no',
        'remarks',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'paid_on' => 'date',
        ];
    }

    public function feeAccount(): BelongsTo
    {
        return $this->belongsTo(FeeAccount::class);
    }
}
