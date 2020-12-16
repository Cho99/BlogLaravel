<?php

namespace App\Http\Middleware;
use App\Models\News;
use Auth;
use Closure;
use App\User;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id_news;
        if($request->news) {
            $id_news = $request->news;
        }
        if($request->my_news) {
            $id_news = $request->my_news;
        }
        $new = News::find($id_news);
        if(!$new) {
            abort(404);
        }
        $user_id = $new->user_id;
        $admin = auth()->guard('admin')->user();
        
        if($admin->level === 0) {
            return $next($request);
        }
        
        if($user_id == auth()->guard('admin')->user()->id) {
            return $next($request);
        } else {
            return abort(404);
        }
    }
}
