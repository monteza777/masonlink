<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\User;
use Session;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function store(Request $request, $posts_id){
        $this->validate($request,
            [
            'comment'=>'required'
            ]);

        $postComment = $request['comment'];
        $post = Post::find($posts_id);

        $comment = new Comment();
        $comment->comment = $postComment;
        $comment->post()->associate($post);

        $comment->save();
        return redirect('/comment/'.$posts_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        /*$user_id = Auth::user()->id;
        $articles = Country::find($user_id);
        dd($articles->article);
        exit();
        return view('articles')->with('articles',$articles);
        */
        // $posthead = User::find($id)->comment();
        $posthead = Post::find($id);
        // $userId   = User::find($user_id)->comment();
        $data = [
            'posthead' => $posthead,
            // 'userId' => $userId
        ];
        return view('comment.post_comment')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $commentEdit = Comment::find($id);
        return view('comment.edit_comment',compact('commentEdit'));
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
        $this->validate($request,
            [
            'comment'=>'required|max:225',
            ]);

        $commentUpdate = Comment::find($id);
        $comment = $request['comment'];

        $commentUpdate->comment = $comment;
        $commentUpdate->save();
        Session::flash('success','Comment Succesfully Updated');
        return redirect('/comment/'.$commentUpdate->post_id);
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $userDelete->delete();
        return redirect('CommentsController');
    }
}
