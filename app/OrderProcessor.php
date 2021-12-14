<?php

declare(strict_types=1);

namespace Mamilove;

use Mamilove\Interfaces\BillerInterface;
use Mamilove\Services\OrderService;
use Mamilove\Models\Order;
use Carbon\Carbon;

class OrderProcessor {

    private $biller;
    private $orderService;

    public function __construct(BillerInterface $biller, OrderService $orderService)
    {
        $this->biller = $biller;
        $this->orderService = $orderService;
    }

    public function process(Order $order): void
    {
        $recent = $this->orderService->getRecentOrderCount($order->account->id);

        if($recent > 0)
        {
            throw new \Exception('Duplicate order likely.');
        }

        $this->biller->bill($order->account->id, $order->amount);

        $this->orderService->addNewOrder($order->account->id, $order->amount);
    }
}