<?php

namespace Modules\Manager\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Manager\Repositories\ProductRepositoryInterface;
use Modules\Manager\Repositories\CategoryRepositoryInterface;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $productRepo;
    protected $categoryRepo;

    public function __construct(ProductRepositoryInterface $productRepo, CategoryRepositoryInterface $categoryRepo)
    {
        $this->productRepo = $productRepo;
        $this->categoryRepo = $categoryRepo;
    }   

    public function index()
    {
        $products =$this->productRepo->getAll();

        
        return view('manager::product.index')->with(compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepo->sortASC('category');
        return view('manager::product.create')->with(compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'product' => 'required|max:255',

            'image' => 'required|image|mimes:png,jpg,gif,svg|
            dimensions:min_width=100,min_height=200,
            max_widt=800,max_height=1000',

            'category_id' => 'required|integer',
            'description' => 'required',
            'store' => 'required|integer',
            'price' => 'required|numeric'
        ]);

        // Thêm hình ảnh
        $path = 'uploads/img/product';

        $get_image = $data['image'];
        $name_image =  current(explode('.',$get_image->getClientOriginalName()));
        $extension_image = $get_image->getClientOriginalExtension();
        $new_name = $name_image.time().'.'.$extension_image;
        $get_image->move($path,$new_name);
        $data['image'] = $new_name;

        $this->productRepo->create($data);

        return redirect()->back()->with('status','Thêm sản phẩm thành công');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->productRepo->find($id);
        return view('manager::product.show')->with(compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->productRepo->find($id);
        $categories = $this->categoryRepo->sortASC('category');
        return view('manager::product.edit')->with(compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'product' => 'required|max:255',

            'image' => 'image|mimes:png,jpg,gif,svg|
            dimensions:min_width=100,min_height=200,
            max_widt=800,max_height=1000',

            'category_id' => 'required|integer',
            'description' => 'required',
            'store' => 'required|integer',
            'price' => 'required|numeric'
        ]);
        if (isset($data['image']))
        {

            $path = 'uploads/img/product';

            $old_image = $this->productRepo->find($id)->image;
            if (file_exists($path.'/'.$old_image))
                unlink($path.'/'.$old_image);
            
            // Thêm hình ảnh
            

            $get_image = $data['image'];
            $name_image =  current(explode('.',$get_image->getClientOriginalName()));
            $extension_image = $get_image->getClientOriginalExtension();
            $new_name = $name_image.time().'.'.$extension_image;
            $get_image->move($path,$new_name);
            $data['image'] = $new_name;
        }
        $this->productRepo->update($id,$data);
        return redirect()->back()->with('status','Cập nhật thông tin sản phẩm thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->productRepo->delete($id);
        return redirect(route('product.index'))->with('status','Xóa sản phẩm thành công');
    }
}
