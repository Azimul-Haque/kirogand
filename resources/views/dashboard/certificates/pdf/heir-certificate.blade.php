<html>
<head>
    <title>সনদ | PDF Download</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        /* The 'kalpurush' font must be available on your PDF generation server (e.g., installed on mPDF) */
        body {
            font-family: 'kalpurush', sans-serif;
            color: #333;
        }

        @page {
            /* Background image and margins from your original code */
            background-image: url({{ public_path('images/logo-background.png') }});
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            /* Reduced top/bottom margin for better content display */
            margin: 40px 60px 50px 60px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .header-table td {
            vertical-align: top;
            padding: 5px 0;
            font-size: 14px;
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
            padding: 10px 30px;
            margin: 20px auto;
            width: 40%;
            border-radius: 20px;
            font-size: 18px;
            font-weight: bold;
        }

        .info-paragraph {
            line-height: 1.8;
            text-align: justify;
            margin-top: 20px;
            font-size: 15px;
        }

        .beneficiary-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
            font-size: 14px;
        }
        .beneficiary-table th, .beneficiary-table td {
            border: 1px solid #999;
            padding: 8px 10px;
            text-align: center;
        }
        .beneficiary-table th {
            background-color: #4472C4; /* Blue header background */
            color: white;
            font-weight: normal;
        }

        .signature-block {
            margin-top: 50px;
            width: 100%;
        }
        .signature-block td {
            width: 33.33%;
            text-align: center;
            font-size: 14px;
            padding-top: 15px;
        }
        .signature-line {
            border-top: 1px dashed #666;
            width: 80%;
            margin: 0 auto;
            margin-top: 5px;
        }
        .qr-code-section {
            width: 100%;
            margin-top: 40px;
        }

    </style>
</head>
<body>

    {{-- HEADER CONTENT - Modified to fit the certificate image --}}
    <htmlpageheader name="page-header">
        @php
            // Extract the applicant data for easier access (assuming it's nested)
            $applicant = $certificate['applicant'] ?? [
                'name' => 'রফিক মিয়া', 'father' => 'করিম মিয়া', 'mother' => 'রহিমা বেগম',
                'village' => 'শংকরপুর', 'ward' => bangla(7), 'paurashava' => 'কালিকাকা-০৩৮০',
                'union' => 'ইপ্রোত্তয়ন', 'upazila' => 'নাগরপুর', 'district' => 'টাঙ্গাইল',
            ];
            // Placeholder data for Union information (if not in $certificate)
            $union_info = $certificate['union_info'] ?? [
                'union_name' => '০২ নং ইপ্রোত্তয়ন ইউনিয়ন', 'upazila' => 'নাগরপুর', 'district' => 'টাঙ্গাইল',
                'chairman_name' => 'নজরুল ইসলাম', 'email' => 'admin@eprottyon.com', 'phone' => '০১৭০০০০০০০০',
            ];
        @endphp

        <table >
            <tr>
                <td style="width: 30%;">
                    {{-- Logo/Flag Left --}}
                    <img src="{{ public_path('images/bangladesh-flag.png') }}" style="height: 70px; width: auto; display: block; margin: 0 auto;">
                </td>
                <td style="width: 40%; text-align: center;">
                    <span style="font-size: 14px;">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</span><br/>
                    <span style="font-size: 18px; font-weight: bold;">{{ $union_info['union_name'] }}</span><br/>
                    <span style="font-size: 13px;">উপজেলা : {{ $union_info['upazila'] }}, জেলা : {{ $union_info['district'] }}।</span><br/>
                    <span style="font-size: 13px;">চেয়ারম্যান : মো: {{ $union_info['chairman_name'] }}</span><br/>
                    <span style="font-size: 13px;">ইমেইল : {{ $union_info['email'] }}</span><br/>
                    <span style="font-size: 13px;">ফোন নম্বর : {{ $union_info['phone'] }}</span>
                </td>
                <td style="width: 30%; text-align: right;">
                    {{-- e-Prottayon Logo Right --}}
                    <div class="logo-box" style="float: right;">
                         <img src="{{ public_path('images/eprottyon-logo.png') }}" style="height: 100%; width: 100%; object-fit: contain;">
                    </div>
                </td>
            </tr>
        </table>
        <div style="border-top: 2px solid green; margin-top: 5px;"></div>
    </htmlpageheader>

    {{-- CERTIFICATE BODY --}}
    <div>
        {{-- Certificate Metadata --}}
        <table style="width: 100%; margin-top: 5px;">
            <tr>
                <td style="text-align: left; font-size: 14px;">সনদ নং- **{{ $certificate['cert_id'] ?? '০৪৫৮২৭' }}**</td>
                <td style="text-align: right; font-size: 14px;">ইস্যুর তারিখ : **{{ $certificate['issue_date'] ?? '০৪-০৭-২০২৪' }}**</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: right; font-size: 14px;">প্রদানের তারিখ: **{{ $certificate['grant_date'] ?? '১০-০৮-২০২৫' }}**</td>
            </tr>
        </table>

        {{-- Certificate Title --}}
        <div class="cert-title">
            ওয়ারিশান সনদ
        </div>

        {{-- Introduction Paragraph --}}
        <p class="info-paragraph">
            এই মর্মে ওয়ারিশান সনদপত্র প্রদান করা যাইতেছে যে, **{{ $applicant['name'] }}**, পিতা: **{{ $applicant['father'] }}**, মাতা: **{{ $applicant['mother'] }}**,
            গ্রাম: **{{ $applicant['village'] }}**, ওয়ার্ড: **{{ $applicant['ward'] }}**, ডাকঘর: **{{ $applicant['paurashava'] }}**, ইউনিয়ন: **{{ $applicant['union'] }}**, উপজেলা: **{{ $applicant['upazila'] }}**,
            জেলা: **{{ $applicant['district'] }}**। তিনি আমার ইউনিয়নের **{{ $applicant['ward'] }}** নং ওয়ার্ডের একজন স্থায়ী বাসিন্দা ছিলেন। তথ্য দাতার তথ্য
            মতে তিনি নিম্ন লিখিত ওয়ারিশান হিসাবে রেখে মৃত্যু বরণ করেন:
        </p>

        {{-- Beneficiary Table --}}
        <div style="text-align: center; margin-bottom: 5px; font-weight: bold; font-size: 14px; margin-top: 30px;">
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
                {{-- Loop over the actual beneficiaries data passed to the template --}}
                @foreach($certificate['beneficiaries'] ?? [] as $beneficiary)
                    <tr>
                        <td>{{ bangla($beneficiary['id']) }}</td>
                        <td>{{ $beneficiary['name'] }}</td>
                        <td>{{ $beneficiary['relation'] }}</td>
                        <td>{{ $beneficiary['voter_id'] }}</td>
                        <td>{{ $beneficiary['dob'] }}</td>
                        <td>{{ $beneficiary['remarks'] }}</td>
                    </tr>
                @endforeach

                @if(empty($certificate['beneficiaries']))
                {{-- Placeholder rows if no actual data is present --}}
                    <tr>
                        <td>{{ bangla(1) }}</td>
                        <td>কল্পনা</td>
                        <td>মেয়ে</td>
                        <td>১০১২২৫২৫৩৩২৫</td>
                        <td>২৫/১১/১৯৯৯</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>{{ bangla(2) }}</td>
                        <td>সুরজ</td>
                        <td>ছেলে</td>
                        <td>১০১২৩৫২৪৪৭৯৩</td>
                        <td>০৫/০৭/১৯৯২</td>
                        <td></td>
                    </tr>
                @endif
            </tbody>
        </table>

        {{-- Closing Remark --}}
        <p class="info-paragraph" style="margin-top: 30px;">
            আমি তার বিদেহি আত্মার মাগফিরাত/শান্তি ও জীবনদের সার্বিক উন্নতি ও মঙ্গল কামনা করছি।
        </p>

        {{-- Signature and Seal Block --}}
        <table class="signature-block">
            <tr>
                <td>
                    <div style="padding-top: 15px;">কায়ালয়াল সীল</div>
                </td>
                <td>
                    <div style="padding-top: 15px;">যাচাইকারী স্বাক্ষর</div>
                    <div class="signature-line"></div>
                </td>
                <td>
                    <div style="padding-top: 15px;">প্রস্তুতকারীর সীল ও স্বাক্ষর</div>
                    <div class="signature-line"></div>
                </td>
                <td>
                    <div style="padding-top: 15px;">অনুমোদনকারীর সীল ও স্বাক্ষর</div>
                    <div class="signature-line"></div>
                </td>
            </tr>
        </table>

        {{-- QR Code and Verification Text --}}
        <div class="qr-code-section">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 20%;">
                        {{-- Placeholder for QR Code image --}}
                        <img src="{{ public_path('images/qrcode-placeholder.png') }}" style="width: 100px; height: 100px;">
                    </td>
                    <td style="width: 80%; padding-left: 20px;">
                        <span style="font-weight: bold; font-size: 14px;">
                            সনদটি যাচাই করতে আপনার মোবাইলে থাকা QR CODE অ্যাপ দিয়ে স্ক্যান করুন<br/>
                            অথবা ভিজিট করুন eprottyon.com
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
        <small>ডাউনলোডের সময়কালঃ <span style="font-family: Calibri;">{{ date('F d, Y, h:i A') }}</span></small><br/>
        <small style="font-family: Calibri; color: #4472C4;">Generated by: https://bcsexamaid.com | Download Android App: BCS Exam Aid – </small>
        <small style="color: #4472C4;">বিসিএস এক্সাম</small>
    </htmlpagefooter>

</body>
</html>
