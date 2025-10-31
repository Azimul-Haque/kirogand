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

        $this->middleware(['admin_or_manager'])->only('index', 'getApplicationbyCType');
    }

    public function index()
    {
        if(Auth::user()->role == 'manager') {
            if (Auth::user()->is_active === 0) {
                Session::flash('success', 'আপনার নিবন্ধন সফল হয়েছে। অনুমোদনের জন্য অপেক্ষা করুন। আপনার সাথে যোগাযোগ করা হবে। অথবা এই নম্বরে যোগাযোগ করুন: 01xxxxxxxxx');
                return redirect()->route('index.index');
            }
        }
        // $localofficescount = LocalOffice::count();
        // $localoffices = LocalOffice::where('name_bn', '!=', '')->orderBy('id', 'desc')->paginate(10);

        return view('dashboard.certificates.index');
    }

    public function getApplicationbyCType($certificate_type)
    {
        if(Auth::user()->role == 'manager') {
            if (Auth::user()->is_active === 0) {
                Session::flash('success', 'আপনার নিবন্ধন সফল হয়েছে। অনুমোদনের জন্য অপেক্ষা করুন। আপনার সাথে যোগাযোগ করা হবে। অথবা এই নম্বরে যোগাযোগ করুন: 01xxxxxxxxx');
                return redirect()->route('index.index');
            }
        }
        // $localofficescount = LocalOffice::count();
        // $localoffices = LocalOffice::where('name_bn', '!=', '')->orderBy('id', 'desc')->paginate(10);

        return view('dashboard.certificates.create')->with('certificate_type', $certificate_type);
    }

    public function createForm(Request $request)
    {
        $selectedType = $request->get('certificate_type');
        $schema = null;
        $availableSchemas = config('certificate_schemas', []); // Load all schemas from config

        if ($selectedType && array_key_exists($selectedType, $availableSchemas)) {
            // Load the schema if a valid type is selected
            $schema = $availableSchemas[$selectedType];
        } else {
            // If no type is selected, select the first one by default for the initial load
            $firstType = key($availableSchemas);
            if ($firstType) {
                $selectedType = $firstType;
                $schema = $availableSchemas[$firstType];
            }
        }

        return view('dashboard.certificate_form', [
            'selectedType' => $selectedType,
            'schema' => $schema,
            'allSchemas' => $availableSchemas,
        ]);
    }

    public function storeCertificate(Request $requests, $certificate_type)
    {
        if(Auth::user()->role == 'manager') {
            if (Auth::user()->is_active === 0) {
                Session::flash('success', 'আপনার নিবন্ধন সফল হয়েছে। অনুমোদনের জন্য অপেক্ষা করুন। আপনার সাথে যোগাযোগ করা হবে। অথবা এই নম্বরে যোগাযোগ করুন: 01xxxxxxxxx');
                return redirect()->route('index.index');
            }
        }
        // $localofficescount = LocalOffice::count();
        // $localoffices = LocalOffice::where('name_bn', '!=', '')->orderBy('id', 'desc')->paginate(10);

        return view('dashboard.certificates.create');
    }

    
}
