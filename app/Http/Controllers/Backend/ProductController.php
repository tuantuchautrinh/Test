<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * khi return view sẽ dẫn đến folder LaravelProject/resources/views/backend/master.blade.php
         */
        // return view('backend.master');

        // Xem dữ liệu của database trên server
        $data = Product::with('category')->get();
        // dd($data);

        // ['products' => $data] với "products" tên do mình đặt và truyền dữ liệu qua là "data" sau đó truyền vào view(LaravelProject/resources/views/backend/modules/product/index.blade.php)
        return view('backend.modules.product.index',['products' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Category::all();
        return view('backend.modules.product.create',['categories' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        echo 'Dữ liệu được thêm';
        // Phải đóng tất cả dd($request) để code chạy xuống dưới

        /**
         * Hiển thị tất cả dữ liệu được điền vào
         */
        // dd($request->all());

        /**
         * Hiển thị tất cả dữ liệu ngoại trừ "_token" và "add"
         */
        // dd($request->except('_token', 'add'));

        /**
         * Lấy một số trường nhất định
         */
        // dd($request->only('_token','add'));

        /**
         * Chỉ lấy trường name ra
         */
        // dd($request->name)

        // Để insert dữ liệu ta có 2 cách như bên dưới

            /**
             * Cách 1
             */
            // #Eloquent ORM - Getting Started #Inserting & Updating Models #Inserts

            // // Validate the request...

            // $flight = new Flight;

            // $flight->name = $request->name;

            // $flight->save();

            /**
             * Cách 2 (nhanh hơn cách 1)
            */
            // #Eloquent ORM - Getting Started #Inserting & Updating Models #Mass Assignment
            // Example: $flight = App\Flight::create(['name' => 'Flight 10']);
            // (LaravelProject/app/Models/tên Model)::create(rồi truyền dữ liệu vô)

        $data = $request->except('_token', 'add');

        /**
         * https://hdtuto.com/article/laravel-57-image-upload-with-validation-example
         *
         * 3 dòng tiếp theo ta đưa vào (LaravelProject/app/Http/Requests/Product/StoreRequest.php)
         *
         * request()->validate([

            * 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            * );
            *
            * $imageName = time().'.'.request()->image->getClientOriginalExtension();
            *
            * request()->image->move(public_path('images'), $imageName);
            */

        // Ta thấy một array["image" => Illuminate\Http\UploadedFile {#278 ▶}] khi "dd($data);"
        // dd($data);

        // Đè dữ liệu vào column "image" và "time()" là thời gian liên tục để không trùng tên
        $data['image'] = time()."-".request()->image->getClientOriginalExtension();
        // dd($data);

        /**
         * Tạo thư mục "images"(LaravelProject/public/images)
         */
        request()->image->move(public_path('images'), $data['image']);

            // ta dùng cách 2
            Product::create($data);

        // với with('thanhcong') ta truyền từ Controller(LaravelProject/app/Http/Controllers/Backend/ProductController.php) sang View(LaravelProject/resources/views/backend/modules/product/index.blade.php)
        return redirect()->route('admin.product.index')->with('thanhcong', 'Thêm sản phẩm thành công');
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
        // ta lấy dữ liệu cần sửa trong database đổ ra
        $product = Product::find($id);
        $category = Category::all();
        // dd($data);
        return view('backend.modules.product.edit',['product' => $product, 'category' => $category]);
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
        /**
         * Ta copy như function store()
         *
         * #Eloquent ORM - Getting Started #Inserting & Updating Models #Updates - Mass Updates
         *
         * App\Flight::where('active', 1)
         *
         *           ->where('destination', 'San Diego')
         *
         *           ->update(['delayed' => 1]);
         *
         * Sau đó ta giải quyết với 2 bước sau:
         *
         * Bước 1: Sửa thông tin sản phẩm nhưng không sửa hình
         *
         * Bước 2: Sửa hình
         */

        $data = $request->except('_token', 'add');
        // empty là rỗng là không có hình nhưng dấu "!" phía trước là ngược lại
        if(!empty($request->image)) {
            $data['image'] = time()."-".request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images'), $data['image']);
        }

        // sản phẩm(model):: "find($id)" tự hiểu là so sánh với column "id"(Table: product) trên server và sửa nội dung mới của mình
        Product::find($id)->update($data);

        // với with('thanhcong') ta truyền từ Controller(LaravelProject/app/Http/Controllers/Backend/ProductController.php) sang View(LaravelProject/resources/views/backend/modules/product/index.blade.php)
        return redirect()->route('admin.product.index')->with('thanhcong', 'Sửa sản phẩm thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // #Eloquent ORM - Getting Started #Deleting Models
        /**
         * $flight = App\Flight::find(1);
         *
         * $flight->delete();
         */
        // ta gọi model Product vào và kiếm số thứ tự là "id" tức là '1' like (find(1)) trong database
        $product = Product::find($id);

        $product->delete();

        return redirect()->route('admin.product.index')->with('thanhcong', 'Xóa sản phẩm thành công');
    }
}
