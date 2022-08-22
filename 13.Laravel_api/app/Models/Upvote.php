<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upvote extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function posts()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    protected $fillable = [
        'user_id',
        'post_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
