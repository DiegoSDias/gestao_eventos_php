<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model{
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    public function events(): HasMany {
        return $this->hasMany(Event::class, 'created_by', 'id');
    }

    public function registrations(): HasMany {
        return $this->hasMany(Registration::class, 'user_id', 'id');
    }

}