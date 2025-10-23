@extends('layouts.index')
@section('title') ডিজিটাল নাগরিক - কর্তৃপক্ষ নিবন্ধন @endsection

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
          <i class="fas fa-user-plus me-3 text-info"></i> কর্তৃপক্ষ নিবন্ধন নিবন্ধন
      </h1>
      <p class="text-center lead mb-5 text-muted">স্থানীয় সরকার কর্তৃপক্ষ (ইউনিয়ন/পৌরসভা/উপজেলা পরিষদ/জেলা পরিষদ) ও কর্মকর্তা একাউন্ট নিবন্ধন ফর্ম।</p>

      <div class="row justify-content-center g-4">
          
          <!-- Left Column (Form: 8/12) -->
          <div class="col-lg-8">
              <div class="card p-4 p-md-5 form-card bg-white">
                  <!-- EDITED: Added method="POST" and action="/admin/register" for custom route targeting -->
                  <form id="adminRegistrationForm" method="POST" action="/admin/register">
                      @csrf
                      <!-- Section 1: সাধারণ তথ্য -->
                      <h2 class="h5 form-heading"><i class="fas fa-info-circle me-2"></i> সাধারণ তথ্য</h2>
                      <div class="row g-3 mb-4">
                          
                          <!-- নাম (বাংলায়) -->
                          <div class="col-md-6">
                              <label for="nameBn" class="form-label small fw-bold">নাম (বাংলায়) <span class="required-asterisk">*</span></label>
                              <input type="text" class="form-control" id="nameBn" placeholder="যেমন: আব্দুল করিম" required>
                          </div>
                          
                          <!-- নাম (ইংরেজিতে) -->
                          <div class="col-md-6">
                              <label for="nameEn" class="form-label small fw-bold">নাম (ইংরেজিতে) <span class="required-asterisk">*</span></label>
                              <input type="text" class="form-control" id="nameEn" placeholder="E.g., Abdul Karim" required>
                          </div>
                          
                          <!-- জাতীয় পরিচয়পত্র নম্বর -->
                          <div class="col-md-6">
                              <label for="nid" class="form-label small fw-bold">জাতীয় পরিচয়পত্র নম্বর <span class="required-asterisk">*</span></label>
                              <input type="text" class="form-control" id="nid" placeholder="১১/১৭ সংখ্যার এনআইডি" required pattern="[0-9]{10,17}" title="অনুগ্রহ করে সঠিক এনআইডি নম্বর দিন।">
                          </div>
                          
                          <!-- মোবাইল নম্বর -->
                          <div class="col-md-6">
                              <label for="mobile" class="form-label small fw-bold">মোবাইল নম্বর <span class="required-asterisk">*</span></label>
                              <div class="input-group">
                                  <span class="input-group-text">+৮৮</span>
                                  <input type="tel" class="form-control" id="mobile" placeholder="১১ ডিজিটের মোবাইল নম্বর" required maxlength="11" pattern="[0-9]{11}" title="১১ ডিজিটের মোবাইল নম্বর দিন।">
                              </div>
                          </div>

                          <!-- ইমেইল এড্রেস -->
                          <div class="col-md-6">
                              <label for="email" class="form-label small fw-bold">ইমেইল এড্রেস <span class="required-asterisk">*</span></label>
                              <input type="email" class="form-control" id="email" placeholder="example@gov.bd" required>
                          </div>
                          
                          <!-- একাউন্ট ধরন -->
                          <div class="col-md-6">
                              <label for="accountType" class="form-label small fw-bold">পদবি <span class="required-asterisk">*</span></label>
                              <select id="accountType" class="form-select" required>
                                  <option value="" selected disabled>পদবি নির্বাচন করুন</option>
                                  <option value="চেয়ারম্যান">ইউনিয়ন চেয়ারম্যান</option>
                                  <option value="সচিব">ইউনিয়ন সচিব</option>
                                  <option value="সহকারী">ইউনিয়ন সহকারী</option>
                                  <option value="মেয়র">মেয়র</option>
                                  <option value="কাউন্সিলর">কাউন্সিলর</option>
                                  <option value="সচিব">পৌর সচিব</option>
                              </select>
                          </div>
                      </div>

                      <!-- Section 2: অফিস তথ্য -->
                      <h2 class="h5 form-heading mt-4"><i class="fas fa-building me-2"></i> অফিস তথ্য</h2>
                      <div class="row g-3 mb-4">
                          
                          <!-- কর্তৃপক্ষের ধরণ -->
                          <div class="col-md-12">
                              <label for="authorityType" class="form-label small fw-bold">কর্তৃপক্ষের ধরণ <span class="required-asterisk">*</span></label>
                              <select id="authorityType" class="form-select" required>
                                  <option value="" selected disabled>কর্তৃপক্ষের ধরণ নির্বাচন করুন</option>
                                  <option value="up">ইউনিয়ন পরিষদ</option>
                                  <option value="poura">পৌরসভা</option>
                                  <option value="upazila">উপজেলা পরিষদ</option>
                                  <option value="district">জেলা পরিষদ</option>
                              </select>
                          </div>

                          <!-- DYNAMIC AUTHORITY FIELDS -->
                          <input type="hidden" name="authority_level" id="add_authority_level">
                          <input type="hidden" name="authority_id" id="add_authority_id">
                          
                          <!-- বিভাগ -->
                          <div class="col-md-6">
                              <label for="add_division_id" class="form-label small fw-bold">বিভাগ <span class="required-asterisk">*</span></label>
                              <select id="add_division_id" class="form-select authority-select" data-level="Division" data-target="add_district_id" data-model="District" required>
                                  <option value="" selected disabled>বিভাগ নির্বাচন করুন</option>
                                  @foreach ($divisions as $division)
                                      <option value="{{ $division->id }}" data-level-name="Division">{{ $division->bn_name }}</option>
                                  @endforeach
                              </select>
                          </div>

                          <!-- জেলা -->
                          <div class="col-md-6">
                              <label for="add_district_id" class="form-label small fw-bold">জেলা <span class="required-asterisk">*</span></label>
                              <select id="add_district_id" class="form-select authority-select" data-level="District" data-target="add_upazila_id" data-model="Upazila" disabled>
                                  <option value="" selected disabled>জেলা নির্বাচন করুন</option>
                              </select>
                          </div>
                          
                          <!-- থানা / উপজেলা -->
                          <div class="col-md-6">
                              <label for="add_upazila_id" class="form-label small fw-bold">থানা / উপজেলা <span class="required-asterisk">*</span></label>
                              <select id="add_upazila_id" class="form-select authority-select" data-level="Upazila" data-target="add_union_id" data-model="Union" disabled>
                                  <option value="" selected disabled>উপজেলা/পৌরসভা নির্বাচন করুন</option>
                              </select>
                          </div>

                          <!-- NEW FIELD: ইউনিয়ন -->
                          <div class="col-md-6">
                              <label for="add_union_id" class="form-label small fw-bold">ইউনিয়ন <span class="required-asterisk">*</span></label>
                              <select id="add_union_id" class="form-select authority-select" data-level="Union" data-target="" data-model="" disabled>
                                  <option value="" selected disabled>ইউনিয়ন নির্বাচন করুন</option>
                              </select>
                          </div>
                          
                          <!-- কর্তৃপক্ষ অফিসের নাম (Specific Office/Designation) -->
                          <div class="col-md-12">
                              <label for="office_name" class="form-label small fw-bold">কর্তৃপক্ষ অফিসের নাম (কার্যালয়) <span class="required-asterisk">*</span></label>
                              <input type="text" class="form-control" id="office_name" placeholder="২নং নেকমরদ ইউনিয়ন পরিষদ/ ভৈরব পৌরসভা ইত্যাদি" required>
                          </div>
                      </div>
                      
                      <!-- Section 3: নিরাপত্তা তথ্য -->
                      <h2 class="h5 form-heading mt-4"><i class="fas fa-lock me-2"></i> পাসওয়ার্ড তৈরি</h2>
                      <div class="row g-3 mb-4">
                          <!-- পাসওয়ার্ড -->
                          <div class="col-md-6">
                              <label for="password" class="form-label small fw-bold">পাসওয়ার্ড <span class="required-asterisk">*</span></label>
                              <input type="password" class="form-control" id="password" required minlength="8" placeholder="ন্যূনতম ৮ অক্ষরের পাসওয়ার্ড">
                          </div>
                          
                          <!-- কনফার্ম পাসওয়ার্ড -->
                          <div class="col-md-6">
                              <label for="confirmPassword" class="form-label small fw-bold">কনফার্ম পাসওয়ার্ড <span class="required-asterisk">*</span></label>
                              <input type="password" class="form-control" id="confirmPassword" required placeholder="পাসওয়ার্ড পুনরায় লিখুন">
                          </div>

                          <div class="col-md-6">
                            <div class="row">
                              <div class="col-md-6">
                                <label for="captcha" class="form-label small fw-bold">কনফার্ম পাসওয়ার্ড <span class="required-asterisk">*</span></label>
                                <img src="{{ route('captcha.image') }}" alt="Captcha Text" style="height: auto; width: 150px;">
                              </div>
                              <div class="col-md-6">
                                <label for="confirmPassword" class="form-label small fw-bold">কনফার্ম পাসওয়ার্ড <span class="required-asterisk">*</span></label>
                                <input type="text" class="form-control" name="captcha" placeholder="Write the Captcha" required="">
                              </div>
                            </div>
                          </div>
                      </div>

                      
                      <!-- Section 4: সম্মতি -->
                      <div class="form-check mb-4">
                          <input class="form-check-input" type="checkbox" value="" id="policyCheck" required>
                          <label class="form-check-label small" for="policyCheck">
                              আমি <a href="{{ route('index.terms-and-conditions') }}" class="text-primary fw-bold">প্রশাসনিক নীতিমালার</a> সাথে একমত পোষণ করছি <span class="required-asterisk">*</span>
                          </label>
                      </div>
                      
                      <!-- Submit Button -->
                      <button type="submit" class="btn btn-success btn-lg w-100 rounded-pill fw-bold"><i class="fas fa-user-plus me-2"></i> নিবন্ধন করুন</button>
                  </form>
              </div>
          </div>
          
          <!-- Right Column (Instructions: 4/12) -->
          <div class="col-lg-4">
              <div class="guideline-card h-100">
                  <h4 class="h5 fw-bold text-darker mb-3"><i class="fas fa-bullhorn me-2 text-primary"></i> নির্দেশিকা ও সতর্কতা</h4>
                  
                  <div class="mb-4">
                      <h6 class="fw-bold text-darker mb-2">আবশ্যিক তথ্যাদি:</h6>
                      <ul class="list-unstyled small">
                          <li class="mb-1"><i class="fas fa-check-circle me-2 text-success"></i> <span class="required-asterisk">(*)</span> চিহ্নিত ক্ষেত্রগুলি পূরণ করা বাধ্যতামূলক।</li>
                          <li class="mb-1"><i class="fas fa-check-circle me-2 text-success"></i> আপনার সঠিক ও সম্পূর্ণ ১১ ডিজিটের মোবাইল নম্বর পূরণ করুন।</li>
                          <li class="mb-1"><i class="fas fa-check-circle me-2 text-success"></i> অনুগ্রহ করে সঠিক নাম্বার প্রদান করুন, কারণ এটি অ্যাকাউন্টের জন্য ব্যবহার হবে।</li>
                      </ul>
                  </div>

                  <div class="mb-4">
                      <h6 class="fw-bold text-darker mb-2">যাচাইকরণ প্রক্রিয়া:</h6>
                      <p class="small mb-2">
                          তথ্য জমা দেওয়ার পর একটি **যাচাইকরণ কোড** প্রদানকৃত মোবাইল নম্বর অথবা ইমেইল এড্রেসে পাঠানো হবে। এই কোডটি দিয়ে আপনার অ্যাকাউন্টের সত্যতা যাচাই করা হবে।
                      </p>
                      <p class="small fw-bold text-danger">অনুগ্রহ করে সঠিক তথ্য প্রদান করুন।</p>
                  </div>
                  
                  <hr class="border-primary opacity-50">
                  
                  <!-- জরুরী প্রয়োজনে -->
                  <div class="mt-4">
                      <h6 class="fw-bold text-darker mb-2"><i class="fas fa-headset me-2 text-danger"></i> জরুরী প্রয়োজনে</h6>
                      <p class="small mb-2">
                          যদি আপনি কোনো সমস্যার সম্মুখীন হোন অথবা আপনার কোনো জিজ্ঞাসা থাকলে আমাদের সাপোর্ট টিমের সাথে যোগাযোগ করতে পারেন।
                      </p>
                      <a href="{{ route('index.contact') }}" class="btn btn-sm btn-outline-danger w-100 rounded-pill mt-2">
                          <i class="fas fa-phone-alt me-2"></i> যোগাযোগ করতে এখানে ক্লিক করুন
                      </a>
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
    

    
