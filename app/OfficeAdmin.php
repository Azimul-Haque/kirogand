<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfficeAdmin extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'office_admins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'local_office_id',
        'user_id',
        'role',
    ];

    /**
     * Get the office associated with this administrator.
     */
    public function localOffice()
    {
        return $this->belongsTo(LocalOffice::class);
    }

    /**
     * Get the user (admin) associated with this relationship.
     */
    public function user()
    {
        // Assuming your main user model is named 'User'
        return $this->belongsTo(User::class); 
    }
}
