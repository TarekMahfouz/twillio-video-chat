<?php

namespace Modules\Twillio\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    protected static function newFactory()
    {
        return \Modules\Twillio\Database\factories\RoomFactory::new();
    }
}
