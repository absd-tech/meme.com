<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Post;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'body',
        'post_id',
        'commenter_name',
    ];

    //Relationship between post and comment
    public function post(){
        return $this->belongsTo(Post::class);
    }

    //Relationship between user and comment
    public function user(){
        return $this->belongsTo(Post::class);
    }
}
