<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User; // 追加


class UsersController extends Controller
{
    //indexは必要ないので割愛
    // public function index()
    // {
    //     // ユーザ一覧をidの降順で取得
    //     $users = User::orderBy('id', 'desc')->paginate(10);

    //     // ユーザ一覧ビューでそれを表示
    //     return view('users.index', [
    //         'users' => $users,
    //     ]);
    // }
    
    public function show($id)
    {
        
        $data = [];
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);
        $works = $user->works()->orderBy('created_at', 'desc')->paginate(10);
        
        $data = [
            'user' => $user,
            'works' => $works,
        ];
        
        return view('users.show', $data);
        
    }
    
    
    public function post($id)
    {
        // dd($id);
        $user = User::findOrFail($id);
        
        // return view('users.post');
        return view('users.post', '$user');
        
    }
    
    /**
     * ユーザのフォロー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function followings($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのフォロー一覧を取得
        $followings = $user->followings()->paginate(10);
        
        $works = $user->works()->orderBy('created_at', 'desc')->paginate(10);
        
        // フォロー一覧ビューでそれらを表示
        // return view('users.followings', [
        return view('users.show', [
            'user' => $user,
            'users' => $followings,
            'works' => $works,
        ]);
    }

    /**
     * ユーザのフォロワー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function followers($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのフォロワー一覧を取得
        $followers = $user->followers()->paginate(10);
        
        $works = $user->works()->orderBy('created_at', 'desc')->paginate(10);

        // フォロワー一覧ビューでそれらを表示
        return view('users.show', [
            'user' => $user,
            'users' => $followers,
            'works' => $works,
        ]);
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
            'microposts' => $favoritings,
        ]);
    }
    
     /**
     * ユーザのフォロワー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
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
