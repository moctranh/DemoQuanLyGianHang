<?php

namespace Modules\Manager\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Manager\Services\StatisticalService;

class StatisticalController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    protected $statisticalService;

    public function __construct(StatisticalService $statisticalService)
    {
        $this->statisticalService = $statisticalService;
    }

    public function index()
    {   
        $month = date('m');
        $year = date('Y');
        return $this->statistical($month,$year);
    }

    public function show(Request $request)
    {
        $data = $request->validate([
            'year' => 'required|min:2015|integer',
            'month' => 'required|min:1|max:12|integer'
        ]);
        return $this->statistical($data['month'],$data['year']);
    }

    protected function statistical($month,$year)
    {
        $statistical['monthly'] = $this->statisticalService->monthly($month,$year);
        $statistical['yearly'] = $this->statisticalService->yearly($year);
        return view('manager::statistical.index')->with(compact('statistical','month','year'));
    }
}
