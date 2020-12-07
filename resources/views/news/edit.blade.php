@extends('layouts.app')

@section('content')
    <form action="{{ route('news.update', [$new->id]) }}" method="POST">
        @csrf
        {{ method_field('PUT') }}
        <div class="form-group">
            <label for="exampleFormControlInput1">Title</label>
            <input type="title" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Title ..."
                value={{ $new->title }}>
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
        <button type="submit" class="btn btn-primary">Edit New</button>
    </form>
@endsection
