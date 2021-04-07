<?php

namespace App\Http\Controllers;

use App\Classes\RiderManagement;
use App\Classes\TicketManagement;
use App\Classes\UserManagement;
use App\Models\Order;
use App\Models\Setting;
use App\Models\User;
use App\RiderOrder;
use App\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function orderToRider(Request $request) {
        return response()->created(
            "Order updated successfully",
            $this->riderManagement->orderToRider($request->all()),
            "rider"
        );
    }

    public function scoreRider(Request $request) {
        return response()->created(
            "Order updated successfully",
            $this->riderManagement->scoreRider($request->all()),
            "rider"
        );
    }

    public function createSettings(Request $request) {
        $configuration = json_encode($request->config);
        $settings = Setting::create([
            "config" => $configuration
        ]);
        return response()->created(
            "System settings updated successfully",
            $settings,
            "settings"
        );
    }

    public function updateSettings(Request $request) {
        $settings  = Setting::all()->first();
        $settings = Setting::where('id', $settings->id)->update([
            'config' => $request->config
        ]);
        return response()->updated(
            "System settings updated successfully",
            Setting::all()->first(),
            "settings"
        );
    }

    public function dashbaord() {
        $visitors = Visitor::selectRaw("COUNT(*) views, DATE_FORMAT(created_at, '%Y %m %e') date")
            ->orderBy('created_at', 'ASC')
            ->groupBy('date')
            ->get();
        $orders = Order::selectRaw("COUNT(*) views, DATE_FORMAT(created_at, '%Y %m %e') date")
            ->orderBy('created_at', 'ASC')
            ->groupBy('date')
            ->get();
        $sales = Order::selectRaw("COUNT(*) views, DATE_FORMAT(created_at, '%Y') date, price price")
            ->orderBy('created_at', 'ASC')
            ->groupBy('date')
            ->get();
        $salesDistribution = Order::all()->groupBy(
            function($val) {
                $addressTextArray = explode(',', $val->address_text);
                $totalCount = count($addressTextArray)-3;
                $result_string = $addressTextArray[$totalCount];
                $result_string = ltrim($result_string);
                $result_string = rtrim($result_string);
                return $result_string;
            }
        );

        $activityLog = [
            "rejected_order" => count(Order::where('status', 'rejected')->get()),
            "ongoing_order" => count(Order::where('status', 'picked_up')->get()),
            "delivered_order" => count(Order::where('status', 'delivered')->get()),
            "cancelled_order" => count(Order::where('status', 'cancelled')->get()),
            "pending_order" => count(Order::where('status', 'pending')->get()),
            "pick_up_order" => count(Order::where('status', 'pick_up')->get()),
            "all_riders" => count(User::where('user_type', 'rider')->get()),
            "inactive_riders" => count(User::where('user_type', 'rider')->where('active', 0)->get()),
            "active_riders" => count(User::where('user_type', 'rider')->where('active', 1)->get()),
        ];
        return response()->created(
            "Dashboard details",
            [
                "visitors" => $visitors,
                "orders" => $orders,
                "sales" => $sales,
                "sales_distribution" => $salesDistribution,
                "activity_log" => $activityLog,
            ],
            "dashboard"
        );
    }
}
