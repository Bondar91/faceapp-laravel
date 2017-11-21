<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('comment_permission', ['except' =>['show']]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post_id_comment_content = 'post_' .$request->post_id. '_comment_content';
        $this->validate($request, [
            $post_id_comment_content => 'required|min:5'
        ],[
            'required' => 'Pole nie może być puste!',
            'min' => 'Podaj więcej niż 5 znaków!',
        ]);
        Comment::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
            'content' => $request->$post_id_comment_content,
        ]);

        return back();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);

        return view('comments.edit', compact('comment'));
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
        $this->validate($request, [
            'comment_content' => 'required|min:5'
        ],[
            'required' => 'Pole nie może być puste!',
            'min' => 'Podaj więcej niż 5 znaków!',
        ]);

        Comment::where('id', $id)->update([
            'content' => $request->comment_content,
        ]);

        return back()->with('message', 'Successfully updeted comment!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        Comment::where([
//            'id' => $id,
//        ])->delete();

        $comment = Comment::findOrFail($id);
        $comment->delete();

        return back();
    }
}
