<?php

namespace App\Models;


use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Model;

class UserCoupon extends Model
{
    use UuidGenerator;

    protected $guarded = [];

    public function users() {
        return $this->belongsTo(User::class);
    }

    public function coupon() {
        return $this->hasOne(Coupon::class);
    }
}
