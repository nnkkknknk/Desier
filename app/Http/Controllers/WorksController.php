<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Work; // 追加
use App\User; // 追加


class WorksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //多分これいらない
        $data = [];
        
        // 認証済みユーザを取得
        $user = \Auth::user();
        // ユーザの投稿の一覧を作成日時の降順で取得
        // （後のChapterで他ユーザの投稿も取得するように変更しますが、現時点ではこのユーザの投稿のみ取得します）
        $works = $user->works()->orderBy('created_at', 'desc')->paginate(10);
        dd($works);
        $data = [
            'user' => $user,
            'works' => $works,
        ];
        
        // Welcomeビューでそれらを表示
        // return view('welcome', $data);
        // return view('users.show', $data);
        return view('works.works', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
        $work = new Work;

        // メッセージ作成ビューを表示
        return view('works.create', [
            'work' => $work,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        //
         // バリデーション
        $request->validate([
            'title' => 'required|max:20',
            'description' => 'required|max:255',
            // 'tag' => 'required|max:255',
        ]);
        
        // dd($request->all());
        // dd($request->user()->works());
        $request->user()->works()->create([
            'title' => $request->title,
            'description' => $request->description,
            // 'tag' => $request->tag,
        ]);
        
        // 認証済みユーザ（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
        
        $data = [];
        $user = $request->user();
        
        // // 前のURLへリダイレクトさせる
        // return back();
        $works = $user->works()->orderBy('created_at', 'desc')->paginate(10);
        
        $data = [
            'user' => $user,
            'works' => $works,
        ];
        
        return view('users.show', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
       
        
        // idの値でメッセージを検索して取得
        $work = Work::findOrFail($id);
        // dd($work);
        $user_id = $work->user_id;
        $user = User::findOrFail($user_id);
        // dd($user);
        // メッセージ詳細ビューでそれを表示
        return view('works.show', [
            'work' => $work,
            'user' => $user,
        ]);
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
        //
        // idの値で投稿を検索して取得
        $work = \App\Work::findOrFail($id);

        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は、投稿を削除
        if (\Auth::id() === $work->user_id) {
            $work->delete();
        }

        // 前のURLへリダイレクトさせる
        return back();
    }
    
     /**
     * お気に入り機能の実装
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function favoritings($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのフォロー一覧を取得
        $favoritings = $user->favoritings()->paginate(10);

        // フォロー一覧ビューでそれらを表示
        return view('users.favoriting', [
            'user' => $user,
            'users' => $favoritings,
        ]);
    }

    public function favoriters($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのフォロワー一覧を取得
        $favoriters = $user->favoriters()->paginate(10);

        // フォロワー一覧ビューでそれらを表示
        return view('users.favoriters', [
            'user' => $user,
            'users' => $favoriters,
        ]);
    }

}
