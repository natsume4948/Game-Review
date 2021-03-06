<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
     'score', 'content', 'game_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

}
