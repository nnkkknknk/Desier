<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = [
        'content',
        'work_id',
        'user_id',
    ];

    public function work()
    {
        return $this->belongsTo(Work::class);
    }

    public function user()
    {
        // return $this->hasMany(User::class);
        return $this->belongsTo(User::class);
    }
    
    public function loadRelationshipCounts()
    {
        $this->loadCount('user');
    }
}
