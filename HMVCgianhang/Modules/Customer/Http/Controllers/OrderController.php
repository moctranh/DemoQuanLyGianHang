<?php

namespace Modules\Customer\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Customer\Services\CustomerService;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function buy(Request $request)
    {
        $data = $request->validate([
            'order_id' => 'required|integer'
        ]);
        
        if ($this->customerService->buyOrder($data['order_id']))
        {
            return redirect()->back()->with('status','Đã đặt hàng thành công');
        }
        else
        {
            $request->session()->flash('errorMessage','Gặp lỗi trong quá trình mua hàng');
            return redirect()->back();
        }
    }


}
