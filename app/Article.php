<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Article extends Model
{
    use Searchable;
    protected $guarded = ['id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
