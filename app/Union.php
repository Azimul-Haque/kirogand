<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Union extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'upazila_id',
        'name',
        'bn_name',
        'url',
    ];

    /**
     * Get the upazila that owns the union.
     */
    public function upazila(): BelongsTo
    {
        return $this->belongsTo(Upazila::class);
    }
}
