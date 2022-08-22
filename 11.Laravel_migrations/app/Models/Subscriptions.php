<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriptions extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasOne(Users::class, 'id', 'user_id');
    }

    public function card()
    {
        return $this->hasOne(Cards::class, 'id', 'card_id');
    }

    public function notifications()
    {
        return $this->belongsToMany(
            Notifications::class,
            'notification_subscription',
            'notification_id',
            'subscription_id'
        )->withTimestamps();
    }
}
