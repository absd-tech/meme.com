<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\user;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'love',
        'post_id'
    ];

    //Relationship between like and post
    public function post(){
        return $this->belongsTo(Post::class);
    }

    //relationship between user and like
    public function user(){
        return $this->belongsToMany(User::class);
    }

}
