<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Resources\Posts;
use App\Models\Apis\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function get_posts()
    {
        $posts = Post::all();
        return Posts::collection($posts)->additional(['status' => true]);
    }


    public function create_post(Request $request)
    {

        $addpost = new Post();
        $addpost->title = $request->title;
        $addpost->tags = $request->tags;
        $addpost->description = $request->description;
        $addpost->author = $request->author;
        $addpost->status = $request->status;

        $save = $addpost->save();
        if ($save) {
            return response()->json(['message' => 'Post has been Added.', 'data' => $addpost]);
        }
    }


    public function update_post(Request $request, $id)
    {
        $editpost = Post::find($id);
        $editpost->title = $request->title;
        $editpost->tags = $request->tags;
        $editpost->description = $request->description;
        $editpost->author = $request->author;
        $editpost->status = $request->status;

        $update = $editpost->update();
        if ($update) {
            return response()->json($editpost);
        }
    }


    public function delete_post($id)
    {
        $del = Post::find($id)->delete();
        if ($del) {
            return response()->json(['message' => 'Post has been deleted.'], 200);
        } else {
            return response()->json(['message' => 'Post Not Found'], 404);
        }
    }
}
