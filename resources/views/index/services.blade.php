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
  <script>
      $(document).ready(function() {
          const defaultVisible = 500; // 12 services visible by default
          const $serviceContainers = $('.service-box-container');
          const $showMoreBtn = $('#showMoreServicesBtn');

          

          // 3. Service Filtering Logic (Works on ALL 40 services)
          $('#serviceSearch').on('keyup', function() {
              var searchText = $(this).val().toLowerCase();

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
    

    
