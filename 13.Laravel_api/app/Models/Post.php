<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function upvotes()
    {
        return $this->hasMany(Upvote::class, 'post_id');
    }

    protected $fillable = [
        'title',
        'link',
        'author_id',
        'author_name',
        'upvotes_count',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
