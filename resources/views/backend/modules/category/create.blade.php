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

    <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data" style="width: 650px;">
        {{--- csrf là 1 token để bảo vệ form an toàn hơn thiếu sẽ báo lỗi "419 | Page Expired" ---}}
        @csrf
        <fieldset>
                <legend>Thông Tin Thể Loại</legend>
                <span class="form_label">Thể loại cha: <span class="required">*</span></span>
                <span class="form_item">
                    <select name="parent">
                        <option  value="0">Vui lòng chọn thể loại cha</option>
                        @php
                            theloaicha($categories, old('parent'));
                        @endphp
                    </select>
                </span><br />
                <span class="form_label">Tên thể loại: <span class="required">*</span></span>
                <span class="form_item">
                    {{--- value="{{ old('name') }} là giữ lại giá trị nhập khi nhấn submit ---}}
                    <input type="text" name="name" class="textbox" value="{{ old('name') }}" />
                </span><br />

                <span class="form_label">Trạng thái thể loại: <span class="required">*</span></span>
                <span class="form_item">
                    <input type="radio" name="status" value="1" {{ (old('status', 1) == 1) ? 'checked' : '' }} /> Hiển thị
                    <input type="radio" name="status" value="2" {{ (old('status') == 2) ? 'checked' : '' }} /> Ẩn
                </span><br />
                <span class="form_label"></span>
                <span class="form_item">
                    <input type="submit" name="add" value="Thêm thể loại" class="button" />
                </span>
            </fieldset>
    </form>
@endsection
