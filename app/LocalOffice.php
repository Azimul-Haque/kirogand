<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocalOffice extends Model
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'local_offices';

    /**
    * The attributes that are mass assignable.
    * The geographical fields are simplified to one.
    *
    * @var array
    */
    protected $fillable = [
        'name_bn',
        'name',
        'package_expiry_date',
        'office_type',
        'is_active',

        // Contact and Visuals
        'email',
        'mobile',
        'monogram',
    ];

    /**
    * Get the administrators (users) associated with this Local Office.
    */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function payments(){
        return $this->hasMany('App\Payment');
    }
}
