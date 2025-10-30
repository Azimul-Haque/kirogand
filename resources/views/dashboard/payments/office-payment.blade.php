@extends('layouts.app')
@section('title') ড্যাশবোর্ড | পেমেন্ট @endsection

@section('third_party_stylesheets')
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css"> --}}

    <style>
        /* প্যাকেজ কার্ডের জন্য কাস্টম স্টাইল */
        .package-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #e0e0e0;
            height: 100%; /* Ensure all cards have equal height */
            display: flex;
            flex-direction: column;
        }

        .package-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* হাইলাইট করা প্যাকেজের জন্য বিশেষ স্টাইল */
        .package-card.suggested-card {
            border-color: #007bff; /* AdminLTE Primary Color */
            box-shadow: 0 0 15px rgba(0, 123, 255, 0.2);
        }

        .card-header-suggested {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding-top: 15px;
        }

        .price-value {
            font-size: 2.0rem; /* মূল্য বড় করে দেখানো */
            font-weight: 700;
            color: #28a745; /* AdminLTE Success Color */
            margin-bottom: 0.5rem;
        }

        .suggested-card .price-value {
            color: #ffc107; /* AdminLTE Warning Color for contrast on blue background */
        }

        .strike-through {
            font-size: 1rem;
            color: #999;
            margin-right: 5px;
        }

        .card-body {
            padding-bottom: 0;
            flex-grow: 1; /* Make sure the body takes up available space */
        }

        .card-footer {
            padding: 1rem;
            border-top: none;
        }

        /* বৈশিষ্ট্য তালিকা সরল করা হয়েছে */
        .feature-list {
            list-style: none;
            padding: 0;
            margin-bottom: 1rem;
        }

        .feature-list li {
            padding: 8px 0;
            border-bottom: 1px dashed #eee;
            font-size: 14px;
            display: flex;
            align-items: center;
        }
        
        .feature-list li:last-child {
            border-bottom: none;
        }

        .feature-check {
            color: #28a745; /* Checkmark color */
            margin-right: 8px;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
	@section('page-header') পেমেন্ট @endsection
  @section('page-header-right')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">ড্যাশবোর্ড</a></li>
        <li class="breadcrumb-item active">পেমেন্ট</li>
    </ol>
  @endsection
    <div class="container-fluid">
		  <div class="row">
          @foreach($packages as $package)
              {{-- কলাম সাইজ: ডেস্কটপে ৪টি কার্ড, ট্যাবলেটে ২ টি, মোবাইলে ১ টি --}}
              <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mb-4">
                  <div class="card package-card @if($package->suggested == 1) suggested-card @endif">
                      
                      {{-- হেডার ও ব্যাজ --}}
                      <div class="card-header text-center p-0 @if($package->suggested == 1) card-header-suggested @endif">
                          @if($package->suggested == 1)
                              {{-- 'জনপ্রিয়' ব্যাজটি কার্ডের উপরে থাকবে --}}
                              <span class="badge badge-warning p-1" style="position: absolute; top: 5px; left: 50%; transform: translateX(-50%); font-size: 0.8rem; z-index: 9999999999;">
                                  সর্বাধিক জনপ্রিয় প্যাকেজ
                              </span>
                              <div class="pt-4 pb-3">
                          @else
                              <div class="pt-3 pb-2">
                          @endif
                              <h4 class="mb-1 @if($package->suggested != 1) text-primary @endif">
                                  {{ $package->name }}
                              </h4>
                              <p class="text-sm m-0 @if($package->suggested == 1) text-white @else text-muted১ @endif">
                                  {{ $package->tagline }}
                              </p>
                          </div>
                      </div>

                      {{-- মূল্য প্রদর্শন --}}
                      <div class="card-body text-center pt-2">
                          <div class="price mb-3">
                              <h2 class="amount">
                                  {{-- স্ট্রাইক-থ্রু মূল্য ছোট করে --}}
                                  <span class="currency strike-through">
                                      <strike>৳ {{ bangla($package->strike_price) }}</strike>
                                  </span>
                                  {{-- মূল মূল্য বড় করে --}}
                                  <span class="price-value">৳ {{ bangla($package->price) }}</span>
                                  {{-- সময়কাল --}}
                                  <small class="text-muted duration">/{{ $package->duration }}</small>
                              </h2>
                          </div>

                          {{-- বৈশিষ্ট্য তালিকা --}}
                          <div class="table-content text-left">
                              <ul class="feature-list">
                                  <li> <span class="feature-check">✓</span> সফটওয়্যারের সকল ফিচারের এক্সেস</li>
                                  <li> <span class="feature-check">✓</span> আনলিমিটেড সার্টিফিকেট জেনারেট</li>
                                  <li> <span class="feature-check">✓</span> একাধিক ইউজার যোগ ও ব্যবহারের সুযোগ</li>
                                  @if($package->price > 1000)
                                    <li> <span class="feature-check">✓</span> নতুন ফিচার অনুরোধ</li>
                                    <li> <span class="feature-check">✓</span> পূর্ণাঙ্গ সাপোর্ট</li>
                                  @else
                                    <li> <span class="feature-check text-danger">✖</span> সীমিত সাপোর্ট</li>
                                  @endif
                              </ul>
                          </div>
                      </div>

                      {{-- বাটন --}}
                      <div class="card-footer text-center">
                          <button 
                              type="button" 
                              data-bs-toggle="modal" 
                              data-bs-target="#packageModal{{ $package->id }}" 
                              class="btn btn-block @if($package->suggested == 1) btn-primary @else btn-outline-primary @endif btn-lg"
                          >
                              শুরু করুন!
                          </button>
                      </div>
                  </div>
              </div>

              {{-- প্যাকেজ মডাল (বিদ্যমান লজিক, সামান্য স্টাইল পরিবর্তন) --}}
              <div class="modal fade" id="packageModal{{ $package->id }}" data-bs-backdrop="static">
                  <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                          <!-- Modal Header -->
                          <div class="modal-header bg-primary text-white">
                              <h4 class="modal-title">{{ $package->name }} প্ল্যান সাবস্ক্রাইব করুন</h4>
                              <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>

                          <form method="post" action="{{ route('index.payment.proceed') }}">
                              @csrf
                              <!-- Modal body -->
                              <div class="modal-body">
                                  <h5 class="text-primary">{{ $package->name }} ({{ $package->tagline }})</h5>
                                  <p>
                                      <b>প্যাকেজের মেয়াদ:</b> <span class="text-bold">{{ $package->duration }}</span>
                                  </p>
                                  
                                  <h3 class="my-3">
                                      <b>মূল্য:</b> 
                                      <span class="text-muted"><strike>৳ {{ bangla($package->strike_price) }}</strike></span> 
                                      <span class="text-success ml-2">৳ {{ bangla($package->price) }}</span>
                                  </h3>

                                  <hr>

                                  <b>ফিচারসমূহ:</b>
                                  <div class="table-content">
                                      <ul class="feature-list">
                                          <li> <span class="feature-check">✓</span> সফটওয়্যারের সকল ফিচারের এক্সেস</li>
                                          <li> <span class="feature-check">✓</span> আনলিমিটেড সার্টিফিকেট জেনারেট</li>
                                          <li> <span class="feature-check">✓</span> একাধিক ইউজার যোগ ও ব্যবহারের সুযোগ</li>
                                          <li> <span class="feature-check">✓</span> মডেল টেস্ট ও সাবজেক্টিভ প্রস্তুতি</li>
                                      </ul>
                                  </div><br/>
                                  
                                  <div class="form-group">
                                      <label for="user_number_{{ $package->id }}" class="font-weight-bold">
                                          অ্যাপে ব্যবহৃত ১১ ডিজিটের মোবাইল নম্বরটি লিখুন:
                                      </label>
                                      @if(Auth::guest())
                                          <p class="text-success text-sm m-0">রেজিস্ট্রেশন না করে থাকলে <a href="#!" class="text-primary font-weight-bold">এখানে ক্লিক করুন</a></p>
                                      @endif
                                      <input 
                                          type="number" 
                                          name="user_number" 
                                          id="user_number_{{ $package->id }}"
                                          onkeypress="if(this.value.length==11) return false;" 
                                          class="form-control form-control-lg" 
                                          placeholder="অ্যাপে ব্যবহৃত মোবাইল নাম্বারটি লিখুন" 
                                          @if(!Auth::guest()) value="{{ Auth::user()->mobile }}" @endif 
                                          required
                                      >
                                  </div>

                                  <small class="mt-3 d-block">
                                      <a href="{{ route('index.terms-and-conditions') }}" target="_blank">শর্তাবলী</a>, <a href="{{ route('index.privacy-policy') }}" target="_blank">গোপনীয়তা নীতি</a> & <a href="{{ route('index.refund-policy') }}" target="_blank">ফেরত নীতি</a> দেখুন।
                                  </small>
                              </div>

                              <!-- Modal footer -->
                              <div class="modal-footer justify-content-between">
                                  <button type="button" class="btn btn-default" data-bs-dismiss="modal">ফিরে যান</button>
                                  <input type="hidden" name="amount" value="{{ $package->price }}" required>
                                  <input type="hidden" name="package_id" value="{{ $package->id }}" required>
                                  <button type="submit" class="btn btn-success btn-lg">
                                      ৳ {{ bangla($package->price) }} পরিশোধ করুন
                                  </button>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          @endforeach
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="adminlte-card-shadow rounded-lg p-4 mb-6 border-l-4 border-green-500 bg-white">
            <div class="flex items-start space-x-3">
                
                <!-- Icon: AdminLTE uses a prominent icon -->
                <i class="fas fa-circle-info text-2xl text-green-500 mt-0.5"></i>
                
                <div class="flex-1">
                    <!-- Title in AdminLTE style -->
                    <h4 class="text-xl font-bold text-gray-700 mb-2">
                        গুরুত্বপূর্ণ ঘোষণা (Important Notice)
                    </h4>
                    
                    <!-- Main Bengali Notification Text -->
                    <p class="bn-text text-gray-600 leading-relaxed">
                        সম্মানিত ইউজার, আপনার প্যাকেজ সংক্রান্ত একটি বিশেষ তথ্য:
                    </p>
                    <p class="bn-text text-gray-800 mt-2 font-semibold">
                        আপনি যখনই **নতুন পেমেন্ট বা প্যাকেজ যোগ করবেন**, তখন আপনার
                        **বর্তমান অবশিষ্ট মেয়াদ** এর সাথে **নতুন প্যাকেজের দিনগুলো যোগ হয়ে যাবে**।
                    </p>

                    <!-- Example for Clarity -->
                    <div class="mt-4 p-3 bg-green-50 rounded-md border border-green-200">
                        <p class="bn-text text-sm text-gray-700">
                            **উদাহরণ:** আপনার প্যাকেজের মেয়াদ শেষ হতে যদি <span class="text-green-600 font-bold">১০ দিন</span> বাকি থাকে এবং আপনি নতুন <span class="text-green-600 font-bold">৩০ দিনের</span> প্যাকেজ যোগ করেন, তাহলে আপনার **মোট মেয়াদ** হবে ১০ + ৩০ = **৪০ দিন**।
                        </p>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>

@endsection

@section('third_party_scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="module">

      $(document).on('click', '#search-button', function() {
        if($('#search-param').val() != '') {
          var urltocall = '{{ route('dashboard.payments') }}' +  '/' + $('#search-param').val();
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
            var urltocall = '{{ route('dashboard.payments') }}' +  '/' + $('#search-param').val();
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
      // import { initializeApp } from 'https://www.gstatic.com/firebasejs/9.9.1/firebase-app.js';

      // // import { auth } from 'https://www.gstatic.com/firebasejs/9.9.1/firebase-auth.js';
      // import { doc, getFirestore, collection, getDocs, addDoc, setDoc, runTransaction } from 'https://www.gstatic.com/firebasejs/9.9.1/firebase-firestore.js';

      // const firebaseConfig = {
      //   apiKey: "AIzaSyDW9yf9W-6mYL35nPYW8rfL__-2vMIBsR8",
      //   authDomain: "bjs-exam.firebaseapp.com",
      //   projectId: "bjs-exam",
      //   storageBucket: "bjs-exam.appspot.com",
      //   messagingSenderId: "750423424153",
      //   appId: "1:750423424153:web:ab554cd595960865a30c08",
      //   measurementId: "G-EXSKW5L6GB"
      // };

      // const app = initializeApp(firebaseConfig);
      // const db = getFirestore(app);

      // // WRITE
      // try {
      //   const docRef = await setDoc(doc(db, "packages", "4"), {
      //     name: "বাৎসরিক",
      //     tagline: "১ বছরের জন্য অ্যাপের সব ফিচার অ্যাভেইলেবল থাকবে",
      //     duration: "১ বছর",
      //     price: "349",
      //     strike_price: "600",
      //     status: 1,
      //     suggested: 0
      //   });

      //   console.log("Document written with ID: ", docRef.id);
      // } catch (e) {
      //   console.error("Error adding document: ", e);
      // }

      // // READ
      // const querySnapshot = await getDocs(collection(db, "packages"));
      // var packages = [];
      // querySnapshot.forEach((doc) => {
      //   console.log(`${doc.id} => ${doc.data()}`);
      //   packages.push(doc.data());
      // });
      // console.log(packages);


      // // UPDATE
      // const sfDocRef = doc(db, "packages", "1");
      // try {
      //   await runTransaction(db, async (transaction) => {
      //     const sfDoc = await transaction.get(sfDocRef);
      //     if (!sfDoc.exists()) {
      //       throw "Document does not exist!";
      //     }
      //     transaction.update(sfDocRef, { name: 'মাসিক ২' });
      //   });
      //   console.log("Transaction successfully committed!");
      // } catch (e) {
      //   console.log("Transaction failed: ", e);
      // }

    </script>
@endsection