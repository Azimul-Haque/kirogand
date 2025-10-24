@extends('layouts.app')
@section('title') ড্যাশবোর্ড | সনদের আবেদন @endsection

@section('third_party_stylesheets')
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css"> --}}

    <style>
    

    </style>
@endsection

@section('content')
  @section('page-header') সনদের আবেদন @endsection
    <div class="container-fluid">
      <!-- Service Search Filter -->
      <div class="row mb-5 justify-content-center">
          <div class="col-md-6">
              <!-- NOTE: The 'rounded-pill' class is applied via custom CSS as 'rounded-pill-custom' for consistency across input group components in BS4 -->
              <div class="input-group input-group-lg shadow-sm rounded-pill-custom"> 
                  <!-- BS5 'border-end-0' becomes BS4 'border-right-0'. 'rounded-start-pill' becomes 'rounded-left' -->
                  <div class="input-group-prepend">
                      <span class="input-group-text bg-white border-right-0 rounded-left"><i class="fas fa-search text-muted"></i></span>
                  </div>
                  <!-- BS5 'border-start-0' becomes BS4 'border-left-0'. 'rounded-end-pill' becomes 'rounded-right' -->
                  <input type="text" id="serviceSearch" class="form-control border-left-0 rounded-right" placeholder="সেবা অনুসন্ধান করুন (যেমন: জন্ম)">
              </div>
          </div>
      </div>
      
      <!-- Service Cards Container -->
      <!-- BS5 'g-4' (gutter) is removed, relying on default BS4 column padding and custom CSS margin-bottom on service boxes -->
      <div class="row" id="serviceGrid">
          
          <!-- Service 1: জন্ম নিবন্ধন সনদ -->
          <!-- BS4 equivalent classes for the grid are used -->
          <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="1">
              <a href="/service/birth-certificate" class="text-decoration-none text-dark d-block">
                  <div class="service-box">
                      <div class="icon-circle" style="background-color: var(--primary-color);"><i class="fas fa-baby"></i></div>
                      <!-- BS5 'fw-bolder' becomes BS4 'font-weight-bold' -->
                      <h3 class="h5 font-weight-bold" style="color: var(--darker-color);">জন্ম নিবন্ধন সনদ</h3>
                  </div>
              </a>
          </div>

          <!-- Service 2: মৃত্যু নিবন্ধন সনদ -->
          <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="2">
              <a href="/service/death-certificate" class="text-decoration-none text-dark d-block">
                  <div class="service-box">
                      <div class="icon-circle" style="background-color: #dc3545;"><i class="fas fa-cross"></i></div> 
                      <h3 class="h5 font-weight-bold" style="color: var(--darker-color);">মৃত্যু নিবন্ধন সনদ</h3>
                  </div>
              </a>
          </div>

          <!-- Service 3: বার্ষিক আয়ের সনদ -->
          <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="3">
              <a href="/service/income-certificate" class="text-decoration-none text-dark d-block">
                  <div class="service-box">
                      <div class="icon-circle" style="background-color: var(--medium-color);"><i class="fas fa-sack-dollar"></i></div>
                      <h3 class="h5 font-weight-bold" style="color: var(--darker-color);">বার্ষিক আয়ের সনদ</h3>
                  </div>
              </a>
          </div>

          <!-- Service 4: চারিত্রিক সনদপত্র -->
          <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="4">
              <a href="/service/character-certificate" class="text-decoration-none text-dark d-block">
                  <div class="service-box">
                      <div class="icon-circle" style="background-color: #ffc107;"><i class="fas fa-user-check"></i></div> 
                      <h3 class="h5 font-weight-bold" style="color: var(--darker-color);">চারিত্রিক সনদপত্র</h3>
                  </div>
              </a>
          </div>
          
          <!-- Service 5: ওয়ারিশ সনদ -->
          <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="5">
              <a href="/service/heir-certificate" class="text-decoration-none text-dark d-block">
                  <div class="service-box">
                      <div class="icon-circle" style="background-color: #6f42c1;"><i class="fas fa-handshake"></i></div>
                      <h3 class="h5 font-weight-bold" style="color: var(--darker-color);">ওয়ারিশ সনদ</h3>
                  </div>
              </a>
          </div>
          
          <!-- Service 6: ঠিকানার প্রত্যয়ন -->
          <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="6">
              <a href="/service/address-certificate" class="text-decoration-none text-dark d-block">
                  <div class="service-box">
                      <div class="icon-circle" style="background-color: var(--light-primary-color);"><i class="fas fa-map-marker-alt"></i></div>
                      <h3 class="h5 font-weight-bold" style="color: var(--darker-color);">ঠিকানার প্রত্যয়ন</h3>
                  </div>
              </a>
          </div>
          
          <!-- Service 7: অবিবাহিত সনদ -->
          <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="7">
              <a href="/service/unmarried" class="text-decoration-none text-dark d-block">
                  <div class="service-box">
                      <div class="icon-circle" style="background-color: #00bcd4;"><i class="fas fa-ring"></i></div>
                      <h3 class="h5 font-weight-bold" style="color: var(--darker-color);">অবিবাহিত সনদ</h3>
                  </div>
              </a>
          </div>

          <!-- Service 8: নতুন ট্রেড লাইসেন্স -->
          <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="8">
              <a href="/service/trade-license-new" class="text-decoration-none text-dark d-block">
                  <div class="service-box">
                      <div class="icon-circle" style="background-color: #795548;"><i class="fas fa-store"></i></div>
                      <h3 class="h5 font-weight-bold" style="color: var(--darker-color);">নতুন ট্রেড লাইসেন্স</h3>
                  </div>
              </a>
          </div>

          <!-- Service 9: ট্রেড লাইসেন্স নবায়ন -->
          <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="9">
              <a href="/service/trade-license-renewal" class="text-decoration-none text-dark d-block">
                  <div class="service-box">
                      <div class="icon-circle" style="background-color: #9e9e9e;"><i class="fas fa-sync-alt"></i></div>
                      <h3 class="h5 font-weight-bold" style="color: var(--darker-color);">ট্রেড লাইসেন্স নবায়ন</h3>
                  </div>
              </a>
          </div>

          <!-- Service 10: কৃষি ভর্তুকির প্রত্যয়ন -->
          <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="10">
              <a href="/service/agriculture-subsidy" class="text-decoration-none text-dark d-block">
                  <div class="service-box">
                      <div class="icon-circle" style="background-color: #4caf50;"><i class="fas fa-leaf"></i></div>
                      <h3 class="h5 font-weight-bold" style="color: var(--darker-color);">কৃষি ভর্তুকির প্রত্যয়ন</h3>
                  </div>
              </a>
          </div>
          
          <!-- Service 11: নাগরিকত্ব সনদ -->
          <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="11">
              <a href="/service/citizenship-certificate" class="text-decoration-none text-dark d-block">
                  <div class="service-box">
                      <div class="icon-circle" style="background-color: #ff9800;"><i class="fas fa-flag"></i></div>
                      <h3 class="h5 font-weight-bold" style="color: var(--darker-color);">নাগরিকত্ব সনদ</h3>
                  </div>
              </a>
          </div>


          <!-- Service 12: ভূমির খাজনা প্রত্যয়ন -->
          <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="12">
              <a href="/service/land-tax-certificate" class="text-decoration-none text-dark d-block">
                  <div class="service-box">
                      <div class="icon-circle" style="background-color: #607d8b;"><i class="fas fa-file-invoice-dollar"></i></div>
                      <h3 class="h5 font-weight-bold" style="color: var(--darker-color);">ভূমির খাজনা প্রত্যয়ন</h3>
                  </div>
              </a>
          </div>
          
          <!-- Duplicate services for demonstration (original had 24 total) -->
           <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="1">
              <a href="/service/birth-certificate" class="text-decoration-none text-dark d-block">
                  <div class="service-box">
                      <div class="icon-circle" style="background-color: var(--primary-color);"><i class="fas fa-baby"></i></div>
                      <h3 class="h5 font-weight-bold" style="color: var(--darker-color);">জন্ম নিবন্ধন সনদ</h3>
                  </div>
              </a>
          </div>

          <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="2">
              <a href="/service/death-certificate" class="text-decoration-none text-dark d-block">
                  <div class="service-box">
                      <div class="icon-circle" style="background-color: #dc3545;"><i class="fas fa-cross"></i></div> 
                      <h3 class="h5 font-weight-bold" style="color: var(--darker-color);">মৃত্যু নিবন্ধন সনদ</h3>
                  </div>
              </a>
          </div>

          <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="3">
              <a href="/service/income-certificate" class="text-decoration-none text-dark d-block">
                  <div class="service-box">
                      <div class="icon-circle" style="background-color: var(--medium-color);"><i class="fas fa-sack-dollar"></i></div>
                      <h3 class="h5 font-weight-bold" style="color: var(--darker-color);">বার্ষিক আয়ের সনদ</h3>
                  </div>
              </a>
          </div>

          <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="4">
              <a href="/service/character-certificate" class="text-decoration-none text-dark d-block">
                  <div class="service-box">
                      <div class="icon-circle" style="background-color: #ffc107;"><i class="fas fa-user-check"></i></div> 
                      <h3 class="h5 font-weight-bold" style="color: var(--darker-color);">চারিত্রিক সনদপত্র</h3>
                  </div>
              </a>
          </div>
          
          <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="5">
              <a href="/service/heir-certificate" class="text-decoration-none text-dark d-block">
                  <div class="service-box">
                      <div class="icon-circle" style="background-color: #6f42c1;"><i class="fas fa-handshake"></i></div>
                      <h3 class="h5 font-weight-bold" style="color: var(--darker-color);">ওয়ারিশ সনদ</h3>
                  </div>
              </a>
          </div>
          
          <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="6">
              <a href="/service/address-certificate" class="text-decoration-none text-dark d-block">
                  <div class="service-box">
                      <div class="icon-circle" style="background-color: var(--light-primary-color);"><i class="fas fa-map-marker-alt"></i></div>
                      <h3 class="h5 font-weight-bold" style="color: var(--darker-color);">ঠিকানার প্রত্যয়ন</h3>
                  </div>
              </a>
          </div>

          
      </div>

          
    </div>
@endsection

@section('third_party_scripts')
  
@endsection