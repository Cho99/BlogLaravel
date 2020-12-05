@extends('layouts.app')

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
            <label for="exampleFormControlTextarea1">Picture</label>
            <input type="file" name="file" required="true">
            @error('file')
                <span class="text-danger font-weight-bold mt-2">{{ $message }}</span>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Add New</button>
    </form>
@endsection
