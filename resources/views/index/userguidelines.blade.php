@extends('layouts.index')
@section('title') ডিজিটাল নাগরিক - নোটিশসমূহ @endsection

@section('third_party_stylesheets')
  <style>
    /* Manual Card Styles */
    .manual-card {
        border-left: 5px solid var(--light-primary-color);
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        transition: box-shadow 0.3s;
    }
    .manual-card:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }
    .step-icon {
        font-size: 1.5rem;
        color: var(--primary-color);
        background-color: #e3f2fd; /* Light Blue background */
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .manual-heading {
        color: var(--darker-color);
    }

    /* Video Guide Styles */
    .video-guide-card {
        background-color: var(--white-bg);
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 25px;
        transition: transform 0.2s;
    }
    .video-guide-card:hover {
        transform: scale(1.02);
    }
    .video-thumbnail {
        background-color: var(--darker-color);
        position: relative;
        cursor: pointer;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
    }
    .play-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 3rem;
        color: white;
        opacity: 0.9;
        transition: opacity 0.2s;
    }
    .video-thumbnail:hover .play-icon {
        opacity: 1;
        color: var(--light-primary-color);
    }
    .placeholder-text {
        color: #ccc;
        padding: 30px 10px;
        text-align: center;
    }
  </style>
@endsection

@section('content')
  <!-- Services List Section (Dynamic Show/Hide Logic) -->
  <section id="services" class="service-section section-gap">
    <div class="container">
      <h1 class="text-center display-6 fw-bold mb-5" style="color: var(--darker-color);"><i class="fas fa-bullhorn me-3 text-primary"></i> গুরুত্বপূর্ণ নোটিশ বোর্ড</h1>
      
      <!-- Centered Row for 6-Column Content -->
      <div class="row justify-content-center">
          <!-- Applies 6-column width on large screens -->
          <div class="col-md-8 col-lg-7"> 
              
              <div id="noticeList" class="d-grid gap-4">
                  <!-- Mock Notices -->
                  <div class="card p-3 shadow-sm rounded-3 notice-card">
                      <div class="card-body p-2">
                          <span class="notice-date small text-uppercase"><i class="fas fa-calendar-alt me-1"></i> অক্টোবর ২৪, ২০২৫</span>
                          <h5 class="fw-bold mt-1 mb-2">ডিজিটাল সনদ যাচাইয়ে নতুন নিরাপত্তা ফিচার যুক্তকরণ</h5>
                          <p class="small text-muted mb-2">সনদ যাচাই প্রক্রিয়াকে আরও সুরক্ষিত করতে নতুন দ্বি-স্তর যাচাইকরণ পদ্ধতি চালু করা হয়েছে। বিস্তারিত জানতে নিচে দেখুন।</p>
                          <a href="#" class="btn btn-sm btn-outline-primary rounded-pill"><i class="fas fa-eye me-1"></i> বিস্তারিত পড়ুন</a>
                      </div>
                  </div>

                  <div class="card p-3 shadow-sm rounded-3 notice-card">
                      <div class="card-body p-2">
                          <span class="notice-date small text-uppercase text-warning"><i class="fas fa-calendar-alt me-1"></i> অক্টোবর ১৭, ২০২৫</span>
                          <h5 class="fw-bold mt-1 mb-2 text-warning">জরুরী সার্ভার রক্ষণাবেক্ষণ বিজ্ঞপ্তি</h5>
                          <p class="small text-muted mb-2">আগামী শনিবার রাত ১২টা থেকে সকাল ৬টা পর্যন্ত পোর্টালের সেবাসমূহ সাময়িকভাবে বন্ধ থাকবে।</p>
                          <a href="#" class="btn btn-sm btn-outline-warning rounded-pill"><i class="fas fa-eye me-1"></i> বিস্তারিত পড়ুন</a>
                      </div>
                  </div>

                  <div class="card p-3 shadow-sm rounded-3 notice-card">
                      <div class="card-body p-2">
                          <span class="notice-date small text-uppercase"><i class="fas fa-calendar-alt me-1"></i> সেপ্টেম্বর ০৫, ২০২৫</span>
                          <h5 class="fw-bold mt-1 mb-2">সকল প্রকার ট্রেড লাইসেন্সের জন্য নতুন আবেদন ফরম চালু</h5>
                          <p class="small text-muted mb-2">পৌরসভা এবং ইউনিয়ন পর্যায়ে ট্রেড লাইসেন্সের অনলাইন আবেদন ফরমে কিছু নতুন তথ্য সংযোজন করা হয়েছে।</p>
                          <a href="#" class="btn btn-sm btn-outline-primary rounded-pill"><i class="fas fa-eye me-1"></i> বিস্তারিত পড়ুন</a>
                      </div>
                  </div>

                  <div class="card p-3 shadow-sm rounded-3 notice-card">
                      <div class="card-body p-2">
                          <span class="notice-date small text-uppercase"><i class="fas fa-calendar-alt me-1"></i> আগস্ট ১০, ২০২৫</span>
                          <h5 class="fw-bold mt-1 mb-2">জন্ম ও মৃত্যু সনদের ফি পুনর্নির্ধারণ</h5>
                          <p class="small text-muted mb-2">সরকারের নতুন গেজেট অনুযায়ী জন্ম ও মৃত্যু নিবন্ধন সনদের জন্য প্রযোজ্য ফির হার পরিবর্তন করা হয়েছে।</p>
                          <a href="#" class="btn btn-sm btn-outline-primary rounded-pill"><i class="fas fa-eye me-1"></i> বিস্তারিত পড়ুন</a>
                      </div>
                  </div>
                  
              </div>
              
              <div class="text-center mt-5">
                   <button class="btn btn-lg btn-secondary rounded-pill fw-bold text-uppercase shadow-sm" disabled>
                      <i class="fas fa-history me-2"></i> আরও পুরোনো নোটিশ
                  </button>
              </div>
          </div>
      </div>
  </div>
  </section>
@endsection

@section('third_party_scripts')
  

@endsection
    

    
