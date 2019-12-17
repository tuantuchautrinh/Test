<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // unique:Table,column kiểm tra dữ liệu có trùng hay không
            'name' => 'required|unique:product,name',
            // giá phải là số không dùng chữ => dùng integer,
            // giá thấp nhất là 1000 => dùng min:giá trị
            'price' => 'required|integer|min:10000',
            'intro' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'name.unique' => 'Tên sản phẩm này đã tồn tại',
            'price.required' => 'Vui lòng nhập giá sản phẩm',
            'price.integer' => 'Giá sản phẩm phải là số',
            'price.min' => 'Giá thấp nhất phải là 10.000',
            'intro.required' => 'Vui lòng nhập tóm tắt sản phẩm',
            'image.required' => 'Vui lòng nhập tên hình',
            'image.image' => 'Đây không phải là hình',
            'image.mimes' => 'File hình chỉ chấp nhận các định dạng sau: jpeg, png, jpg, gif, svg',
            'image.max' => 'Dung lượng file không được phép lớn hơn 2 Mb'
        ];
    }
}
