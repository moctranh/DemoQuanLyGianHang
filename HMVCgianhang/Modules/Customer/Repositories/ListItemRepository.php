<?php
namespace Modules\Customer\Repositories;

use App\Repositories\BaseRepository;
use Modules\Customer\Entities\ListItem;

class ListItemRepository extends BaseRepository implements ListItemRepositoryInterface
{
    public function getModel()
    {
        return ListItem::class;
    }
    
    public function quantityIncrement($id)
    {

        $this->model->find($id)->increment('quantity');
        
    }

    public function quantityDecrement($id)
    {
        $this->model->find($id)->decrement('quantity');
    }

    // Tìm item dựa vào product_id và order_id
    public function findItem($order_id,$product_id)
    {
        return $this->model->where('order_id',$order_id)->where('product_id',$product_id);
    }

    // Xóa dựa vào product_id và order_id
    public function deleteItem($order_id,$product_id)
    {
        $this->findItem($order_id,$product_id)->delete();
    }
    
}