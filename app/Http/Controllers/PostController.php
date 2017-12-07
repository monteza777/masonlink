<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Session;
use App\Comment;

class PostController extends Controller
{
    public function postCreatePost(Request $request){
        // Validation
        $this->validate($request,[
            'body' => 'required|max:255',
            ]);
        
        $post = new Post();
        $post->body = $request['body'];

        if($request->hasFile('images')){
            $image = $request->file('images');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Storage::disk('local')->put($filename, File::get($image)); 

            $post->images = $filename;
        }

        $request->user()->posts()->save($post);
        return redirect()->route('dashboard');

    }

    public function getDashboard(){
        $posts = Post::orderBy('created_at','desc')->get();
        // $CommentCount = Comment::all();
        $data = [
            // 'CommentCount' => $CommentCount,
            'posts' => $posts,
        ];
        return view('home')->with($data);

    }

    public function getDeletePost($post_id){
        $post = Post::where('id',$post_id)->first();
        if (Auth::user() != $post->user) {
            return redirect()->back();
        }
        Storage::delete($post->images);
        $post->delete();
        $post->comments()->delete();
        return redirect()->route('dashboard')->with(['message' => 'Successfully Deleted']);
    }

    public function postEditPost(Request $request){
        $this->validate($request, [
            'body' => 'required|max:255',
        ]);
        $post = Post::find($request['postId']);
        if (Auth::user() != $post->user) {
            return redirect()->back();
        }
        $post->body = $request['body'];
        $post->edited = 1;
        $post->update();
            return response()->json(['new_body' => $post->body], 200);
    }
//////////////// FOR NEW EDIT STYLE ////////
    public function editPost($id){
        $postEdit = Post::find($id);
        return view('post.edit_post',compact('postEdit'));
    }

    public function updatePost(Request $request, $id)
    {
        $postUpdate = Post::find($id);
        $body = $request['body'];
        // $image = $request['images']; 
        $postUpdate->body = $body;

        if($request->hasFile('images')){
        $image = $request->file('images');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        Storage::disk('local')->put($filename, File::get($image)); 
        $oldFile = $postUpdate->images;
        $postUpdate->images = $filename;  
        Storage::delete($oldFile);
        }
       
        $postUpdate->save();
        Session::flash('updated','The Post has been updated!!');
        return redirect()->route('dashboard');
    }

///////////////////// END OF EDIT STYLE ////////
    public function postLikePost(Request $request){
        $post_id = $request['postId'];
        $is_like = $request['isLike'] === 'true';
        $update = false;
        $post = Post::find($post_id);
        if(!$post){
            return null;
        }
        $user = Auth::user();
        $like = $user->likes()->where('post_id', $post_id)->first();
        if($like){
            $already_like = $like->like;
            $update = true;
            if ($already_like == $is_like){
                $like->delete();
                return null;
            }
        } else{
            $like = new Like();
        }
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->post_id = $post->id;
        if($update){
            $like->update();
        } else{
            $like->save();
        }
        return null;
    }

    public function getPostImage($filename){
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }
}
 