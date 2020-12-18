@extends('admin/layout')

@section('title', 'Post')

@section('content')
    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-2">
        Add Post
        <i class="fas fa-plus"></i>
    </a>
    <table class="table  table-fixed">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Tags</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <td>{{ $post->name }}</td>
                    <td>
                        @foreach ($post['tags'] as $tag)
                            <div>
                                {{ $tag->name }}
                            </div>
                        @endforeach
                    </td>
                    <td>
                        <div class="d-flex">
                            <div><a href="{{ route('posts.edit', [$post->id]) }}" class="btn btn-success mr-2">Edit</a></div>
                            <div>
                                <form action="{{ route('posts.destroy', [$post->id]) }}" method="POST">
                                    @csrf
                                    @method('Delete')
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
