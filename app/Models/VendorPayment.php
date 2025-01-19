<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorPayment extends Model
{
    use HasFactory;
    protected $table = 'vendorpayments';
    protected $fillable = [
        'auth_id',
        'amount',
        'employee_id',
        'balance_before',
        'balance_after',
        'created_at',
    ];
    public function leader()
    {
        return $this->belongsTo(User::class, "auth_id");
    }
    public function vendor()
    {
        return $this->belongsTo(User::class, "employee_id");
    }
}
