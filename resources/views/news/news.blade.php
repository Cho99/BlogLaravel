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
        <div class="row ml-2 mr-2" id="row">
            @if ($news)
                @foreach ($news as $new)
                    <div class="col-sm-3 ml-2 mr-5 mb-5" style="max-width: 18rem; width: 18rem;">
                        <a href="{{ route('news.show', [$new->id]) }}" style="text-decoration: none;">
                            <div class="card text-dark">
                                <img class="card-img-top img-fluid" src="upload/{{ $new->picture }}" alt="Card image cap"
                                    style="width: 256px; max-width: 256px; height:143px; max-height:143px">
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold text-break text-truncate">{{ $new->title }}</h5>
                                    <span class="text-danger"><i class="far fa-clock"></i>
                                        {{ date('d-m-Y', strtotime($new->updated_at)) }}</span>
                                    <p class="card-text text-break text-truncate">{{ $new->content }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="row ml-2 mr-2" id="rowSearch">
        </div>
    </div>
    {{-- <div class="d-flex justify-content-center"> {{ $news->links() }} </div>
    --}}
    </div>
@endsection
