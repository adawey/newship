<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    public $table = "payments";
    protected $fillable = [
        'details_id',
        'auth_id',
        'amount',
    ];
    public function branch(){
        return $this->belongsTo(ShipingDetail::class , 'details_id');
    }
    public function leader()
    {
        return $this->belongsTo(User::class, "auth_id");
    }
   

}
