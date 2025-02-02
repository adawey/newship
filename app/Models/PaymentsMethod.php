<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentsMethod extends Model
{
    use HasFactory;
    public $table = "payments_methods";
    protected $fillable = [
        'name',
    ];
}
