<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    protected $fillable = [
        'Reference Number',
        'Title',
        'Description',
        'CreatedByUserId',
        'AssignedToUserId',
        'CategoryId',
        'PriorityId',
        'StatusId',
    ];
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'CreatedByUserId');
    }
    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'AssignedToUserId');
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'CategoryId');
    }
     public function priority(): BelongsTo
    {
        return $this->belongsTo(Priority::class, 'PriorityId');
    }
     public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'StatusId');
    }
    public function comments(): HasMany
    {
        return $this->hasMany(TicketComment::class, 'TicketId');
    }
     public function attachments(): HasMany
    {
        return $this->hasMany(TicketAttachment::class, 'TicketId');
    }

}
