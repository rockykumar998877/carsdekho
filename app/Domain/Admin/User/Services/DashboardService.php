<?php

namespace Domain\Admin\User\Services;

use Domain\Admin\Order\Service\OrderService;
use Domain\Admin\Product\Services\ProductVariantService;

class DashboardService
{
    protected $orderService;

    protected $productService;

    protected $userService;

    protected $orderItemService;

    protected $productVariantService;

    /**
     * Create a new instance of the class.
     *
     * Initializes the required service dependencies used for 
     * handling orders, users, and product variants.
     * @param  \Domain\Admin\Order\Service\OrderService  $orderService
     * The service responsible for managing order-related operations.
     * @param  \Domain\Admin\User\Service\UserService  $userService
     * The service responsible for managing user-related operations.
     * @param  \Domain\Admin\Product\Service\ProductVariantService  $productVariantService
     * The service responsible for managing product variant operations.
     */
    public function __construct(
        OrderService $orderService,
        UserService $userService,
        ProductVariantService $productVariantService
    ) {
        $this->orderService = $orderService;
        $this->userService = $userService;
        $this->productVariantService = $productVariantService;
    }

    /**
     * Get the total number of orders.
     *
     * This method retrieves the count of all orders
     * from the order service for dashboard or reporting purposes.
     *
     * @return int
     */
    public function allOrders()
    {
        return $this->orderService->countOrderData();
    }

    /**
     * Get the total number of customers.
     *
     * This method returns the total customer count
     * using the user service, typically used in dashboard statistics.
     *
     * @return int
     */
    public function allCustomer()
    {
        return $this->userService->customerDataCount();
    }

    /**
     * Get the total revenue amount.
     *
     * This method calculates and returns the total revenue
     * from all completed orders via the order service.
     *
     * @return float
     */
    public function totalRevenueData()
    {
        return $this->orderService->totalRevenue();
    }

    /**
     * Get monthly revenue statistics.
     *
     * This method fetches and returns the revenue data
     * grouped by month, used for chart visualization or reports.
     *
     * @return array
     */
    public function monthlyAmount()
    {
        return $this->orderService->getMonthlyRevenue();
    }

    /**
     * Retrieve monthly order and sales statistics.
     *
     * This function calls the OrderService to fetch data related to
     * the total number of orders and sales amount for each month.
     *
     * @return mixed  Returns the monthly order and sales data from the service.
     */
    public function monthlyOrderAndSales()
    {
        return $this->orderService->getMonthlyOrderAndSales();
    }

    /* Get the total number of product variants.
     *
     * @return int
     */
    public function productVariantData()
    {
        return $this->productVariantService->productValiantCount()->count();
    }
}
