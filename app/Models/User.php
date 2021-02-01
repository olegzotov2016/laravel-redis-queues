<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 *
 * @property int $id
 * @property string $name
 * @property string $password
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @param string|null $value
     *
     * @return string
     */
    public function setPasswordAttribute(?string $value): string
    {
        if ($value) {
            return $this->attributes['password'] = Hash::make($value);
        }

        return $this->attributes['password'] = $this->password;
    }

    /**
     * @param $password
     *
     * @return bool
     */
    public function checkPassword($password): bool
    {
        return Hash::check($password, $this->password);
    }

    /**
     * @param $email
     *
     * @return User|null
     */
    public  function findUserByEmail($email): ?User
    {
        return self::where('email', $email)->first();
    }
}
