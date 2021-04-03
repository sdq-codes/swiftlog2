<?php

namespace App\Http\Controllers;

use App\Classes\RiderManagement;
use App\Classes\TicketManagement;
use App\Classes\UserManagement;
use App\Models\Setting;
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

    public function createSettings(Request $request) {
        return Setting::create([
            "config" => $request->config
        ]);
    }

    public function updateSettings(Request $request) {
        $settings  = Setting::all()->first();
        $settings = Setting::where('id', $settings->id)->update([
            'config' => $request->config
        ]);
        return response()->updated(
            "System settings updated successfully",
            $settings,
            "settings"
        );
    }
}
