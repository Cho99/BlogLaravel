@extends('admin/layout')

@section('title', 'Create Tags')

@section('content')
    @if (Session::has('mess'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Thông báo: </strong> {!! Session::get('mess') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form action="{{ route('tags.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleFormControlInput1">Name Tags</label>
            <input type="text" name="name" class="form-control" id="name_tags" placeholder="Tags...">
        </div>
        @error('name')
            <span class="text-danger font-weight-bold mt-2">{{ $message }}</span>
        @enderror
        <div class="form-group">
            <label for="exampleFormControlSelect1">Tags</label>
            <select name="tag_id" class="form-control">
                <option value="0">--- Tags ---</option>
                @php
                function showTag($tags, $parent_id = 0, $char = '')
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
                        showTag($tags, $item->id, $char.'--');
                        }
                    }
                }
                @endphp

                @php
                showTag($tags)
                @endphp
            </select>
        </div>
        @error('parent_id')
            <span class="text-danger font-weight-bold mt-2">{{ $message }}</span>
        @enderror
        <fieldset class="form-group">
            <label for="exampleFormControlSelect1">Status</label>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="set" value="1" checked>
                    <label class="form-check-label" for="set">
                        Set
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="unset" value="0">
                    <label class="form-check-label" for="unset">
                        Unset
                    </label>
                </div>
            </div>
        </fieldset>
        @error('status')
            <span class="text-danger font-weight-bold mt-2">{{ $message }}</span>
        @enderror
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Add new</button>
            </div>
        </div>
    </form>
@endsection
