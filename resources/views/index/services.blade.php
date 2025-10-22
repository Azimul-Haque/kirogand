@extends('layouts.index')
@section('title') ডিজিটাল নাগরিক - সনদ ও প্রত্যয়ন সেবাসমূহ @endsection

@section('third_party_stylesheets')

@endsection

@section('content')
  <!-- Services List Section (Dynamic Show/Hide Logic) -->
  <section id="services" class="service-section section-gap" style="background-color: var(--light-bg);">
      <div class="container">
          <h2 class="text-center mb-5 fw-bold display-6" style="color: var(--darker-color);"><i class="fas fa-list-check me-2 text-primary"></i> সনদ ও প্রত্যয়ন সেবাসমূহ</h2>
          
          <!-- Service Search Filter -->
          <div class="row mb-5 justify-content-center">
              <div class="col-md-6">
                   <div class="input-group input-group-lg shadow-sm rounded-pill">
                      <span class="input-group-text bg-white border-end-0 rounded-start-pill"><i class="fas fa-search text-muted"></i></span>
                      <input type="text" id="serviceSearch" class="form-control border-start-0 rounded-end-pill" placeholder="সেবা অনুসন্ধান করুন (যেমন: জন্ম)">
                  </div>
              </div>
          </div>
          
          <!-- Service Cards Container -->
          <div class="row g-4" id="serviceGrid">
              
              <!-- DYNAMICALLY GENERATED SERVICE BOXES (40 TOTAL) -->
              <!-- Note: The first 12 services will be visible, the rest will be dynamically hidden by JS -->
              
              <!-- Service 1: জন্ম নিবন্ধন সনদ -->
              <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="1">
                  <a href="/service/birth-certificate" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: var(--primary-color);"><i class="fas fa-baby"></i></div>
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">জন্ম নিবন্ধন সনদ</h3>
                      </div>
                  </a>
              </div>

              <!-- Service 2: মৃত্যু নিবন্ধন সনদ -->
              <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="2">
                  <a href="/service/death-certificate" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: #dc3545;"><i class="fas fa-cross"></i></div> 
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">মৃত্যু নিবন্ধন সনদ</h3>
                      </div>
                  </a>
              </div>

              <!-- Service 3: বার্ষিক আয়ের সনদ -->
              <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="3">
                  <a href="/service/income-certificate" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: var(--medium-color);"><i class="fas fa-sack-dollar"></i></div>
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">বার্ষিক আয়ের সনদ</h3>
                      </div>
                  </a>
              </div>

              <!-- Service 4: চারিত্রিক সনদপত্র -->
              <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="4">
                  <a href="/service/character-certificate" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: #ffc107;"><i class="fas fa-user-check"></i></div> 
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">চারিত্রিক সনদপত্র</h3>
                      </div>
                  </a>
              </div>
              
              <!-- Service 5: ওয়ারিশ সনদ -->
              <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="5">
                  <a href="/service/heir-certificate" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: #6f42c1;"><i class="fas fa-handshake"></i></div>
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">ওয়ারিশ সনদ</h3>
                      </div>
                  </a>
              </div>
              
              <!-- Service 6: ঠিকানার প্রত্যয়ন -->
              <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="6">
                  <a href="/service/address-certificate" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: var(--light-primary-color);"><i class="fas fa-map-marker-alt"></i></div>
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">ঠিকানার প্রত্যয়ন</h3>
                      </div>
                  </a>
              </div>
              
              <!-- Service 7: অবিবাহিত সনদ -->
              <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="7">
                  <a href="/service/unmarried" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: #00bcd4;"><i class="fas fa-ring"></i></div>
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">অবিবাহিত সনদ</h3>
                      </div>
                  </a>
              </div>

              <!-- Service 8: নতুন ট্রেড লাইসেন্স -->
              <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="8">
                  <a href="/service/trade-license-new" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: #795548;"><i class="fas fa-store"></i></div>
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">নতুন ট্রেড লাইসেন্স</h3>
                      </div>
                  </a>
              </div>

              <!-- Service 9: ট্রেড লাইসেন্স নবায়ন -->
              <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="9">
                  <a href="/service/trade-license-renewal" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: #9e9e9e;"><i class="fas fa-sync-alt"></i></div>
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">ট্রেড লাইসেন্স নবায়ন</h3>
                      </div>
                  </a>
              </div>

              <!-- Service 10: কৃষি ভর্তুকির প্রত্যয়ন -->
              <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="10">
                  <a href="/service/agriculture-subsidy" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: #4caf50;"><i class="fas fa-leaf"></i></div>
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">কৃষি ভর্তুকির প্রত্যয়ন</h3>
                      </div>
                  </a>
              </div>
              
              <!-- Service 11: নাগরিকত্ব সনদ -->
              <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="11">
                  <a href="/service/citizenship-certificate" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: #ff9800;"><i class="fas fa-flag"></i></div>
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">নাগরিকত্ব সনদ</h3>
                      </div>
                  </a>
              </div>


              <!-- Service 12: ভূমির খাজনা প্রত্যয়ন -->
              <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="12">
                  <a href="/service/land-tax-certificate" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: #607d8b;"><i class="fas fa-file-invoice-dollar"></i></div>
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">ভূমির খাজনা প্রত্যয়ন</h3>
                      </div>
                  </a>
              </div>

              <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="1">
                  <a href="/service/birth-certificate" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: var(--primary-color);"><i class="fas fa-baby"></i></div>
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">জন্ম নিবন্ধন সনদ</h3>
                      </div>
                  </a>
              </div>

              <!-- Service 2: মৃত্যু নিবন্ধন সনদ -->
              <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="2">
                  <a href="/service/death-certificate" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: #dc3545;"><i class="fas fa-cross"></i></div> 
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">মৃত্যু নিবন্ধন সনদ</h3>
                      </div>
                  </a>
              </div>

              <!-- Service 3: বার্ষিক আয়ের সনদ -->
              <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="3">
                  <a href="/service/income-certificate" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: var(--medium-color);"><i class="fas fa-sack-dollar"></i></div>
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">বার্ষিক আয়ের সনদ</h3>
                      </div>
                  </a>
              </div>

              <!-- Service 4: চারিত্রিক সনদপত্র -->
              <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="4">
                  <a href="/service/character-certificate" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: #ffc107;"><i class="fas fa-user-check"></i></div> 
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">চারিত্রিক সনদপত্র</h3>
                      </div>
                  </a>
              </div>
              
              <!-- Service 5: ওয়ারিশ সনদ -->
              <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="5">
                  <a href="/service/heir-certificate" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: #6f42c1;"><i class="fas fa-handshake"></i></div>
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">ওয়ারিশ সনদ</h3>
                      </div>
                  </a>
              </div>
              
              <!-- Service 6: ঠিকানার প্রত্যয়ন -->
              <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="6">
                  <a href="/service/address-certificate" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: var(--light-primary-color);"><i class="fas fa-map-marker-alt"></i></div>
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">ঠিকানার প্রত্যয়ন</h3>
                      </div>
                  </a>
              </div>
              
              <!-- Service 7: অবিবাহিত সনদ -->
              <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="7">
                  <a href="/service/unmarried" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: #00bcd4;"><i class="fas fa-ring"></i></div>
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">অবিবাহিত সনদ</h3>
                      </div>
                  </a>
              </div>

              <!-- Service 8: নতুন ট্রেড লাইসেন্স -->
              <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="8">
                  <a href="/service/trade-license-new" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: #795548;"><i class="fas fa-store"></i></div>
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">নতুন ট্রেড লাইসেন্স</h3>
                      </div>
                  </a>
              </div>

              <!-- Service 9: ট্রেড লাইসেন্স নবায়ন -->
              <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="9">
                  <a href="/service/trade-license-renewal" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: #9e9e9e;"><i class="fas fa-sync-alt"></i></div>
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">ট্রেড লাইসেন্স নবায়ন</h3>
                      </div>
                  </a>
              </div>

              <!-- Service 10: কৃষি ভর্তুকির প্রত্যয়ন -->
              <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="10">
                  <a href="/service/agriculture-subsidy" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: #4caf50;"><i class="fas fa-leaf"></i></div>
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">কৃষি ভর্তুকির প্রত্যয়ন</h3>
                      </div>
                  </a>
              </div>
              
              <!-- Service 11: নাগরিকত্ব সনদ -->
              <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="11">
                  <a href="/service/citizenship-certificate" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: #ff9800;"><i class="fas fa-flag"></i></div>
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">নাগরিকত্ব সনদ</h3>
                      </div>
                  </a>
              </div>


              <!-- Service 12: ভূমির খাজনা প্রত্যয়ন -->
              <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="12">
                  <a href="/service/land-tax-certificate" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: #607d8b;"><i class="fas fa-file-invoice-dollar"></i></div>
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">ভূমির খাজনা প্রত্যয়ন</h3>
                      </div>
                  </a>
              </div>

          </div>
          
          <!-- Show More Button -->
          {{-- <div class="text-center mt-5">
               <a href="#" id="showMoreServicesBtn" class="btn btn-outline-primary btn-lg rounded-pill shadow">
                  সকল সেবার সম্পূর্ণ তালিকা <i class="fas fa-arrow-circle-down ms-2"></i>
              </a>
          </div> --}}
      </div>
  </section>
@endsection

@section('third_party_scripts')
  

@endsection
    

    
