<?php

namespace App;

use App\Models\Order;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Model;

class RiderOrder extends Model
{
    //
    use UuidGenerator;

    public function order() {
        return $this->belongsTo(Order::class);
    }
}
