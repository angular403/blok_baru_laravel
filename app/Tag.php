<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = "tag";

    protected $fillable = [
        'name',
        'slug'
    ];

    public function Post()
    {
        return $this->belongsToMany('App\Post');
    }
}
