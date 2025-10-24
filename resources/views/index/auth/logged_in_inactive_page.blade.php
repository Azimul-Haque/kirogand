@extends('layouts.index')
@section('title') ডিজিটাল নাগরিক - কর্তৃপক্ষ নিবন্ধন সফল @endsection

@section('third_party_stylesheets')
  <style>
    /* Form Specific Styles */
    .form-card {
        border-left: 5px solid var(--light-primary-color);
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        height: 100%; /* Ensure card matches guideline height */
    }
    .guideline-card {
        background-color: #e3f2fd; /* Light blue background */
        border-radius: 12px;
        padding: 25px;
        border: 1px solid #cce5ff;
    }
    .form-heading {
        color: var(--darker-color);
        border-bottom: 2px solid var(--primary-color);
        padding-bottom: 10px;
        margin-bottom: 20px;
    }
    .required-asterisk {
        color: #dc3545; /* Red for emphasis */
        font-weight: bold;
    }

    /* Responsive Layout Adjustments */
    @media (max-width: 991.98px) {
        .guideline-card {
            margin-top: 30px;
        }
    }
  </style>
@endsection

@section('content')
  <!-- Services List Section (Dynamic Show/Hide Logic) -->
  <section id="services" class="service-section section-gap">
    <div class="container">
      <!-- Title for Registration Page -->
      <h1 class="text-center display-6 fw-bold mb-4" style="color: var(--darker-color);">
          <i class="fas fa-user-plus me-3 text-info"></i> কর্তৃপক্ষ নিবন্ধন সফল
      </h1>
      <p class="text-center lead mb-5 text-muted">স্থানীয় সরকার কর্তৃপক্ষ (ইউনিয়ন/পৌরসভা/উপজেলা পরিষদ/জেলা পরিষদ) ও কর্মকর্তা একাউন্ট নিবন্ধন</p>

      <div id="resultContainer" class="mt-5 d-none">
          <h2 class="h3 fw-bold mb-4 text-center" style="color: var(--darker-color);">যাচাইয়ের ফলাফল</h2>
          <div class="row justify-content-center">
              <div class="col-md-8 col-lg-6">
                  <div id="verificationResult" class="card p-4 p-md-5 border-0 shadow-lg rounded-3">
                      <!-- Result content will be injected here -->
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
        const csrfToken = '{{ csrf_token() }}';
        const baseUrl = '{{ url('/') }}';

        // --- 1. Dynamic Location Loading Function ---
        function loadLocations(selector, parentId, targetSelector, modelName) {
            const $targetSelect = $(targetSelector);
            $targetSelect.html('<option value="">লোড হচ্ছে...</option>').prop('disabled', true);

            if (!parentId) {
                // Clear and disable downstream if parentId is empty
                $targetSelect.html('<option value="" selected disabled>নির্বাচন করুন</option>').prop('disabled', true);
                // Recursively clear further downstream if needed (e.g., clearing Upazila if District changes to empty)
                if (modelName === 'District') {
                    $('#' + $(selector).data('target')).html('<option value="" selected disabled>নির্বাচন করুন</option>').prop('disabled', true);
                    $('#' + $('#' + $(selector).data('target')).data('target')).html('<option value="" selected disabled>নির্বাচন করুন</option>').prop('disabled', true);
                } else if (modelName === 'Upazila') {
                    $('#' + $(selector).data('target')).html('<option value="" selected disabled>নির্বাচন করুন</option>').prop('disabled', true);
                }
                return;
            }

            let routeSegment = '';
            if (modelName === 'District') routeSegment = 'districts/';
            else if (modelName === 'Upazila') routeSegment = 'upazilas/';
            else if (modelName === 'Union') routeSegment = 'unions/';

            $.ajax({
                url: `${baseUrl}/api/location/${routeSegment}${parentId}`,
                method: 'GET',
                success: function(data) {
                    $targetSelect.empty();
                    $targetSelect.append('<option value="" selected disabled>নির্বাচন করুন</option>');
                    $.each(data, function(id, name) {
                        $targetSelect.append(`<option value="${id}">${name}</option>`);
                    });
                    $targetSelect.prop('disabled', false);
                },
                error: function() {
                    $targetSelect.html('<option value="">লোড করতে ব্যর্থ</option>').prop('disabled', true);
                    console.error('Failed to load locations for ' + modelName);
                }
            });
        }

        // --- 2. Change Event Listener (Cascading Dropdowns) ---
        // Applies to both Add and Edit modals
        $(document).on('change', '.authority-select', function() {
            const userId = $(this).data('userid');
            const parentId = $(this).val();
            const targetId = $(this).data('target');
            const modelName = $(this).data('model');
            const level = $(this).data('level');
            const context = $(this).attr('id').startsWith('add') ? 'add' : 'edit';
            
            // 2a. Update the hidden authority_level/authority_id fields

            if (parentId) {
                $('#add_authority_level').val(level);
                $('#add_authority_id').val(parentId);
            } else {
                // If the selected value is empty, reset the current authority level/id
                $('#add_authority_level').val('');
                $('#add_authority_id').val('');
            }
            
            // 2b. Load the next level of locations
            if (targetId) {
                // Clear the authority selection for downstream models when a parent changes
                $('#' + targetId).prop('disabled', true).html('<option value="" selected disabled>নির্বাচন করুন</option>');
                
                // Clear any selections two levels down (for District -> Union clearing)
                const grandTargetId = $('#' + targetId).data('target');
                if (grandTargetId) {
                    $('#' + grandTargetId).prop('disabled', true).html('<option value="" selected disabled>নির্বাচন করুন</option>');
                }

                if (parentId && modelName) {
                  loadLocations('#' + $(this).attr('id'), parentId, '#' + targetId, modelName);
                }
            }
        });
      });
  </script>

@endsection
    

    
