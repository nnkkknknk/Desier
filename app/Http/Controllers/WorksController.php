<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MicropostsController extends Controller
{
    public function index()
    {
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
}