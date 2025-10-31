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
use App\Certificate;

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
use PDF;
use QrCode;

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

    public function createCertificate($certificate_type)
    {
        if(Auth::user()->role == 'manager') {
            if (Auth::user()->is_active === 0) {
                Session::flash('success', 'আপনার নিবন্ধন সফল হয়েছে। অনুমোদনের জন্য অপেক্ষা করুন। আপনার সাথে যোগাযোগ করা হবে। অথবা এই নম্বরে যোগাযোগ করুন: 01xxxxxxxxx');
                return redirect()->route('index.index');
            }
        }

        return view('dashboard.certificates.create')->with('certificate_type', $certificate_type);
    }

    public function storeCertificate(Request $request, $certificate_type)
    {
        
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'father' => ['required', 'string', 'max:255'],
            'mother' => ['required', 'string', 'max:255'],
            'id_type' => ['required', 'string', 'in:এনআইডি,জন্ম সনদ'],
            'id_value' => ['required', 'string', 'max:100'],
            'mobile' => ['required', 'string', 'max:255'],
            'village' => ['required', 'string', 'max:255'],
            'ward' => ['required', 'string', 'min:1', 'max:99'],
            'post_office' => ['required', 'string', 'max:255'],
            'union' => ['required', 'string', 'max:255'],
            'heirs_data' => ['required', 'array', 'min:1'],
            'heirs_data.*.name' => ['required', 'string', 'max:255'],
            'heirs_data.*.relation' => ['required', 'string', 'max:255'],
            'heirs_data.*.id_data' => ['nullable', 'string'],
            'heirs_data.*.dob' => ['nullable', 'string'],
            'heirs_data.*.remark' => ['nullable', 'string', 'max:255'],
        ]);

        $applicantData = $request->only([
            'name', 'father', 'mother', 'id_type', 'id_value', 'mobile',
            'village', 'ward', 'post_office', 'union'
        ]);

        // create new user
        $newuser = User::create([
            'local_office_id' => Auth::user()->local_office_id,
            'is_active ' => 0,
            'nid' => $request->id_value,
            'name' => $request->name,
            'role' => 'user', // this is important
            'designation' => 'নাগরিক',
            'mobile' => $request->mobile,
            'password' => Hash::make('123456'),
        ]);

        $dataPayload = [
            'applicant' => $applicantData,
            'heirs' => array_values($request->heirs_data),
            'submission_timestamp' => now()->toDateTimeString(),
        ];

        $uniqueSerial = now()->format('ymd') . Auth::user()->local_office_id . mt_rand(100000, 999999); 

        $certificate = Certificate::create([
            'local_office_id' => Auth::user()->local_office_id,
            'certificate_type' => $certificate_type,
            'recipient_user_id' => $newuser->id,
            'status' => 0, // 0 = draft, 1 = published
            'unique_serial' => $uniqueSerial,
            'issued_at' => now(),
            'data_payload' => $dataPayload,
        ]);

        return redirect()->route('dashboard.certificates.draft', $uniqueSerial)
                         ->with('success', 'সনদপত্রের সফলভাবে ড্রাফট করা হয়েছে। সিরিয়াল নং: ' . $certificate->unique_serial);
    }

    public function getDraftCertificate($unique_serial)
    {
        if(Auth::user()->role == 'manager') {
            if (Auth::user()->is_active === 0) {
                Session::flash('success', 'আপনার নিবন্ধন সফল হয়েছে। অনুমোদনের জন্য অপেক্ষা করুন। আপনার সাথে যোগাযোগ করা হবে। অথবা এই নম্বরে যোগাযোগ করুন: 01xxxxxxxxx');
                return redirect()->route('index.index');
            }
        }

        $certificate = Certificate::where('local_office_id', Auth::user()->local_office_id) // this is important
                                  ->where('unique_serial', $unique_serial)
                                  ->first();

        return view('dashboard.certificates.draft')->withCertificate($certificate);
    }

    public function editCertificate($unique_serial)
    {
        if(Auth::user()->role == 'manager') {
            if (Auth::user()->is_active === 0) {
                Session::flash('success', 'আপনার নিবন্ধন সফল হয়েছে। অনুমোদনের জন্য অপেক্ষা করুন। আপনার সাথে যোগাযোগ করা হবে। অথবা এই নম্বরে যোগাযোগ করুন: 01xxxxxxxxx');
                return redirect()->route('index.index');
            }
        }

        $certificate = Certificate::where('unique_serial', $unique_serial)->first();

        return view('dashboard.certificates.edit')->withCertificate($certificate);
    }

    public function updateCertificate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'father' => ['required', 'string', 'max:255'],
            'mother' => ['required', 'string', 'max:255'],
            'id_type' => ['required', 'string', 'in:এনআইডি,জন্ম সনদ'],
            'id_value' => ['required', 'string', 'max:100'],
            'mobile' => ['required', 'string', 'max:255'],
            'village' => ['required', 'string', 'max:255'],
            'ward' => ['required', 'string', 'min:1', 'max:99'],
            'post_office' => ['required', 'string', 'max:255'],
            'union' => ['required', 'string', 'max:255'],
            'heirs_data' => ['required', 'array', 'min:1'],
            'heirs_data.*.name' => ['required', 'string', 'max:255'],
            'heirs_data.*.relation' => ['required', 'string', 'max:255'],
            'heirs_data.*.id_data' => ['nullable', 'string'],
            'heirs_data.*.dob' => ['nullable', 'string'],
            'heirs_data.*.remark' => ['nullable', 'string', 'max:255'],
        ]);

        $certificate = Certificate::findOrFail($id);

        $applicantData = $request->only([
            'name', 'father', 'mother', 'id_type', 'id_value', 'mobile',
            'village', 'ward', 'post_office', 'union'
        ]);

        // Preserve the original submission timestamp from the existing payload
        $submissionTimestamp = $certificate->data_payload['submission_timestamp'] ?? now()->toDateTimeString();

        $updatedDataPayload = [
            'applicant' => $applicantData,
            'heirs' => array_values($request->heirs_data),
            'submission_timestamp' => $submissionTimestamp,
            'updated_timestamp' => now()->toDateTimeString(),
        ];

        $uniqueSerial = now()->format('ymd') . Auth::user()->local_office_id . mt_rand(100000, 999999); 

        $certificate->update([
            'data_payload' => $updatedDataPayload,
            'status' => 0, // Keep status as draft after an edit
        ]);

        return redirect()->route('dashboard.certificates.draft', $certificate->unique_serial)
                         ->with('success', 'সনদপত্র সফলভাবে আপডেট করা হয়েছে। সিরিয়াল নং: ' . $certificate->unique_serial);
    }

    public function approveCertificate(Request $request)
    {
        if(Auth::user()->role == 'manager') {
            if (Auth::user()->is_active === 0) {
                Session::flash('success', 'আপনার নিবন্ধন সফল হয়েছে। অনুমোদনের জন্য অপেক্ষা করুন। আপনার সাথে যোগাযোগ করা হবে। অথবা এই নম্বরে যোগাযোগ করুন: 01xxxxxxxxx');
                return redirect()->route('index.index');
            }
        }

        $certificate = Certificate::findOrFail($request->id);
        $certificate->status = 1;
        $certificate->save();

        Session::flash('success', 'সনদ অনুমোদন করা হয়েছে, প্রিন্ট করুন।');
        return redirect()->route('dashboard.certificates.list')->with('justapproved', $certificate->id);
    }

    public function printCertificate($unique_serial)
    {
        if(Auth::user()->role == 'manager') {
            if (Auth::user()->is_active === 0) {
                Session::flash('success', 'আপনার নিবন্ধন সফল হয়েছে। অনুমোদনের জন্য অপেক্ষা করুন। আপনার সাথে যোগাযোগ করা হবে। অথবা এই নম্বরে যোগাযোগ করুন: 01xxxxxxxxx');
                return redirect()->route('index.index');
            }
        }

        $certificate = Certificate::where('unique_serial', $unique_serial)->first();

        $pdf = PDF::loadView('dashboard.certificates.pdf.heir-certificate', ['certificate' => $certificate]);
        $fileName = 'Cert-' . $certificate->unique_serial . '.pdf';
        return $pdf->stream($fileName); // download/stream
    }

    public function downloadCertificate($unique_serial)
    {
        if(Auth::user()->role == 'manager') {
            if (Auth::user()->is_active === 0) {
                Session::flash('success', 'আপনার নিবন্ধন সফল হয়েছে। অনুমোদনের জন্য অপেক্ষা করুন। আপনার সাথে যোগাযোগ করা হবে। অথবা এই নম্বরে যোগাযোগ করুন: 01xxxxxxxxx');
                return redirect()->route('index.index');
            }
        }

        $certificate = Certificate::where('unique_serial', $unique_serial)->first();

        $pdf = PDF::loadView('dashboard.certificates.pdf.heir-certificate', ['certificate' => $certificate]);
        $fileName = 'Cert-' . $certificate->unique_serial . '.pdf';
        return $pdf->download($fileName); // download/stream
    }

    public function getCertificateList()
    {
        if(Auth::user()->role == 'manager') {
            if (Auth::user()->is_active === 0) {
                Session::flash('success', 'আপনার নিবন্ধন সফল হয়েছে। অনুমোদনের জন্য অপেক্ষা করুন। আপনার সাথে যোগাযোগ করা হবে। অথবা এই নম্বরে যোগাযোগ করুন: 01xxxxxxxxx');
                return redirect()->route('index.index');
            }
        }

        $certificates = Certificate::where('local_office_id', Auth::user()->local_office_id)->paginate(10);

        return view('dashboard.certificates.list')->withCertificates($certificates);
    }

    public function showCertificateQr()
    {
        // 1. Define the data you want to encode (e.g., the verification link)
        $dataToEncode = url("/verify/{$unique_serial}");

        // 2. Generate the QR code as an SVG string.
        // We set the size (200px) and a color (4, 137, 102 - a nice green).
        // The generate() method returns an SVG string, perfect for embedding directly in HTML.
        $qrCodeSvg = QrCode::size(200)
                            ->color(4, 137, 102) // Green color for the code lines
                            ->generate($dataToEncode);

        // 3. Pass the SVG string to the view
        return view('certificate-qr', [
            'qrCodeSvg' => $qrCodeSvg,
            'verificationLink' => $dataToEncode
        ]);
    }
}
