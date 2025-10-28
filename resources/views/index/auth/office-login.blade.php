@extends('layouts.index')
@section('title') ডিজিটাল নাগরিক - কর্তৃপক্ষ নিবন্ধন @endsection

@section('third_party_stylesheets')
  <style>
    /* Form Specific Styles */
    .form-card {
        border-left: 5px solid var(--light-primary-color);
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        height: 100%; /* Ensure card matches guideline height */
    }
    .guideline-card {
        background-color: #e3f2fd; /* Light blue background */
        border-radius: 12px;
        padding: 25px;
        border: 1px solid #cce5ff;
    }
    .form-heading {
        color: var(--darker-color);
        border-bottom: 2px solid var(--primary-color);
        padding-bottom: 10px;
        margin-bottom: 20px;
    }
    .required-asterisk {
        color: #dc3545; /* Red for emphasis */
        font-weight: bold;
    }

    /* Responsive Layout Adjustments */
    @media (max-width: 991.98px) {
        .guideline-card {
            margin-top: 30px;
        }
    }
  </style>
@endsection

@section('content')
  <!-- Services List Section (Dynamic Show/Hide Logic) -->
  <section id="services" class="service-section section-gap">
    <div class="container">
      <!-- Title for Registration Page -->
      <h1 class="text-center display-6 fw-bold mb-4" style="color: var(--darker-color);">
          <i class="fas fa-user-plus me-3 text-info"></i> কর্তৃপক্ষ নিবন্ধন
      </h1>
      <p class="text-center lead mb-5 text-muted">স্থানীয় সরকার কর্তৃপক্ষ (ইউনিয়ন/পৌরসভা/উপজেলা পরিষদ/জেলা পরিষদ) ও কর্মকর্তা একাউন্ট নিবন্ধন ফর্ম</p>

      <div class="row justify-content-center g-4">
          
          <!-- Left Column (Form: 8/12) -->
          <div class="col-lg-8">
              <div class="card p-4 p-md-5 form-card bg-white">
                <!-- EDITED: Added method="POST" and action="/admin/register" for custom route targeting -->
                <form id="authorityRegistrationForm" method="POST" action="{{ route('register.store.authority') }}">
                  @csrf
                  <!-- Section 1: সাধারণ তথ্য -->
                  <h2 class="h5 form-heading"><i class="fas fa-info-circle me-2"></i> সাধারণ তথ্য</h2>
                  <div class="row g-3 mb-4">

                      <!-- নাম (বাংলায়) -->
                      <div class="col-md-6">
                          <label for="name" class="form-label small fw-bold">নাম (বাংলায়) <span class="required-asterisk">*</span></label>
                          <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                 name="name" 
                                 id="name" 
                                 placeholder="যেমন: আব্দুল করিম" 
                                 required 
                                 value="{{ old('name') }}"> <!-- Added old() -->
                          @error('name')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                      
                      <!-- নাম (ইংরেজিতে) -->
                      <div class="col-md-6">
                          <label for="name_en" class="form-label small fw-bold">নাম (ইংরেজিতে) <span class="required-asterisk">*</span></label>
                          <input type="text" class="form-control @error('name_en') is-invalid @enderror" 
                                 id="name_en" 
                                 name="name_en" 
                                 placeholder="E.g., Abdul Karim" 
                                 required 
                                 value="{{ old('name_en') }}"> <!-- Added old() -->
                          @error('name_en')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                      
                      <!-- জাতীয় পরিচয়পত্র নম্বর -->
                      <div class="col-md-6">
                          <label for="nid" class="form-label small fw-bold">জাতীয় পরিচয়পত্র নম্বর <span class="required-asterisk">*</span></label>
                          <input type="number" class="form-control @error('nid') is-invalid @enderror" 
                                 id="nid" 
                                 name="nid" 
                                 placeholder="১১/১৭ সংখ্যার এনআইডি" 
                                 required 
                                 pattern="[0-9]{10,17}" 
                                 title="অনুগ্রহ করে সঠিক এনআইডি নম্বর দিন" 
                                 value="{{ old('nid') }}"> <!-- Added old() -->
                          @error('nid')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                      
                      <!-- মোবাইল নম্বর -->
                      <div class="col-md-6">
                          <label for="mobile" class="form-label small fw-bold">মোবাইল নম্বর <span class="required-asterisk">*</span></label>
                          <div class="input-group">
                              <span class="input-group-text">+88</span>
                              <input type="tel" class="form-control @error('mobile') is-invalid @enderror" 
                                     name="mobile" 
                                     placeholder="১১ ডিজিটের মোবাইল নম্বর (ইংরেজিতে)" 
                                     required 
                                     maxlength="11" 
                                     pattern="[0-9]{11}" 
                                     title="১১ ডিজিটের মোবাইল নম্বর দিন" 
                                     value="{{ old('mobile') }}"> <!-- Added old() -->
                          </div>
                          @error('mobile')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>

                      <!-- ইমেইল এড্রেস -->
                      <div class="col-md-6">
                          <label for="email" class="form-label small fw-bold">ইমেইল এড্রেস <span class="required-asterisk">*</span></label>
                          <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                 id="email" 
                                 name="email" 
                                 placeholder="example@gov.bd" 
                                 required 
                                 value="{{ old('email') }}"> <!-- Added old() -->
                          @error('email')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                      
                      <!-- পদবি -->
                      <div class="col-md-6">
                          <label for="designation" class="form-label small fw-bold">পদবি <span class="required-asterisk">*</span></label>
                          <select id="designation" name="designation" class="form-select @error('designation') is-invalid @enderror" required>
                              <option value="" selected disabled>পদবি নির্বাচন করুন</option>
                              <option value="চেয়ারম্যান" {{ old('designation') == 'চেয়ারম্যান' ? 'selected' : '' }}>ইউনিয়ন চেয়ারম্যান</option>
                              <option value="সচিব" {{ old('designation') == 'সচিব' ? 'selected' : '' }}>ইউনিয়ন সচিব</option>
                              <option value="সহকারী" {{ old('designation') == 'সহকারী' ? 'selected' : '' }}>ইউনিয়ন সহকারী</option>
                              <option value="মেয়র" {{ old('designation') == 'মেয়র' ? 'selected' : '' }}>মেয়র</option>
                              <option value="কাউন্সিলর" {{ old('designation') == 'কাউন্সিলর' ? 'selected' : '' }}>কাউন্সিলর</option>
                              <option value="পৌর সচিব" {{ old('designation') == 'পৌর সচিব' ? 'selected' : '' }}>পৌর সচিব</option>
                          </select>
                          @error('designation')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                  </div>

                  <!-- Section 2: অফিস তথ্য -->
                  <h2 class="h5 form-heading mt-4"><i class="fas fa-building me-2"></i> অফিস তথ্য</h2>
                  <div class="row g-3 mb-4">
                      
                      <!-- কর্তৃপক্ষের ধরণ -->
                      <div class="col-md-12">
                          <label for="authorityType" class="form-label small fw-bold">কর্তৃপক্ষের ধরণ <span class="required-asterisk">*</span></label>
                          <select id="authorityType" name="office_type" class="form-select @error('office_type') is-invalid @enderror" required> <!-- Added name="office_type" -->
                              <option value="" selected disabled>কর্তৃপক্ষের ধরণ নির্বাচন করুন</option>
                              <option value="up" {{ old('office_type') == 'up' ? 'selected' : '' }}>ইউনিয়ন পরিষদ</option>
                              <option value="poura" {{ old('office_type') == 'poura' ? 'selected' : '' }}>পৌরসভা</option>
                              {{-- <option value="upazila">উপজেলা পরিষদ</option>
                              <option value="district">জেলা পরিষদ</option> --}}
                          </select>
                          @error('office_type')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>

                      <!-- DYNAMIC AUTHORITY FIELDS -->
                      <input type="hidden" name="authority_level" id="add_authority_level" value="{{ old('authority_level') }}">
                      <input type="hidden" name="authority_id" id="add_authority_id" value="{{ old('authority_id') }}">
                      
                      <!-- বিভাগ -->
                      <div class="col-md-6">
                          <label for="add_division_id" class="form-label small fw-bold">বিভাগ <span class="required-asterisk">*</span></label>
                          <select id="add_division_id" name="add_division_id" class="form-select authority-select @error('add_division_id') is-invalid @enderror" data-level="Division" data-target="add_district_id" data-model="District" required>
                              <option value="" selected disabled>বিভাগ নির্বাচন করুন</option>
                              @foreach ($divisions as $division)
                                  <option value="{{ $division->id }}" data-level-name="Division" {{ old('add_division_id') == $division->id ? 'selected' : '' }}>{{ $division->bn_name }}</option> <!-- Added old() check -->
                              @endforeach
                          </select>
                          @error('add_division_id')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>

                      <!-- জেলা -->
                      <div class="col-md-6">
                          <label for="add_district_id" class="form-label small fw-bold">জেলা <span class="required-asterisk">*</span></label>
                          <select id="add_district_id" name="add_district_id" class="form-select authority-select @error('add_district_id') is-invalid @enderror" data-level="District" data-target="add_upazila_id" data-model="Upazila" {{ old('add_district_id') ? '' : 'disabled' }}>
                              <option value="{{ old('add_district_id') }}" selected>{{ old('add_district_id') ? 'পূর্ববর্তী জেলা নির্বাচিত' : 'জেলা নির্বাচন করুন' }}</option>
                              <!-- Existing options will be shown by JS, or the old value will be retained if available -->
                          </select>
                          @error('add_district_id')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                      
                      <!-- থানা / উপজেলা -->
                      <div class="col-md-6">
                          <label for="add_upazila_id" class="form-label small fw-bold">থানা / উপজেলা <span class="required-asterisk">*</span></label>
                          <select id="add_upazila_id" name="add_upazila_id" class="form-select authority-select @error('add_upazila_id') is-invalid @enderror" data-level="Upazila" data-target="add_union_id" data-model="Union" {{ old('add_upazila_id') ? '' : 'disabled' }}>
                              <option value="{{ old('add_upazila_id') }}" selected>{{ old('add_upazila_id') ? 'পূর্ববর্তী উপজেলা নির্বাচিত' : 'উপজেলা/পৌরসভা নির্বাচন করুন' }}</option>
                              <!-- Existing options will be shown by JS, or the old value will be retained if available -->
                          </select>
                          @error('add_upazila_id')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>

                      <!-- NEW FIELD: ইউনিয়ন -->
                      <div class="col-md-6">
                          <label for="add_union_id" class="form-label small fw-bold">ইউনিয়ন <span class="required-asterisk">*</span></label>
                          <select id="add_union_id" name="add_union_id" class="form-select authority-select @error('add_union_id') is-invalid @enderror" data-level="Union" data-target="" data-model="" {{ old('add_union_id') ? '' : 'disabled' }}>
                              <option value="{{ old('add_union_id') }}" selected>{{ old('add_union_id') ? 'পূর্ববর্তী ইউনিয়ন নির্বাচিত' : 'ইউনিয়ন নির্বাচন করুন' }}</option>
                              <!-- Existing options will be shown by JS, or the old value will be retained if available -->
                          </select>
                          @error('add_union_id')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                      
                      <!-- কর্তৃপক্ষ অফিসের নাম (Specific Office) -->
                      <div class="col-md-12">
                          <label for="office_name" class="form-label small fw-bold">কর্তৃপক্ষ অফিসের নাম (কার্যালয়) <span class="required-asterisk">*</span></label>
                          <input type="text" class="form-control @error('office_name') is-invalid @enderror" 
                                 id="office_name" 
                                 name="office_name" 
                                 autocomplete="new-text" 
                                 placeholder="২নং নেকমরদ ইউনিয়ন পরিষদ/ ভৈরব পৌরসভা ইত্যাদি" 
                                 required 
                                 value="{{ old('office_name') }}"> <!-- Added name and old() -->
                          @error('office_name')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                  </div>

                  <!-- Section 3: নিরাপত্তা তথ্য -->
                  <h2 class="h5 form-heading mt-4"><i class="fas fa-lock me-2"></i> পাসওয়ার্ড তৈরি</h2>
                  <div class="row g-3 mb-4">
                      <!-- পাসওয়ার্ড -->
                      <div class="col-md-6">
                          <label for="password" class="form-label small fw-bold">পাসওয়ার্ড <span class="required-asterisk">*</span></label>
                          <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                 id="password" 
                                 autocomplete="new-password" 
                                 name="password" 
                                 required 
                                 minlength="8" 
                                 placeholder="ন্যূনতম ৮ অক্ষরের পাসওয়ার্ড">
                          @error('password')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                      
                      <!-- কনফার্ম পাসওয়ার্ড -->
                      <div class="col-md-6">
                          <label for="confirmPassword" class="form-label small fw-bold">কনফার্ম পাসওয়ার্ড <span class="required-asterisk">*</span></label>
                          <input type="password" 
                                 id="password-confirm" 
                                 class="form-control" 
                                 name="password_confirmation" 
                                 placeholder="পাসওয়ার্ড পুনরায় লিখুন" 
                                 autocomplete="new-password" 
                                 required>
                      </div>

                      <div class="col-md-6">
                          <div class="row">
                              <div class="col-md-6">
                                  <label for="captcha" class="form-label small fw-bold">ক্যাপচা</label>
                                  <img src="{{ route('captcha.image') }}" alt="Captcha Text" style="height: auto; width: 150px;">
                              </div>
                              <div class="col-md-6">
                                  <label class="form-label small fw-bold">ক্যাপচা টেক্সট লিখুন <span class="required-asterisk">*</span></label>
                                  <input type="text" 
                                         class="form-control @error('captcha') is-invalid @enderror" 
                                         name="captcha" 
                                         placeholder="ক্যাপচা এখানে লিখুন" 
                                         required="">
                                  @error('captcha')
                                      <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                              </div>
                          </div>
                      </div>
                  </div>

                  <!-- Section 4: সম্মতি -->
                  <div class="form-check mb-4">
                      <input class="form-check-input" type="checkbox" value="1" name="policy_check" id="policyCheck" required {{ old('policy_check') ? 'checked' : '' }}> <!-- Added name and old() check for checkbox -->
                      <label class="form-check-label small" for="policyCheck">
                          আমি <a href="{{ route('index.terms-and-conditions') }}" class="text-primary fw-bold">প্রশাসনিক নীতিমালার</a> সাথে একমত পোষণ করছি <span class="required-asterisk">*</span>
                      </label>
                  </div>

                  <!-- Submit Button -->
                  <button type="submit" class="btn btn-success btn-lg w-100 rounded-pill fw-bold"><i class="fas fa-user-plus me-2"></i> নিবন্ধন করুন</button>
                </form>
              </div>
          </div>
          
          <!-- Right Column (Instructions: 4/12) -->
          <div class="col-lg-4">
              <div class="guideline-card h-100">
                  <h4 class="h5 fw-bold text-darker mb-3"><i class="fas fa-bullhorn me-2 text-primary"></i> নির্দেশিকা ও সতর্কতা</h4>
                  
                  <div class="mb-4">
                      <h6 class="fw-bold text-darker mb-2">আবশ্যিক তথ্যাদি:</h6>
                      <ul class="list-unstyled small">
                          <li class="mb-1"><i class="fas fa-check-circle me-2 text-success"></i> <span class="required-asterisk">(*)</span> চিহ্নিত ক্ষেত্রগুলি পূরণ করা বাধ্যতামূলক।</li>
                          <li class="mb-1"><i class="fas fa-check-circle me-2 text-success"></i> আপনার সঠিক ও সম্পূর্ণ ১১ ডিজিটের মোবাইল নম্বর পূরণ করুন।</li>
                          <li class="mb-1"><i class="fas fa-check-circle me-2 text-success"></i> অনুগ্রহ করে সঠিক নাম্বার প্রদান করুন, কারণ এটি অ্যাকাউন্টের জন্য ব্যবহার হবে।</li>
                      </ul>
                  </div>

                  <div class="mb-4">
                      <h6 class="fw-bold text-darker mb-2">যাচাইকরণ প্রক্রিয়া:</h6>
                      <p class="small mb-2">
                          তথ্য জমা দেওয়ার পর একটি **যাচাইকরণ কোড** প্রদানকৃত মোবাইল নম্বর অথবা ইমেইল এড্রেসে পাঠানো হবে। এই কোডটি দিয়ে আপনার অ্যাকাউন্টের সত্যতা যাচাই করা হবে।
                      </p>
                      <p class="small fw-bold text-danger">অনুগ্রহ করে সঠিক তথ্য প্রদান করুন।</p>
                  </div>
                  
                  <hr class="border-primary opacity-50">
                  
                  <!-- জরুরী প্রয়োজনে -->
                  <div class="mt-4">
                      <h6 class="fw-bold text-darker mb-2"><i class="fas fa-headset me-2 text-danger"></i> জরুরী প্রয়োজনে</h6>
                      <p class="small mb-2">
                          যদি আপনি কোনো সমস্যার সম্মুখীন হোন অথবা আপনার কোনো জিজ্ঞাসা থাকলে আমাদের সাপোর্ট টিমের সাথে যোগাযোগ করতে পারেন।
                      </p>
                      <a href="{{ route('index.contact') }}" class="btn btn-sm btn-outline-danger w-100 rounded-pill mt-2">
                          <i class="fas fa-phone-alt me-2"></i> যোগাযোগ করতে এখানে ক্লিক করুন
                      </a>
                  </div>
              </div>
          </div>

      </div>
    </div>
  </section>
@endsection

@section('third_party_scripts')
    
@endsection
    

    


























<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BCS Exam | Login</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="{{ url('/home') }}"><b>বিসিএস এক্সাম</b></a>
    </div>
    <!-- /.login-logo -->

    <!-- /.login-box-body -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">লগইন করুন</p>

            <form method="post" action="{{ url('/login') }}">
                @csrf

                <div class="input-group mb-3">
                    <input type="number"
                           name="mobile"
                           value="{{ old('mobile') }}"
                           placeholder="মোবাইল নম্বর (১১ ডিজিট)"
                           class="form-control @error('mobile') is-invalid @enderror">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-phone"></span></div>
                    </div>
                    @error('mobile')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="password"
                           name="password"
                           placeholder="পাসওয়ার্ড"
                           class="form-control @error('password') is-invalid @enderror">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror

                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">মনে রাখুন</label>
                        </div>
                    </div>

                    <div class="col-6">
                        <button type="submit" class="btn btn-primary btn-block">লগইন করুন</button>
                    </div>

                </div>
            </form>

            {{-- <p class="mb-1">
                <a href="{{ route('password.request') }}">I forgot my password</a>
            </p>
            <p class="mb-0">
                <a href="{{ route('register') }}" class="text-center">Register a new membership</a>
            </p> --}}
        </div>
        <!-- /.login-card-body -->
    </div>

</div>
<!-- /.login-box -->

<script src="{{ mix('js/app.js') }}" defer></script>

</body>
</html>
