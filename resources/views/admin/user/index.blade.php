@extends('admin/layout')

@section('title', 'List User')

@section('content')
    <table class="table  table-fixed">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>
                <th scope="col">Total News</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <th scope="row">{{ $user['id'] }}</th>
                <td>{{ $user['name'] }}</td>
                <td>{{ $user['email'] }}</td>
                <td>1</td>
                <td>{{ $user['total'] }} Bài viết</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
