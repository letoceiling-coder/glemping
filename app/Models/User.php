<?php

namespace App\Models;


use App\Models\Traits\Filterable;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable implements MustVerifyEmail
{
    use Filterable,HasApiTokens, HasFactory, Notifiable;

    protected $with = [ 'role','image'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'active',
        'role_id',
        'image_id',
        'subscription',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
//        'password' => 'hashed',
        'active' => 'integer',
        'role_id' => 'integer',
        'phone' => 'string',
        'subscription' => 'boolean',
    ];

    public function sendEmailVerificationNotification()
    {
        try {
            $this->notify(new VerifyEmail);
        } catch (\Exception $exception) {
            redirect()->to(url()->previous());
        }

    }
    public function role(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(UserRole::class, 'id', 'role_id');
    }
    public function image(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Image::class, 'id', 'image_id');
    }
}
