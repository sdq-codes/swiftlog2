<?php

namespace App\Classes;

use App\Repositories\Interfaces\RiderGuarantorRepositoryInterface;
use App\Repositories\Interfaces\RiderRepositoryInterface;
use App\RiderOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiderManagement
{
    private $riderRepository;

    private $riderGuarantorRepository;

    public function __construct(
        RiderRepositoryInterface $riderRepository,
        RiderGuarantorRepositoryInterface $riderGuarantorRepository
    ) {
        $this->riderRepository = $riderRepository;
        $this->riderGuarantorRepository = $riderGuarantorRepository;
    }

    public function all() {
        return response()->fetch(
            'Riders fetched',
            $this->riderRepository->all(),
            'riders'
        );
    }

    public function orderToRider(Request $request) {
        $riderOrder = RiderOrder::create([
            'order_id' => $request->order_id,
            'rider_id' => $request->rider_id,
        ]);
        return $riderOrder;
    }
}
