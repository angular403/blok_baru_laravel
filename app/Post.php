<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $table = "post";
    protected $fillable = [
        'judul',
        'category_id',
        'content',
        'gambar',
        'slug',
        'users_id'
    ];

    public function Category()
    {
        return $this->belongsTo('App\Category');
    }

    public function tag()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function Users()
    {
        return $this->belongsTo('App\User');
    }
}
