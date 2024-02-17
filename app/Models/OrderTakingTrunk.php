<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTakingTrunk extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_trunk_id',
        'lat_caption',
        'long_caption',
    ];
}