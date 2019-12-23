<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::all();
        return view('backend.modules.category.index', ['categories' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Category::all();
        return view('backend.modules.category.create', ['categories' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->except('_token', 'add');
        Category::create($data);
        return redirect()->route('admin.category.index')->with('thanhcong', 'Thêm thể loại thành công');
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
        $data = Category::find($id);
        $categories = Category::where('id', '!=', $id)->get();
        return view('backend.modules.category.edit', [
            'category' => $data,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->except('_token', 'add');
        Category::find($id)->update($data);
        return redirect()->route('admin.category.index')->with('thanhcong', 'Sửa thể loại thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $parent = Category::where('parent', $id)->count();
        if($parent > 0) {
            return redirect()->route('admin.category.index')->with('thatbai', 'Không thể xóa thể loại này');
        }

        $count_product = Product::where('category_id', $id)->count();
        if($count_product > 0) {
            return redirect()->route('admin.category.index')->with('thatbai', 'Không thể xóa thể loại này vì đang chứa sản phẩm bên trong');
        }

        Category::find($id)->delete();

        return redirect()->route('admin.category.index')->with('thanhcong', 'Xóa thể loại thành công');
    }
}
