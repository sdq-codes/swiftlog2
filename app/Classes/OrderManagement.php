<?php
namespace App\Classes;

use App\Models\Order;
use App\Repositories\Interfaces\OrderDestinationRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\OrderScheduleRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderManagement
{
    private $orderRepository;
    private $orderScheduleRepository;
    private $orderDestinationRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        OrderScheduleRepositoryInterface $orderScheduleRepository,
        OrderDestinationRepositoryInterface $orderDestinationRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->orderDestinationRepository = $orderDestinationRepository;
        $this->orderScheduleRepository = $orderScheduleRepository;
    }

    public function create(array $data) {
        $order = null;
        DB::transaction(function () use(&$order, $data) {
            $data['user_id'] = Auth::user()->id;
            $order = $this->orderRepository->create($data);
            $data['order_id'] = $order->id;
            if ($data['schedule'] === true) {
                $data['order_schedule']['order_id'] = $order->id;
                $this->orderScheduleRepository->create($data['order_schedule']);
            }
//            if ()
            foreach ($data['order_destinations'] as $key => $order_destination) {
                $order_destination['order_id'] = $order->id;
                $this->orderDestinationRepository->create($order_destination);
            }
        });
        return $order;

    }

    public function fetch(string $orderId) {
        return $this->orderRepository->fetch($orderId);
    }

    public function user() {
        $userId = Auth::user()->id;
        return $this->orderRepository->user($userId);
    }

    public function all() {
        return $this->orderRepository->all();
    }

    public function update(array $data, string $orderId) {
        $order = Order::whereId($orderId)->first();
        return $this->orderRepository->update($order, $data);
    }

}
