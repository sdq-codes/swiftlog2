<?php

namespace App\Models;


use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Model;

class Rider extends Model
{
    use UuidGenerator;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function guarantors() {
        return $this->hasMany(RiderGuarantor::class);
    }

    public function bikes() {
        return $this->hasMany(BikeRider::class);
    }
}
