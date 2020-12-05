<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\News;
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
        // $news = News::cursor()->filter(function ($news){
        //     return $news->id > 4;
        // });
        return view('news.news', ['news' => $news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('news.create');
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
            return redirect()->route('news.index');
        } else {
            return redirect()->route('news.create');
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
        return view('news.show', ['new' => $new, 'author' => $author]);
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
        if(!$new) {
            return abort(404);
        }
        return view('news.edit', ['new' => $new]);
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
            'title' => 'required',
            'content' => 'required|min:20'
        ]);
        $title = $request->title;
        $content = $request->content;
        $result = News::where('id', $id)
            ->update(['title' => $title, 'content' => $content]);
        if ($result) {
            return redirect()->route('news.index');
        } else {
            return redirect()->route('news.edit', ['id' => $id]);
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
            return redirect()->route('my_news.index');
        }
    }

    public function delete(Request $request, $id) {
       $new = News::Where('id', $id)->delete();
       if ($new) {
        return redirect()->route('news.index');
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
