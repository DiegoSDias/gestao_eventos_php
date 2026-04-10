<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Registration extends Model {

    public $timestamps = false;
    
    protected $fillable = [
        'user_id',
        'event_id',
        'registration_date',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function event(): BelongsTo {
        return $this->belongsTo(User::class, 'event_id', 'id');
    }
}