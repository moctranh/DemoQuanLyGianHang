<?php

namespace Modules\Customer\Repositories;

use App\Repositories\BaseRepository;

use Modules\Customer\Entities\Order;
use Modules\Customer\Entities\ListItem;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{

    
    public function getModel()
    {
        return Order::class;
    }

    public function ordering($customer_id)
    {
        $result = $this->model->where('customer_id',$customer_id)->where('customer_ordering',true)->get();
        return $result->first()->id;
    }

    // Chỉ lấy thông tin cơ bản của giỏ hàng
    public function getOnlyOrdering($customer_id)
    {
        $result = $this->model->where('customer_id',$customer_id)
        ->where('customer_ordering',true)
        ->get();
        return $result;
    }

    // Lấy thông tin chi tiết của giỏ hàng
    public function getOrdering($customer_id)
    {
        $order = $this->getOnlyOrdering($customer_id)->first();
        if ($order == NULL)
        {
            return NULL;
        }

        $result = $order->products()->get();
        $result = $this->totalPrice($result);
        
        return $result;
    }

    public function totalPrice($list_item)
    {    
        $list_item->total = 0;

        foreach($list_item as $item)
        {
            $item->pivot['totalPrice'] = $item->pivot->quantity * $item->price;
            $list_item->total += $item->pivot->totalPrice;
        }
        return $list_item;
    }

    public function setWaitingConfirm($id)
    {
        return $this->model->where('id',$id)->update([
            'customer_ordering' => false
        ]);
    }

    public function listOrdered($customer_id)
    {
        return $this->model->where('customer_id',$customer_id)->get();
    }
}