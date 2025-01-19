<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacation extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'vacations';
    protected $fillable = [
        'employee_id',
        'auth_id',
        'attachement',
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
