<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Video;
use App\Models\Tag;
class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $videos = Video::with('tags')->get();
        //$videos = Video::all();
        //dd($videos);
        return view('videos.index', compact('videos'));
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
        return view('videos.create', compact('tags'));
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
        $video = new Video;
        $video->name = $request->name;
        $result = $video->save();
        $tags = $request->tag;
        if($result) {
            foreach($tags as $tag) {
                $tag = Tag::find($tag);
                $video->tags()->attach($tag);
            }
            return redirect()->route('videos.index');
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
        $video = Video::find($id)->load('tags');
        $tags = Tag::all();
        return view('videos.edit', compact('video', 'tags'));
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
        //dd($id, $request->all());
        $video =  Video::find($id);
        $video->name = $request->name;
        $tag = $request->tag; 
        $video->tags()->sync($tag);
        $video->save();
        return redirect()->route('videos.index');
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
        $video = Video::find($id);
        $tags = $video->load('tags');
        foreach($tags['tags'] as $tag) {
            $video->tags()->detach($tag);
        }
        $result = $video->delete();
        if ($result) {
            return redirect()->route('videos.index');
        }
    }
}
