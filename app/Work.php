<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    //
    // protected $table = 'comment';
    protected $fillable = [
        'tag', 
        'user_id', 
        'title', 
        'description',
        'comment',
    ];
    
    /**
     * この投稿を所有するユーザ。（ Userモデルとの関係を定義）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
        
    }
    
     public function favoriter()
    {
        return $this->belongsToMany(User::class, 'favorites', 'works_id', 'user_id')->withTimestamps();
    }
    
     public function tags()
    {
        return $this->hasMany(Tag::class);
    }
    
     public function upload_images()
    {
        return $this->hasMany(UploadImage::class);
    }
     public function codes()
    {
        return $this->hasMany(Uploadcode::class);
    }
    
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
    
    
    // public function commenter() {
        
    //     // return $this->hasMany(Comment::class);
    //     return $this->belongsToMany(User::class, 'comment', 'works_id', 'user_id')->withTimestamps();
        
    // }
    // belongsToMany() では、関係先のModelのクラス（User::class) を第一引数に指定します。
    // 第二引数に中間テーブル（user_follow）を指定します。
    // 第三引数には中間テーブルに保存されている自分のidを示すカラム名（user_id）を指定します。
    // 第四引数には中間テーブルに保存されている関係先のidを示すカラム名（follow_id）を指定します。
    
    public function loadRelationshipCounts()
    {
        $this->loadCount('tags', 'upload_images', 'codes','comment');
    }
    
    
    

}
