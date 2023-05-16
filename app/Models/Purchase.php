<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function branch()
    {
        return $this->belongsTo(branch::class);
    }

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier');
    }

}
