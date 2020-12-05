@extends('layouts.app')

@section('content')
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <h1 class="text-center">News</h1>
        <div class="container">
            <div class="action_top d-flex justify-content-between  align-items-center m-4">
                <a href="{{ route('news.create') }}" class="btn btn-success">Add New</a>
                <!-- Search form -->
                <div class="col-xs-3">
                    <form action="/search" method="GET" id="header-search"
                        class="form-inline d-flex justify-content-center md-form form-sm active-purple active-purple-2 mt-2">
                        <input onkeyup="onSearch(this.value)" class="form-control search" name="key" id="search" type="text"
                            placeholder="Search" aria-label="Search">
                    </form>
                </div>
            </div>

            {{-- Ajax live search --}}
            <script>
                function onSearch(str) {
                    if (str.length > 0) {
                        document.getElementById("row").style.display = "none";
                        document.getElementById("rowSearch").style.display = "";
                    } else {
                        document.getElementById("row").style.display = "";
                        document.getElementById("rowSearch").style.display = "none";
                    }
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            $news = this.responseText;
                            console.log($news);
                            document.getElementById("rowSearch").innerHTML = this.responseText;
                        }
                    }
                    xhttp.open("GET", "/search?key=" + str, true);
                    xhttp.send();
                }

            </script>
        </div>
        <div class="row justify-content-center" id="row">
            @if ($news)
                @foreach ($news as $new)
                    <div class="col-sm-3 m-4">
                        <div class="card" style="width: 18rem">
                            <img class="card-img-top img-fluid"
                                src="{{URL:($new->picture)}}"
                                alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title text-break text-truncate">{{ $new->title }}</h5>
                                <p class="card-text text-break text-truncate">{{ $new->content }}</p>
                                <div class="form_button d-flex justify-content-between">
                                    <div class="btn_show">
                                        <a href="{{ route('news.show', [$new->id]) }}" class="btn btn-primary"><i
                                                class="far fa-newspaper"></i></a>
                                    </div>
                                    <div class="action d-flex">
                                        <div class="btn_edit mr-1">
                                            <a href="{{ route('news.edit', [$new->id]) }}" class="btn btn-success"><i
                                                    class="fas fa-edit"></i></a>
                                        </div>
                                        <div class="btn_delete ml-1">
                                            <form method="POST" action="{{ route('news.destroy', [$new->id]) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <div class="form-group">
                                                    {{-- <input type="submit"
                                                        class="btn btn-danger" value="Delete">
                                                    --}}
                                                    <button class="btn btn-warning"><i
                                                            class='far fa-trash-alt'></i></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="rowSearch row justify-content-between" id="rowSearch">

    </div>
    {{-- <div class="d-flex justify-content-center"> {{ $news->links() }} </div>
    --}}
    </div>
@endsection
