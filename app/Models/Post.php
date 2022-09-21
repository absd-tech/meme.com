<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Like;
use App\Models\Comment;
use App\Models\notification;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'image',
        'user_id'
    ];

    //Relationship between post and user
    public function user(){
        return $this->belongsTo(User::class);
    }

    //Relationship between post ans like
    public function like(){
        return $this->hasOne(Like::class);
    }

    //Relationship with comment
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    //relationship with notification
    public function notifications(){
        return $this->hasMany(Notification::class);
    }

}
