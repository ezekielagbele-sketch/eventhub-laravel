<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use App\Models\Registration;

class Event extends Model
{
    /**
     * Mass assignable fields
     */
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

    /**
     * Cast attributes
     */
    protected function casts(): array
    {
        return [
            'event_date' => 'date',
        ];
    }

    /**
     * Event belongs to a User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Event belongs to a Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Event has many Registrations
     */
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}