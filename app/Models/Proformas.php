<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proformas extends Model
{
    use HasFactory;

    protected $fillable = [
        'receipt_reference_id',
        'proforma_number',
        'due_date',
        'amount',
        'terms_and_condition',
        'remark',
        'attachment',
    ];

    public function receipts()
    {
        return $this->hasOne(Proformas::class, 'proforma_id','id');
    }
    public function receiptReference()
    {
        return $this->belongsTo(ReceiptReferences::class, 'receipt_reference_id');
    }

    public function receiptItems()
    {
        return $this->hasMany(ReceiptItem::class);
    }
    
}
