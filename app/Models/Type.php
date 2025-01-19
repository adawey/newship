<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    public $table = "types";
    protected $fillable = [
        'name',
        'days',
        'daystwo',
        'overnightone',
        'nolon',
        'overnight',
        'parent_id'
    ];
    public function parent()
    {
        return $this->belongsTo(Type::class, 'parent_id');
    }
}
