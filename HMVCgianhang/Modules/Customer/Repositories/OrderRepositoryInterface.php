<?php

namespace Modules\Customer\Repositories;
use App\Repositories\RepositoryInterface;

interface OrderRepositoryInterface extends RepositoryInterface
{

    // Lấy mã đơn hàng đang trong trạng thái đặt hàng
    public function ordering($customer_id);
    

    // Lấy tổng giá tiền 
    public function totalPrice($id);
    
    // Chuyển đơn hàng sang trạng thái chờ xác nhận
    public function setWaitingConfirm($id);

    // Lấy ra danh sách đơn đã đặt hàng
    public function listOrdered($customer_id);
}