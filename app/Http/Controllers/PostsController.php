<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\DB;
use GuzzleHttp;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use PHPExcel;
use PHPExcel_IOFactory;
use OzdemirBurak\JsonCsv\File\Json;
use PHPUnit\Util\Json as UtilJson;
use Psy\Util\Json as PsyUtilJson;

use App\Http\Requests\CustomExportRequest;
use App\Http\Requests\PostsValidationRequest;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()

    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $posts = Post::orderBy('id', 'asc')->paginate(10);
        return view('posts.index')->with('posts', $posts);
    }

    public function getDataFromAPI()
    {
        $client = new GuzzleHttp\Client();
        $posts2 = $client->request('GET', 'https://jsonplaceholder.typicode.com/posts');
        $posts = json_decode($posts2->getBody(), true);

        for ($i = 0; $i < 100; $i++) {

            $title = $posts[$i]['title'];
            $body = $posts[$i]['body'];
            // $title = $_REQUEST['title'];
            // $body = $_REQUEST['body'];
            $post = new Post;
            $post->title = addslashes("$title");
            $post->body = addslashes("$body");

            $post->save();
        }
        return view('posts.index')->with('posts', $posts);
    }

    public function exportCsv(Request $request)
    {
        // dd($_request->all());
        // dd($_REQUEST);
        $fileName = 'my_posts.csv';
        $tasks = Post::all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('id', 'title', 'body');

        $callback = function () use ($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['id']  = $task->id;
                $row['title']    = $task->title;
                $row['body']    = $task->body;

                fputcsv($file, array($row['id'], $row['title'], $row['body']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportCsvCustom(CustomExportRequest $request)
    {

        $cc = $request['checkbox'];

        $fileName = 'my_posts.csv';
        // $tasks = Post::all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('id', 'title', 'body');
        $chk = "";

        $tasks = Post::all();
        $callback = function () use ($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($_REQUEST['checkbox'] as $chk) {
                // dd($_REQUEST['checkbox']);
                // $tasks = Post::all();
                $tasks = Post::where("id", "=", $chk)->get();

                foreach ($tasks as $task) {
                    $row['id']  = $task->id;
                    $row['title']    = $task->title;
                    $row['body']    = $task->body;

                    fputcsv($file, array($row['id'], $row['title'], $row['body']));
                }
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }





    public function create(Request $request)
    {

        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (isset($_POST['export_to_csv'])) {
            $cc = $request['checkbox'];

            $fileName = 'my_posts.csv';

            $headers = array(
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            );

            $columns = array('id', 'title', 'body');
            $chk = "";

            $tasks = Post::all();
            $callback = function () use ($tasks, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);
                foreach ($_REQUEST['checkbox'] as $chk) {
                    // dd($_REQUEST['checkbox']);
                    // $tasks = Post::all();
                    $tasks = Post::where("id", "=", $chk)->get();

                    foreach ($tasks as $task) {
                        $row['id']  = $task->id;
                        $row['title']    = $task->title;
                        $row['body']    = $task->body;

                        fputcsv($file, array($row['id'], $row['title'], $row['body']));
                    }
                }
                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        } else if (isset($_POST['getDataFromApi_StoreToDatabase'])) {


            Post::query()->truncate();
            $client = new GuzzleHttp\Client();
            $posts2 = $client->request('GET', 'https://jsonplaceholder.typicode.com/posts');
            $posts = json_decode($posts2->getBody(), true);

            for ($i = 0; $i < 100; $i++) {

                $title = $posts[$i]['title'];
                $body = $posts[$i]['body'];


                $post = new Post;
                $post->title = addslashes("$title");
                $post->body = addslashes("$body");

                $post->save();
            }

            return redirect('/posts')->with('success', 'Posts imported');
        }
    }


    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit')->with('post', $post);
    }


    function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' =>  'required',
        ]);

        //update post
        $post = Post::find($id);
        $post->body = $request->input('body');
        $post->title = $request->input('title');

        $post->save();

        return redirect('/posts')->with('success', 'Post updated');
    }


    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect('/posts')->with('success', 'Post deleted');
    }
}
