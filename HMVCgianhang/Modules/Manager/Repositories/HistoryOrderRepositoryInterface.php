<?php
namespace Modules\Manager\Repositories;

use App\Repositories\GetOnlyRepositoryInterface;

interface HistoryOrderRepositoryInterface extends GetOnlyRepositoryInterface
{
    // Lấy ra danh sách hóa đơn đang chờ xác nhận
    public function getAllWaitingConfirm();

    // Lấy ra danh sách tất cả đơn hàng
    public function getAllOrder();

    // Lấy ra danh sách đơn hàng theo id order
    public function getByOrder($order_id);

    // Xác nhận đơn hàng
    public function confirm($order_id);

    // Từ chối đơn hàng
    public function cancel($order_id);

    // Lấy ra danh sách đã thanh toán trong khoảng thời gian;
    public function getTurnOver($start, $end);

}