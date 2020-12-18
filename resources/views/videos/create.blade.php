@extends('layouts.app')

@section('content')
    <h1 class="text-center"> Add Video</h1>
    @if (Session::has('mess'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Thông báo: </strong> {!! Session::get('mess') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <form action="{{ route('videos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleFormControlInput1">Name Video</label>
            <input type="text" name="name" class="form-control" id="name_tags" placeholder="Tags...">
        </div>
        @error('name')
            <span class="text-danger font-weight-bold mt-2">{{ $message }}</span>
        @enderror

        @foreach ($tags as $tag)
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="tag[{{ $tag->id }}]" type="checkbox" id="inlineCheckbox1" value="{{ $tag->id }}">
                <label class="form-check-label" for="inlineCheckbox1">{{ $tag->name }}</label>
            </div>
        @endforeach
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Add Video</button>
            </div>
        </div>
    </form>
@endsection
