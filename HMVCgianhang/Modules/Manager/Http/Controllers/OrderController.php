<?php

namespace Modules\Manager\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Manager\Services\ManagerService;
use Modules\Manager\Events\ConfirmOrderEvent;

class OrderController extends Controller
{

    protected $managerService;

    public function __construct(ManagerService $managerService)
    {
        $this->managerService = $managerService;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $orders = $this->managerService->historyOrderRepo->getAllOrder();
        return view('manager::order.index')->with(compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('manager::create');
    }

    /**
     * Confirm resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function confirm($order_id,Request $request)
    {
        $data = $request->validate([
            'confirmed' => 'required|boolean',
        ]);

        $status = NULL;

        if ($data['confirmed'])
        {
            if ($this->managerService->historyOrderRepo->confirm($order_id))
            {
                $status = 'Đã xác nhận đơn hàng thành công';
            }
            else
            {
                $messageError = 'Có lỗi trong quá trình xác nhận đơn hàng';
            }
        }
        else 
        {
            if ($this->managerService->historyOrderRepo->cancel($order_id))
            {
                $status = 'Đã từ chối đơn hàng thành công';
            }
            else
            {
                $messageError = 'Có lỗi trong quá trình từ chối đơn hàng';
            }
        }

        if ($status != NULL)
        {
            event(new ConfirmOrderEvent($order_id));
            return redirect()->back()->with(compact('status'));
        }
        return redirect()->back()->with(compact('messageError'));

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $data = $this->managerService->getDetailOrder($id);
        return view('manager::order.show')->with(compact('data'));
    }

    
}
