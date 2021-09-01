<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    // public $timestamps = false;

    public function to_branches()
    {
        return $this->belongsTo(branch::class, 'branch_to');
    }

    public function from_branches()
    {
        return $this->belongsTo(branch::class, 'branch_from');
    }

    public function user()
    {
        return $this->belongsTo(user::class);
    }

}
