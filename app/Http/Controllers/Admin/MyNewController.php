<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Admin;
use App\Models\Tag;
use App\User;
use Auth; 
class MyNewController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['except' => 'login']);
        $this->middleware('Role', ['only' => ['edit','update','destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $id = auth()->guard('admin')->user()->id;
        $author = auth()->guard('admin')->user()->author_name;
        $news = Admin::find($id)->news;
        // print_r($news);
        // die;
        $tags = Tag::All();
        $data = [];
        if($news) {
            foreach($news as $new) {
                foreach($tags as $tag) {
                    if($new->tag_id == $tag->id){
                        array_push($data,['id' => $new->id ,
                        'title' => $new->title, 
                        'picture' => $new->picture,
                        'user_id' => $new->user_id,
                        'author' => $author, 
                        'tag_name' => $tag->name,
                        'status' => $new->status, 
                        'updated_at' => $new->updated_at]);
                    }
                }
            }
        }
        return view('admin.new.my_new',['data' => $data]);
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
        $user_id = auth()->guard('admin')->user()->id;
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
            return redirect()->route('my_news.create')->with('mess', 'Đăng bài thành công');
        } else {
            return redirect()->route('my_news.create')->with('mess', 'Đăng bài thất bài');
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
        $author = Admin::find($user_id);
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
            return redirect()->route('my_news.index')->with('mess','Sửa thành công bài đăng');
        } else {
            return redirect()->route('my_news.edit', ['id' => $id])->with('mess','Sửa bài đăng thất bài');
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
        //
        $result = News::find($id)->delete();
        if($result) {
            return redirect()->route('my_news.index')->with('mess','Xóa thành công bài đăng');
        }else {
            return redirect()->route('my_news.index')->with('mess','Xóa bài đăng thất bại');
        }
    }
}
