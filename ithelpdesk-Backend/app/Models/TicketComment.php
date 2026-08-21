<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class TicketComment extends Model
{
    protected $fillable = [
        'TicketId',
        'UserId',
        'CommentText',
        'IsInternalNote',
    ];
    public function comments(): BelongsTo
    {
        return $this->belongsTo(Ticket::class, 'TicketId');
    }
     public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'UserId');
    }

}
