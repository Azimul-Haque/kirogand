<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

use App\User;
use App\Package;
use App\Temppayment;
use App\Payment;
use App\Blog;

use App\Division;
use App\District;
use App\Upazila;
use App\Union;
use App\UserAuthority;
use App\LocalOffice;
use App\Certificate;

use Carbon\Carbon;
use DB;
use Hash;
use Auth;
use Image;
use File;
use Session;
use Artisan;
use Cache;
// use Redirect;
use OneSignal;
use PDF;
use Shipu\Aamarpay\Facades\Aamarpay;


class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
        
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return redirect('https://play.google.com/store/apps/details?id=com.orbachinujbuk.bcs');
        
        // $packages = Package::where('status', 1)->get();
        // $blogs = Blog::orderBy('id', 'desc')->get()->take(3);

        return view('index.index');
        
                    // ->withPackages($packages)
                    // ->withBlogs($blogs);
    }

    public function getServices()
    {
        return view('index.services');
    }

    public function getVerifyCertificate()
    {
        return view('index.verifycertificate');
    }

    public function verifyCertificate($unique_serial)
    {
        $certificate = Certificate::where('unique_serial', $unique_serial)
                                  // ->where('status', 1) // নাগরিক আবেদন করলে দেখা যাবে তখন
                                  ->first();
                                  
        return view('index.verify')->withCertificate($certificate);
    }

    public function getApplicationStatus()
    {
        return view('index.applicationstatus');
    }

    public function getNotices()
    {
        return view('index.notices');
    }

    public function getUserGuidelines()
    {
        return view('index.userguidelines');
    }

    public function termsAndConditions()
    {
        return view('index.termsandconditions');
    }

    public function privacyPolicy()
    {
        return view('index.privacypolicy');
    }

    public function refundPolicy()
    {
        return view('index.refundpolicy');
    }

    public function paymentProceed(Request $request)
    {
        $this->validate($request,array(
            'user_number'    =>   'required',
            'package_id'     =>   'required',
            'amount'         =>   'required',
        ));

        $user = User::where('mobile', $request->user_number)->first();
        $package = Package::findOrFail($request->package_id);

        if($user) {
            // $temppayment = new Temppayment;
            // $temppayment->user_id = $user->id;
            // $temppayment->package_id = $request->package_id;
            // $temppayment->uid = $user->uid;
            // // generate Trx_id
            // $trx_id = 'BJS' . random_string(10);
            // $temppayment->trx_id = $trx_id;
            // $temppayment->amount = $request->amount;
            // $temppayment->save();

            Session::flash('info','পেমেন্টটি সম্পন্ন করুন!');
            return view('index.payments.bkashpay')
                            ->withUser($user)
                            ->withAmount($request->amount)
                            ->withPackageid($package->id)
                            ->withPackagedesc($package->name . ' - ' . $package->duration . ' - ৳ ' . $package->price);
        } else {
            // Session::flash('warning','নাম্বারটি পাওয়া যায়নি! অ্যাপে গিয়ে রেজিস্ট্রেশন করুন।');
            Session::flash('swalwarning','নাম্বারটি পাওয়া যায়নি! অ্যাপে গিয়ে রেজিস্ট্রেশন করুন।');
            // Session::flash('swalwarningappling','https://play.google.com/store/apps/details?id=com.orbachinujbuk.bcs_constitution&pcampaignid=pcampaignidMKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1');
            return redirect()->route('index.index');
        }
    }

    public function paymentSuccess(Request $request)
    {
        
        $user_id = $request->get('opt_a');
        
        if($request->get('pay_status') == 'Failed') {
            Session::flash('info', 'পেমেন্ট সম্পন্ন হয়নি, আবার চেষ্টা করুন!');
            return redirect()->route('index.index');
        }
        
        $amount_request = $request->get('opt_b');
        $amount_paid = $request->get('amount');

        if($request->pay_status == "Successful" && $amount_paid == $amount_request) {
            // OLD VERIFICATION METHOD
            
            $temppayment = Temppayment::where('trx_id', $request->mer_txnid)->first();
            // dd($request->all());
            $payment = new Payment;
            $payment->user_id = $user_id;
            $payment->package_id = $temppayment->package_id;
            $payment->uid = $temppayment->uid;
            $payment->payment_status = 1;
            $payment->card_type = $request->card_type;
            $payment->trx_id = $request->mer_txnid;
            $payment->amount = $request->amount;
            $payment->store_amount = $request->store_amount;
            $payment->save();

            $user = User::findOrFail($user_id);
            $current_package_date = Carbon::parse($user->package_expiry_date);
            $package = Package::findOrFail($temppayment->package_id);
            if($current_package_date->greaterThanOrEqualTo(Carbon::now())) {
                $package_expiry_date = $current_package_date->addDays($package->numeric_duration)->format('Y-m-d') . ' 23:59:59';
            } else {
                $package_expiry_date = Carbon::now()->addDays($package->numeric_duration)->format('Y-m-d') . ' 23:59:59';
            }
            // dd($package_expiry_date);
            $user->package_expiry_date = $package_expiry_date;
            $user->save();
            // ARO KAAJ THAKTE PARE, JODI FIREBASE EO UPDATE KORA LAAGE
            // ARO KAAJ THAKTE PARE, JODI FIREBASE EO UPDATE KORA LAAGE
            // dd($payment);

            $temppayment->delete();

            Session::flash('swalsuccess', 'পেমেন্ট সফল হয়েছে। অ্যাপটি ব্যবহার করুন। ধন্যবাদ!');
            return redirect()->route('index.index');
        } else {
            // dd($request->all());
            // $paymentdata = json_encode($request->all());
            // Session::flash('swalsuccess', $paymentdata);
            Session::flash('info', 'পেমেন্ট সম্পন্ন হয়নি, অনুগ্রহ করে Contact ফর্ম এর মাধ্যমে আমাদের জানান।');
            return redirect()->route('index.index');
        }

        // $valid  = Aamarpay::valid($request, $amount_request);
        // if($valid)
        // {
        //     // dd($request->all());
        // } 
    }

    public function paymentCancel(Request $request)
    {
        Session::flash('info','পেমেন্টটি ক্যানসেল করা হয়েছে!');
        return redirect()->route('index.index');
    }

    public function paymentFailed(Request $request)
    {
        Session::flash('info','পেমেন্টটি ব্যর্থ হয়েছে! অনুগ্রহ করে যোগাযোগ করুন।');
        return redirect()->route('index.index');
    }



    public function paymentSuccessApp(Request $request)
    {
        if($request->get('pay_status') == 'Failed') {
            Session::flash('info', 'পেমেন্ট সম্পন্ন হয়নি, আবার চেষ্টা করুন!');
            return redirect()->route('index.index');
        }
        
        $amount_request = $request->get('opt_b');
        $amount_paid = $request->get('amount');

        if($request->pay_status == "Successful" && $amount_paid == $amount_request) {
            // OLD VERIFICATION METHOD
            
            $temppayment = Temppayment::where('trx_id', $request->mer_txnid)->first();
            // dd($request->all());
            $payment = new Payment;
            $payment->user_id = $temppayment->user_id;
            $payment->package_id = $temppayment->package_id;
            $payment->uid = $temppayment->uid;
            $payment->payment_status = 1;
            $payment->card_type = $request->card_type;
            $payment->trx_id = $request->mer_txnid;
            $payment->amount = $request->amount;
            $payment->store_amount = $request->store_amount;
            $payment->save();

            $user = User::findOrFail($temppayment->user_id);
            $current_package_date = Carbon::parse($user->package_expiry_date);
            $package = Package::findOrFail($temppayment->package_id);
            if($current_package_date->greaterThanOrEqualTo(Carbon::now())) {
                $package_expiry_date = $current_package_date->addDays($package->numeric_duration)->format('Y-m-d') . ' 23:59:59';
            } else {
                $package_expiry_date = Carbon::now()->addDays($package->numeric_duration)->format('Y-m-d') . ' 23:59:59';
            }
            // dd($package_expiry_date);
            $user->package_expiry_date = $package_expiry_date;
            $user->save();
            // ARO KAAJ THAKTE PARE, JODI FIREBASE EO UPDATE KORA LAAGE
            // ARO KAAJ THAKTE PARE, JODI FIREBASE EO UPDATE KORA LAAGE
            // dd($payment);

            $temppayment->delete();

            Session::flash('swalsuccess', 'পেমেন্ট সফল হয়েছে। অ্যাপটি ব্যবহার করুন। ধন্যবাদ!');
            // return redirect()->route('index.index');
        } else {
            // dd($request->all());
            // $paymentdata = json_encode($request->all());
            // Session::flash('swalsuccess', $paymentdata);
            Session::flash('info', 'পেমেন্ট সম্পন্ন হয়নি, অনুগ্রহ করে Contact ফর্ম এর মাধ্যমে আমাদের জানান।');
            // return redirect()->route('index.index');
        }

        // $valid  = Aamarpay::valid($request, $amount_request);
        // if($valid)
        // {
        //     // dd($request->all());
        // } 
    }

    public function paymentCancelApp(Request $request)
    {
        Session::flash('info','পেমেন্টটি ক্যানসেল করা হয়েছে!');
    }


    // Generate PDF...

    public function getExamSolvePDF($softtoken, $examid)
    {
        if($softtoken == env('SOFT_TOKEN'))
        {
            $exam = Exam::findOrFail($examid);

            // return view('index.pdf.test')->withExam($exam);

            $pdf = PDF::loadView('index.pdf.examsolvepdf', ['exam' => $exam]);
            $fileName = 'Single-Exam-Solve-Sheet-' . $exam->id . '.pdf';
            return $pdf->stream($fileName); // download/stream
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function checkIP()
    {
        $response = file_get_contents('http://66.45.237.70/api.php');

        dd($response);
    }

    public function requestACDelete(Request $request)
    {
        Session::flash('swalsuccess', 'Thank you for the deletion request. We will update you soon!');
        return redirect()->route('index.index');
    }

    public function redirectPlayStore()
    {
        return redirect('https://play.google.com/store/apps/details?id=com.orbachinujbuk.bcs');
    }

    public function getAPIStatus()
    {
        return view('index.apistatus');
    }

    public function getDocumentation()
    {
        return view('index.documentation');
    }

    public function getAuthorityRegister()
    {
        $divisions = Division::all();

        return view('index.auth.register-authority')->withDivisions($divisions);
    }

    public function storeAuthorityRegister(Request $request)
    {
        $rules = [
            'name'        => 'required|string|max:191',
            'name_en'        => 'required|string|max:191',
            'nid'        => 'required|string|max:191',
            'mobile'      => 'required|string|max:191|unique:users,mobile',
            'email'      => 'required|string|max:191|unique:users,email',
            'designation'      => 'required',
            'authority_level' => 'nullable|string|in:Division,District,Upazila,Union',
            // Validation for authority ID based on selected level
            'authority_id' => [
                'nullable',
                Rule::requiredIf(fn () => $request->authority_level),
                'integer',
            ],

            'office_name'    => 'required|string|max:191',
            'office_type'    => 'required',
            'password'    => 'required|string|min:8|max:191|confirmed',
            'captcha' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);
        
        // Correct manual handling MUST include withInput()
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput(); // <--- ADD THIS LINE if you manually validate
        }

        // Retrieve the CAPTCHA text from the session
        $sessionCaptcha = Session::get('captcha');

        if (strtolower($request->input('captcha')) != strtolower($sessionCaptcha)) {
            // If the CAPTCHA is incorrect, redirect back with an error.
            return redirect()->back()->withErrors(['captcha' => 'ক্যাপচাটি ভুল হয়েছে !']);
        }

        try {
            $user = new User;
            $user->name = $request->name;
            $user->is_active = 0; // by default active kora thakbe na
            $user->name_en = $request->name_en;
            $user->nid = $request->nid;
            $user->mobile = $request->mobile;
            $user->email = $request->email;
            $user->designation = $request->designation;
            $user->role = 'manager'; // All authority accounts will be manager
            
            $user->password = Hash::make($request->password);
            $user->save();

            $this->syncUserAuthoritywithLO($user, $request);

            // 3. POST-REGISTRATION LOGIN
            Auth::login($user);

            // 4. REDIRECT BASED ON STATUS
            if ($user->is_active === 0) {
                // User is logged in but inactive. Redirect to a non-dashboard page (e.g., home)
                // and show a message that their account is pending approval.
                Session::flash('success', 'আপনার নিবন্ধন সফল হয়েছে। অনুমোদনের জন্য অপেক্ষা করুন। আপনার সাথে যোগাযোগ করা হবে। অথবা এই নম্বরে যোগাযোগ করুন: 01737988070');
                return view('index.auth.logged_in_inactive_page'); // Change 'home' to your desired route name for the home page

            } else {
                // User is active (shouldn't happen with default 'is_active' = 0, but good for safety)
                return redirect()->route('dashboard.index');
            }
        } catch (\Exception $e) {
            // Handle any database saving errors
            return redirect()->back()->with('error', 'দুঃখিত, কোন একটি সমস্যা হয়েছে। আবার চেষ্টা করুন!');
        }
    }

    protected function syncUserAuthoritywithLO(User $user, Request $request)
    {
        $level = $request->input('authority_level');
        $id = $request->input('authority_id');

        // Check if an authority assignment is requested
        if ($level && $id) {
            // Determine the fully qualified model class name
            $modelClass = 'App\\' . $level;
            
            if (class_exists($modelClass)) {
                UserAuthority::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'authority_id' => $id,
                        'authority_type' => $modelClass,
                        'role' => $request->designation, // Use user role as authority role for simplicity
                    ]
                );
                // update or create Local Office
                $localoffice = LocalOffice::updateOrCreate(
                    [
                        'package_expiry_date' => Carbon::now()->format('Y-m-d') . ' 23:59:59',
                        'name_bn' => $request->office_name,
                        'office_type' => $request->office_type,
                        'is_active' => 0, // by default active kora thakbe na
                    ]
                );
                $user->local_office_id = $localoffice->id;
                $user->save();
            }
        } else {
            // If no authority is selected, delete any existing authority assignments
            $user->authorities()->delete();
        }
    }

    public function getOfficeLogin()
    {
        return view('index.auth.office-login');
    }

    public function getCitizenRegister()
    {
        Session::flash('warning', 'নাগরিক নিবন্ধন এর কাজ চলমান। আপনার নিকটস্থ ইউনিয়ন/পৌরসভায় যোগাযোগ করুন, তারা ড্যাশবোর্ড থেকে সনদ প্রদান করবে!');
        return redirect()->route('index.index');
        return view('index.auth.register-citizen');
    }

    public function getContact()
    {
        return view('index.contact');
    }

    public function storeMessage(Request $request)
    {
        $this->validate($request,array(
            'name'              =>   'required',
            'mobile'            =>   'required',
            'message'           =>   'required',
            'contactcaptcha'    =>   'required',
        ));

        // Retrieve the CAPTCHA text from the session
        $sessionCaptcha = Session::get('contactcaptcha');

        if (strtolower($request->input('contactcaptcha')) != strtolower($sessionCaptcha)) {
            // If the CAPTCHA is incorrect, redirect back with an error.
            return redirect()->back()->withErrors(['contactcaptcha' => 'ক্যাপচাটি ভুল হয়েছে !']);
        }

        $message = new Message;
        $message->name = $request->name;
        $message->mobile = $request->mobile;
        $message->message = $request->message;
        $message->save();
        
        return response()->json([
            'success' => true
        ]);
    }

    public function generateCaptcha()
    {
        // Define image dimensions
        $width = 100;
        $height = 30;

        // Create a new image
        $image = imagecreatetruecolor($width, $height);

        // Define colors
        $white = imagecolorallocate($image, 227, 242, 253);
        $black = imagecolorallocate($image, 0, 0, 0);

        // Fill the background with white
        imagefilledrectangle($image, 0, 0, $width, $height, $white);

        // Generate a random string for the CAPTCHA
        $captchaText = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6);

        // Store the captcha in the session
        Session::put('captcha', $captchaText);

        // Draw the text on the image
        imagestring($image, 5, 20, 7, $captchaText, $black);

        // Capture the image output as a string
        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();
        imagedestroy($image);

        // Return the image data with the correct content type header
        return Response::make($imageData, 200, ['Content-Type' => 'image/png']);
    }

    public function generateContactCaptcha()
    {
        // Define image dimensions
        $width = 100;
        $height = 30;

        // Create a new image
        $image = imagecreatetruecolor($width, $height);

        // Define colors
        $white = imagecolorallocate($image, 200, 200, 200);
        $black = imagecolorallocate($image, 0, 0, 0);

        // Fill the background with white
        imagefilledrectangle($image, 0, 0, $width, $height, $white);

        // Generate a random string for the CAPTCHA
        $captchaText = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6);

        // Store the contactcaptcha in the session
        Session::put('contactcaptcha', $captchaText);

        // Draw the text on the image
        imagestring($image, 5, 20, 7, $captchaText, $black);

        // Capture the image output as a string
        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();
        imagedestroy($image);

        // Return the image data with the correct content type header
        return Response::make($imageData, 200, ['Content-Type' => 'image/png']);
    }

    // clear configs, routes and serve
    public function clear()
    {
        Artisan::call('route:clear');
        // Artisan::call('optimize');
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('key:generate');
        Artisan::call('config:clear');
        Session::flush();
        return 'Config and Route Cached. All Cache Cleared';
    }
    
}
