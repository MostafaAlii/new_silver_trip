<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;
class State extends Model {
    use HasFactory,Translatable; 

    protected $fillable = [
        'country_id',
        'status',
    ];
    protected $translatedAttributes = ['name'];
    protected $with = ['translations'];

    public function cities() {
        return $this->hasMany(City::class, 'state_id');
    }

    public function status() {
        return $this->status  ? 'Active' : 'NO Active';
    }

    public function country() {
        return $this->belongsTo(Country::class, 'country_id');
    }
}