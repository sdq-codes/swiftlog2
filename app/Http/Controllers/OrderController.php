<?php

namespace App\Http\Controllers;

use App\Classes\OrderManagement;
use App\Classes\UserManagement;
use Illuminate\Http\Request;

use GuzzleHttp\Client;

class OrderController extends Controller {
    private $orderManagement;

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
        $client = new Client();

        $response = $client->request('GET', $request->url);
        return $response->getBody();
    }
}
