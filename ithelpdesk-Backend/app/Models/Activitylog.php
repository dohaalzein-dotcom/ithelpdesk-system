<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Activitylog extends Model
{
    protected $fillable = [
        'UserId',
        'ActionType',
        'Description',
        
    ];
    public function activity(): BelongsTo
    {
        return $this->belongsTo(User::class, 'UserId');
    }
}
