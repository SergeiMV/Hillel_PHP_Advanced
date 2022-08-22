<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    protected $fillable = [
        'title',
        'description',
        'author_id',
        'author_name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
