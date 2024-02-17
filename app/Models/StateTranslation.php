<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateTranslation extends Model {
    protected $table = 'state_translations';
    protected $fillable = ['name'];
    public $timestamps = false;
}