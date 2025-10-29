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
                      <span class="badge badge-primary">📞 {{ $localoffice->mobile }}</span>
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
                  <div class="modal fade" id="editLocalOfficeModal{{ $localoffice->id }}" tabindex="-1" role="dialog" aria-labelledby="editLocalOfficeModalLabel" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header bg-primary">
                          <h5 class="modal-title" id="editLocalOfficeModalLabel">ব্যবহারকারী তথ্য হালনাগাদ</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form method="post" action="{{ route('dashboard.users.update', $localoffice->id) }}">
                          <div class="modal-body">
                            @php
                              $userAuthority = $localOffice->user->authorities->first();

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
                            
                                @csrf

                                <div class="input-group mb-3">
                                    <input type="text"
                                           name="name_bn"
                                           class="form-control"
                                           value="{{ $localoffice->name_bn }}"
                                           placeholder="নাম" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-user"></span></div>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <input type="text"
                                           name="name"
                                           class="form-control"
                                           value="{{ $localoffice->name }}"
                                           placeholder="নাম" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-user"></span></div>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <input type="text"
                                           name="mobile"
                                           value="{{ $localoffice->mobile }}"
                                           autocomplete="off"
                                           class="form-control"
                                           placeholder="মোবাইল নম্বর (১১ ডিজিট)" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-phone"></span></div>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <input type="email"
                                           name="email"
                                           value="{{ $localoffice->email }}"
                                           autocomplete="off"
                                           class="form-control"
                                           placeholder="অফিস ইমেইল এড্রেস">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                  <select name="office_type" class="form-control" required>
                                    <option disabled="" value="">ধরন নির্ধারণ করুন</option>
                                    <option value="up" @if($localoffice->office_type == 'up') selected="" @endif>ইউনিয়ন পরিষদ</option>
                                    <option value="poura" @if($localoffice->office_type == 'poura') selected="" @endif>পৌরসভা</option>
                                  </select>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-landmark"></span></div>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <input type="text"
                                           name="packageexpirydate"
                                           id="packageexpirydate{{ $localoffice->id }}" 
                                           value="{{ date('F d, Y', strtotime($localoffice->package_expiry_date)) }}"
                                           autocomplete="off"
                                           class="form-control"
                                           placeholder="প্যাকেজের মেয়াদ বৃদ্ধি" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-calendar-check"></span></div>
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