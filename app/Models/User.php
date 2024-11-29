<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'photo',
        'email_verified_at',
        'is_twoFactor',
        "role_id",
        'provider_id',
        'provider',
        'provider_token',
        "is_suspended"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'provider_token'    ];

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


    public static function generateUsername($username){
        if ($username == null){
            $username = Str::lower(Str::random(8));
        }

        if(!empty(User::where('username', $username)->first())){
            $newUsername = Str::lower(Str::random(8));
            $username =self::generateUsername($newUsername);
        }
        return $username;
    }

    public function role(){
        return $this->hasOne(Role::class, "id", "role_id");
    }

    public function seller(){
        return $this->has(Seller::class);
    }

    public function address(){
        return $this->belongsToMany(Address::class);
    }

    public function review(){
        return $this->hasMany(Review::class);
    }

    public function cart(){
        return $this->hasMany(Cart::class);
    }

    public function notification(){
        return $this->hasMany(notification::class);
    }
}
