<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Package;
use App\Payment;
use App\Division;
use App\District;
use App\Upazila;
use App\Union;
use App\UserAuthority;
use App\LocalOffice;

use Carbon\Carbon;
use Illuminate\Validation\Rule;
use DB;
use Hash;
use Auth;
use Image;
use File;
use Session;
use Artisan;
// use Redirect;
use OneSignal;
use Purifier;
use Cache;

class CertificateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth')->except('clear');
        // $this->middleware(['admin'])->only();

        $this->middleware(['admin_or_manager'])->only('getApplyforCertificate');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // if user is a manager, redirect him to his profile
        // if user is a manager, redirect him to his profile
        if(Auth::user()->role == 'user') {
            // abort(403, 'Access Denied');
            Session::flash('warning', 'নাগরিক একাউন্ট এ কাজ চলমান!');
            return redirect()->route('index.index');
        } elseif(Auth::user()->role == 'manager') {
            if (Auth::user()->is_active === 0) {
                // User is logged in but inactive. Redirect to a non-dashboard page (e.g., home)
                // and show a message that their account is pending approval.
                Session::flash('success', 'আপনার নিবন্ধন সফল হয়েছে। অনুমোদনের জন্য অপেক্ষা করুন। আপনার সাথে যোগাযোগ করা হবে। অথবা এই নম্বরে যোগাযোগ করুন: 01xxxxxxxxx');
                return redirect()->route('index.index');

            }
        }

        if(Auth::user()->local_office_id) {
          $packageexpirycheck = isPackageExpired(Auth::user()->localOffice->package_expiry_date);
          if($packageexpirycheck) {
            Session::flash('warning', 'আপনার সফটওয়্যার ব্যবহারের প্যাকেজটির মেয়াদ শেষ, প্যাকেজ কিনুন!');
          }
        }

        // $totalsites = Site::count();
        $totalusers = User::count();
        $totallocaloffices = LocalOffice::count();

        $totalpayment = Payment::sum('store_amount');
        // $totalbalance = Balance::sum('store_amount');
        // $totalexpense = Expense::sum('store_amount');

        $totalmonthlypayment = DB::table('payments')
                                ->select(DB::raw('SUM(store_amount) as totalamount'))
                                ->where(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"), "=", Carbon::now()->format('Y-m'))
                                // ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
                                ->first();
        $last14daysusersdaily = DB::table('users')
                                    ->select('created_at', DB::raw('COUNT(*) as totalusers'))
                                    ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"))
                                    ->orderBy('created_at', 'DESC')
                                    ->take(14)
                                    ->get();
        $daysforchartc = [];
        foreach ($last14daysusersdaily as $key => $days) {
            $daysforchartc[] = date_format(date_create($days->created_at), "M d");
        }
        $daysforchartc = json_encode(array_reverse($daysforchartc));

        $totalusersforchartc = [];
        foreach ($last14daysusersdaily as $key => $days) {
            $totalusersforchartc[] = $days->totalusers;
        }
        $originalforcumulitive = array_reverse($totalusersforchartc);
        $totalusersforchartc = json_encode(array_reverse($totalusersforchartc));

        $totaluserscumulitiveforchartc = [];
        $cumulitiveusersprimary = 0;
        foreach ($originalforcumulitive as $totalusersforc) {
            $cumulitiveusersprimary += $totalusersforc;
            $totaluserscumulitiveforchartc[] = $cumulitiveusersprimary;
        }
        $totaluserscumulitiveforchartc = json_encode($totaluserscumulitiveforchartc);
        // dd($totaluserscumulitiveforchartc);

        return view('dashboard.index')->withTotalusers($totalusers)
                                      ->withTotalpayment($totalpayment)
                                      ->withTotalmonthlypayment($totalmonthlypayment)
                                      ->withDaysforchartc($daysforchartc)
                                      ->withTotalusersforchartc($totalusersforchartc)
                                      ->withTotaluserscumulitiveforchartc($totaluserscumulitiveforchartc)
                                      ->withTotallocaloffices($totallocaloffices);
                                    // ->withTotalbalance($totalbalance)
                                    // ->withTotalexpense($totalexpense)
                                    // ->withTodaystotalexpense($todaystotalexpense)
                                    // ->withTodaystotaldeposit($todaystotaldeposit);
    }

    
}
