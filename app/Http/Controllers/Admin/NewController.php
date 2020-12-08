<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Tag;
use App\User;
use Auth; 

class NewController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['only' => ['index , show']]);
        $this->middleware('Role', ['only' => ['edit','update','destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$page = 3;
        //$news = News::paginate($page);
        $news = News::orderBy('id','DESC')->get();
        $users = User::all();
        $tags = Tag::all();

        $data = [];
        foreach($news as $new) {
            foreach($users as $user) {
                foreach($tags as $tag) {
                    if($new->user_id == $user->id) {
                        if($new->tag_id == $tag->id) {
                            array_push($data,['id' => $new->id ,
                            'title' => $new->title, 
                            'picture' => $new->picture,
                            'user_id' => $new->user_id,
                            'author' => $user->name,
                            'tag_name' => $tag->name,
                            'status' => $new->status, 
                            'updated_at' => $new->updated_at]);
                        }
                    }
                }
            }
        }
        // $news = News::cursor()->filter(function ($news){
        //     return $news->id > 4;
        // });
        return view('admin.new.list_new', ['news' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tags = Tag::all();
        return view('admin.new.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user_id = Auth::id();
        $new = new News;
        $new->title = $request->title;
        $new->content = $request->content;
        $new->user_id = $user_id;
        $new->status = 1;  
        $new->tag_id = $request->tag_id;
        $validate =  $request->validate( [
            'title' => 'required',
            'content' => 'required|min:20'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file;
            $file->move('upload', $file->getClientOriginalName());
        }
        $new->picture = $file->getClientOriginalName();
       
        if ($new->save()) {
            return redirect()->route('admin.new.index')->with('mess', 'Tạo bài viết thành công');
        } else {
            return redirect()->route('admin.new.create')->with('mess', 'Thêm bài viết thất bại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $new = News::find($id);
        if(!$new) {
            abort(404);
        }
        $user_id = $new->user_id;
        $author = User::find($user_id);
        return view('admin.new.show', ['new' => $new, 'author' => $author]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $new = News::find($id);
        $tags = Tag::all();
        if(!$new) {
            return abort(404);
        }
        return view('admin.new.edit', ['new' => $new, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validate =  $request->validate( [
            'title' => 'required|max:50|min:5',
            'content' => 'required|min:20'
        ]);
        $title = $request->title;
        $content = $request->content;
        $tag_id = $request->tag_id;
        $result = News::where('id', $id)
            ->update(['title' => $title, 'content' => $content, 'tag_id' => $tag_id]);
        if ($result) {
            return redirect()->route('news.index')->with('mess', 'Cập nhật bài đăng thành công');
        } else {
            return redirect()->route('news.edit', ['id' => $id])->with('mess', 'Cập nhật bài đăng thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $new = News::Where('id', $id)->delete();
        if ($new) {
            return redirect()->route('news.index')->with('mess', 'Xóa thành công bài đăng');
        }
    }

    public function delete(Request $request, $id) {
       $result = News::Where('id', $id)->delete();
       if ($result) {
           return redirect()->route('news.index')->with('mess', 'Xóa bài đăng thành công');
       } else {
           return redirect()->route('news.index')->with('mess', 'Xóa bài đăng thất bại');
       }
    }

    public function search(Request $request)
    {
        $key = $request->key;
        $output = '';
        $data = News::where('title', 'like', '%' . $key . '%')->orderBy('id','DESC')->get();
        if ($data) {
            foreach ($data as $new) {
                $time = date('d-m-Y', strtotime($new->updated_at));
                $output .= "
                <div class='col-sm-3 ml-2 mr-5 mb-5' style='max-width: 18rem; width: 18rem;'>
                <a href='{{ route('news.show', [$new->id]) }}' style='text-decoration: none;'>
                    <div class='card text-dark'>
                        <img class='card-img-top img-fluid' src='upload/$new->picture' alt='Card image cap'
                            style='width: 256px; max-width: 256px; height:143px; max-height:143px'>
                        <div class='card-body'>
                            <h5 class='card-title font-weight-bold text-break text-truncate'>$new->title</h5>
                            <span class='text-danger'><i class='far fa-clock'></i> $time</span>
                            <p class='card-text text-break text-truncate'>$new->content</p>
                        </div>
                    </div>
                </a>
            </div>
                ";
            }  
        }
        return $output;
    }
}
