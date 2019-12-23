{{--- @extends là trong master.blade.php có gì thì được thừa hưởng hết ---}}
@extends ('backend.master')
@section('content')

@if(session('thanhcong'))
    <div class="result_msg">
        {{ session('thanhcong') }}
    </div>
@endif

@if(session('thatbai'))
    <div class="error_msg">
        {{ session('thatbai') }}
    </div>
@endif

    <table class="list_table">
        <tr class="list_heading">
            <td class="id_col">STT</td>
            <td>Tên thể loại</td>
            <td>Tên thể loại cha</td>
            <td>Trạng thái</td>
            <td class="action_col">Quản lý?</td>
        </tr>

        <!--- categories được truyền qua từ (LaravelProject/app/Http/Controllers/Backend/CategoryController.php) --->
        @foreach($categories as $item)
        <tr class="list_data">
            {{--- $loop->iteration là mặc định không bao giờ thay đổi và tăng từ 1 đến n ---}}
            <td class="aligncenter">{{ $loop->iteration }}</td>
            <td class="list_td aligncenter">{{ $item->name }}</td>
            <td class="list_td aligncenter">{{ tentheloai($item->parent) }}</td>
            <td class="list_td aligncenter">
                @if($item->status == 1)
                    Hiển thị
                @else
                    Ẩn
                @endif
            </td>
            <td class="list_td aligncenter">
                <a href="{{ route('admin.category.edit',['id' => $item->id]) }}"><img src="{{ asset('backend/images/edit.png') }}" /></a>&nbsp;&nbsp;&nbsp;
                {{--- ['id' => $item->id] 'id' được gọi vào từ route của (LaravelProject/routes/web.php) và "$item->id" được truyền vào từ database ---}}
                {{--- ta gọi hàm "acceptDelete()" từ (LaravelProject/resources/views/backend/master.blade.php) để khi click vào sẽ hiện thông báo ---}}
                <a onclick="return acceptDelete('Bạn có chắc muốn xóa không')" href="{{ route('admin.category.destroy',['id' => $item->id]) }}"><img src="{{ asset('backend/images/delete.png') }}" /></a>
            </td>
        </tr>
        @endforeach
    </table>
@endsection
