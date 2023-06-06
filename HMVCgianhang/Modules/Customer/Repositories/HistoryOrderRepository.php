<?php
namespace Modules\Customer\Repositories;

use App\Repositories\BaseRepository;
use Modules\Customer\Entities\HistoryOrder;

class HistoryOrderRepository extends BaseRepository implements HistoryOrderRepositoryInterface
{
    public function getModel()
    {
        return HistoryOrder::class;
    }

    public function getByCustomer($list_order_customer)
    {
        return $this->model->select(
            $this->model->raw('sum(price*quantity) as total,order_id,confirm,paid,cancel')
        )->whereIn('order_id',$list_order_customer)->groupBy('order_id','confirm','paid','cancel','created_at')->get();
    }

    public function getByOrder($order_id)
    {
        return $this->model->select(
            $this->model->raw('*,price*quantity as total')
        )->where('order_id',$order_id)->get();
    }

}

