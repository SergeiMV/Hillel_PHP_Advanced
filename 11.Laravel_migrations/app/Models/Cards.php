<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cards extends Model
{
    use HasFactory;

    public function author()
    {
        return $this->hasOne(Users::class, 'id', 'author_id');
    }

    public function executor()
    {
        return $this->hasOne(Users::class, 'id', 'executor_id');
    }

    public function column()
    {
        return $this->hasOne(Columns::class, 'id', 'column_id');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class, 'card_id');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscriptions::class, 'card_id');
    }

    public function notifications()
    {
        return $this->hasMany(Comments::class, 'card_id');
    }
}
