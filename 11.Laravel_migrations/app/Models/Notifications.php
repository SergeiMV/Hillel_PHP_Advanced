<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;

    public function card()
    {
        return $this->hasOne(Cards::class, 'id', 'card_id');
    }

    public function subscriptions()
    {
        return $this->belongsToMany(
            Subscriptions::class,
            'notification_subscription',
            'notification_id',
            'subscription_id',
        )->withTimestamps();
    }
}
