<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branch extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $hidden = [
        'organization_id',
    ];

    /**
     * Get the user that owns the Branch
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function staffs()
    {
        return $this->belongsToMany(User::class);
    }

    public function staff()
    {
        return $this->hasMany(Staff::class);
    }

    public function products()
    {
        return $this->hasMany(product::class);
    }


    public function sales()
    {
        return $this->hasMany(sales::class);
    }
}
