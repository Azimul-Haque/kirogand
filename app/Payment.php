<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function localOffice() {
      return $this->belongsTo('App\User');
    }

    public function package() {
      return $this->belongsTo('App\Package');
    }
}
