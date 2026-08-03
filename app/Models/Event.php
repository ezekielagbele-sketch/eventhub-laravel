<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use App\Models\Registration;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'venue',
        'event_date',
        'event_time',
        'capacity',
        'image',
        'user_id',
        'category_id',
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}

public function category()
{
    return $this->belongsTo(Category::class);
}

public function registrations()
{
    return $this->hasMany(Registration::class);
}
}
