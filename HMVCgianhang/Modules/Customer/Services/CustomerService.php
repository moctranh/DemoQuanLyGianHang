<?php
namespace Modules\Customer\Services;

use Modules\Customer\Repositories\ProductRepositoryInterface;
use Modules\Customer\Repositories\OrderRepositoryInterface;
use Modules\Customer\Repositories\ListItemRepositoryInterface;
use Modules\Customer\Repositories\HistoryOrderRepositoryInterface;
use App\Repositories\UserRepository;

class CustomerService
{

    public function __construct(ProductRepositoryInterface $productRepo,
    OrderRepositoryInterface $orderRepo,
    ListItemRepositoryInterface $itemRepo,
    UserRepository $userRepo,
    HistoryOrderRepositoryInterface $historyOrderRepo
    )
    {
        $this->productRepo = $productRepo;
        $this->orderRepo = $orderRepo;
        $this->itemRepo = $itemRepo;
        $this->userRepo = $userRepo;
        $this->historyOrderRepo = $historyOrderRepo;
    }

    // Láy id giỏ hàng của customer
    public function ordering($customer_id)
    {
        $result = $this->orderRepo->getOnlyOrdering($customer_id);
        if ( sizeof($result)==0)
        {
            return $this->orderRepo->create(['customer_id'=>$customer_id])->id;
        }
        
        return $this->orderRepo->ordering($customer_id);
    }

    // Tăng giảm số lượng sản phẩm trong giỏ hàng
    public function quantityIncrement($id)
    {
        $result = $this->itemRepo->find($id);
        if ($result)
        {
            $result->quantityIncrement($id);
            return true;
        }
        return false;        
    }
    public function quantityDecrement($id)
    {
        $result = $this->itemRepo->find($id);
        if ($result)
        {
            $result->quantityDecrement($id);
            return true;
        }
        return false;        
    }

    // Thêm sản phẩm vào giỏ hàng
    public function addToCart($data)
    {
        $item = $this->itemRepo->findItem($data['order_id'], $data['product_id'])->first();
        if ($item == NULL)
        {
            $this->itemRepo->create($data);
        }
        else
        {
            $data['quantity'] += $item->quantity;
            $this->itemRepo->update($item->id,$data);
        }
    }

    // Mua đơn hàng
    public function buyOrder($order_id)
    {
        if(!$this->orderIsThisCustomer($order_id))
        {
            return false;
        }
        // Kiểm tra xem có đủ số lượng trong kho không
        $products = $this->orderRepo->find($order_id)->products()->get();
        foreach($products as $index => $product)
        {
            if (!$this->checkStore($product->id,$product->pivot->quantity))
            {
                return false;
            }
        }
        
        foreach($products as $product)
        {
            // giảm số lượng trong kho
            $this->productRepo->wasBought($product->id, $product->pivot->quantity);

            // Lưu vào lịch sử mua hàng
            $data = [
                'order_id' => $product->pivot->order_id,
                'product_id' => $product->id,
                'quantity' => $product->pivot->quantity,
                'product' => $product->product,
                'image' => $product->image,
                'description' => $product->description,
                'price' => $product->price,
            ];
            $this->historyOrderRepo->create($data);
        }

        // Chuyển sang trạng thái đã order, chờ xác nhận
        $this->orderRepo->setWaitingConfirm($order_id);

        return true;

        
    }

    // Có phải đơn hàng chính chủ không
    public function orderIsThisCustomer($order_id)
    {
        $order_customer = $this->orderRepo->find($order_id)->customer_id;
        $user_id = $this->userRepo->getUserId();
        if ($order_customer == $user_id)
        {
            return true;
        }
        return false;
    }

    // Check xem sản phẩm trong kho có đủ số lượng không
    public function checkStore($product_id,$quantity)
    {
        $store = $this->productRepo->find($product_id)->store;
        if ($quantity <= $store)
        {
            return true;
        }
        return false;
    }

    // Lấy ra danh sách đơn đặt hàng của User
    public function listOrdered()
    {
        $customer_id = $this->userRepo->getUserId();
        $list =  $this->orderRepo->listOrdered($customer_id)->pluck('id');
        $listOrdered = $this->historyOrderRepo->getByCustomer($list);
        return $listOrdered->toArray();
    }

    // Lấy ra danh sách history Order
    public function historyOrder($order_id)
    {
        $data['products'] = $this->historyOrderRepo->getByOrder($order_id);
        $data['order'] = $data['products']->first()->order()->first();
        
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
