<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Upazila extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'district_id',
        'name',
        'bn_name',
        'url',
    ];

    /**
     * Get the district that owns the upazila.
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    /**
     * Get the unions for the upazila.
     */
    public function unions()
    {
        return $this->hasMany(Union::class);
    }
}
