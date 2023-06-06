<?php
namespace Modules\Manager\Repositories;

use App\Repositories\BaseGetOnlyRepository;
use Modules\Manager\Entities\HistoryOrder;

class HistoryOrderRepository extends BaseGetOnlyRepository implements HistoryOrderRepositoryInterface
{
    public function getModel()
    {
        return HistoryOrder::class;
    }
    public function getAllWaitingConfirm()
    {
        return $this->model->select(
            $this->model->raw('sum(price*quantity) as total, order_id')
        )->where('confirm',false)->where('cancel',false)->groupBy('order_id')->get();
    }

    public function getAllOrder()
    {
        return $this->model->select(
            $this->model->raw('sum(price*quantity) as total, order_id,confirm,paid,cancel')
        )->groupBy('order_id','confirm','paid','cancel','created_at')->get();
    }

    public function getByOrder($order_id)
    {
        return $this->model->select(
            $this->model->raw('*,price*quantity as total')
        )->where('order_id',$order_id)->get();
    }

    public function confirm($order_id)
    {   
        try {
            //code...
            $this->model->where('order_id',$order_id)
            ->where('cancel',false)
            ->update([
                'confirm' => true,
                'paid' => true,
            ]);
            return true;
        } catch (Throwable $th) {
            //throw $th;
            return false;
        }
    }

    public function cancel($order_id)
    {   
        try {
            //code...
            $this->model->where('order_id',$order_id)
            ->where('confirm',false)
            ->where('paid',false)
            ->update([
                'cancel' => true,
            ]);
            return true;
        } catch (Throwable $th) {
            //throw $th;
            return false;
        }
    }
    
    public function getTurnOver($start,$end)
    {
        return $this->model->select(
            $this->model->raw('*,price*quantity as total')
        )->where('paid',true)
        ->where('updated_at','>=',$start)
        ->where('updated_at','<',$end)->get();
    }

}