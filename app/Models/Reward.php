<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reward extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'employee_id',
        'auth_id',
        'amount',
        'date',
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, "employee_id");
    }
    public function leader()
    {
        return $this->belongsTo(User::class, "auth_id");
    }
}
