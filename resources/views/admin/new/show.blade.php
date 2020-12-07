@extends('admin/layout')

@section('title', '')

@section('content')
    <div class="jumbotron">
        <h1 class="display-4">{{ $new->title }}</h1>

        <hr class="my-4">
        <span class="text-danger"><i class="far fa-clock" title="{{ $new->updated_at }}"></i>
            {{ date('d-m-Y', strtotime($new->updated_at)) }}</span>
        <span> | <b><i class="fas fa-user-edit" title="Author: {{ $author->name }}"></i> {{ $author->name }}</b> </span>
        <p>{{ $new->content }}</p>
    </div>
@endsection
