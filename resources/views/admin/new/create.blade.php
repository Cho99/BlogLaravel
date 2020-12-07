@extends('admin/layout')

@section('title', 'Create New')

@section('content')
    <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleFormControlInput1">Title</label>
            <input type="title" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Title ...">
            @error('title')
                <span class="text-danger font-weight-bold mt-2">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Content</label>
            <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="3"></textarea>
            @error('content')
                <span class="text-danger font-weight-bold mt-2">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Tag</label>
            <select name="tag_id" class="form-control">
                <option>--- Tag ---</option>
                @php
                    function showTags($tags, $parent_id = 0, $char = '')
                    {
                        foreach ($tags as $key => $item)
                        {
                            // Nếu là chuyên mục con thì hiển thị
                            if ($item['parent_id'] == $parent_id)
                            {
                                if($item->parent_id == 0) {
                                    echo '<option value="'.$item->id.'">'. $char . $item->name . '</option>';
                                } else {
                                    echo '<option value="'.$item->id.'">'. $char . $item->name . '</option>';
                                }
                                // Xóa chuyên mục đã lặp
                                unset($tags[$key]);
                                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                                showTags($tags, $item->id, $char.'--');
                            }
                        }
                    }
                @endphp

                @php
                    showTags($tags) 
                @endphp
            </select>
        </div>

        <div class="form-group">
            <label for="exampleFormControlTextarea1">Picture</label>
            <input type="file" name="file" required="true">
            @error('file')
                <span class="text-danger font-weight-bold mt-2">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Add New</button>
    </form>
@endsection
