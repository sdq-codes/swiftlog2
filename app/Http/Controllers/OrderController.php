<?php

namespace App\Http\Controllers;

use App\Classes\OrderManagement;
use App\Classes\UserManagement;
use App\Visitor;
use Illuminate\Http\Request;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller {
    private $orderManagement;

    private function visited() {
        $user = Auth::user();
        if (
            count(Visitor::where('user_id', $user->id)
            ->whereDate('created_at', Carbon::today())->get()) < 1
        ) {
            Visitor::create([
                "user_id" => $user->id
            ]);
        }
    }

    public function __construct(
        OrderManagement $orderManagement
    ) {
        $this->orderManagement = $orderManagement;
    }

    public function all() {
        return response()->fetch(
            "Successfully fetched all orders",
            $this->orderManagement->all(),
            "orders"
        );
    }

    public function create(Request $request) {
        $this->visited();
        return response()->created(
            'Order sucessfully created',
            $this->orderManagement->create($request->all()),
            'order'
        );
    }

    public function fetch(string $orderId) {
        return response()->fetch(
            'Order fetched',
            $this->orderManagement->fetch($orderId),
            'order'
        );
    }

    public function user() {
        $this->visited();
        return response()->fetch(
            'Order fetched',
            $this->orderManagement->user(),
            'order'
        );
    }

    public function update(Request $request, string $orderId) {
        return response()->updated(
            'Order fetched',
            $this->orderManagement->update($request->all(), $orderId),
            'order'
        );
    }

    public function distance(Request $request) {
        $this->visited();
        $client = new Client();
        $response = $client->request('GET', $request->url);
        return $response->getBody();
    }
}
