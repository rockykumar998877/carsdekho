<?php

namespace Domain\Admin\User\Actions;

use Domain\Admin\User\Services\DashboardService;

class DashboardAction
{
    /**
     * Constructor to inject the DashboardService dependency.
     *
     * @param DashboardService $service The service responsible for order operations.
     */
    public function __construct(private DashboardService $service)
    {
        $this->service = $service;
    }

    /**
     * Retrieve the total count of all orders.
     *
     * This method calls the service layer to get the total number
     * of orders available in the system, typically used for dashboard metrics.
     *
     * @return int
     */
    public function getAllOrderCount()
    {
        return $this->service->allOrders();
    }

    /**
     * Retrieve the total count of all customers.
     *
     * This method calls the service layer to get the total number
     * of registered customers, used for reporting or analytics.
     *
     * @return int
     */
    public function getAllCustomerCount()
    {
        return $this->service->allCustomer();
    }

    /**
     * Retrieve the total revenue generated.
     *
     * This method calls the service layer to calculate and return
     * the total revenue from all completed or processed orders.
     *
     * @return float
     */
    public function getTotalRevenue()
    {
        return $this->service->totalRevenueData();
    }

    /**
     * Retrieve monthly revenue data.
     *
     * This method calls the service layer to get revenue details
     * grouped by month, typically used for charts or financial reports.
     *
     * @return array
     */
    public function getMonthlyAmount()
    {
        return $this->service->monthlyAmount();
    }

    /**
     * Get monthly order and sales data.
     *
     * This method retrieves monthly order and sales information
     * by calling the corresponding method from the service layer.
     *
     * @return mixed  Returns the monthly order and sales data provided by the service.
     */
    public function getMonthlyOrderAndSales()
    {
        return $this->service->monthlyOrderAndSales();
    }

     /* Get the total number of product variants.
     *
     * This method retrieves the count of all product variants available
     * in the system through the service layer.
     *
     * @return int  The total count of product variants.
     */
    public function getTotalProducts()
    {
        return $this->service->productVariantData();
    }
}
