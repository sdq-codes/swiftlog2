<?php

namespace App\Classes;

use App\Repositories\Interfaces\RiderGuarantorRepositoryInterface;
use App\Repositories\Interfaces\RiderRepositoryInterface;
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
        return $this->riderRepository->all();
    }
}
