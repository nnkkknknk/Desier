<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $fillable = ['tag'];

    /**
     * この投稿を所有するユーザ。（ Userモデルとの関係を定義）
     */
    public function work()
    {
        return $this->belongsTo(Work::class);
    }
}
