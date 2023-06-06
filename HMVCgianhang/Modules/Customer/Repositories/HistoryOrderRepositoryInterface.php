<?php
namespace Modules\Customer\Repositories;

use App\Repositories\RepositoryInterface;

interface HistoryOrderRepositoryInterface extends RepositoryInterface
{
    // Láy danh sách đơn hàng của khách hàng
    public function getByCustomer($list_order_customer);
}