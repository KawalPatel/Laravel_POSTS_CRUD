<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Cuser;
use Illuminate\Support\Facades\DB;


class CuserController extends Controller
{

    public function index()
    {
        if (false == Auth::check()) {
            return redirect('/login')->with('error', 'Access denied: please login to continue');
        } else {
            //$posts = DB::select('Select * from posts');
            $posts = Cuser::orderBy('created_at', 'asc')->paginate(10);
            return view('posts.index')->with('posts', $posts);
        }
    }

    public function create()
    {
        return view('posts.create');
    }


    public function store(Request $request)
    {
        //create post


        $post = new Cuser;
        $post->id = rand();
        $post->name = addslashes($request->input('name'));

        $post->email = addslashes($request->input('email'));
        $post->password = addslashes($request->input('password'));


        $post->save();

        return redirect('/posts')->with('success', 'Post created');
    }


    public function show($id)
    {

        $post = Cuser::find($id);
        return view('posts.show')->with('post', $post);
    }

    public function edit($id)
    {
        $post = Cuser::find($id);
        // if (auth()->user()->email !== 'kawalpatel0897@gmail.com') {
        //     return redirect('/posts')->with('error', 'Access denied: only admins can edit');
        // }
        return view('posts.edit')->with('post', $post);
    }

    public function update(Request $request, $id)
    {
        //validate first
        $this->validate($request, [
            'name' => ['regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/', 'max:100'],

            'email' => ['string',  'max:170'],



        ]);
        // return $this->destroy($id); -----> how to call another function from a function

        //validation done, confirm changes?

        //create post

        $post = Cuser::find($id);
        $post->name = $request->input('name');
        $post->email = $request->input('email');

        $post->save();

        return redirect('/posts')->with('success', 'Post updated');
    }


    public function destroy($id)
    {
        $post = Cuser::find($id);

        // if (auth()->user()->email !== 'kawalpatel0897@gmail.com') {
        //     return redirect('/posts')->with('error', 'Access denied');
        // }
        $post->delete();

        return redirect('/posts')->with('success', 'Post deleted');
    }
}
