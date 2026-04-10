<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model{

    protected $fillable = [
        'title',
        'description',
        'event_date',
        'location',
        'created_by',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function registrations(): HasMany {
        return $this->hasMany(Registration::class, 'event_id', 'id');
    }


}