@extends('layouts.index')
@section('title') ডিজিটাল নাগরিক - সনদ যাচাই @endsection

@section('third_party_stylesheets')
  <style>
    .result-success {
        border-left: 5px solid #28a745;
        background-color: #e8f5e9;
    }
    .result-failure {
        border-left: 5px solid #dc3545;
        background-color: #fce4ec;
    }

    .card-header-custom {
        background-color: #007bff; /* Primary color - Bootstrap Blue */
        color: white;
        font-weight: 700;
    }
    /* Ensure Bangla text uses the correct display rules */
    .text-bn {
        direction: ltr; /* Ensure left-to-right display for Bangla content */
    }
    /* Custom class for rounded corners slightly larger than default */
    .rounded-xl {
        border-radius: 1rem !important; 
    }
  </style>
@endsection

@section('content')
  <!-- Services List Section (Dynamic Show/Hide Logic) -->
  <section id="services" class="service-section section-gap">
    <div class="container">
      <h1 class="text-center display-6 fw-bold mb-5" style="color: var(--darker-color);"><i class="@if(isset($certificate)) fas fa-check-circle me-3  text-success @else fas fa-times-circle me-3 text-danger @endif"></i> সনদপত্র যাচাই ফলাফল</h1>
      
      <!-- Centered Row for 6-Column Form -->
      <div class="row @if(!isset($certificate)) justify-content-center @endif">
          <!-- Applies 6-column width on large screens and 8-column on medium screens -->
          <div class="@if(!isset($certificate)) col-md-6 col-lg-6 @else col-md-4 col-lg-4 @endif "> 
              <!-- Verification Form Card -->
              <div class="card p-4 p-md-5 shadow-lg rounded-3">
                  <div class="card-body">
                      
                      <div class="mb-5 text-center">
                          <span for="verificationInput" class="fw-bold h4">
                            <i class="@if(isset($certificate)) fas fa-check-circle me-3  text-success @else fas fa-times-circle me-3 text-danger @endif"></i>
                            @if(isset($certificate))
                              <span class="text-success">সনদটি বৈধ!</span>
                            @else
                              <span class="text-danger">সনদটি জাল!</span>
                            @endif
                          </span>
                      </div>

                      <p class="lead text-muted mb-4 text-center">
                        @if(isset($certificate))
                          সনদটি যাচাই করে এর সত্যতা পাওয়া গিয়েছে।
                        @else
                          সনদটি যাচাই করে এর সত্যতা পাওয়া যায়নি!
                        @endif
                        
                      </p>
                      
                      
                  </div>
              </div>
          </div>
          @if(isset($certificate))
            <div class="col-12 col-md-8 col-lg-8 p-3">
                            
                <!-- Card to display the verified data -->
                <div id="dataCard" class="card shadow-lg border-0 rounded-xl">
                    <div class="card-header card-header-custom rounded-top-xl py-3 px-4">
                        <h5 class="mb-0 text-white d-flex align-items-center">
                            <!-- Bootstrap Icon Placeholder (Check Circle) -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill me-2" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.429 10.47l-1.63-1.63a.75.75 0 1 0-1.06 1.06l2.17 2.17a.75.75 0 0 0 1.08-.022l4.5-5.5a.75.75 0 0 0-.022-1.08z"/>
                            </svg>
                            যাচাই সফল: উত্তরাধিকারী সনদের বিবরণ
                        </h5>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <p class="text-success fw-bold text-center mb-4 text-xl">
                            সনদ নম্বর: <span id="certIdDisplay" class="text-decoration-underline text-primary"></span>
                        </p>
                        
                        <!-- Main Details List (Bootstrap List Group) -->
                        <ul class="list-group list-group-flush border rounded-lg mb-4">
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3 bg-light">
                                <span class="fw-semibold text-gray-700">মৃত ব্যক্তি:</span>
                                <span id="deceasedNameDisplay" class="text-primary fw-bold text-bn"></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                <span class="fw-semibold text-gray-700">জারির তারিখ:</span>
                                <span id="issueDateDisplay" class="text-dark text-bn"></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3 bg-light">
                                <span class="fw-semibold text-gray-700">বর্তমান অবস্থা:</span>
                                <span id="statusDisplay" class="badge bg-success text-white px-3 py-2 rounded-pill text-bn"></span>
                            </li>
                        </ul>

                        <!-- HEIR LIST SECTION (Bootstrap Table) -->
                        <h6 class="text-lg font-bold text-gray-800 mb-3 border-bottom pb-2">বৈধ উত্তরাধিকারীদের তালিকা</h6>
                        <div id="heirsListContainer" class="table-responsive">
                            <!-- Heir list table will be generated here by JavaScript -->
                        </div>
                        
                        <div class="mt-4">
                            <div class="fw-semibold text-gray-700 mb-2">সংযুক্ত ভূমি রেকর্ড:</div>
                            <p id="landRecordsDisplay" class="alert alert-info mb-0 p-3 text-bn"></p>
                        </div>
                    </div>
                    
                    <div class="card-footer text-center text-muted py-3">
                        তথ্য জাতীয় রেকর্ড ডেটাবেস থেকে পুনরুদ্ধার করা হয়েছে।
                    </div>
                </div>
            </div>
            @endif
      </div>
    </div>
  </section>
@endsection

@section('third_party_scripts')
  

@endsection
    

    
