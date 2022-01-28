<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Lumen\Auth\Authorizable;

/**
 * @property int                  id
 * @property string               first_name
 * @property string               last_name
 * @property string               email
 * @property string               password
 * @property string               phone
 * @property Carbon               updated_at
 * @property Carbon               created_at
 *
 * @property Collection|Company[] companies
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordInterface
{
    use Authenticatable, Authorizable, HasFactory, CanResetPassword, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'phone',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * @return HasMany
     */
    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }
}
