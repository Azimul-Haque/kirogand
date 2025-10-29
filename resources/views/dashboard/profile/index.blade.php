@extends('layouts.app')
@section('title') ড্যাশবোর্ড | প্রোফাইল @endsection

@section('third_party_stylesheets')
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datepicker.min.css') }}">

    <style>
    

    </style>
@endsection

@section('content')
  @section('page-header') প্রোফাইল @endsection
    <div class="container-fluid">
      <div class="row">
        <!-- ============================================= -->
        <!-- COLUMN 1: আমার তথ্য (My Information) - col-md-6 -->
        <!-- ============================================= -->
        <div class="col-md-6">
            <!-- Card for My Information Form -->
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-user-circle mr-1"></i> আমার তথ্য</h3>
                </div>
                <!-- Form: My Information -->
                <form action="{{ route('dashboard.profile.update.user', Auth::user()->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="POST">
                    <div class="card-body">
                        
                        <!-- Row 1: Name (Bengali & English) -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input type="text"
                                           name="name"
                                           class="form-control"
                                           value="{{ Auth::user()->name }}"
                                           placeholder="নাম" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-user"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input type="text"
                                           name="name_en"
                                           class="form-control"
                                           value="{{ Auth::user()->name_en }}"
                                           placeholder="ইংরেজি নাম (OPTIONAL)">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-user"></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Row 2: Mobile & Email -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input type="text"
                                           name="mobile"
                                           value="{{ Auth::user()->mobile }}"
                                           autocomplete="off"
                                           class="form-control"
                                           placeholder="আপনার মোবাইল নম্বর (১১ ডিজিট)" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-phone"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input type="email"
                                           name="email"
                                           value="{{ Auth::user()->email }}"
                                           autocomplete="off"
                                           class="form-control"
                                           placeholder="আপনার ইমেইল এড্রেস">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Row 3: NID -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input type="text"
                                           name="nid"
                                           value="{{ Auth::user()->nid }}"
                                           autocomplete="off"
                                           class="form-control"
                                           placeholder="এনআইডি" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-id-card"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <select id="designation" name="designation" class="form-control" required>
                                        <option value="" disabled="">পদবি (প্রশাসক/মেয়র/চেয়ারম্যান/সচিব ইত্যাদি, যদি থাকে)</option>
                                        <option value="চেয়ারম্যান" @if(Auth::user()->designation == 'চেয়ারম্যান') selected @endif>ইউনিয়ন চেয়ারম্যান</option>
                                        <option value="সচিব" @if(Auth::user()->designation == 'সচিব') selected @endif>ইউনিয়ন সচিব</option>
                                        <option value="সহকারী" @if(Auth::user()->designation == 'সহকারী') selected @endif>ইউনিয়ন সহকারী</option>
                                        <option value="মেয়র" @if(Auth::user()->designation == 'মেয়র') selected @endif>মেয়র</option>
                                        <option value="কাউন্সিলর" @if(Auth::user()->designation == 'কাউন্সিলর') selected @endif>কাউন্সিলর</option>
                                        <option value="পৌর সচিব" @if(Auth::user()->designation == 'পৌর সচিব') selected @endif>পৌর সচিব</option>
                                    </select>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-user-secret"></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Row 4: Designation & Password -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input type="password"
                                           name="password"
                                           class="form-control"
                                           autocomplete="new-password"
                                           placeholder="পাসওয়ার্ড (ঐচ্ছিক)">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save mr-1"></i> তথ্য সংরক্ষণ করুন</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
        
        <!-- ============================================= -->
        <!-- COLUMN 2: আমার কার্যালয় (My Office) - col-md-6 -->
        <!-- ============================================= -->
        <div class="col-md-6">
            <!-- Card for My Office Form -->
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-building mr-1"></i> আমার কার্যালয়</h3>
                </div>
                <!-- Form: My Office -->
                <form action="{{ route('dashboard.profile.update.localoffice', Auth::user()->local_office_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="POST">
                    <div class="card-body">

                        <!-- Row 1: Office Name (Bengali & English) -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input type="text"
                                           name="name_bn"
                                           class="form-control"
                                           value="{{ Auth::user()->localOffice->name_bn }}"
                                           placeholder="নাম" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-home"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input type="text"
                                           name="name"
                                           class="form-control"
                                           value="{{ Auth::user()->localOffice->name }}"
                                           placeholder="ইংরেজি নাম (OPTIONAL)">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-flag"></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Row 2: Mobile & Email -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input type="text"
                                           name="mobile"
                                           value="{{ Auth::user()->localOffice->mobile }}"
                                           autocomplete="off"
                                           class="form-control"
                                           placeholder="অফিস মোবাইল নম্বর (১১ ডিজিট)" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-phone-square-alt"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input type="email"
                                           name="email"
                                           value="{{ Auth::user()->localOffice->email }}"
                                           autocomplete="off"
                                           class="form-control"
                                           placeholder="অফিস ইমেইল এড্রেস" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-envelope-square"></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Row 3: Monogram File Upload -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <!-- Custom File Input (AdminLTE compatible) -->
                                    <div class="custom-file">
                                        <input type="file"
                                               class="custom-file-input"
                                               id="monogram"
                                               name="monogram"
                                               accept="image/png, image/jpeg, image/gif"
                                               required> <!-- Assuming monogram is null, hence required -->
                                        <label class="custom-file-label" for="monogram">মনোগ্রাম সিলেক্ট করুন</label>
                                    </div>
                                    <small class="form-text text-muted">সর্বোচ্চ ফাইলের সাইজ 300KB (PNG, JPG, GIF), (300px X 300px)</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                              @php
                                  // 1. Define the full local path to the file.
                                  // We use public_path() because that's where File::exists() looks.
                                  $imagePath = public_path('images/localoffices/' . Auth::user()->localOffice->monogram);

                                  // 2. Check if the file name is stored AND if the physical file exists.
                                  $monogramExists = $localOffice->monogram && File::exists($imagePath);
                              @endphp
                              @if($monogramExists)
                                <img src="" alt="">
                              @endif
                            </div>
                        </div>
                        
                        <!-- Additional Text/Disclaimer -->
                        <h3 class="text-secondary text-sm font-weight-bold mt-4">অন্যান্য তথ্য আপডেট করতে চাইলে ডি-নাগরিক কর্তৃপক্ষের সাথে যোগাযোগ করুন</h3>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info float-right"><i class="fas fa-upload mr-1"></i> কার্যালয় তথ্য আপডেট করুন</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>

    </div>
    <!-- /.row -->
    </div>
@endsection

@section('third_party_scripts')
  <script>
    // JavaScript to update the label text of the custom file input
    document.querySelector('#monogram').addEventListener('change', function (e) {
        var fileName = e.target.files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
  </script>
@endsection