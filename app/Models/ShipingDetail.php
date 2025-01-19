<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipingDetail extends Model
{
    use HasFactory;

    public $table = "shiping_details";
    protected $fillable = [
        'shiping_id',
        'type_id',
        'driver_id',
        'tahmel_between',
        'car_number',
        'trailer_number',
        'charge_date',
        'charge_datetwo',
        'charge_between',
        'decharge_date',
        'shoaa',
        'tankat',
        'nolon',
        'tax',
        'gmrok',
        'karta',
        'mizan',
        'kobry',
        'transfar',
        'leaval',
        'goverment',
        'balance_fees',
        'entry',
        'overnight',
        'overnight2',
        'digging',
        'backfilling',
        'enamel_door',
        'accommodation',
        'totalone',
        'covenant',
        'discount',
        'blank_slice',
        'full_slice',
        'slice_kopry',
        'full_kopry',
        'entrance_fees',
        'gard',
        'due',
        'drivermony',
        'overnightdriv',
        'residual',
        'created_at',
    ];
    public function driv(){
        return $this->belongsTo(Driver::class , 'driver_id');
    }
    public function mainship(){
        return $this->belongsTo(Shipping::class , 'shiping_id');
    }
    public function payments(){
        return $this->hasMany(Payment::class , 'details_id');
    }
}