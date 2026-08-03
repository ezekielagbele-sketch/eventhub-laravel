<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Event;

class Registration extends Model
{
    protected $fillable = [
        'event_id',
        'user_id',
        'name',
        'email',
        'phone',
    ];

    // A registration belongs to one event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // A registration belongs to one user (optional for guests)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
