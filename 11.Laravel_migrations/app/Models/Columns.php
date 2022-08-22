<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Columns extends Model
{
    use HasFactory;

    public function cards()
    {
        return $this->hasMany(Cards::class, 'column_id');
    }

    public function board()
    {
        return $this->hasOne(Boards::class, 'id', 'board_id');
    }
}
