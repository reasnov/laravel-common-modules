<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Modules\User\Database\Factories\UserFactory;
use Modules\User\Support\UsernameGenerator;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, HasRoles, HasUuids, Notifiable;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'avatar_url',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            if (empty($user->username)) {
                $user->username = (new UsernameGenerator)->generate($user->name);
            }
        });
    }

    public function initials(): Attribute
    {
        return Attribute::make(
            get: function () {
                $names = explode(' ', trim($this->name));
                $initials = mb_strtoupper(mb_substr($names[0], 0, 1));
                if (isset($names[1])) {
                    $initials .= mb_strtoupper(mb_substr($names[1], 0, 1));
                }

                return $initials;
            },
        );
    }

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }
}
