<?php

declare(strict_types=1);

namespace Mamilove\Repositories;

use Mamilove\Models\Order;

class OrderRepository {

    private $order;

    function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function getOrderCountByAccountIdAndTime(int $accountId, $timestamp): int
    {
        return $this->order::where('account', $accountId)
            ->where('create_at', $timestamp)
            ->count();
    }

    public function insert(array $orderDatas)
    {
        return $this->order->create($orderDatas);
    }
}