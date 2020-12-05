@extends('layouts.app')

@section('content')
    <h1 class="text-center">My Tags</h1>
    @if (Session::has('mess'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Thông báo: </strong> {!! Session::get('mess') !!}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <a href="{{ route('tags.create') }}" class="btn btn-primary mb-2">
        Add Tags 
        <i class="fas fa-plus"></i>
    </a>
    <table class="table table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                function showTags($tags, $parent_id = 0, $char = '')
                {
                    foreach ($tags as $key => $item)
                    {   
                        // Nếu là chuyên mục con thì hiển thị
                        if ($item['parent_id'] == $parent_id)
                        {
                            echo '<tr>';
                            echo '<td>'. $item->id .'</td>';
                            if($item->parent_id == 0) {
                                echo '<td> <b>'. $char . $item['name'] .'</b> </td>';
                            }else {
                                echo '<td>'. $char . $item['name'] .'</td>';
                            }
                          
                            if($item->status == 0) {
                                echo '<td><i class="fas fa-times"></i></td>';
                            }
                            else {
                                echo '<td><i class="fas fa-check"></i></td>';
                            }
                            echo '<td>
                                    <div class="action d-flex">
                                        <a class="text-info" href="'.route('tags.edit',[$item->id]).'" title="Edit"><i class="far fa-edit"></i></a>
                                        <form action="'.route('tags.destroy',[$item->id]).'" method="POST">
                                            '.csrf_field().'
                                            '.method_field('DELETE').'
                                            <button class="text-info" type="submit" style="background: none; border: none;"
                                                title="Delete"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                </td>';    
                            echo '</tr>';
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
        </tbody>
    </table>
@endsection
