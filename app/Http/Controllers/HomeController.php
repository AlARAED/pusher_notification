<?php

namespace App\Http\Controllers;

use App\Events\NewComment;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::with('comments')->get();



        return view('home',compact('posts'));    }

        public function  saveComment(Request $request){
            Comment::create([
                   'post_id' => $request->post_id ,
                   'user_id' => Auth::id(),
                   'comment' => $request->post_content,
            ]);

              $data =[
                   'user_id' => Auth::id(),
                   'user_name'  => Auth::user()->name,
                   'comment' => $request->post_content,
                   'post_id' =>$request->post_id ,
              ];


               ///   save  notify in database table ////

             event(new NewComment($data));

            return redirect() -> back() -> with(['success'=> 'تم اضافه تعليقك بنجاح ']);
        }


}
