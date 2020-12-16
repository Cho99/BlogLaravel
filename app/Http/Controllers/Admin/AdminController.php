<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Models\Admin;
use App\Models\News;
use Auth;
use Session;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('login', 'postLogin', 'create', 'store', 'changeLanguage');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $author = Admin::find(1)->withCount('news')->get();
        //$pwd = auth()->guard('admin')->user()->remember_token;
        // dd($pwd);
        $totalNews = 0;
        foreach ($author as $item) {
            $totalNews = $item->news_count;
        }
        // dd($totalNews);
        // die;
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
        if (Auth::guard('admin')->check()) {
            return redirect()->back();
        }
        return view('admin.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {
        //
        //dd($request->all());
        $level = 0;
        $admin = new Admin;
        $admin->author_name = $request->author;
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->level = $level;
        if ($admin->save()) {
            return redirect()->route('admin.index')->with('mess_success', 'Đăng ký tài khoản thành công');
        } else {
            return redirect()->back();
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
        $admin = Admin::find($id);
        $news = $admin->news;
        $totalNews = count($news);
        $newActive = 0;
        $newUncheck = 0;
        $tags = [];
        foreach ($news as $new) {
            if ($new->tags) {
                array_push($tags, [
                    'id' => $new->tags->id,
                    'name' => $new->tags->name,
                ]);
            }

            if ($new->status == 1) {
                $newActive++;
            }
            if ($new->status == 0) {
                $newUncheck++;
            }
        }
        $tags = array_unique($tags, SORT_REGULAR);
        return view('admin.profile.index', ['admin' => $admin, 'tags' => $tags, 'newActive' => $newActive, 'newUncheck' => $newUncheck, 'totalNews' => $totalNews]);
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

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ],
            [
                'email.required' => 'Email không được để trống',
                'password.required' => 'Password không được để trống',
            ]);
        //$remember = $request->input('remember', false);
        $remember = false;
        if ($request->remember) {
            $remember = true;
        }
        $user = $request->only('email', 'password');
        // if ($request->remember == trans('remember.Remember Me')) {
        //     $remember = true;
        // } else {
        //     $remember = false;
        // }

        if (Auth::guard('admin')->attempt($user, $remember)) {
            $request->session()->regenerate();
            return redirect()->route('index');
        } else {
            return redirect()->back()->with('mess', 'Email với tài khoản không đúng')->withInput(
                $request->only('email')
            );
        }
    }

    public function login()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->back();
        }
        return view('admin/login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.index');
    }

    public function download($picture)
    {
        return response()->file('../public/upload/' . $picture);
    }

    public function changeLanguage(Request $request)
    {
        $lang = $request->language;
        $language = config('app.locale');
        if ($lang == 'en') {
            $language = 'en';
        }
        if ($lang == 'vi') {
            $language = 'vi';
        }
        Session::put('language', $language);
        return redirect()->back();
    }

}
