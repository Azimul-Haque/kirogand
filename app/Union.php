<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Union extends Model
{
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
    public function upazila()
    {
        return $this->belongsTo(Upazila::class);
    }
}
