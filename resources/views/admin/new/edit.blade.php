@extends('admin/layout')

@section('title', 'Edit New')

@section('content')
    <form action="{{ route('my_news.update', [$new->id]) }}" method="POST">
        @csrf
        {{ method_field('PUT') }}
        <div class="form-group">
            <label for="exampleFormControlInput1">Title</label>
            <input type="title" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Title ..."
                value="{{ $new->title }}">
            @error('title')
                <span class="text-danger font-weight-bold mt-2">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Content</label>
            <textarea class="form-control" name="content" id="exampleFormControlTextarea1"
                rows="3">{{ $new->content }}</textarea>
            @error('content')
                <span class="text-danger font-weight-bold mt-2">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Tag</label>
            <select name="tag_id" class="form-control">
                <option value="0">--- Tags ---</option>
                @php
                    function showTags($tags, $tag ,$parent_id = 0, $char = '')
                    {
                        foreach ($tags as $key => $item)
                        {
                            // Nếu là chuyên mục con thì hiển thị
                            if ($item['parent_id'] == $parent_id)
                            {
                                if($item['id'] == $tag) {
                                    echo '<option value="'.$item->id.'" selected> '. $char . $item->name . '</option>';
                                } else {
                                    echo '<option value="'.$item->id.'"> '. $char . $item->name . '</option>';
                                }
                                // Xóa chuyên mục đã lặp
                                unset($tags[$key]);
                                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                                showTags($tags, $tag ,$item->id, $char.'--');
                            }
                        }
                    }
                @endphp
                @php
                    showTags($tags, $new->tag_id) 
                @endphp
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Edit New</button>
    </form>
@endsection
