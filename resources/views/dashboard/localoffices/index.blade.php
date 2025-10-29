@extends('layouts.app')
@section('title') ড্যাশবোর্ড | ইউনিয়ন/পৌরসভা @endsection

@section('third_party_stylesheets')
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css"> --}}

    <style>
    

    </style>
@endsection

@section('content')
  @section('page-header') ইউনিয়ন/পৌরসভা @endsection
    <div class="container-fluid">
      <div class="card">
          <div class="card-header">
            <h3 class="card-title">ইউনিয়ন/পৌরসভা তালিকা (মোট: {{ $localofficescount }})</h3>

            <div class="card-tools">
              {{-- <button type="button" class="btn btn-success btn-sm"  data-toggle="modal" data-target="#addPackageModal" title="" rel="tooltip" data-original-title="ইউনিয়ন/পৌরসভা যোগ করুন">
                <i class="fas fa-clipboard-check"></i> নতুন ইউনিয়ন/পৌরসভা
              </button> --}}
              <div class="card-tools">
                <form class="form-inline form-group-lg" action="">
                  <div class="form-group">
                    <input type="search-param" class="form-control form-control-sm" placeholder="ইউনিয়ন/পৌরসভা খুঁজুন" id="search-param" required>
                  </div>
                  <button type="button" id="search-button" class="btn btn-default btn-sm" style="margin-left: 5px;">
                    <i class="fas fa-search"></i> খুঁজুন
                  </button>
                </form>
                
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table">
              <thead>
                <thead>
                  <th>কার্যালয়</th>
                  <th>অবস্থা</th>
                  <th>ধরন</th>
                  <th>ব্যবহারকারীগণ</th>
                  <th>যোগদান</th>
                  <th>একশন</th>
                </thead>
              </thead>
              <tbody>
                @foreach($localoffices as $localoffice)
                  <tr>
                    <td>
                      {{ $localoffice->name_bn }}</br>
                      <span class="badge badge-primary">📞 {{ $localoffice->phone }}</span>
                      <span class="badge badge-warning">✉ {{ $localoffice->email }}</span>
                    </td>
                    <td>
                      <span class="badge badge-{{ $localoffice->is_active == 0 ? 'light' : 'success' }}">{{ $localoffice->is_active == 0 ? 'এক্টিভ নয়' : 'একটিভ' }}</span><br/>
                      <small><span>প্যাকেজ: <b>{{$localoffice->package_expiry_date != null ? date('d F, Y', strtotime($localoffice->package_expiry_date)) : 'N/A' }}</b></span></small>
                    </td>
                    <td>{{ $localoffice->office_type == 'up' ? 'ইউনিয়ন পরিষদ' : 'পৌরসভা' }}</td>
                    <td>
                      @foreach($localoffice->users as $user)
                        {{ $user->name }}
                      @endforeach
                    </td>
                    <td><small>{{ date('F d, Y', strtotime($localoffice->created_at)) }}</small></td>
                    <td>
                      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editLocalOfficeModal{{ $localoffice->id }}">
                        <i class="fas fa-pen"></i>
                      </button>
                    </td>
                  </tr>
                  {{-- Edit Modal Code --}}
                  {{-- Edit Modal Code --}}
                  <!-- Modal -->
                  <div class="modal fade" id="editLocalOfficeModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editLocalOfficeModalLabel" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header bg-primary">
                          <h5 class="modal-title" id="editLocalOfficeModalLabel">ব্যবহারকারী তথ্য হালনাগাদ</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form method="post" action="{{ route('dashboard.users.update', $user->id) }}">
                          <div class="modal-body">
                            
                                @csrf

                                <div class="input-group mb-3">
                                    <input type="text"
                                           name="name"
                                           class="form-control"
                                           value="{{ $user->name }}"
                                           placeholder="নাম" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-user"></span></div>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <input type="text"
                                           name="mobile"
                                           value="{{ $user->mobile }}"
                                           autocomplete="off"
                                           class="form-control"
                                           placeholder="মোবাইল নম্বর (১১ ডিজিট)" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-phone"></span></div>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <input type="text"
                                           name="uid"
                                           value="{{ $user->uid }}"
                                           autocomplete="off"
                                           class="form-control"
                                           placeholder="Firebase UID">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-server"></span></div>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <input type="text"
                                           name="onesignal_id"
                                           value="{{ $user->onesignal_id }}"
                                           autocomplete="off"
                                           class="form-control"
                                           placeholder="Onesignal Player ID">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-bell"></span></div>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                  <select name="role" class="form-control" required>
                                    <option disabled="" value="">ধরন নির্ধারণ করুন</option>
                                    <option value="admin" @if($user->role == 'admin') selected="" @endif>এডমিন</option>
                                    <option value="manager" @if($user->role == 'manager') selected="" @endif>স্থানীয় সরকার প্রতিনিধি</option>
                                    {{-- <option value="volunteer" @if($user->role == 'volunteer') selected="" @endif>ভলান্টিয়ার</option> --}}
                                    <option value="user" @if($user->role == 'user') selected="" @endif>ব্যবহারকারী</option>
                                    {{-- <option value="accountant" @if($user->role == 'accountant') selected="" @endif>একাউন্টেন্ট</option> --}}
                                  </select>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-user-secret"></span></div>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <input type="text"
                                           name="designation"
                                           value="{{ $user->designation }}"
                                           autocomplete="off"
                                           class="form-control"
                                           placeholder="পদবি (প্রশাসক/মেয়র/চেয়ারম্যান/সচিব ইত্যাদি, যদি থাকে)">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-user-secret"></span></div>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <input type="text"
                                           name="packageexpirydate"
                                           id="packageexpirydate{{ $user->id }}" 
                                           value="{{ date('F d, Y', strtotime($user->package_expiry_date)) }}"
                                           autocomplete="off"
                                           class="form-control"
                                           placeholder="প্যাকেজের মেয়াদ বৃদ্ধি" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-calendar-check"></span></div>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <input type="password"
                                           name="password"
                                           class="form-control"
                                           autocomplete="new-password"
                                           placeholder="পাসওয়ার্ড (ঐচ্ছিক)">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                                    </div>
                                </div>

                                <hr class="my-4">
                                <h6 class="mb-3">কর্তৃপক্ষ (Authority) নির্ধারণ (ঐচ্ছিক)</h6>
                                
                                <!-- DYNAMIC AUTHORITY FIELDS FOR EDIT -->
                                <input type="hidden" name="authority_level" id="edit_authority_level{{ $user->id }}">
                                <input type="hidden" name="authority_id" id="edit_authority_id{{ $user->id }}">

                                <div class="row">
                                  <div class="col-md-6">
                                    <!-- Division Dropdown (Level 1) -->
                                      <div class="input-group mb-3">
                                          <select id="edit_division_id{{ $user->id }}" class="form-control authority-select" data-userid="{{ $user->id }}" data-level="Division" data-target="edit_district_id{{ $user->id }}" data-model="District">
                                              <option value="" selected disabled>বিভাগ নির্বাচন করুন</option>
                                              @foreach ($divisions as $division)
                                                  <option value="{{ $division->id }}" data-level-name="Division">{{ $division->bn_name }}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                    <!-- District Dropdown (Level 2) -->
                                    <div class="input-group mb-3">
                                        <select id="edit_district_id{{ $user->id }}" class="form-control authority-select" data-userid="{{ $user->id }}" data-level="District" data-target="edit_upazila_id{{ $user->id }}" data-model="Upazila" disabled>
                                            <option value="" selected disabled>জেলা নির্বাচন করুন</option>
                                        </select>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-6">
                                    <!-- Upazila Dropdown (Level 3 - Can be Municipality Authority) -->
                                    <div class="input-group mb-3">
                                        <select id="edit_upazila_id{{ $user->id }}" class="form-control authority-select" data-userid="{{ $user->id }}" data-level="Upazila" data-target="edit_union_id{{ $user->id }}" data-model="Union" disabled>
                                            <option value="" selected disabled>উপজেলা/পৌরসভা নির্বাচন করুন</option>
                                        </select>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <!-- Union Dropdown (Level 4) -->
                                    <div class="input-group mb-3">
                                        <select id="edit_union_id{{ $user->id }}" class="form-control authority-select" data-userid="{{ $user->id }}" data-level="Union" data-target="" data-model="" disabled>
                                            <option value="" selected disabled>ইউনিয়ন নির্বাচন করুন</option>
                                        </select>
                                    </div>
                                    <!-- END DYNAMIC AUTHORITY FIELDS -->
                                  </div>
                                </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ফিরে যান</button>
                            <button type="submit" class="btn btn-primary">দাখিল করুন</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  {{-- Edit Modal Code --}}
                  {{-- Edit Modal Code --}}
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        {{ $localoffices->links() }}
    </div>
@endsection

@section('third_party_scripts')
  {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
  <script type="module">

    $(document).on('click', '#search-button', function() {
      if($('#search-param').val() != '') {
        var urltocall = '{{ route('dashboard.local-offices') }}' +  '/' + $('#search-param').val();
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
          var urltocall = '{{ route('dashboard.local-offices') }}' +  '/' + $('#search-param').val();
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
@endsection