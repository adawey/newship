<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    public $table ="shipings";
    protected $fillable = [
        'address',
        'typeof',
        'addof',
        'addtwo',
        'addthree',
        'ship_number',
        'status',
        'client_name',
        'type',
        'created_at',
    ];

    public function typ(){
        return $this->belongsTo(Type::class , 'type');
    }
}
