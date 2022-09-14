<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'content', 'image', 'game_id', 'user_id',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }


    public function likes()
    {
        return $this->hasMany(Like::class, 'post_id', 'id');
    }
}
