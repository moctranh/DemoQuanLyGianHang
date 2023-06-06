<?php
namespace Modules\Manager\Repositories;

use App\Repositories\BaseRepository;
use Modules\Manager\Entities\Product;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return Product::class;
    }

    public function getProduct()
    {
        return $this->model->select('product')->take(5)->get();
    }
    
}