<?php

namespace App;

use App\API\AdminModel;
use App\API\UserModel;
use App\API\UserRelatedModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
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
     * Relationship: Get the user's userModels
     *
     * @return HasMany
     */
    public function userModels()
    {
        return $this->hasMany(UserModel::class);
    }

    /**
     * Relationship: Get the user's userRelatedModels through userModel
     *
     * @return HasManyThrough
     */
    public function userRelatedModels()
    {
        return $this->hasManyThrough(UserRelatedModel::class, UserModel::class);
    }

    /*
     * Check if the user is admin
     *
     * @return bool
     */
    public function admin(): bool
    {
        return $this->hasRole('admin');
    }

}
