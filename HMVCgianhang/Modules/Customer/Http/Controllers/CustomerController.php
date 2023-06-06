<?php

namespace Modules\Customer\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Customer\Services\CustomerService;

class CustomerController extends Controller
{
    
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index()
    {
        $products = $this->customerService->productRepo->getAll();
        return view('customer::index')->with(compact('products'));
    }

    public function detailProduct($product_id)
    {
        $product = $this->customerService->productRepo->find($product_id);
        return view('customer::detailProduct')->with(compact('product'));
    }

    public function addCart(Request $request, $product_id)
    {
        $data = $request->validate([
            'quantity' => 'required|min:1|integer'
        ]);
        $data['product_id'] = $product_id;
        $customer_id = Auth::user()->id;
        $data['order_id'] = $this->customerService->ordering($customer_id);

        $this->customerService->addToCart($data);

        return redirect()->back()->with('status','Thêm vào giỏ hàng thành công');
        
    }

    public function cart()
    {
        $customer_id = Auth::user()->id;
        $products = $this->customerService->orderRepo->getOrdering($customer_id);
        return view('customer::cart')->with(compact('products'));
    }

    // Xóa 1 sản phẩm ra khỏi giỏ hàng
    public function deleteCart($order_id, $product_id)
    {
        $this->customerService->itemRepo->deleteItem($order_id,$product_id);
        return redirect()->back()->with('status','Xóa sản phẩm trong giỏ hàng thành công');
    }
}
