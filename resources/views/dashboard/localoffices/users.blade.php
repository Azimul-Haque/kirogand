@extends('layouts.app')
@section('title') ড্যাশবোর্ড | ব্যবহারকারীগণ @endsection

@section('third_party_stylesheets')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')
	@section('page-header') ব্যবহারকারীগণ (মোট {{ bangla($userscount) }} জন) @endsection
  @section('page-header-right')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">ড্যাশবোর্ড</a></li>
        <li class="breadcrumb-item active">ব্যবহারকারীগণ</li>
    </ol>
  @endsection
    <div class="container-fluid">
		  <div class="card">
          <div class="card-header">
            <h3 class="card-title">ব্যবহারকারীগণ</h3>
            {{-- <small><a href="{{ route('dashboard.userssort')  }}" style="margin-left: 5px;">সর্বোচ্চ পরীক্ষার্থী</a></small>
            <small><a href="{{ route('dashboard.expiredusers')  }}" style="margin-left: 5px;">মেয়াদোত্তীর্ণ পরীক্ষার্থী</a></small> --}}

            <div class="card-tools">
              <form class="form-inline form-group-lg" action="">
                <div class="form-group">
                  <input type="search-param" class="form-control form-control-sm" placeholder="ব্যবহারকারী খুঁজুন" id="search-param" required>
                </div>
                <button type="button" id="search-button" class="btn btn-default btn-sm" style="margin-left: 5px;">
                  <i class="fas fa-search"></i> খুঁজুন
                </button>
                {{-- <button type="button" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#addBulkDate" style="margin-left: 5px;">
                  <i class="fas fa-calendar-alt"></i> বাল্ক মেয়াদ বাড়ান
                </button> --}}
                {{-- <button type="button" class="btn btn-success btn-sm"  data-toggle="modal" data-target="#addUserModal" style="margin-left: 5px;">
                  <i class="fas fa-user-plus"></i> নতুন
                </button> --}}
              </form>
            	
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table">
              <tbody>
                <tr>
                  <th>1.</th>
                  <th>Update software</th>
                  <th>
                    <div class="progress progress-xs">
                      <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                    </div>
                  </th>
                  <th><span class="badge bg-danger">55%</span></th>
                </tr>
                @foreach($users as $user)
                	<tr>
                		<td>
                			<a href="{{ route('dashboard.users.single', $user->id) }}">{{ $user->name }}</a>
                			<br/>
                			<small class="text-black-50">{{ $user->mobile }}</small> 
                			<span class="badge @if($user->role == 'admin') bg-success @elseif($user->role == 'manager') bg-warning @else bg-info @endif">{{ checkrole($user->role) }}</span><br/>
                      <small><span>যোগদান: {{ date('d F, Y h:i A', strtotime($user->created_at)) }}</span></small><br/>
                      {{-- <small><span>প্যাকেজ: <b>{{ $user->localOffice != null ? $user->localOffice->package_expiry_date != null ? date('d F, Y', strtotime($user->localOffice->package_expiry_date)) : 'N/A' : 'N/A' }}</b></span></small> --}}
                		</td>
                    <td>
                      {{ $user->designation }}<br/>
                      {{ $user->localOffice != null ? $user->localOffice->name_bn : '' }}
                    </td>
                    <td>

                      @if ($user->authorities->isNotEmpty())
                          {{-- {{ print_r($user->authorities->first()->getAncestorsByLevel()) }} --}}
                          @php
                              $auth = $user->authorities->first();
                          @endphp
                          {{-- Display the full dynamic hierarchy string --}}
                          {{-- {!! $auth->getFullHierarchy() !!}  --}}
                          <span class="badge badge-secondary">
                              ({{ (new \ReflectionClass($auth->authority_type))->getShortName() }})
                          </span>
                      @endif

                      @php
                        $userAuthority = $user->authorities->first();

                        if ($userAuthority) {
                          // 2. Call the method to get the full hierarchy array
                          $hierarchy = $userAuthority->getAncestorsByLevel();

                          // 3. Access the specific level you need (e.g., 'District')
                          // Note: The keys are the English model names: 'Division', 'District', 'Upazila', 'Union'
                          
                          // To get the Division Model:
                          $divisionModel = $hierarchy['Division'] ?? null;

                          // To get the District Model:
                          $districtModel = $hierarchy['District'] ?? null;

                          // To get the Upazilla Model:
                          $upazilaModel = $hierarchy['Upazila'] ?? null;
                          
                          // To get the Assigned Authority Model (Union, Upazila, etc.):
                          $assignedModel = $userAuthority->authority; 
                          $level = (new \ReflectionClass($userAuthority->authority_type))->getShortName();
                          
                          // --- Displaying Data ---
                          if ($districtModel) {
                              // You can now access any column (ID, name, bn_name)
                              echo "<br/>বিভাগ: " . $divisionModel->bn_name;
                              echo ", জেলা: " . $districtModel->bn_name;
                              // echo "<br/>District ID: " . $districtModel->id;
                          }

                          if ($upazilaModel) {
                              // You can now access any column (ID, name, bn_name)
                              echo "<br/>উপজেলা: " . $upazilaModel->bn_name;
                              if($level == 'Union') {
                                echo ", ইউনিয়ন: " . $assignedModel->bn_name;
                              }
                          }
                      }
                      @endphp
                    </td>
                		<td align="right" width="15%">
                      
                      @if($user->is_active == 0)
                      <button type="button" class="btn btn-warning btn-sm edit-user-btn" data-toggle="modal" data-target="#actiavateUser{{ $user->id }}">
                        <i class="fas fa-toggle-on"></i>
                      </button>
                      @endif
                			<button type="button" class="btn btn-primary btn-sm edit-user-btn" data-toggle="modal" data-target="#editUserModal{{ $user->id }}">
                				<i class="fas fa-user-edit"></i>
                			</button>


                			{{-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteUserModal{{ $user->id }}">
                				<i class="fas fa-user-minus"></i>
                			</button> --}}
                		</td>
                        {{-- Delete User Modal Code --}}
                        {{-- Delete User Modal Code --}}
                        <!-- Modal -->
                        {{-- <div class="modal fade" id="deleteUserModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true" data-backdrop="static">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header bg-danger">
                                <h5 class="modal-title" id="deleteUserModalLabel">ব্যবহারকারী ডিলেট</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                আপনি কি নিশ্চিতভাবে এই ব্যবহারকারীকে ডিলেট করতে চান?<br/>
                                <center>
                                    <big><b>{{ $user->name }}</b></big><br/>
                                    <small><i class="fas fa-phone"></i> {{ $user->mobile }}</small>
                                </center>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ফিরে যান</button>
                                <a href="{{ route('dashboard.users.delete', $user->id) }}" class="btn btn-danger">ডিলেট করুন</a>
                              </div>
                            </div>
                          </div>
                        </div> --}}
                        {{-- Delete User Modal Code --}}
                        {{-- Delete User Modal Code --}}
                	</tr>
                    {{-- Activate User Modal Code --}}
                    {{-- Activate User Modal Code --}}
                    <!-- Modal -->
                    {{-- <div class="modal fade" id="actiavateUser{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="actiavateUserModalLabel" aria-hidden="true" data-backdrop="static">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header bg-warning">
                            <h5 class="modal-title" id="actiavateUserModalLabel">ব্যবহারকারী এক্টিভেট</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            আপনি কি নিশ্চিতভাবে এই ব্যবহারকারীকে এক্টিভেট করতে চান?<br/>
                            <center>
                                <big><b>{{ $user->name }}</b></big><br/>
                                স্থানীয় সরকার কার্যালয়: {{ $user->localOffice != null ? $user->localOffice->name_bn : '' }}
                            </center>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ফিরে যান</button>
                            <a href="{{ route('dashboard.users.activate', $user->id) }}" class="btn btn-warning">এক্টিভেট করুন</a>
                          </div>
                        </div>
                      </div>
                    </div> --}}
                    {{-- Activate User Modal Code --}}
                    {{-- Activate User Modal Code --}}
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        {{ $users->links() }}
    </div>
@endsection

@section('third_party_scripts')
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script type="text/javascript">
        $(document).on('click', '#search-button', function() {
          if($('#search-param').val() != '') {
            var urltocall = '{{ route('dashboard.users') }}' +  '/' + $('#search-param').val();
            location.href= urltocall;
          } else {
            $('#search-param').css({ "border": '#FF0000 2px solid'});
            Toast.fire({
                icon: 'warning',
                title: 'কিছু লিখে খুঁজুন!'
            })
          }
        });
        $("#search-param").keyup(function(e) {
          if(e.which == 13) {
            if($('#search-param').val() != '') {
              var urltocall = '{{ route('dashboard.users') }}' +  '/' + $('#search-param').val();
              location.href= urltocall;
            } else {
              $('#search-param').css({ "border": '#FF0000 2px solid'});
              Toast.fire({
                  icon: 'warning',
                  title: 'কিছু লিখে খুঁজুন!'
              })
            }
          }
        });
    </script>

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
                  $('#' + context + '_authority_level').val(level);
                  $('#' + context + '_authority_id').val(parentId);
                  if(context == 'edit') {
                    $('#' + context + '_authority_level' + userId).val(level);
                    $('#' + context + '_authority_id' + userId).val(parentId);
                  }
              } else {
                  // If the selected value is empty, reset the current authority level/id
                  $('#' + context + '_authority_level').val('');
                  $('#' + context + '_authority_id').val('');
                  if(context == 'edit') {
                    $('#' + context + '_authority_level' + userId).val(level);
                    $('#' + context + '_authority_id' + userId).val(parentId);
                  }
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


          // --- 3. Populate Edit Modal on Button Click ---
          $('.edit-user-btn').on('click', function() {

            // কাজ করতে হবে Populate করতে চাইলে
            // কাজ করতে হবে Populate করতে চাইলে
            // কাজ করতে হবে Populate করতে চাইলে

              const userId = $(this).data('userid');
              const userName = $(this).data('user-name');
              const userMobile = $(this).data('user-mobile');
              const userRole = $(this).data('user-role');
              const authTypeFull = $(this).data('user-authority'); // e.g., App\Models\Union
              const authId = $(this).data('user-authority-id'); // e.g., 5

              // Set basic user data
              $('#editUserForm').attr('action', `${baseUrl}/dashboard/users/${userId}`);
              $('#edit_name').val(userName);
              $('#edit_mobile').val(userMobile);
              $('#edit_user_role').val(userRole);
              
              // Reset authority fields
              $('#edit_authority_level' + userId).val('');
              $('#edit_authority_id' + userId).val('');
              
              // Reset all location dropdowns
              $('#edit_division_id'+userId).val('');
              $('#edit_district_id'+userId).prop('disabled', true).html('<option value="" selected disabled>জেলা নির্বাচন করুন</option>');
              $('#edit_upazila_id'+userId).prop('disabled', true).html('<option value="" selected disabled>উপজেলা/পৌরসভা নির্বাচন করুন</option>');
              $('#edit_union_id'+userId).prop('disabled', true).html('<option value="" selected disabled>ইউনিয়ন নির্বাচন করুন</option>');

              if (authTypeFull && authId) {
                  // Extract the model name from the full class path
                  const authLevel = authTypeFull.split('\\').pop(); // e.g., 'Union'

                  // A custom function is required here to fetch the full lineage of the authority ID
                  // For simplicity and to fit into a single response, we'll manually set the deepest level and rely on a full page reload or a more complex JS chain.

                  // In a real application, you'd send an AJAX request to fetch the parent IDs (District, Division) based on the Union/Upazila ID, and then recursively populate the dropdowns.
                  // Since that requires complex backend logic, we will mock the selection of the correct level:

                  // Mocking the selection based on the deepest available level
                  if (authLevel === 'Union') {
                      // Requires fetching Upazila -> District -> Division lineage
                      // Since we can't do that now, we'll just set the final fields and let the admin change the selection if needed.
                      // This is an area for improvement.
                      
                      // The simplest approach that works: let the admin re-select the full chain.
                      // A better approach: 
                      // 1. Fetch the Union model (via API) to get its upazila_id.
                      // 2. Fetch the Upazila model to get its district_id.
                      // 3. Fetch the District model to get its division_id.
                      // 4. Set division, load districts, set district, load upazilas, set upazila, load unions, set union.

                      // Temporary assignment for the form submission
                      $('#edit_authority_level' + userId).val(authLevel);
                      $('#edit_authority_id' + userId).val(authId);
                      
                      // Inform the user that they may need to re-select
                      console.warn(`User authority set at ${authLevel}. Please select the correct Division/District/Upazila/Union manually for full view.`);

                  } else if (authLevel === 'Upazila') {
                      $('#edit_authority_level' + userId).val(authLevel);
                      $('#edit_authority_id' + userId).val(authId);
                  } 
                  // ... handle District, Division ...
              }
          });
      });
  </script>
@endsection