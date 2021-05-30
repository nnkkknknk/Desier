<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    //
    protected $fillable = [
        'tag', 
        'user_id', 
        'title', 
        'description'
    ];
    
    /**
     * この投稿を所有するユーザ。（ Userモデルとの関係を定義）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
        
        
    }
    
     public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    public function loadRelationshipCounts()
    {
        $this->loadCount('tags');
    }
    

}
