<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasRoles;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'position',
        'level',
        'phone',
        'password'
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
     * Get the user that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organization()
    {
        return $this->hasOne(Organization::class);
    }

    public function staff()
    {
        return $this->hasOne(Staff::class);
    }

    public function branch()
    {
        return $this->belongsToMany(Branch::class)->withTimestamps();
    }


    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public function sales()
    {
        return $this->hasMany(Sales::class);
    }
    public function sales_returns()
    {
        return $this->hasMany(Sales_Return::class);
    }

    public function reconciles()
    {
        return $this->hasMany(Reconcile::class);
    }


    public function transfers()
    {
        return $this->hasMany(Transfer::class);
    }


    public function getAllPermissionsAttribute() {
        $permissions = [];
          foreach (Auth::user()->getAllPermissions() as $permission) {
            if (Auth::user()->can($permission->name)) {
                $permissions[] = $permission->name;
              }
          }
          return $permissions;
      }
      
}
