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
  </style>
@endsection

@section('content')
  <!-- Services List Section (Dynamic Show/Hide Logic) -->
  <section id="services" class="service-section section-gap">
    <div class="container">
      <h1 class="text-center display-6 fw-bold mb-5" style="color: var(--darker-color);"><i class="@if(isset($certificate)) fas fa-check-circle me-3  text-success @else fas fa-times-circle me-3 text-danger @endif"></i> সনদপত্র যাচাই ফলাফল</h1>
      
      <!-- Centered Row for 6-Column Form -->
      <div class="row justify-content-center">
          <!-- Applies 6-column width on large screens and 8-column on medium screens -->
          <div class="col-md-8 col-lg-8"> 
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
                          <span class="text-danger">সনদটি জাল!</span>
                        @endif
                        
                      </p>
                      
                      
                  </div>
              </div>
          </div>
      </div>
    </div>
  </section>
@endsection

@section('third_party_scripts')
  

@endsection
    

    
