<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Event;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];


    // one category has many events
    public function events()
    {
       return $this->hasMany(Event::class);
    }
}