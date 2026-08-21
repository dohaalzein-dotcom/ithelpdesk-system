<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    protected $fillable = [
        'UserId',
        'Title',
        'Message',
        'IsRead',
    ];
    public function notifications(): BelongsTo
    {
        return $this->belongsTo(User::class, 'UserId');
    }
}
