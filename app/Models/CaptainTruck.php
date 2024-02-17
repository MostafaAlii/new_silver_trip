<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class CaptainTruck extends Model {
    protected $table = "captain_trucks";
    protected $fillable = [
        'captain_id',
        'trunk_make_id',
        'trunk_model_id',
        'trunk_number',
        'trunk_color',
        'trunk_year',
    ];

    public function captain() {
        return $this->belongsTo(Captain::class,'captain_id');
    }

    public function trunk_make() {
        return $this->belongsTo(TrunkMake::class, 'trunk_model_id');
    }

    public function trunk_model() {
        return $this->belongsTo(TrunkModel::class, 'tricycle_model_id');
    }

    public function trunkImages() {
        return $this->hasMany(TrunkImage::class, 'imageable_id', 'id');
    }
}
