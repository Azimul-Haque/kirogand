@extends('layouts.index')
@section('title') ডিজিটাল নাগরিক - যোগাযোগ @endsection

@section('third_party_stylesheets')
  <style>
    .notice-card {
        background-color: var(--white-bg);
        border-left: 5px solid var(--primary-color);
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
  </style>
@endsection

@section('content')
  <!-- Services List Section (Dynamic Show/Hide Logic) -->
  <section id="services" class="service-section section-gap">
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


            <div class="col-lg-6">
                <div class="p-4 p-md-5 verification-card">
                    <h2 class="h3 fw-bold text-center mb-4" style="color: var(--darker-color);">
                        <i class="fas fa-shield-alt me-2 text-primary"></i> দ্রুত সনদ যাচাই
                    </h2>
                    <p class="text-center text-muted mb-4">সনদপত্রের সত্যতা যাচাই করতে সনদ নম্বর ও QR কোড ব্যবহার করুন।</p>
                    
                    <form action="certificate_verify.html" method="GET" class="row g-3">
                        <div class="col-md-7">
                            <label for="certificateNumber" class="form-label fw-bold">সনদপত্রের নম্বর</label>
                            <input type="text" class="form-control form-control-lg" id="certificateNumber" name="cert_id" placeholder="সনদপত্র নম্বরটি এখানে লিখুন" required>
                        </div>
                        <div class="col-md-5 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill fw-bold">
                                <i class="fas fa-search me-2"></i> যাচাই করুন
                            </button>
                        </div>
                    </form>
                    <p class="text-center small mt-3 mb-0">বিস্তারিত যাচাইয়ের জন্য <a href="{{ route('index.verify-certificate') }}" class="text-info fw-bold">সনদ যাচাই পেজে</a> যান।</p>
                </div>
            </div>

        </div>
    </div>
  </section>
@endsection

@section('third_party_scripts')
  

@endsection
    

    
