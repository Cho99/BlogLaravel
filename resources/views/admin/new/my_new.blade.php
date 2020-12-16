@extends('admin/layout')

@section('title', 'My News')

@section('content')
    @if (Session::has('mess'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Thông báo: </strong> {!! Session::get('mess') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <a href="{{ route('my_news.create') }}" class="btn btn-primary mb-2">
        Add New
        <i class="fas fa-plus"></i>
    </a>
    <table class="table table-fixed" width="100%">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">News</th>
                <th scope="col">Author</th>
                <th scope="col">Tag</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <div>
             <tbody>
            @foreach ($data as $new)
                <tr>
                    <th scope="row">{{ $new['id'] }}</th>
                    <td>
                        <div>
                            <a href="{{ route('admin.download', [$new['picture']]) }}" target="_blank" rel="noopener noreferrer"> <img style="height: 75px; width:120px" src="{{ url('upload/', $new['picture']) }}"
                                title="{{ $new['id'] }}"> </a>
                            {{-- <div class="info ml-3 d-flex flex-column">
                                <div>
                                    <h6 class=""> Title: </h6>
                                    <span class="text-break text-truncate"
                                        style="max-width: 170px;">{{ $new['title'] }}</span>
                                </div>
                                <span class="text-danger"><i class="far fa-clock" title="{{ $new['updated_at'] }}"></i>
                                    {{ date('d-m-Y', strtotime($new['updated_at'])) }}</span>
                            </div> --}}
                        </div>
                    </td>
                    <td>
                        <span>{{ $new['author'] }}</span>
                    </td>
                    <td>
                        <span>{{ $new['tag_name'] }}</span>
                    </td>
                    <td>
                        @if ($new['status'] == 0) {
                            <i class="fas fa-times"></i>
                            }
                        @else
                            <i class="fas fa-check"></i>
                        @endif
                    </td>
                    <td style="padding-left:0">
                        <div class="action d-flex justify-content-around">
                            <a class="text-info" href="{{ route('my_news.show', [$new['id']]) }}" title="Detail"><i
                                    class="fas fa-file-alt"></i></a>
                            <a class="text-info" href="{{ route('my_news.edit', [$new['id']]) }}" title="Edit"><i
                                    class="far fa-edit"></i></a>
                            <form action="{{ route('my_news.destroy', [$new['id']]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="text-info" type="submit" style="background: none; border: none;"
                                    title="Delete"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </div>
    </table>

@endsection
