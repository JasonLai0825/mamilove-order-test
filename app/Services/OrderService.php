<?php

namespace Mamilove\Services;

use Carbon\Carbon;
use Mamilove\Repositories\OrderRepository;

class OrderService {

    private $orderRepository;

    function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getRecentOrderCount(int $accountId): int
    {
        $timestamp = Carbon::now()->subMinutes(5);
        return $this->orderRepository->getOrderCountByAccountIdAndTime($accountId, $timestamp);
    }

    public function addNewOrder(int $accountId, float $amount): void
    {
        $this->orderRepository->insert(array(
            'account' => $accountId,
            'amount' => $amount,
            'create_at' => Carbon::now()
        ));
    }
}