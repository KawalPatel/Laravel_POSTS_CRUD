//update post

$get_posts = Post::find($id);
$get_posts->id = $request->input('id');
$get_posts->body = $request->input('body');
$get_posts->title = $request->input('title');
// $post = Post::firstOrCreate([$request->input('id') => $get_posts->id], $get_posts);
$post = Post::where('id', '=', $request->input('id'))->first();
if ($post === null) {
$post = new Post;
$post->id = addslashes("$get_posts->id");
$post->title = addslashes("$get_posts->title");
$post->body = addslashes("$get_posts->body");

$post->save();
}