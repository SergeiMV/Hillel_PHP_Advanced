<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boards extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(Users::class, 'board_user', 'board_id', 'user_id')->withTimestamps();
    }

    public function author()
    {
        return $this->hasOne(Users::class, 'id', 'author_id');
    }

    public function columns()
    {
        return $this->hasMany(Columns::class, 'board_id');
    }
}
