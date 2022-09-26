<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Tweet;
use Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $comments = Comment::getAllOrderByUpdated_at();
        return view('tweet.show', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // commentディレクトリの中のcreate.vlade.phpを示している．
        return view('comment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //　いったんバリデーションは置いとく..やっぱやる
        // バリデーション
        $validator = Validator::make($request->all(), [
            'comment' => 'required',
        ]);
        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
            ->route('comment.create')
            ->withInput()
            ->withErrors($validator);
        }

        // $data = $comment->merge(['user_id' => Auth::user()->id])->all();
        // $result = Comment::create($data);
        $result = Comment::create($request->all());

        // ddd($result);
        return redirect()->route('tweet.show');
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
        // ddd($id);
        $result = Comment::find($id)->delete();
        return redirect()->route('tweet.show');
    }
}
