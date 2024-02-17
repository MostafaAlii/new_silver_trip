<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
class Country extends Model {
    use HasFactory,Translatable; 
    protected $table = 'countries';
    protected $fillable = ['status','code','logo'];
    protected $translatedAttributes = ['name'];
    protected $with = ['translations'];
    public $timestamps = true;
    public function states() {
        return $this->hasMany(State::class, 'country_id');
    }

    public function status() {
        return $this->status ? 'Active' : 'NO Active';
    }

    public function scopeActive() {
        return $this->whereStatus(true)->get();
    }
}