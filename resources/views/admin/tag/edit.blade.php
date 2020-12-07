@extends('admin/layout')

@section('title', 'Edit Tag')

@section('content')
    @if (Session::has('mess'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Thông báo: </strong> {!! Session::get('mess') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>   
        </div>
    @endif
    <form action="{{ route('tags.update', [$tag->id]) }}" method="POST">
        @csrf
        {{ method_field('PUT') }}
        <div class="form-group">
            <label for="exampleFormControlInput1">Name Tags</label>
        <input type="text" name="name" class="form-control" id="name_tags" placeholder="Tags..." value="{{ $tag->name }}">
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Tags</label>
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
                                if($item['id'] == $tag->parent_id) {
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
                    showTags($tags, $tag) 
                @endphp
            </select>
        </div>
        <fieldset class="form-group">
            <label for="exampleFormControlSelect1">Status</label>
              <div class="col-sm-10">
               @if ($tag->status == 1)
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
               @else
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="set" value="1" checked>
                    <label class="form-check-label" for="set">
                    Set
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="unset" value="0" checked>
                    <label class="form-check-label" for="unset">
                    Unset
                    </label>
                </div> 
               @endif
                
              </div>
          </fieldset>
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
        </div>
    </form>
@endsection
