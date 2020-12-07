@extends('layouts.app')

@section('content')
    <h1 class="text-center mb-4">My News</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col" class="">News</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($news as $new)
                <tr style="max-height: 120px; height: 120px">
                    <th class="w-10" style="width: 200px">{{ $new->id }}</th>
                    <td>
                        <div class="d-flex">
                            <img style="height: 128px; width:200px" src="{{ url('upload/',$new->picture) }}"
                                title="{{ $new->title }}">
                            <div class="info ml-3 d-flex flex-column">
                               <div>
                                <h5 class=""> Title: </h5>
                                    <span class="text-break text-truncate" style="max-width: 50px; width: 50px;">{{ $new->title }}</span> 
                               </div>
                                <span class="text-danger"><i class="far fa-clock" title="{{ $new->updated_at }}"></i>
                                    {{ date('d-m-Y', strtotime($new->updated_at)) }}</span>
                            </div>
                        </div>
                    </td>
                    <td style="padding-left:0">
                        <div class="action d-flex justify-content-around">
                            <a class="text-info" href="{{ route('news.show', [$new->id]) }}" title="Detail"><i
                                    class="fas fa-file-alt fa-2x"></i></a>
                            <a class="text-info" href="{{ route('news.edit', [$new->id]) }}" title="Edit"><i
                                    class="far fa-edit fa-2x"></i></a>
                            <form action="{{ route('news.destroy', [$new->id]) }}" method="POST">
                                 @csrf
                                 @method('DELETE')
                                <button class="text-info" type="submit" style="background: none; border: none;" title="Delete"><i class="fas fa-trash-alt fa-2x"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
