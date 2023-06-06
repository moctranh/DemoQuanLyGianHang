<?php

namespace Modules\Customer\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Customer\Services\CustomerService;

class HistoryOrderController extends Controller
{

    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $listOrdered = $this->customerService->listOrdered();
        return view('customer::history.index')->with(compact('listOrdered'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id,Request $request)
    {

        if (!$this->customerService->orderIsThisCustomer($id))
        {
            $request->session()->flash('errorMessage','Đơn hàng #'.$id.' không phải của bạn');
            return redirect()->back();
        }

        $data = $this->customerService->historyOrder($id);
        return view('customer::history.show')->with(compact('data'));
    }


}
