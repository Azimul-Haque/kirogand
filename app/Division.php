<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'bn_name',
        'url',
    ];

    /**
     * Get the districts for the division.
     */
    public function districts(): HasMany
    {
        return $this->hasMany(District::class);
    }
}
