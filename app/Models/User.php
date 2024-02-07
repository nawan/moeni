<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Attribute as GlobalAttribute;
use Illuminate\Database\Eloquent\Casts\Attribute as CastsAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nik',
        'no_kontak',
        'alamat',
        'email',
        'password',
        'image',
        'is_admin',
        'status',
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
        'password' => 'hashed',
    ];

    public function production()
    {
        return $this->hasMany(Production::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function production_user()
    {
        return $this->hasMany(Production_users::class);
    }


    // public function gravatar(): Attribute
    // {
    //     $hash = md5(strtolower(trim($this->attributes['email'])));
    //     return new Attribute(
    //         get: fn () => "http://www.gravatar.com/avatar/$hash",
    //     );
    // }
}
