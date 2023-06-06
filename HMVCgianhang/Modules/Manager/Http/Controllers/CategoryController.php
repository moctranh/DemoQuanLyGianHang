<?php

namespace Modules\Manager\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Manager\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $categoryRepo;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function index()
    {
        $categories = $this->categoryRepo->getAll();
        return view('manager::category.index')->with(compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager::category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // $data = $request->input();

        // $validator = Validator::make($data,[
        //     'category' => ['required','max:255'],
        //     'description' => ['required']
        // ]);

        // if ($validator->fails()) {
        //     return redirect(route('home'))
        //                 ->withErrors($validator)
        //                 ->withInput();
        // }
        // dd($validator);

        $data = $request->validate([
            'category' => 'required|unique:category|max:255',
            'description' => 'required'
        ]);

        $this->categoryRepo->create($data);
        
        return redirect()->back()->with('status','Thêm thể loại thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepo->find($id); 
        return view('manager::category.edit')->with(compact('category'));
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

        $category = $this->categoryRepo->find($id);


        $in_category = $request->input('category');

        /* 
        *   Xử lý unique với category khi cập nhật thể loại
        *   Nếu tên ko thay đổi thì nó đã thõa yêu cầu từ khi thêm thể loại nên không cần validate
        */

        if ($in_category == $category->category){
            $data = $request->validate([
                'category' => '',
                'description' => 'required'
            ]);
        } else {
            $data = $request->validate([
                'category' => 'required|unique:category|max:255',
                'description' => 'required'
            ]);
        }      
        

        $this->categoryRepo->update($id,$data);
        
        return redirect()->back()->with('status','Cập nhật thể loại thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $this->categoryRepo->delete($id);
        return redirect()->back()->with('status','Xóa thể loại thành công');
    }
}
