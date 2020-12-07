@extends('admin/layout')

@section('title', 'My News')

@section('content')
    <a href="{{ route('news.create') }}" class="btn btn-primary mb-2">
        Add New
        <i class="fas fa-plus"></i>
    </a>
    <table class="table">
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
        <tbody>
            @foreach ($news as $new)
                <tr>
                    <th scope="row">{{ $new->id }}</th>
                    <td>
                        <div class="d-flex">
                            <img style="height: 75px; width:120px" src="{{ url('upload/', $new->picture) }}"
                                title="{{ $new->title }}">
                            <div class="info ml-3 d-flex flex-column">
                                <div>
                                    <h6 class=""> Title: </h6>
                                    <span class="text-break text-truncate"
                                        style="max-width: 170px;">{{ $new->title }}</span>
                                </div>
                                <span class="text-danger"><i class="far fa-clock" title="{{ $new->updated_at }}"></i>
                                    {{ date('d-m-Y', strtotime($new->updated_at)) }}</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span>{{ Auth::user()->name }}</span>
                    </td>
                    <td>
                        <span>{{$new->tag_id}}</span>
                    </td>
                    <td>
                        @if ($new->status == 0) {
                            <i class="fas fa-times"></i>
                            }
                        @else
                            <i class="fas fa-check"></i>
                        @endif
                    </td>
                    <td style="padding-left:0">
                        <div class="action d-flex justify-content-around">
                            <a class="text-info" href="{{ route('news.show', [$new->id]) }}" title="Detail"><i
                                    class="fas fa-file-alt"></i></a>
                            <a class="text-info" href="{{ route('news.edit', [$new->id]) }}" title="Edit"><i
                                    class="far fa-edit"></i></a>
                            <form action="{{ route('news.destroy', [$new->id]) }}" method="POST">
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
    </table>
@endsection