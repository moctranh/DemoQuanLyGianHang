<?php
namespace Modules\Manager\Services;

use Modules\Manager\Repositories\HistoryOrderRepositoryInterface;
use Modules\Manager\Repositories\ProductRepositoryInterface;
use Modules\Manager\Repositories\CategoryRepositoryInterface;

class ManagerService 
{
    public function __construct(HistoryOrderRepositoryInterface $historyOrderRepo,
        ProductRepositoryInterface $productRepo,
        CategoryRepositoryInterface $categoryRepo
    )
    {
        $this->historyOrderRepo = $historyOrderRepo;
        $this->productRepo = $productRepo;
        $this->categoryRepo = $categoryRepo;
    }

    public function getDetailOrder($order_id)
    {
        $data['products'] = $this->historyOrderRepo->getByOrder($order_id);
        $data['order'] = $data['products']->first()->order()->first();
        $data['user'] = $data['order']->user()->first();
        
        foreach ($data as $key => $info)
        {
            $data[$key] = $info->toArray();
        }

        $data['total'] = 0;
        foreach($data['products'] as $product)
        {
            $data['total']+=$product['total'];
        }
        return $data;
    }

    
}