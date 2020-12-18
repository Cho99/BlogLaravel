@extends('admin/layout')

@section('title', 'Videos')

@section('content')
    <a href="{{ route('videos.create') }}" class="btn btn-primary mb-2">
        Add Video
        <i class="fas fa-plus"></i>
    </a>
    <table class="table  table-fixed">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Tags</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($videos as $video)
                <tr>
                    <th scope="row">{{ $video->id }}</th>
                    <td>{{ $video->name }}</td>
                    <td>
                        @foreach ($video['tags'] as $item)
                            <div>{{ $item->name }}</div>
                        @endforeach
                    </td>
                    <td>
                        <div><a href="{{ route('posts.edit', [$video->id]) }}">Edit</a></div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
