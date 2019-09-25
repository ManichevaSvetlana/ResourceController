<?php

namespace App;

use App\Models\API\UserModel;
use App\Models\API\UserRelatedModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
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
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'is_admin',
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
     * Database: Get the is_admin attribute
     *
     * @return bool
     */
    public function getIsAdminAttribute() : bool
    {
        return $this->id ? $this->admin() : false;
    }

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

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null
     *
     * @throws \Exception
     */
    public function delete()
    {
        $this->userModels()->delete();
        return parent::delete();
    }

}
