<html>
<head>
    <title>ওয়ারিশান সনদপত্র | PDF Download</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        body {
            font-family: 'kalpurush', sans-serif;
            color: #333;
        }
        @php
            $back_image = public_path('images/localoffices/'. $certificate->localOffice->monogram);
            if(File::exists($image_path)) {
                $image_url = $image_path;
            } else {
                $image_url = public_path('images/icon.png');
            }
        @endphp

        @page {
            header: page-header;
            footer: page-footer;
            background-image: url({{ public_path('images/logo-background.png') }});
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            /* Reduced top/bottom margin for better content display */
            margin: 180px 80px 40px 70px;
        }
        .page-header,
          .page-header-space {
            height: 250px;
          }

        /* --- Custom Styles for Certificate Layout --- */

        .draft-watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            color: rgba(255, 0, 0, 0.2);
            font-size: 100px;
            font-weight: bold;
            z-index: 1000;
            width: 100%;
            text-align: center;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
            padding-top: 20px;
            margin-bottom: 5px;
        }
        .header-table td {
            vertical-align: top;
            padding: 5px 0px;
            font-size: 13px;
        }

        .logo-box {
            width: 120px;
            height: 120px;
            border: 1px solid #1a8b1a; /* Green border around e-Prottayon logo */
            border-radius: 50%;
            padding: 5px;
            display: inline-block;
        }

        .cert-title {
            text-align: center;
            background-color: #e5ffe5; /* Light green background */
            border: 1px solid #c2e6c2;
            padding: 10px 10px;
            margin: 10px auto;
            width: 40%;
            border-radius: 20px;
            font-size: 18px;
            font-weight: bold;
        }

        .info-paragraph {
            line-height: 1.6;
            text-align: justify;
            margin-top: 20px;
            font-size: 15px;
        }

        .beneficiary-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0px;
            font-size: 13px;
        }
        .beneficiary-table th, .beneficiary-table td {
            border: 1px solid #999;
            padding: 8px 10px;
            text-align: center;
        }
        .beneficiary-table th {
            background-color: #E5E7EB;
            font-weight: normal;
        }

        .signature-block {
            margin-top: 10px;
            width: 100%;
        }
        .signature-block td {
            width: 25%; /* Four columns for signatures */
            text-align: center;
            font-size: 13px;
            padding-top: 15px;
        }
        .signature-line {
            border-top: 3px dashed #666;
            width: 80%;
            margin: 0 auto;
            margin-top: 5px;
        }
        .qr-code-section {
            width: 100%;
            margin-top: 30px;
        }

    </style>
</head>
<body>

    {{-- Data Extraction (Replicating the PHP block from your input) --}}
    @php
        // Accessing the payload from the certificate object
        $payload = $certificate->data_payload ?? [];
        $applicant = $payload['applicant'] ?? [];
        $heirs = $payload['heirs'] ?? [];

        //get levels data
        $lglevels = [];
        $auth = Auth::user()->authorities->first();
        if(count(getgovlevels($auth)) > 0) {
            $lglevels = getgovlevels($auth);
        }
        //get levels data
        $union_info = [
            'union_name' => $certificate->localOffice->name_bn ?? 'তথ্য নেই',
            'upazila' => $lglevels['Upazila'] ?? 'তথ্য নেই',
            'district' => $lglevels['District'] ?? 'তথ্য নেই',
            // 'chairman_name' => $certificate->localOffice->name_bn,
            'email' => $certificate->localOffice->email ?? '',
            'phone' => $certificate->localOffice->mobile ?? '',
        ];

        // Conditional Draft Watermark
        $is_draft = ($certificate->status ?? 0) == 0;
    @endphp

    @if ($is_draft)
        <div class="draft-watermark">খসড়া খসড়া খসড়া</div>
    @endif

    {{-- HEADER CONTENT - Modified to fit the certificate image --}}
    <htmlpageheader name="page-header">
        <table class="header-table">
            <tr><td style="width: 30%;"></td></tr>
            <tr><td style="width: 30%;"></td></tr>
            <tr><td style="width: 30%;"></td></tr>
            <tr>
                <td style="width: 30%;">
                    <img src="{{ public_path('images/govt-logo.png') }}" style="height: 100px; width: auto; display: block; margin: 0 auto;">
                </td>
                <td style="width: 40%; text-align: center;">
                    <span style="font-size: 16px;">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</span><br/>
                    <span style="font-size: 18px; font-weight: bold; color: #15803D;">{{ $union_info['union_name'] }}</span><br/>
                    <span style="font-size: 14px;">উপজেলা: {{ $union_info['upazila'] }}, জেলা: {{ $union_info['district'] }}।</span><br/>
                    {{-- <span style="font-size: 14px;">চেয়ারম্যান: মো: {{ $union_info['chairman_name'] }}</span><br/> --}}
                    <span style="font-size: 14px;">ইমেইল: <span style="font-family: Calibri;">{{ $union_info['email'] }}</span></span><br/>
                    <span style="font-size: 14px;">ফোন নম্বর: {{ $union_info['phone'] }}</span>
                </td>
                <td style="width: 30%; text-align: right;">
                    @php
                        $image_path = public_path('images/localoffices/'. $certificate->localOffice->monogram);
                        if(File::exists($image_path)) {
                            $image_url = $image_path;
                        } else {
                            $image_url = public_path('images/icon.png');
                        }
                    @endphp
                    <img src="{{ $image_url }}" style="height: 100px; width: auto; object-fit: contain;">
                </td>
            </tr>
        </table>
    </htmlpageheader>
    
    <div style="border-top: 2px solid green; margin-top: 5px;"></div>

    {{-- CERTIFICATE BODY --}}
    <div>
        {{-- Certificate Metadata --}}
        <table style="width: 100%; margin-top: 5px;">
            <tr>
                <td style="text-align: left; font-size: 14px;">@if($certificate->memo) স্মারক নং - {{ $certificate->memo }} @else সনদ নং - {{ $certificate->unique_serial }} @endif</td>
                <td style="text-align: right; font-size: 14px;">তারিখ : {{ $certificate->issued_at != null ?  bangla(date('d-m-Y', strtotime($certificate->issued_at))) : bangla(date('d-m-Y')) }}</td>
            </tr>
            {{-- <tr>
                <td colspan="2" style="text-align: right; font-size: 14px;">প্রদানের তারিখ: {{ bangla(date('d-m-Y')) }}</td>
            </tr> --}}
        </table>

        {{-- Certificate Title --}}
        <div class="cert-title">
            ওয়ারিশান সনদ
        </div>

        {{-- Introduction Paragraph (Using Applicant Data) --}}
        <p class="info-paragraph">
            এই মর্মে ওয়ারিশান সনদপত্র প্রদান করা যাচ্ছে যে, {{ $applicant['name'] ?? '--' }}, পিতা: {{ $applicant['father'] ?? '--' }}, মাতা: {{ $applicant['mother'] ?? '--' }},
            গ্রাম: {{ $applicant['village'] ?? '--' }}, ওয়ার্ড: {{ $applicant['ward'] ?? '--' }}, ডাকঘর: {{ $applicant['post_office'] ?? '--' }}, ইউনিয়ন: {{ $applicant['union'] ?? '--' }}, উপজেলা: {{ $union_info['upazila'] ?? '--' }},
            জেলা: {{ $union_info['district'] ?? '--' }}। তিনি আমার ইউনিয়নের {{ $applicant['ward'] ?? '--' }} নং ওয়ার্ডের একজন স্থায়ী বাসিন্দা ছিলেন। তথ্য দাতার তথ্য
            মতে তিনি নিম্ন লিখিত ওয়ারিশান হিসাবে রেখে মৃত্যু বরণ করেন।
        </p>

        {{-- Beneficiary Table (Using Heirs Data) --}}
        <div style="text-align: center; margin-bottom: 5px; font-weight: bold; font-size: 18px; margin-top: 10px; font-weight: bold;">
            ওয়ারিশগণের নাম
        </div>
        <table class="beneficiary-table">
            <thead>
                <tr>
                    <th style="width: 8%;">ক্রমিক নং</th>
                    <th style="width: 25%;">নাম</th>
                    <th style="width: 15%;">সম্পর্ক</th>
                    <th style="width: 25%;">ভোটার আইডি/জন্ম সনদ</th>
                    <th style="width: 15%;">জন্ম তারিখ</th>
                    <th style="width: 12%;">মন্তব্য</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($heirs as $index => $heir)
                    <tr>
                        <td>{{ bangla($index + 1) }}</td>
                        <td>{{ $heir['name'] ?? '--' }}</td>
                        <td>{{ $heir['relation'] ?? '--' }}</td>
                        <td>{{ $heir['id_data'] ?? '--' }}</td> {{-- Mapping ID No. to the 'ভোটার আইডি' column --}}
                        <td>{{ $heir['dob'] ?? '--' }}</td>
                        <td>{{ $heir['remark'] ?? '--' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="color: red;">কোন ওয়ারিশের তথ্য পাওয়া যায়নি।</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Closing Remark --}}
        <p class="info-paragraph" style="margin-top: 15px;">
            আমি তার বিদেহি আত্মার মাগফিরাত/শান্তি ও জীবনদের সার্বিক উন্নতি ও মঙ্গল কামনা করছি।
        </p>

        {{-- Signature and Seal Block --}}
        <table class="signature-block">
            <tr>
                <td>
                    <img src="{{ public_path('images/seal-placeholder.png') }}" style="height: 70px; width: auto; display: block; margin: 0 auto;">
                </td>
                @if($certificate->localOffice->signatory == 2)
                    <td>
                        <div style="padding-top: 10px;">প্রস্তুতকারীর সিল ও স্বাক্ষর</div>
                        <div class="signature-line"></div>
                        <div style="border-top: 2px solid green; margin-top: 5px;"></div>
                    </td>
                    <td>
                        <div style="padding-top: 10px;">অনুমোদনকারীর সিল ও স্বাক্ষর</div>
                        <div class="signature-line"></div>
                    </td>
                @else
                    <td>
                        <div style="padding-top: 10px;"></div>
                    </td>
                    <td>
                        <div style="padding-top: 10px;">অনুমোদনকারীর সিল ও স্বাক্ষর</div>
                        <div class="signature-line"></div>
                    </td>
                @endif
            </tr>
        </table>

        {{-- QR Code and Verification Text --}}
        <div class="qr-code-section">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 15%;">
                        {{-- Placeholder for QR Code image --}}
                        {{-- <img src="{{ public_path('images/govt-logo.png') }}" style="height: 80px; width: auto; display: block; margin: 0 auto;"> --}}
                        <img src="data:image/svg;base64, {!! base64_encode($qrCodeSvg) !!}" style="height: 80px; width: auto; display: block; margin: 0 auto;">
                    </td>
                    <td style="width: 85%; padding-left: 20px;">
                        <span style=" font-size: 13px;">
                            সনদটি যাচাই করতে <span style="font-family: Calibri;">QR CODE</span> টি স্ক্যান করুন<br/>
                            অথবা <span style="font-family: Calibri;">www.dnagorik.com</span> ভিজিট করুন এই আইডিটি যাচাই করুন: <span style="font-family: Calibri;">{{ $certificate->unique_serial ?? '--' }}</span>
                        </span>
                        <p style="font-size: 10px; margin-top: 10px; line-height: 1.5;">
                            বি:দ্র: তথ্য গোপন বা ভুল দিলে আবেদনকারী দায়ী থাকবেন, কর্তৃপক্ষ দায়ী নয়, সনদ বাতিলযোগ্য।
                        </p>
                    </td>
                </tr>
            </table>
        </div>

    </div>

    {{-- FOOTER CONTENT - Re-used from your original code --}}
    <htmlpagefooter name="page-footer">
        <small style="font-size: 10px;">ডাউনলোডের সময়কাল: <span style="font-family: Calibri;">{{ date('F d, Y, h:i A') }}</span></small><br/>
        <small style="font-size: 10px; color: #4472C4;"><span style="font-family: Calibri;">Generated by: {{ url('/') }}</span> | ডিজিটাল নাগরিক </small>
    </htmlpagefooter>

</body>
</html>
