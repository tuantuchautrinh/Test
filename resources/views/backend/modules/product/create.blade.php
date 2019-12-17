{{--- @extends là trong master.blade.php có gì thì được thừa hưởng hết ---}}
@extends ('backend.master')
@section('content')

    {{--- #The Basics - Validation #Validation Quickstart #Displaying The Validation Errors ---}}
    <!-- Create Post Form -->
    @if ($errors->any())
        <div class="error_msg">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data" style="width: 650px;">
        {{--- csrf là 1 token để bảo vệ form an toàn hơn thiếu sẽ báo lỗi "419 | Page Expired" ---}}
        @csrf
        <fieldset>
                <legend>Thông Tin Sản Phẩm</legend>

                <span class="form_label">Tên sản phẩm: <span class="required">*</span></span>
                <span class="form_item">
                    {{--- value="{{ old('name') }} là giữ lại giá trị nhập khi nhấn submit ---}}
                    <input type="text" name="name" class="textbox" value="{{ old('name') }}" />
                </span><br />
                <span class="form_label">Giá: <span class="required">*</span></span>
                <span class="form_item">
                    <input type="text" name="price" class="textbox" value="{{ old('price') }}" />
                </span><br />
                <span class="form_label">Giới thiệu: <span class="required">*</span></span>
                <span class="form_item">
                    <textarea name="intro" rows="5" class="textbox">{{ old('intro') }}</textarea>
                </span><br />
                <span class="form_label">Nội dung:</span>
                <span class="form_item">
                    <textarea name="content" rows="8" class="textbox">{{ old('content') }}</textarea>
                </span><br />
                <span class="form_label">Hình sản phẩm:</span>
                <span class="form_item">
                    <input type="file" name="image" class="textbox" />
                </span><br />
                <span class="form_label">Trạng thái sản phẩm: <span class="required">*</span></span>
                <span class="form_item">
                    <input type="radio" name="status" value="1" {{ (old('status', 1) == 1) ? 'checked' : '' }} /> Hiển thị
                    <input type="radio" name="status" value="2" {{ (old('status') == 2) ? 'checked' : '' }} /> Ẩn
                </span><br />
                <span class="form_label"></span>
                <span class="form_item">
                    <input type="submit" name="add" value="Thêm sản phẩm" class="button" />
                </span>
            </fieldset>
    </form>
@endsection
