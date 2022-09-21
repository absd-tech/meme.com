<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\User;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'someone',
        'user_id',
        'post_id'
    ];

    //relationship with post
    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
