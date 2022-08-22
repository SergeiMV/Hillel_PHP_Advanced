<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    public function card()
    {
        return $this->hasOne(Cards::class, 'id', 'card_id');
    }

    public function user()
    {
        return $this->hasOne(Users::class, 'id', 'user_id');
    }
}
