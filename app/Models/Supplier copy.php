<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
    

    public function purchases()
    {
        return $this->hasMany(Supplier::class);
    }
}
