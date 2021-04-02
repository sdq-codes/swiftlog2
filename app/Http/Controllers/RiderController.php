<?php

namespace App\Http\Controllers;

use App\Classes\RiderManagement;
use App\Classes\TicketManagement;
use App\Classes\UserManagement;
use Illuminate\Http\Request;

class RiderController extends Controller {
    private $riderManagement;

    private $userManagement;

    public function __construct(
        RiderManagement $riderManagement,
        UserManagement $userManagement
    )
    {
        $this->userManagement = $userManagement;
        $this->riderManagement = $riderManagement;
    }

    public function all() {
        return $this->riderManagement->all();
    }
}
