<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditReceipts extends Model
{
    use HasFactory;
    protected $fillable = [
        'receipt_reference_id',
        'credit_receipt_number',
        'total_amount_received',
        'description',
        'remark',
        'attachment',
    ];

    
    public function receiptReference()
    {
        return $this->belongsTo(ReceiptReferences::class, 'receipt_reference_id');
    }
}
