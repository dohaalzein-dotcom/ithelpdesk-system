<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
class User extends Authenticatable implements JWTSubject
{
    
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'RoleId');
    }
     public function creator(): HasMany
     {
        return $this->hasMany(Ticket::class, 'CreatedByUserId');
     }
     public function assignee(): HasMany
     {
        return $this->hasMany(Ticket::class, 'AssignedByUserId');
     }
     public function users(): HasMany
     {
        return $this->hasMany(TicketComment::class, 'UserId');
     }
     public function uploads(): HasMany
     {
        return $this->hasMany(TicketAttachment::class, 'UploadByUserId');
     }
     public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'UserId');
    }
     public function activity(): HasMany
    {
        return $this->hasMany(ActivityLog::class, 'UserId');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'Username',
        'Email',
        'Password',
        'RoleId',
        'AccountStatus',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function getAuthPassword()
    {
        return $this->Password;
    }
}
