<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'invoice_number', 'subtotal', 'discount',
        'total', 'amount_paid', 'change_amount', 'status',
        'payment_method', 'notes',
    ];

    protected $casts = [
        'subtotal'      => 'decimal:2',
        'discount'      => 'decimal:2',
        'total'         => 'decimal:2',
        'amount_paid'   => 'decimal:2',
        'change_amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }

    /**
     * Generate nomor invoice otomatis.
     */
    public static function generateInvoiceNumber(): string
    {
        $date  = now()->format('Ymd');
        $count = self::whereDate('created_at', today())->count() + 1;
        return 'TRX-' . $date . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);
    }
}
