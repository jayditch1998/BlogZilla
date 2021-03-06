<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'title',
        'body',
        'author_id',
        'author',
        'img',
    ];

    public function likes(){
        return $this->hasMany(Likes::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
