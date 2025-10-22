@extends('layouts.index')
@section('title') ডিজিটাল নাগরিক @endsection

@section('third_party_stylesheets')
  <style>
    /* --- NOTICE BOARD STYLES (MATCHING dedicated page) --- */
    .notice-card {
        background-color: var(--white-bg);
        border-left: 5px solid var(--primary-color); /* Default border color */
        transition: box-shadow 0.3s, transform 0.3s;
    }
    .notice-card:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }
    .notice-date {
        color: var(--light-primary-color);
        font-weight: 600;
    }
    /* --- END NOTICE BOARD STYLES --- */
  </style>
@endsection

@section('content')
  <!-- Hero/Banner Section -->
  <section id="home" class="hero-section section-gap">
      <div class="container">
          <div class="row align-items-center">
              <div class="col-lg-6 mb-4 mb-lg-0 hero-text">
                  <h1 class="display-5 fw-bolder" style="color: var(--darker-color);">ডিজিটাল নাগরিক: সনদপত্র, প্রত্যয়ন ও সরকারি সেবার সেবা প্ল্যাটফর্ম</h1>
                  <p class="lead text-muted mt-3">

                      স্থানীয় সরকার কর্তৃপক্ষের (ইউনিয়ন, পৌরসভা, উপজেলা পরিষদ) মাধ্যমে সকল ডিজিটাল সনদপত্র (জন্ম, মৃত্যু, চারিত্রিক, নাগরিকত্ব ইত্যাদি) অনলাইনে আবেদন, ট্র‍্যাকিং ও যাচাই করুন। আপনার প্রয়োজন এখন ডিজিটাল উপায়ে আপনার হাতের মুঠোয়।
                  </p>
                  <div class="mt-4 d-flex flex-column flex-md-row">
                      <!-- Button Rename: নাগরিক নিবন্ধন করুন -> সনদ আবেদন করুন -->
                      <a href="/citizen-registration" class="btn btn-primary btn-lg rounded-pill me-md-3 mb-2 mb-md-0 shadow-lg text-uppercase">
                          <i class="fas fa-file-alt me-2"></i> সনদ আবেদন করুন
                      </a>
                      <!-- Button Rename: আমাদের সকল সেবা দেখুন -> সনদ যাচাই করুন -->
                      <a href="{{ route('index.verify-certificate') }}" class="btn btn-outline-primary btn-lg rounded-pill shadow" style="">
                          সনদ যাচাই করুন <i class="fas fa-magnifying-glass ms-2"></i>
                      </a>
                  </div>
              </div>

              <!-- Slider/Carousel -->
              <div class="col-lg-6 hero-image text-center">
                  <div id="heroCarousel" class="carousel slide shadow-2xl rounded-3" data-bs-ride="carousel">
                      <div class="carousel-inner rounded-3">
                          <div class="carousel-item active">
                              <img src="https://placehold.co/600x420/0d6efd/ffffff?text=ডিজিটাল+আবেদন+প্রক্রিয়া" class="d-block w-100" alt="Slider Image 1">
                          </div>
                          <div class="carousel-item">
                              <img src="https://placehold.co/600x420/2c3e50/ffffff?text=দ্রুত+সনদ+যাচাই" class="d-block w-100" alt="Slider Image 2">
                          </div>
                          <div class="carousel-item">
                              <img src="https://placehold.co/600x420/17a2b8/ffffff?text=স্থানীয়+সরকার+কর্তৃপক্ষ" class="d-block w-100" alt="Slider Image 3">
                          </div>
                      </div>
                      <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Previous</span>
                      </button>
                      <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Next</span>
                      </button>
                  </div>
              </div>
          </div>
      </div>
  </section>

  <!-- Services List Section (Dynamic Show/Hide Logic) -->
  <section id="services" class="service-section section-gap" style="background-color: var(--light-bg);">
      <div class="container">
          <h2 class="text-center mb-5 fw-bold display-6" style="color: var(--darker-color);">প্রধান ডিজিটাল সেবাসমূহ</h2>
          
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
              <div class="col-lg-2 col-md-4 col-sm-6 service-box-container" data-service-id="1">
                  <a href="/service/birth-certificate" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: var(--primary-color);"><i class="fas fa-baby"></i></div>
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">জন্ম নিবন্ধন সনদ</h3>
                      </div>
                  </a>
              </div>

              <!-- Service 2: মৃত্যু নিবন্ধন সনদ -->
              <div class="col-lg-2 col-md-4 col-sm-6 service-box-container" data-service-id="2">
                  <a href="/service/death-certificate" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: #dc3545;"><i class="fas fa-cross"></i></div> 
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">মৃত্যু নিবন্ধন সনদ</h3>
                      </div>
                  </a>
              </div>

              <!-- Service 3: বার্ষিক আয়ের সনদ -->
              <div class="col-lg-2 col-md-4 col-sm-6 service-box-container" data-service-id="3">
                  <a href="/service/income-certificate" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: var(--medium-color);"><i class="fas fa-sack-dollar"></i></div>
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">বার্ষিক আয়ের সনদ</h3>
                      </div>
                  </a>
              </div>

              <!-- Service 4: চারিত্রিক সনদপত্র -->
              <div class="col-lg-2 col-md-4 col-sm-6 service-box-container" data-service-id="4">
                  <a href="/service/character-certificate" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: #ffc107;"><i class="fas fa-user-check"></i></div> 
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">চারিত্রিক সনদপত্র</h3>
                      </div>
                  </a>
              </div>
              
              <!-- Service 5: ওয়ারিশ সনদ -->
              <div class="col-lg-2 col-md-4 col-sm-6 service-box-container" data-service-id="5">
                  <a href="/service/heir-certificate" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: #6f42c1;"><i class="fas fa-handshake"></i></div>
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">ওয়ারিশ সনদ</h3>
                      </div>
                  </a>
              </div>
              
              <!-- Service 6: ঠিকানার প্রত্যয়ন -->
              <div class="col-lg-2 col-md-4 col-sm-6 service-box-container" data-service-id="6">
                  <a href="/service/address-certificate" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: var(--light-primary-color);"><i class="fas fa-map-marker-alt"></i></div>
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">ঠিকানার প্রত্যয়ন</h3>
                      </div>
                  </a>
              </div>
              
              <!-- Service 7: অবিবাহিত সনদ -->
              <div class="col-lg-2 col-md-4 col-sm-6 service-box-container" data-service-id="7">
                  <a href="/service/unmarried" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: #00bcd4;"><i class="fas fa-ring"></i></div>
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">অবিবাহিত সনদ</h3>
                      </div>
                  </a>
              </div>

              <!-- Service 8: নতুন ট্রেড লাইসেন্স -->
              <div class="col-lg-2 col-md-4 col-sm-6 service-box-container" data-service-id="8">
                  <a href="/service/trade-license-new" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: #795548;"><i class="fas fa-store"></i></div>
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">নতুন ট্রেড লাইসেন্স</h3>
                      </div>
                  </a>
              </div>

              <!-- Service 9: ট্রেড লাইসেন্স নবায়ন -->
              <div class="col-lg-2 col-md-4 col-sm-6 service-box-container" data-service-id="9">
                  <a href="/service/trade-license-renewal" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: #9e9e9e;"><i class="fas fa-sync-alt"></i></div>
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">ট্রেড লাইসেন্স নবায়ন</h3>
                      </div>
                  </a>
              </div>

              <!-- Service 10: কৃষি ভর্তুকির প্রত্যয়ন -->
              <div class="col-lg-2 col-md-4 col-sm-6 service-box-container" data-service-id="10">
                  <a href="/service/agriculture-subsidy" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: #4caf50;"><i class="fas fa-leaf"></i></div>
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">কৃষি ভর্তুকির প্রত্যয়ন</h3>
                      </div>
                  </a>
              </div>
              
              <!-- Service 11: নাগরিকত্ব সনদ -->
              <div class="col-lg-2 col-md-4 col-sm-6 service-box-container" data-service-id="11">
                  <a href="/service/citizenship-certificate" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: #ff9800;"><i class="fas fa-flag"></i></div>
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">নাগরিকত্ব সনদ</h3>
                      </div>
                  </a>
              </div>

              <!-- Service 12: ভূমির খাজনা প্রত্যয়ন -->
              <div class="col-lg-2 col-md-4 col-sm-6 service-box-container" data-service-id="12">
                  <a href="/service/land-tax-certificate" class="text-decoration-none text-dark d-block">
                      <div class="service-box">
                          <div class="icon-circle" style="background-color: #607d8b;"><i class="fas fa-file-invoice-dollar"></i></div>
                          <h3 class="h5 fw-bolder" style="color: var(--darker-color);">ভূমির খাজনা প্রত্যয়ন</h3>
                      </div>
                  </a>
              </div>

              <!-- Additional Services (13-40) - Initially Hidden by JS -->
              <!-- MOCK DATA LOOP START: 13 to 40 -->
              <!-- The following script generates the remaining 28 services for demonstration -->
              <script>
                  // Function to generate services 13 through 40 (mock data)
                  const serviceGrid = document.getElementById('serviceGrid');
                  const colors = ['#f44336', '#e91e63', '#9c27b0', '#673ab7', '#3f51b5', '#2196f3', '#009688', '#8bc34a', '#ffeb3b', '#ff5722'];
                  
                  for (let i = 13; i <= 40; i++) {
                      const container = document.createElement('div');
                      // Add d-none class for initial hiding, which JS will remove if necessary
                      container.className = 'col-lg-2 col-md-4 col-sm-6 service-box-container d-none'; 
                      container.dataset.serviceId = i;

                      const serviceName = (i % 3 === 0) ? `বিশেষ সনদপত্র - ${i}` : (i % 2 === 0 ? `সরকারি সেবা - ${i}` : `অন্যান্য প্রত্যয়ন - ${i}`);
                      const iconClass = (i % 5 === 0) ? 'fas fa-graduation-cap' : 'fas fa-id-card';
                      const bgColor = colors[(i - 1) % colors.length];

                      container.innerHTML = `
                          <a href="/service/misc-${i}" class="text-decoration-none text-dark d-block">
                              <div class="service-box">
                                  <div class="icon-circle" style="background-color: ${bgColor};"><i class="${iconClass}"></i></div>
                                  <h3 class="h5 fw-bolder" style="color: var(--darker-color);">${serviceName}</h3>
                              </div>
                          </a>
                      `;
                      serviceGrid.appendChild(container);
                  }
              </script>
              <!-- MOCK DATA LOOP END -->

          </div>
          
          <!-- Show More Button -->
          <div class="text-center mt-5">
               <a href="#" id="showMoreServicesBtn" class="btn btn-outline-primary btn-lg rounded-pill shadow">
                  সকল সেবার সম্পূর্ণ তালিকা <i class="fas fa-arrow-circle-down ms-2"></i>
              </a>
          </div>
      </div>
  </section>

  <!-- Notices and Registration/Login Links -->
  <section id="notices" class="section-gap" style="background-color: var(--white-bg);">
      <div class="container">
          <div class="row g-5">
              
              <!-- Notices Section -->
              <div class="col-lg-7">
                  <h2 class="h3 fw-bold mb-4" style="color: var(--darker-color);"><i class="fas fa-bell me-2"></i> গুরুত্বপূর্ণ নোটিশ বোর্ড</h2>
                  
                  <div class="d-grid gap-3">
                    <!-- Notice 1: New Security Feature (Primary/Default Color) -->
                    <a href="{{ route('index.notices') }}" class="text-decoration-none d-block">
                        <div class="card p-3 shadow-sm rounded-3 notice-card">
                            <div class="card-body p-2">
                                <span class="notice-date small text-uppercase"><i class="fas fa-calendar-alt me-1"></i> অক্টোবর ২৪, ২০২৫</span>
                                <h5 class="fw-bold mt-1 mb-2" style="color: var(--darker-color);">ডিজিটাল সনদ যাচাইয়ে নতুন নিরাপত্তা ফিচার যুক্তকরণ</h5>
                                <p class="small text-muted mb-0">সনদ যাচাই প্রক্রিয়াকে আরও সুরক্ষিত করতে নতুন দ্বি-স্তর যাচাইকরণ পদ্ধতি চালু...</p>
                            </div>
                        </div>
                    </a>
                    
                    <!-- Notice 2: Emergency Maintenance (Warning Color) -->
                    <a href="{{ route('index.notices') }}" class="text-decoration-none d-block">
                        <div class="card p-3 shadow-sm rounded-3 notice-card" style="border-left: 5px solid #ffc107;"> <!-- Warning border color -->
                            <div class="card-body p-2">
                                <span class="notice-date small text-uppercase text-warning"><i class="fas fa-calendar-alt me-1"></i> অক্টোবর ১৭, ২০২৫</span>
                                <h5 class="fw-bold mt-1 mb-2 text-warning">জরুরী সার্ভার রক্ষণাবেক্ষণ বিজ্ঞপ্তি</h5>
                                <p class="small text-muted mb-0">আগামী শনিবার রাত ১২টা থেকে সকাল ৬টা পর্যন্ত পোর্টালের সেবাসমূহ সাময়িকভাবে বন্ধ থাকবে।</p>
                            </div>
                        </div>
                    </a>

                    <!-- Notice 3: Process Simplification (Success/Union Color) -->
                    <a href="{{ route('index.notices') }}" class="text-decoration-none d-block">
                        <div class="card p-3 shadow-sm rounded-3 notice-card">
                            <div class="card-body p-2">
                                <span class="notice-date small text-uppercase" style="color: var(--union-color);"><i class="fas fa-calendar-alt me-1"></i> অক্টোবর ০৫, ২০২৫</span>
                                <h5 class="fw-bold mt-1 mb-2" style="color: var(--darker-color);">ওয়ারিশ সনদ আবেদনের প্রক্রিয়া সরলীকরণ</h5>
                                <p class="small text-muted mb-0">নাগরিকের সুবিধার্থে ওয়ারিশ সনদ আবেদনের ধাপ ও প্রয়োজনীয়তা কমানো হয়েছে। নতুন প্রক্রিয়া দেখুন...</p>
                            </div>
                        </div>
                    </a>

                    <!-- Notice 2: Emergency Maintenance (Warning Color) -->
                    <a href="{{ route('index.notices') }}" class="text-decoration-none d-block">
                        <div class="card p-3 shadow-sm rounded-3 notice-card" style="border-left: 5px solid #198754;"> <!-- Warning border color -->
                            <div class="card-body p-2">
                                <span class="notice-date small text-uppercase text-success"><i class="fas fa-calendar-alt me-1"></i> অক্টোবর ১৭, ২০২৫</span>
                                <h5 class="fw-bold mt-1 mb-2 text-success">জরুরী সার্ভার রক্ষণাবেক্ষণ বিজ্ঞপ্তি</h5>
                                <p class="small text-muted mb-0">আগামী শনিবার রাত ১২টা থেকে সকাল ৬টা পর্যন্ত পোর্টালের সেবাসমূহ সাময়িকভাবে বন্ধ থাকবে।</p>
                            </div>
                        </div>
                    </a>

                </div>

                <!-- Link to the full notice board page -->
                <div class="mt-4 text-center text-lg-start" id="contact">
                    <a href="{{ route('index.notices') }}" class="btn btn-outline-primary rounded-pill fw-bold">সকল নোটিশ দেখুন <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
              </div>

              <!-- Registration/Login Links (Citizen and Admin) -->
              <div class="col-lg-5">
                  <h2 class="h3 fw-bold mb-4" style="color: var(--darker-color);"><i class="fas fa-key me-2"></i> কর্তৃপক্ষ তালিকাভুক্তির আবেদন</h2>
                  <!-- Administrative Panel (New distinct button colors) -->
                  <div class="card shadow-sm mb-4 border-0 rounded-3 admin-card" style="border-left-color: #00bcd4 !important;">
                      <div class="card-body p-4">
                          <h3 class="h4 card-title fw-bold" style="color: var(--darker-color);">প্রশাসনিক প্যানেল</h3>
                          <p class="card-text text-muted">সনদপত্র অনুমোদন, যাচাই এবং সিস্টেম পরিচালনার জন্য কর্তৃপক্ষের রেজিস্ট্রেশন ও লগইন।</p>
                          
                          <div class="d-grid gap-2">
                              <!-- Button 1: Admin Login (Navy Blue/Primary Action) -->
                              <a href="/admin-login" class="btn text-white rounded-pill fw-bold" style="background-color: #2c3e50; border-color: #2c3e50;"><i class="fas fa-user-cog me-2"></i> প্রশাসনিক লগইন</a>
                              <hr class="my-2 text-muted">
                              
                              <!-- Button 2: Union Registration (Green - Grassroots) -->
                              <a href="/union-registration" class="btn text-white rounded-pill btn-sm fw-bold" style="background-color: #28a745; border-color: #28a745;"><i class="fas fa-map-marker-alt me-1"></i> ইউনিয়ন রেজিস্ট্রেশন করুন</a>
                              
                              <!-- Button 3: Pourashava Registration (Teal - Municipal) -->
                              <a href="/pouroshova-registration" class="btn text-white rounded-pill btn-sm fw-bold" style="background-color: #17a2b8; border-color: #17a2b8;"><i class="fas fa-city me-1"></i> পৌরসভা রেজিস্ট্রেশন করুন</a>
                              
                              <!-- Button 4: Upazila Registration (Indigo - Authority) -->
                              <a href="/upazila-registration" class="btn text-white rounded-pill btn-sm fw-bold" style="background-color: #6f42c1; border-color: #6f42c1;"><i class="fas fa-building me-1"></i> উপজেলা পরিষদ রেজিস্ট্রেশন করুন</a>
                          </div>
                      </div>
                  </div>

                  <!-- Citizen Panel -->
                  <div class="card shadow-sm border-0 rounded-3 border-start border-primary border-4" style="border-left-color: var(--primary-color) !important;">
                      <div class="card-body p-4">
                          <h3 class="h4 card-title fw-bold" style="color: var(--primary-color);">নাগরিক প্যানেল</h3>
                          <p class="card-text text-muted">আপনার সনদপত্র আবেদনের অবস্থা জানতে এবং নতুন আবেদন করতে প্রবেশ করুন।</p>
                          <a href="/citizen-login" class="btn btn-primary w-100 mb-2 rounded-pill"><i class="fas fa-sign-in-alt me-2"></i> নাগরিক লগইন</a>
                          <a href="/citizen-registration" class="btn btn-link w-100 fw-bold" style="color: var(--primary-color);">নতুন নিবন্ধন করুন</a>
                      </div>
                  </div>

              </div>
          </div>
      </div>
  </section>

  <!-- Statistics and Contact Section -->
  <section  class="section-gap" style="background-color: var(--light-bg);">
      <div class="container">
          <div class="row g-5">
              
              <!-- Statistics Section (REVERTED TO PREVIOUS DESIGN) -->
              <div class="col-lg-6">
                  <h2 class="h3 fw-bold mb-4" style="color: var(--darker-color);"><i class="fas fa-chart-bar me-2"></i> ডিজিটাল সেবার পরিসংখ্যান</h2>
                  <div class="row g-4">
                      <!-- Stat Card 1 -->
                      <div class="col-6">
                          <div class="card p-4 rounded-3 text-center stats-card border-0 shadow-sm" style="background-color: #e3f2fd; border-bottom: 5px solid var(--primary-color);">
                              <h3 class="display-4 fw-bolder text-primary mb-1">২</h3>
                              <p class="mb-0 text-uppercase fw-bold text-muted">সিটি কর্পোরেশন</p>
                          </div>
                      </div>
                      <!-- Stat Card 2 -->
                      <div class="col-6">
                          <div class="card p-4 rounded-3 text-center stats-card border-0 shadow-sm" style="background-color: #fff3e0; border-bottom: 5px solid #ff9800;">
                              <h3 class="display-4 fw-bolder" style="color: #ff9800;">৯</h3>
                              <p class="mb-0 text-uppercase fw-bold text-muted">পৌরসভা আওতাধীন</p>
                          </div>
                      </div>
                      <!-- Stat Card 3 -->
                      <div class="col-6">
                          <div class="card p-4 rounded-3 text-center stats-card border-0 shadow-sm" style="background-color: #e8f5e9; border-bottom: 5px solid #4caf50;">
                              <h3 class="display-4 fw-bolder" style="color: #4caf50;">২৭১৭ টি</h3>
                              <p class="mb-0 text-uppercase fw-bold text-muted">ইউনিয়ন আওতাধীন</p>
                          </div>
                      </div>
                      <!-- Stat Card 4 -->
                      <div class="col-6">
                          <div class="card p-4 rounded-3 text-center stats-card border-0 shadow-sm" style="background-color: #fce4ec; border-bottom: 5px solid #e91e63;">
                              <h3 class="display-4 fw-bolder" style="color: #e91e63;">৮০০৯১ টি</h3>
                              <p class="mb-0 text-uppercase fw-bold text-muted">সেবা প্রদান</p>
                          </div>
                      </div>
                       <!-- Stat Card 5 (Full Width) -->
                       <div class="col-12">
                          <div class="card p-4 rounded-3 text-center stats-card border-0 shadow-sm" style="background-color: #f0f4c3; border-bottom: 5px solid #607d8b;">
                              <h3 class="display-4 fw-bolder" style="color: #607d8b;">৪০ টি</h3>
                              <p class="mb-0 text-uppercase fw-bold text-muted">মোট সেবাসমূহ</p>
                          </div>
                      </div>
                  </div>
              </div>
              
              <!-- Contact Section -->
              <div class="col-lg-6">
                  <h2 class="h3 fw-bold mb-4" style="color: var(--darker-color);"><i class="fas fa-headset me-2"></i> যোগাযোগ ও সহায়তা</h2>
                  
                  <div class="card shadow-lg border-0 rounded-3">
                      <div class="card-body p-5">
                          <h3 class="h4 fw-bold mb-4" style="color: var(--darker-color);">সহায়তা ডেস্কের ঠিকানা</h3>
                          <p class="mb-2"><i class="fas fa-map-marker-alt me-2" style="color: var(--light-primary-color);"></i> <strong>ঠিকানা:</strong> ডিজিটাল প্রত্যয়ন শাখা, স্থানীয় সরকার বিভাগ, ঢাকা, বাংলাদেশ।</p>
                          <p class="mb-2"><i class="fas fa-phone me-2" style="color: var(--light-primary-color);"></i> <strong>ফোন:</strong> +৮৮০ ৯৬৭৮-০০০০০০ (কার্যকালীন)</p>
                          <p class="mb-4"><i class="fas fa-envelope me-2" style="color: var(--light-primary-color);"></i> <strong>ইমেইল:</strong> support@esonod.gov.bd</p>
                          
                          <hr>
                          
                          <form action="/contact-submit" method="POST">
                              <div class="mb-3">
                                  <label for="contactName" class="form-label">আপনার নাম</label>
                                  <input type="text" class="form-control rounded-pill" id="contactName" placeholder="নাম" required>
                              </div>
                              <div class="mb-4">
                                  <label for="contactMessage" class="form-label">বার্তার বিষয়বস্তু</label>
                                  <textarea class="form-control rounded-3" id="contactMessage" rows="4" placeholder="আপনার সমস্যাটি লিখুন..." required></textarea>
                              </div>
                              <button type="submit" class="btn btn-primary w-100 rounded-pill text-uppercase fw-bold">বার্তা পাঠান</button>
                          </form>
                      </div>
                  </div>
              </div>

          </div>
      </div>
  </section>

@endsection

@section('third_party_scripts')
  <script>
      $(document).ready(function() {
          const defaultVisible = 12; // 12 services visible by default
          const $serviceContainers = $('.service-box-container');
          const $showMoreBtn = $('#showMoreServicesBtn');

          // 1. Initial Hiding Logic (executed immediately after mock data script runs)
          // Hides services from index 12 (the 13th item) onwards
          $serviceContainers.each(function(index) {
              if (index >= defaultVisible) {
                  $(this).addClass('d-none');
              }
          });

          // 2. Toggle Visibility Logic
          $showMoreBtn.on('click', function(e) {
              e.preventDefault();
              
              // Get all currently hidden services (which are not hidden by the search filter)
              const $hiddenServices = $serviceContainers.filter('.d-none');
              
              if ($hiddenServices.length > 0) {
                  // Show all hidden services
                  $hiddenServices.removeClass('d-none');
                  // Update button text and icon
                  $(this).html('প্রথম ১২টি সেবা দেখুন <i class="fas fa-arrow-circle-up ms-2"></i>').removeClass('btn-outline-primary').addClass('btn-outline-danger');
              } else {
                  // Hide back (services 13 onwards)
                  $serviceContainers.each(function(index) {
                      if (index >= defaultVisible) {
                          $(this).addClass('d-none');
                      }
                  });
                  // Update button text and icon
                  $(this).html('সকল সেবার সম্পূর্ণ তালিকা <i class="fas fa-arrow-circle-down ms-2"></i>').removeClass('btn-outline-danger').addClass('btn-outline-primary');
              }
          });

          // 3. Service Filtering Logic (Works on ALL 40 services)
          $('#serviceSearch').on('keyup', function() {
              var searchText = $(this).val().toLowerCase();
              
              // Ensure the button state resets when searching
              // If search text is present, show all services initially so the filter works correctly
              if (searchText.length > 0) {
                  $serviceContainers.removeClass('d-none');
                  $showMoreBtn.hide(); // Hide the show more button during search
              } else {
                  // Reset to default state
                  $showMoreBtn.show();
                   $serviceContainers.each(function(index) {
                      if (index >= defaultVisible) {
                          $(this).addClass('d-none');
                      }
                  });
                   // Reset button text
                   $showMoreBtn.html('সকল সেবার সম্পূর্ণ তালিকা <i class="fas fa-arrow-circle-down ms-2"></i>').removeClass('btn-outline-danger').addClass('btn-outline-primary');
              }

              $serviceContainers.each(function() {
                  var $serviceContainer = $(this);
                  var serviceName = $serviceContainer.find('h3').text().toLowerCase();
                  
                  // Show or hide the container based on the search text
                  // NOTE: If search is active, the container remains hidden/shown by the filter, overriding the initial hiding logic.
                  if (serviceName.indexOf(searchText) > -1) {
                      $serviceContainer.removeClass('d-none');
                  } else if (searchText.length > 0) { // Only hide if search is active
                      $serviceContainer.addClass('d-none');
                  }
              });

              // If search is active and all services are visible, no need to show the toggle button
              if (searchText.length > 0) {
                  $showMoreBtn.hide();
              } else {
                  $showMoreBtn.show();
              }
          });
      });
  </script>

@endsection
    

    
