<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'branch_user';

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

}
