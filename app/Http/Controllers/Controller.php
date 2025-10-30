<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Message;
use App\LocalOffice;
use View;
use Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct() 
    {
      // etake cache korte hobe sathe sathe reported question gular cound dhukaite hobe
      $unresolvedmessagecount = Message::where('status', 0)->count();
      if(!isEmpty(Auth::user()->local_office_id)) {
        $localoffice = LocalOffice::findOrFail(Auth::user()->local_office_id);
        $packageexpirycheck = isPackageExpired($localoffice->package_expiry_date);
      }
      View::share('unresolvedmessagecount', $unresolvedmessagecount);
    }
}
