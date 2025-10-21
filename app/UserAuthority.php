<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAuthority extends Model
{
    protected $fillable = [
        'user_id',
        'authority_id',
        'authority_type',
        'role',
    ];

    /**
     * Get the user associated with this authority assignment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the parent authority model (Union, Upazila, District, or Division).
     */
    public function authority()
    {
        // This links authority_id and authority_type to the correct geographic model (Union, Upazila, etc.)
        return $this->morphTo();
    }
}
