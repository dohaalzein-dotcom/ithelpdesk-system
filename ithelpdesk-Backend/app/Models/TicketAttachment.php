<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketAttachment extends Model
{
    protected $fillable = [
        'TicketId',
        'FileName',
        'FilePath',
        'FileType',
        'FileSize',
        'UploadByUserId',
    ];
    public function attachments(): BelongsTo
    {
        return $this->belongTo(Ticket::class, 'TicketId');
    }
    public function uploads(): BelongsTo
    {
        return $this->belongTo(User::class, 'UploadByUserId');
    }

}
