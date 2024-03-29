<?php

namespace App\Services;

use App\Services\DiscountService;
use App\Services\OrderService;

class DashboardService
{
    public function __construct(OrderService $orderService, DiscountService $discountService)
    {
        $this->orderService = $orderService;
        $this->discountService = $discountService;
    }

    public function getClientDashboardData()
    {
        $submittedOrders = $this->orderService->getUserSubmittedOrders(3);
        $unsubmittedOrders = $this->orderService->getUserUnubmittedOrders(3);
        $confirmedOrders = $this->orderService->getUserConfirmedOrders(3);
        $discounts = $this->discountService->getUserDiscounts(5);
        return array(
            'submittedOrders' => $submittedOrders,
            'unsubmittedOrders' => $unsubmittedOrders,
            'confirmedOrders' => $confirmedOrders,
            'discounts' => $discounts
        );
    }

    public function getAdminDashboardData()
    {
        $submittedOrders = $this->orderService->getSubmittedOrders(5);
        $confirmedOrders = $this->orderService->getConfirmedOrders(5);
        return array(
            'submittedOrders' => $submittedOrders,
            'confirmedOrders' => $confirmedOrders,
        );
    }
}
