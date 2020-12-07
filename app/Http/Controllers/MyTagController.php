<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class MyTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tags = Tag::all();
        return view('tags.show', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tags = Tag::get();
        return view('tags.create', compact('tags'));
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
        $tag = new Tag;
        $tag->name = $request->name;
        $tag->parent_id = $request->tag_id;
        $tag->status = $request->status;
        $validate = $request->validate([
            'name' => 'required',
            'tag_id' => 'required',
            'status' => 'required',
        ]);
        if ($tag->save()) {
            return redirect()->action('MyTagController@create')->with('mess', 'Thêm thành công');
        } else {
            echo redirect()->action('MyTagController@create')->with('mess', 'Lỗi hệ thống');
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
        $tag = Tag::find($id);
        $tags = Tag::Where('parent_id', 0)->get();
        return view('tags.edit', ['tag' => $tag, 'tags' => $tags]);
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
        $name = $request->name;
        $parent_id = $request->tag_id;
        $status = $request->status;
        
        // $tag = Tag::find($id);
        // if ($tag->parent_id == $parent_id AND $parent_id != 0) {
        //     $tag_a = Tag::find($parent_id);
        //     $parent_id_a = $tag_a->parent_id;
        //     $result = Tag::where('id', $id)->update(['name' => $name, 'parent_id' => $parent_id_a, 'status' => $status]);
        //     if ($result) {
        //         $result = Tag::where('id', $parent_id)->update([
        //             'parent_id' => $id]);
        //         if ($result) {
        //             return redirect()->route('tags.index')->with('mess', 'Sửa thành công');
        //         } else {
        //             return redirect()->route('tags.index')->with('mess', 'Sửa thất bại');
        //         }
        //     }
        // }
        if($parent_id == $id) {
            return redirect()->route('tags.edit', $id)->with('mess', 'Sửa thất bại');
        }

        $result = Tag::where('id', $id)->update([
            'name' => $name, 'parent_id' => $parent_id, 'status' => $status]);
        if ($result) {
            return redirect()->route('tags.index')->with('mess', 'Sửa thành công');
        } else {
            return redirect()->route('tags.edit', ['id' => $id])->with('mess', 'Sửa thất bại');
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
        $tags = Tag::all();
        foreach($tags as $item) {
            if($id == $item->parent_id) {
                return redirect()->route("tags.index")->with("mess", "Tag hiện tại vẫn có các tags con nếu muốn xóa phải không có Tag con nào");
            }
        }
        $tag = Tag::where('id', $id)->delete();
        if($tag) {
            return redirect()->route("tags.index")->with("mess", "Xóa Tag thành công");
        } else {
            return redirect()->route("tags.index")->with("mess", "Xóa thất bại");
        }
    }
}
