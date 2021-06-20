<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uploadcode extends Model
{
    //
    protected $table = "codes";
    protected $fillable = ['file_name','file_path','work_id'];
    
    public function work()
    {
        return $this->belongsTo(Work::class);
    }
}
