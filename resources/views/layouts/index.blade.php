<!DOCTYPE html>
<html lang="en">

<head>
  <!--====== Required meta tags ======-->
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  @if (!Request::is('blogs', 'blogs/*', 'blog', 'blog/*'))
    <meta name="description" content="ডি-নাগরিক: অনলাইনে ডিজিটাল সনদপত্র, প্রত্যয়ন ও সরকারি সেবা নিতে এখনই যুক্ত হোন ডিজিটাল নাগরিকের সাথে—বাংলাদেশের সেরা সনদ ও প্রত্যয়ন সেবা প্ল্যাটফর্ম।">
    <meta name="keywords" content="ডি-নাগরিক, ডিজিটাল নাগরিক, সনদপত্র, প্রত্যয়ন, জন্ম নিবন্ধন, মৃত্যু নিবন্ধন, অনলাইন সেবা, স্থানীয় সরকার, ইউনিয়ন পরিষদ, পৌরসভা, ডিজিটাল সেবা, বাংলাদেশ">
    <meta name="author" content="D Nagorik System">

    <meta property="og:image" content="{{ asset('images/bcs-exam-aid-banner.png') }}" />
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:site_name" content="BCS Exam Aid">
    <meta property="og:locale" content="en_US">
    <meta property="fb:admins" content="100001596964477">
    <meta property="fb:app_id" content="1471913530260781">
    <meta property="og:type" content="website">
    <meta property="og:image:alt" content="BCS Exam Aid" />
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="facebook-domain-verification" content="zzjvr4zbhetww7xikfwoq0rlpu6u09" />
  @endif
  @yield('meta-data')

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('images/favicon.png') }}">
  <meta name="theme-color" content="#155BD5">
  <meta name="msapplication-navbutton-color" content="#155BD5">
  <meta name="apple-mobile-web-app-status-bar-style" content="#155BD5">


  <!--====== Title ======-->
  {{-- <title>BCS Exam Aid</title> --}}
  <title>@yield('title')</title>
  <!--====== Favicon Icon ======-->
  <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/svg" />

  <!-- Load Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hGk+ALEwIH" crossorigin="anonymous">
    <!-- Load Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLMDJz9a9wGg/QzY0n8m8FzG0K6Qo/d9E8K1Z5X+8WlGqJ3hK/Wz5H5uL5T/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    /* Custom Styles for Professional Look - Clean Blue/Navy Palette */
    :root {
        --primary-color: #0d6efd; /* Standard Blue for main actions */
        --darkest-color: #2c3e50; /* Header, Footer BG (Dark Navy) */
        --darker-color: #34495e; /* Main Text, Service Box Accent (Slightly Lighter Navy) */
        --medium-color: #007bff; /* Primary Accent Blue */
        --light-primary-color: #17a2b8; /* Secondary Accent Teal */
        --light-bg: #f8f9fa; /* Lightest Gray Background */
        --white-bg: #ffffff; /* Explicit White */
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--white-bg);
        color: var(--darker-color);
    }
    
    .section-gap {
        padding-top: 5rem;
        padding-bottom: 5rem;
    }

    /* 1. New Header Structure for Logo, and Nav */
    header.navbar-custom {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .top-bar {
        background-color: var(--light-bg) !important; /* Light background for marquee */
        border-bottom: 1px solid #e0e0e0;
    }
    
    .logo-area {
        background-color: var(--darkest-color) !important; /* Dark Navy for Logo panel */
    }

    /* Ensure the main nav is slightly lighter than the logo area for contrast */
    nav.navbar.bg-darker {
         background-color: var(--darker-color) !important;
    }

    /* Service Cards Enhancement (6 column layout) */
    .service-box {
        background-color: var(--white-bg);
        padding: 20px 10px; 
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); 
        transition: transform 0.3s, box-shadow 0.3s;
        min-height: 180px; 
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        border-bottom: 5px solid var(--darker-color); 
    }

    .service-box:hover {
        transform: translateY(-8px); 
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
        border-bottom-color: var(--medium-color); 
    }

    .icon-circle {
        background-color: var(--darker-color); 
        color: white;
        padding: 18px; 
        border-radius: 50%; 
        margin-bottom: 15px;
        font-size: 1.8rem; 
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        display: inline-flex; 
        align-items: center; 
        justify-content: center; 
    }
    
    /* New Admin Panel Theming (Multiple Colors) */
    .admin-card {
        border-left: 5px solid #28a745 !important; /* Default Green accent for context */
    }
    
    /* Stats Card Revert CSS */
    .stats-card {
        border: 1px solid #ddd;
        transition: all 0.3s;
    }
    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    /* Footer Revert CSS */
    footer.footer-custom {
        background-color: var(--darkest-color);
        color: #ecf0f1; /* Light text */
        padding: 40px 0 20px 0;
    }
    footer.footer-custom a {
        color: #ecf0f1;
        text-decoration: none;
        transition: color 0.2s;
    }
    footer.footer-custom a:hover {
        color: var(--light-primary-color);
    }

    /* Mobile specific adjustments */
    @media (max-width: 991.98px) {
        .hero-section {
            padding-top: 3rem;
            padding-bottom: 3rem;
        }
        .section-gap {
            padding-top: 3rem;
            padding-bottom: 3rem;
        }
    }
</style>

  <!-- Structured data JSON-LD (optional but highly recommended) -->
  @if (!Request::is('blogs', 'blogs/*', 'blog', 'blog/*', 'documentation'))
    <script type="application/ld+json">
      {
      "@context": "https://schema.org",
      "@type": "Website",
      "headline": "BCS Exam Aid",
      "description": "BCS Exam Aid - বিসিএস ও সরকারি চাকরির সেরা প্ল্যাটফর্ম",
      "image": "{{ asset('images/bcs-exam-aid-banner.png') }}",
      "url": "{{ url()->current() }}",
      "author": {
          "@type": "Person",
          "name": "A. H. M. Azimul Haque"
        }
      }
  </script>
  @endif
  
  @yield('third_party_stylesheets')
</head>

<body>

  <!--====== NAVBAR NINE PART START ======-->

  <!-- Main Header Container -->
  <header class="navbar-custom sticky-top">
      <!-- Marquee Text (Hidden on Mobile) - COMMENTED OUT AS PER REQUEST -->
      <!-- <div class="top-bar d-none d-lg-block">
          <div class="container">
              <marquee class="small text-darker-color fw-bold">
                  <i class="fas fa-certificate text-danger me-2"></i> আপনার ডিজিটাল সনদপত্র আবেদনের জন্য জাতীয় পরিচয়পত্র নম্বর ও জন্ম তারিখ ব্যবহার করুন। সেবাসমূহ এখন আরও দ্রুত এবং নির্ভরযোগ্য।
              </marquee>
          </div>
      </div> -->

      <!-- 2. Logo/Branding Area (Bigger Logo) -->
      <div class="logo-area">
          <div class="container py-3 d-flex align-items-center justify-content-between">
              <a href="{{ route('index.index') }}" title="ডি-নাগরিক হোম" style="text-decoration: none;">
                <div class="d-flex align-items-center">
                    <!-- Increased Icon Size and Text Emphasis -->
                    {{-- <i class="fas fa-landmark me-3" style="font-size: 2.8rem; color: var(--light-primary-color);"></i> --}}
                    <img src="{{ asset('/') }}images/logo.png" class="img-fluid" style="height: 60px; width: auto;" alt="ডি-নাগরিক: ডিজিটাল প্রত্যয়ন পোর্টাল">
                    <span class="h3 fw-bolder text-white mb-0 d-none d-sm-inline">ডি-নাগরিক: ডিজিটাল প্রত্যয়ন পোর্টাল</span>
                    <span class="h4 fw-bolder text-white mb-0 d-inline d-sm-none">ডি-নাগরিক</span>
                </div>
              </a>
              <!-- Replaced 'সহায়তা ডেস্ক' with two new account buttons -->
              <div class="d-none d-md-flex gap-3">
                  <a href="{{ route('register.citizen') }}" class="btn btn-outline-light rounded-pill"><i class="fas fa-user me-2"></i> নাগরিক একাউন্ট</a>
                  <a href="{{ route('register.authority') }}" class="btn btn-outline-info rounded-pill"><i class="fas fa-user-tie me-2"></i> প্রশাসনিক একাউন্ট</a>
              </div>
          </div>
      </div>
      
      <!-- 3. Main Navigation Bar -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-darker">
          <div class="container">
              <!-- Toggler button remains for mobile -->
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav w-100 align-items-lg-center">
                      <li class="nav-item"><a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ route('index.index') }}"><i class="fas fa-home me-1"></i> হোম</a></li>
                      <!-- New Links Added -->
                      <li class="nav-item"><a class="nav-link {{ Request::is('verify-certificate') ? 'active' : '' }}" href="{{ route('index.verify-certificate') }}"><i class="fas fa-check-circle me-1"></i> সনদ যাচাই</a></li>
                      <li class="nav-item"><a class="nav-link {{ Request::is('application-status') ? 'active' : '' }}" href="{{ route('index.application-status') }}"><i class="fas fa-tasks me-1"></i> আবেদনের অবস্থা</a></li>
                      <li class="nav-item"><a class="nav-link {{ Request::is('services') ? 'active' : '' }}" href="{{ route('index.services') }}"><i class="fas fa-list-check me-1"></i> সেবাসমূহ</a></li>
                      <li class="nav-item"><a class="nav-link {{ Request::is('notices') ? 'active' : '' }}" href="{{ route('index.notices') }}"><i class="fas fa-bullhorn me-1"></i> নোটিশ বোর্ড</a></li>
                      <!-- Order Change: User Guide before Contact -->
                      <li class="nav-item"><a class="nav-link {{ Request::is('user-guidelines') ? 'active' : '' }}" href="{{ route('index.user-guidelines') }}"><i class="fas fa-book me-1"></i> ব্যবহার নির্দেশিকা</a></li>
                      <li class="nav-item"><a class="nav-link {{ Request::is('contact') ? 'active' : '' }}" href="{{ route('index.contact') }}"><i class="fas fa-headset me-1"></i> যোগাযোগ</a></li>
                      
                      <!-- Login/Dropdown remains, floated right (mostly redundant now, but kept for mobile/small screen) -->
                     {{--  <li class="nav-item dropdown ms-auto">
                          <a class="nav-link dropdown-toggle btn btn-primary btn-sm ms-lg-3 rounded-pill" href="#" id="loginDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="fas fa-sign-in-alt me-1"></i> প্রবেশ
                          </a>
                          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="loginDropdown">
                              <li><a class="dropdown-item text-primary fw-bold" href="/citizen-login"><i class="fas fa-user me-2"></i> নাগরিক লগইন</a></li>
                              <li><hr class="dropdown-divider"></li>
                              <li><a class="dropdown-item text-info fw-bold" href="/admin-login"><i class="fas fa-user-tie me-2"></i> প্রশাসনিক লগইন</a></li>
                          </ul>
                      </li> --}}
                  </ul>
              </div>

              <!-- Login Dropdown for Mobile/Tablet/Desktop - Now visible on all screens (Removed d-lg-none) -->
              <div class="dropdown d-flex ms-auto"> 
                  <a class="nav-link dropdown-toggle btn btn-primary btn-sm rounded-pill text-white" 
                     href="#" 
                     id="loginDropdownMobile" 
                     role="button" 
                     data-bs-toggle="dropdown" 
                     aria-expanded="false" 
                     style="padding: 6px 15px;">
                     @if(Auth::user())
                      <i class="fas fa-user-tie me-2"></i> {{ Auth::user()->name }}
                     @else
                      <i class="fas fa-sign-in-alt me-1"></i> লগইন
                     @endif
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="loginDropdownMobile">
                    @if(Auth::user())
                     <i class="fas fa-user-tie me-2"></i> {{ Auth::user()->name }}
                    @else
                     <li><a class="dropdown-item text-primary fw-bold" href="/citizen-login"><i class="fas fa-user me-2"></i> নাগরিক লগইন</a></li>
                     <li><hr class="dropdown-divider"></li>
                     <li><a class="dropdown-item text-info fw-bold" href="{{ route('office.login') }}"><i class="fas fa-user-tie me-2"></i> প্রশাসনিক একাউন্ট</a></li>
                    @endif
                      
                  </ul>
              </div>
              <!-- END MOBILE/DESKTOP DROPDOWN -->
          </div>
      </nav>
  </header>
  <!--====== NAVBAR NINE PART ENDS ======-->

  <main>
    @yield('content')
  </main>


  <!-- Start Footer Area -->
  <footer class="footer-custom">
      <div class="container">
          <div class="row">
              <div class="col-md-4 mb-4 mb-md-0">
                  <a href="{{ route('index.index') }}" title="ডি-নাগরিক হোম" style="text-decoration: none;">
                    <h5 class="fw-bold text-uppercase">
                      {{-- <i class="fas fa-landmark me-2"></i> --}}
                      <img src="{{ asset('/') }}images/logo-horizontal.png" class="img-fluid" style="height: 75px; width: auto;" alt="ডি-নাগরিক: ডিজিটাল প্রত্যয়ন পোর্টাল">
                    </h5>
                  </a>
                  <p class="small mt-3">স্থানীয় সরকার কর্তৃপক্ষের ডিজিটাল প্রত্যয়ন ও সনদপত্র ব্যবস্থাপনা ব্যবস্থা। জনগণের জন্য দ্রুত ও স্বচ্ছ সেবা নিশ্চিত করতে আমরা প্রতিশ্রুতিবদ্ধ।</p>
                  <div class="social-links mt-3">
                      <a href="#" class="me-3 btn btn-outline-light btn-sm rounded-circle"><i class="fab fa-facebook-f"></i></a>
                      <a href="#" class="me-3 btn btn-outline-light btn-sm rounded-circle"><i class="fab fa-twitter"></i></a>
                      <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i class="fab fa-linkedin-in"></i></a>
                  </div>
              </div>
              
              <div class="col-md-2 mb-4 mb-md-0">
                  <h5 class="fw-bold text-uppercase">জরুরী প্রয়োজনে</h5>
                  <ul class="list-unstyled mt-3">
                      <li><a href="#contact">হটলাইন: 1678</a></li>
                      <li><a href="/police">নিকটস্থ থানা</a></li>
                      <li><a href="/fire-service">ফায়ার সার্ভিস</a></li>
                      <li><a href="/disaster">দুর্যোগ সহায়তা</a></li>
                  </ul>
              </div>
              
              <div class="col-md-3 mb-4 mb-md-0">
                  <h5 class="fw-bold text-uppercase">গুরুত্বপূর্ণ লিংকসমূহ</h5>
                  <ul class="list-unstyled mt-3">
                      <li><a href="#services">সেবা ও আবেদন</a></li>
                      <li><a href="/verification">সনদ যাচাই</a></li>
                      <li><a href="#notices">নোটিশ বোর্ড</a></li>
                      <li><a href="/terms">শর্তাবলী</a></li>
                  </ul>
              </div>
              
              <div class="col-md-3">
                  <h5 class="fw-bold text-uppercase">সহায়তা ও যোগাযোগ</h5>
                  <ul class="list-unstyled mt-3">
                      <li><a href="/faq">প্রায়শই জিজ্ঞাসিত প্রশ্ন (FAQ)</a></li>
                      <li><a href="{{ route('index.contact') }}">সহায়তা কেন্দ্রে যোগাযোগ</a></li>
                      <li><a href="{{ route('index.user-guidelines') }}">ব্যবহারকারী নির্দেশিকা</a></li>
                      <li><a href="/privacy">গোপনীয়তা নীতি</a></li>
                  </ul>
              </div>
          </div>
          <hr class="my-4 border-light">
          <div class="text-center small">
              &copy;  সকল স্বত্ব সংরক্ষিত - স্থানীয় সরকার কর্তৃপক্ষ, গণপ্রজাতন্ত্রী বাংলাদেশ সরকার
          </div>
      </div>
  </footer>
  <!--/ End Footer Area -->

  {{-- <div class="made-in-ayroui mt-4">
    <a href="https://ayroui.com" target="_blank" rel="nofollow">
      <img style="width:220px" src="{{ asset('/') }}images/ayroui.svg">
    </a>
  </div> --}}

  <a href="#" class="scroll-top btn-hover">
    <i class="lni lni-chevron-up"></i>
  </a>

  <!--====== js ======-->
  <!-- Load Bootstrap 5 JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  
  <!-- Load jQuery for Service Filtering and Dynamic Hiding -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  

  @yield('third_party_scripts')
  @include('partials._messages')
</body>

</html>