@extends('admin/layout')

@section('title', 'Profile')

@section('css')
    <link href="{{ asset('/admins/css/profile.css') }}" rel="stylesheet">
@endsection

@section('content')
    <form method="post">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog"
                        alt="" />
                    <div class="file btn btn-lg btn-primary">
                        Change Photo
                        <input type="file" name="file" />
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                    <h5>
                        {{ $admin->author_name }}
                    </h5>
                        {{-- @if ($admin->level == 1)
                            <h6>Admin</h6>
                        @else
                            <h6>Author</h6>
                        @endif --}}
                    <h6>{{ $admin->level == 1 ? 'Admin' : 'Author' }}</h6>
                    <p class="proile-rating"><span>Total: {{ $totalNews }} </span> news</p>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                aria-controls="home" aria-selected="true">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                aria-controls="profile" aria-selected="false">Timeline</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2">
                <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="profile-work">
                    <p>Info</p>
                    Author: <label>{{ $admin->author_name }}</label><br />
                    Email: <label>{{ $admin->email }}</label><br />
                    Phone: <label>091237222</label><br />
                    Home:
                    <p>Writing genre</p>
                    @foreach ($tags as $tag)
                        <a href="">{{ $tag['name']}} </a><br />
                    @endforeach
                </div>
            </div>
            <div class="col-md-8">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <label>News active</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $newActive }}  <i class="fas fa-newspaper"></i></p> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>News uncheck</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $newUncheck }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Followers</label>
                            </div>
                            <div class="col-md-6">
                                <p>10</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Followings</label>
                            </div>
                            <div class="col-md-6">
                                <p>5</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Experience</label>
                            </div>
                            <div class="col-md-6">
                                <p>Expert</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
