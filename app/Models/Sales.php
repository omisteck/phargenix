<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sales extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public $timestamps = false;

    /**
     * Get the user that owns the Sales
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch()
    {
        return $this->belongsTo(branch::class);
    }

    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
