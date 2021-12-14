<?php

declare(strict_types=1);

namespace Mamilove\Tests;

use PHPUnit\Framework\TestCase;
use Mamilove\OrderProcessor;
use Mamilove\Interfaces\BillerInterface;
use Mamilove\Services\OrderService;
use Mamilove\Models\Order;

class OrderProcessorTest extends TestCase {

    private $biller;
    private $orderService;
    private $orderProcessor;

    protected function setUp(): void
    {
        $this->biller = $this->createMock(BillerInterface::class);
        $this->orderService  = $this->createMock(OrderService::class);
        $this->orderProcessor = new OrderProcessor($this->biller, $this->orderService);
    }

    public function testDuplicateOrder()
    {
        $this -> expectException(\Exception::class);
        $order = new Order();
        $order->account = (object)['id' => 1];
        $this->orderService->method('getRecentOrderCount')->willReturn(1);
        $this->orderProcessor->process($order);
    }

    public function testPassProcess()
    {
        try {
            $order = new Order();
            $order->account = (object)['id' => 1];
            $order->amount = 100;
            $this->orderService->method('getRecentOrderCount')->willReturn(0);
            $this->orderProcessor->process($order);
            $this->assertTrue(true);
        }catch(\Exception $e) {
            $this->assertTrue(false);
        }
    }
}