<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'division_id',
        'name',
        'bn_name',
        'lat',
        'lon',
        'url',
    ];

    /**
     * Get the division that owns the district.
     */
    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    /**
     * Get the upazilas for the district.
     */
    public function upazilas()
    {
        return $this->hasMany(Upazila::class);
    }
}
