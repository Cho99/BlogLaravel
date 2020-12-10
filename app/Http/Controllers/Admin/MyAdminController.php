<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Admin;
use Auth;

class MyAdminController extends Controller
{
    public function __construct()
    {
       //$this->middleware('admin', ['except' => 'login', 'postLogin']);
    }
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $news = News::all();    
        return view('admin.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    public function postLogin(Request $request) {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ],
        [
            'email.required' => 'Email không được để trống',
            'password.required' => 'Password không được để trống'
        ]);
        $user = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        // if ($request->remember == trans('remember.Remember Me')) {
        //     $remember = true;
        // } else {
        //     $remember = false;
        // }
      

        if(Auth::guard('admin')->attempt($user)) {
            return redirect()->route('index');
        } else {
            return redirect()->back()->with('mess', 'Email với tài khoản không đúng');
        }
    }


    public function login() {
        return view('admin/login');
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.index');
    }
}

   
