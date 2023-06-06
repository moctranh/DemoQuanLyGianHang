<?php
namespace Modules\Customer\Repositories;

use App\Repositories\BaseGetOnlyRepository;
use Modules\Customer\Entities\Product;

class ProductRepository extends BaseGetOnlyRepository implements ProductRepositoryInterface
{
    public function getModel()
    {
        return Product::class;
    }

    public function wasBought($id,$quantity)
    {
        $this->model->where('id',$id)->decrement('store',$quantity);
    }
}