<html>
<head>
    <title>ওয়ারিশান সনদ | PDF Download</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        /* This font family must be available on your PDF generation server (e.g., installed on mPDF) */
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
            margin: 40px 60px 50px 60px; /* Reduced top/bottom margin for better content display */
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
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
        <table class="header-table">
            <tr>
                <td style="width: 30%;">
                    {{-- Logo/Flag Left (Assuming you have an image path for the flag) --}}
                    <img src="{{ public_path('images/bangladesh-flag.png') }}" style="height: 70px; width: auto; display: block; margin: 0 auto;">
                </td>
                <td style="width: 40%; text-align: center;">
                    <span style="font-size: 14px;">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</span><br/>
                    <span style="font-size: 18px; font-weight: bold;">{{ $data['union_name'] ?? '০২ নং ইপ্রোত্তয়ন ইউনিয়ন' }}</span><br/>
                    <span style="font-size: 13px;">উপজেলা : {{ $data['upazila_name'] ?? 'নাগরপুর' }}, জেলা : {{ $data['district_name'] ?? 'টাঙ্গাইল' }}।</span><br/>
                    <span style="font-size: 13px;">চেয়ারম্যান : মো: {{ $data['chairman_name'] ?? 'নজরুল ইসলাম' }}</span><br/>
                    <span style="font-size: 13px;">ইমেইল : {{ $data['email'] ?? 'admin@eprottyon.com' }}</span><br/>
                    <span style="font-size: 13px;">ফোন নম্বর : {{ $data['phone'] ?? '০১৭00000000' }}</span>
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
                <td style="text-align: left; font-size: 14px;">সনদ নং- **{{ $data['cert_number'] ?? '০৪৫৮২৭' }}**</td>
                <td style="text-align: right; font-size: 14px;">ইস্যুর তারিখ : **{{ $data['issue_date'] ?? '০৪-০৭-২০২৪' }}**</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: right; font-size: 14px;">প্রদানের তারিখ: **{{ $data['grant_date'] ?? '১০-০৮-২০২৫' }}**</td>
            </tr>
        </table>

        {{-- Certificate Title --}}
        <div class="cert-title">
            ওয়ারিশান সনদ
        </div>

        {{-- Introduction Paragraph --}}
        @php
            // Example data for the applicant/sender
            $applicant = [
                'name' => 'রফিক মিয়া',
                'father' => 'করিম মিয়া',
                'mother' => 'রহিমা বেগম',
                'village' => 'শংকরপুর',
                'ward' => bangla(০৪), // Helper function assumed for Bengali numerals
                'paurashava' => 'কালিকাকা-০৩৮০',
                'union' => 'ইপ্রোত্তয়ন',
                'upazila' => 'নাগরপুর',
                'district' => 'টাঙ্গাইল',
            ];
            // You will pass the actual $data array from your controller.
            $a = $data['applicant'] ?? $applicant;
        @endphp
        <p class="info-paragraph">
            এই মর্মে ওয়ারিশান সনদপত্র প্রদান করা যাইতেছে যে, **{{ $a['name'] }}**, পিতা: **{{ $a['father'] }}**, মাতা: **{{ $a['mother'] }}**,
            গ্রাম: **{{ $a['village'] }}**, ওয়ার্ড: **{{ $a['ward'] }}**, ডাকঘর: **{{ $a['paurashava'] }}**, ইউনিয়ন: **{{ $a['union'] }}**, উপজেলা: **{{ $a['upazila'] }}**,
            জেলা: **{{ $a['district'] }}**। তিনি আমার ইউনিয়নের **{{ $a['ward'] }}** নং ওয়ার্ডের একজন স্থায়ী বাসিন্দা ছিলেন। তথ্য দাতার তথ্য
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
                @php
                    // Example data for the beneficiaries array
                    $beneficiaries = [
                        ['id' => 1, 'name' => 'কল্পনা', 'relation' => 'মেয়ে', 'voter_id' => '১০১২২৫২৫৩৩২৫', 'dob' => '২৫/১১/১৯৯৯', 'remarks' => ''],
                        ['id' => 2, 'name' => 'সুরজ', 'relation' => 'ছেলে', 'voter_id' => '১০১২৩৫২৪৪৭৯৩', 'dob' => '০৫/০৭/১৯৯২', 'remarks' => ''],
                    ];
                @endphp
                {{-- Loop over the actual beneficiaries data passed to the template --}}
                @foreach($data['beneficiaries'] ?? $beneficiaries as $beneficiary)
                    <tr>
                        <td>{{ bangla($beneficiary['id']) }}</td>
                        <td>{{ $beneficiary['name'] }}</td>
                        <td>{{ $beneficiary['relation'] }}</td>
                        <td>{{ $beneficiary['voter_id'] }}</td>
                        <td>{{ $beneficiary['dob'] }}</td>
                        <td>{{ $beneficiary['remarks'] }}</td>
                    </tr>
                @endforeach
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
