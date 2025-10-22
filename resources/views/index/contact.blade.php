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
      <h1 class="text-center display-6 fw-bold mb-5" style="color: var(--darker-color);"><i class="fas fa-bullhorn me-3 text-primary"></i> যোগাযোগ ও সহায়তা</h1>
        <div class="row g-5 align-items-center">
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
  

@endsection
    

    
