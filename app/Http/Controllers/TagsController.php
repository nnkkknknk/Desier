<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tag; // 追加

class TagsController extends Controller
{
    
     public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'tag' => 'required|max:255',
        ]);
        // 認証済みユーザ（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
        $request->work()->tags()->create([
            'tag' => $request->tag,
        ]);

        // 前のURLへリダイレクトさせる
        return back();
    }
}
