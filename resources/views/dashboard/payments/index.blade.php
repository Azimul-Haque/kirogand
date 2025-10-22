@extends('layouts.app')
@section('title') ড্যাশবোর্ড | পেমেন্ট @endsection

@section('third_party_stylesheets')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css">
    <style type="text/css">
      /* Service Cards Enhancement (6 column layout) */
      .service-box {
          background-color: var(--white-bg);
          padding: 20px 10px; 
          border-radius: 12px;
          box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); 
          transition: transform 0.3s, box-shadow 0.3s;
          min-height: 180px; 
          display: flex;
          flex-direction: column;
          justify-content: center;
          align-items: center;
          text-align: center;
          border-bottom: 5px solid var(--darker-color); 
      }

      .service-box:hover {
          transform: translateY(-8px); 
          box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
          border-bottom-color: var(--medium-color); 
      }

      .icon-circle {
          background-color: var(--darker-color); 
          color: white;
          padding: 18px; 
          border-radius: 50%; 
          margin-bottom: 15px;
          font-size: 1.8rem; 
          box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
          display: inline-flex; 
          align-items: center; 
          justify-content: center; 
      }
    </style>
@endsection

@section('content')
	@section('page-header') পেমেন্ট @endsection
    <div class="container-fluid">
		<div class="card">
          <div class="card-header">
            <h3 class="card-title">পেমেন্ট তালিকা</h3>

            <div class="card-tools">
            	{{-- <button type="button" class="btn btn-success btn-sm"  data-toggle="modal" data-target="#addPackageModal" title="" rel="tooltip" data-original-title="পেমেন্ট যোগ করুন">
            		<i class="fas fa-clipboard-check"></i> নতুন পেমেন্ট
            	</button> --}}
              <div class="card-tools">
                <form class="form-inline form-group-lg" action="">
                  <div class="form-group">
                    <input type="search-param" class="form-control form-control-sm" placeholder="পেমেন্ট খুঁজুন" id="search-param" required>
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
                  <th>ব্যবহারকারী</th>
                  <th>প্যাকেজ</th>
                  <th>পেমেন্ট স্ট্যাটাস</th>
                  <th>কার্ডের ধরন</th>
                  <th>ট্রানজেকশন আইডি</th>
                  <th>পরিমাণ</th>
                  <th>সময়</th>
                </thead>
              </thead>
              <tbody>
                @foreach($payments as $payment)
                	<tr>
                    <td>
                      <a href="{{ route('dashboard.users.single', $payment->user->id) }}">{{ $payment->user->name }}</a>
                      <small>({{ $payment->user->payments->count() }} বার)</small><br/>
                      <small class="text-black-50">{{ $payment->user->mobile }}</small>
                    </td>
                    <td>{{ $payment->package->name }}</td>
                    <td>{{ $payment->payment_status == 1 ? 'Successfull' : 'Failed' }}</td>
                    <td>{{ $payment->card_type }}</td>
                    <td>{{ $payment->trx_id }}</td>
                    <td><b>৳ {{ $payment->store_amount }}</b> <small>(৳ {{ $payment->amount }})</small></td>
                		<td>{{ date('F d, Y h:i A', strtotime($payment->created_at)) }}</td>
                	</tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        {{ $payments->links() }}

        <div class="row g-4" id="serviceGrid">
            
            <!-- DYNAMICALLY GENERATED SERVICE BOXES (40 TOTAL) -->
            <!-- Note: The first 12 services will be visible, the rest will be dynamically hidden by JS -->
            
            <!-- Service 1: জন্ম নিবন্ধন সনদ -->
            <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="1">
                <a href="/service/birth-certificate" class="text-decoration-none text-dark d-block">
                    <div class="service-box">
                        <div class="icon-circle" style="background-color: var(--primary-color);"><i class="fas fa-baby"></i></div>
                        <h3 class="h5 fw-bolder" style="color: var(--darker-color);">জন্ম নিবন্ধন সনদ</h3>
                    </div>
                </a>
            </div>

            <!-- Service 2: মৃত্যু নিবন্ধন সনদ -->
            <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="2">
                <a href="/service/death-certificate" class="text-decoration-none text-dark d-block">
                    <div class="service-box">
                        <div class="icon-circle" style="background-color: #dc3545;"><i class="fas fa-cross"></i></div> 
                        <h3 class="h5 fw-bolder" style="color: var(--darker-color);">মৃত্যু নিবন্ধন সনদ</h3>
                    </div>
                </a>
            </div>

            <!-- Service 3: বার্ষিক আয়ের সনদ -->
            <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="3">
                <a href="/service/income-certificate" class="text-decoration-none text-dark d-block">
                    <div class="service-box">
                        <div class="icon-circle" style="background-color: var(--medium-color);"><i class="fas fa-sack-dollar"></i></div>
                        <h3 class="h5 fw-bolder" style="color: var(--darker-color);">বার্ষিক আয়ের সনদ</h3>
                    </div>
                </a>
            </div>

            <!-- Service 4: চারিত্রিক সনদপত্র -->
            <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="4">
                <a href="/service/character-certificate" class="text-decoration-none text-dark d-block">
                    <div class="service-box">
                        <div class="icon-circle" style="background-color: #ffc107;"><i class="fas fa-user-check"></i></div> 
                        <h3 class="h5 fw-bolder" style="color: var(--darker-color);">চারিত্রিক সনদপত্র</h3>
                    </div>
                </a>
            </div>
            
            <!-- Service 5: ওয়ারিশ সনদ -->
            <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="5">
                <a href="/service/heir-certificate" class="text-decoration-none text-dark d-block">
                    <div class="service-box">
                        <div class="icon-circle" style="background-color: #6f42c1;"><i class="fas fa-handshake"></i></div>
                        <h3 class="h5 fw-bolder" style="color: var(--darker-color);">ওয়ারিশ সনদ</h3>
                    </div>
                </a>
            </div>
            
            <!-- Service 6: ঠিকানার প্রত্যয়ন -->
            <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="6">
                <a href="/service/address-certificate" class="text-decoration-none text-dark d-block">
                    <div class="service-box">
                        <div class="icon-circle" style="background-color: var(--light-primary-color);"><i class="fas fa-map-marker-alt"></i></div>
                        <h3 class="h5 fw-bolder" style="color: var(--darker-color);">ঠিকানার প্রত্যয়ন</h3>
                    </div>
                </a>
            </div>
            
            <!-- Service 7: অবিবাহিত সনদ -->
            <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="7">
                <a href="/service/unmarried" class="text-decoration-none text-dark d-block">
                    <div class="service-box">
                        <div class="icon-circle" style="background-color: #00bcd4;"><i class="fas fa-ring"></i></div>
                        <h3 class="h5 fw-bolder" style="color: var(--darker-color);">অবিবাহিত সনদ</h3>
                    </div>
                </a>
            </div>

            <!-- Service 8: নতুন ট্রেড লাইসেন্স -->
            <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="8">
                <a href="/service/trade-license-new" class="text-decoration-none text-dark d-block">
                    <div class="service-box">
                        <div class="icon-circle" style="background-color: #795548;"><i class="fas fa-store"></i></div>
                        <h3 class="h5 fw-bolder" style="color: var(--darker-color);">নতুন ট্রেড লাইসেন্স</h3>
                    </div>
                </a>
            </div>

            <!-- Service 9: ট্রেড লাইসেন্স নবায়ন -->
            <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="9">
                <a href="/service/trade-license-renewal" class="text-decoration-none text-dark d-block">
                    <div class="service-box">
                        <div class="icon-circle" style="background-color: #9e9e9e;"><i class="fas fa-sync-alt"></i></div>
                        <h3 class="h5 fw-bolder" style="color: var(--darker-color);">ট্রেড লাইসেন্স নবায়ন</h3>
                    </div>
                </a>
            </div>

            <!-- Service 10: কৃষি ভর্তুকির প্রত্যয়ন -->
            <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="10">
                <a href="/service/agriculture-subsidy" class="text-decoration-none text-dark d-block">
                    <div class="service-box">
                        <div class="icon-circle" style="background-color: #4caf50;"><i class="fas fa-leaf"></i></div>
                        <h3 class="h5 fw-bolder" style="color: var(--darker-color);">কৃষি ভর্তুকির প্রত্যয়ন</h3>
                    </div>
                </a>
            </div>
            
            <!-- Service 11: নাগরিকত্ব সনদ -->
            <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="11">
                <a href="/service/citizenship-certificate" class="text-decoration-none text-dark d-block">
                    <div class="service-box">
                        <div class="icon-circle" style="background-color: #ff9800;"><i class="fas fa-flag"></i></div>
                        <h3 class="h5 fw-bolder" style="color: var(--darker-color);">নাগরিকত্ব সনদ</h3>
                    </div>
                </a>
            </div>


            <!-- Service 12: ভূমির খাজনা প্রত্যয়ন -->
            <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="12">
                <a href="/service/land-tax-certificate" class="text-decoration-none text-dark d-block">
                    <div class="service-box">
                        <div class="icon-circle" style="background-color: #607d8b;"><i class="fas fa-file-invoice-dollar"></i></div>
                        <h3 class="h5 fw-bolder" style="color: var(--darker-color);">ভূমির খাজনা প্রত্যয়ন</h3>
                    </div>
                </a>
            </div>

            <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="1">
                <a href="/service/birth-certificate" class="text-decoration-none text-dark d-block">
                    <div class="service-box">
                        <div class="icon-circle" style="background-color: var(--primary-color);"><i class="fas fa-baby"></i></div>
                        <h3 class="h5 fw-bolder" style="color: var(--darker-color);">জন্ম নিবন্ধন সনদ</h3>
                    </div>
                </a>
            </div>

            <!-- Service 2: মৃত্যু নিবন্ধন সনদ -->
            <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="2">
                <a href="/service/death-certificate" class="text-decoration-none text-dark d-block">
                    <div class="service-box">
                        <div class="icon-circle" style="background-color: #dc3545;"><i class="fas fa-cross"></i></div> 
                        <h3 class="h5 fw-bolder" style="color: var(--darker-color);">মৃত্যু নিবন্ধন সনদ</h3>
                    </div>
                </a>
            </div>

            <!-- Service 3: বার্ষিক আয়ের সনদ -->
            <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="3">
                <a href="/service/income-certificate" class="text-decoration-none text-dark d-block">
                    <div class="service-box">
                        <div class="icon-circle" style="background-color: var(--medium-color);"><i class="fas fa-sack-dollar"></i></div>
                        <h3 class="h5 fw-bolder" style="color: var(--darker-color);">বার্ষিক আয়ের সনদ</h3>
                    </div>
                </a>
            </div>

            <!-- Service 4: চারিত্রিক সনদপত্র -->
            <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="4">
                <a href="/service/character-certificate" class="text-decoration-none text-dark d-block">
                    <div class="service-box">
                        <div class="icon-circle" style="background-color: #ffc107;"><i class="fas fa-user-check"></i></div> 
                        <h3 class="h5 fw-bolder" style="color: var(--darker-color);">চারিত্রিক সনদপত্র</h3>
                    </div>
                </a>
            </div>
            
            <!-- Service 5: ওয়ারিশ সনদ -->
            <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="5">
                <a href="/service/heir-certificate" class="text-decoration-none text-dark d-block">
                    <div class="service-box">
                        <div class="icon-circle" style="background-color: #6f42c1;"><i class="fas fa-handshake"></i></div>
                        <h3 class="h5 fw-bolder" style="color: var(--darker-color);">ওয়ারিশ সনদ</h3>
                    </div>
                </a>
            </div>
            
            <!-- Service 6: ঠিকানার প্রত্যয়ন -->
            <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="6">
                <a href="/service/address-certificate" class="text-decoration-none text-dark d-block">
                    <div class="service-box">
                        <div class="icon-circle" style="background-color: var(--light-primary-color);"><i class="fas fa-map-marker-alt"></i></div>
                        <h3 class="h5 fw-bolder" style="color: var(--darker-color);">ঠিকানার প্রত্যয়ন</h3>
                    </div>
                </a>
            </div>
            
            <!-- Service 7: অবিবাহিত সনদ -->
            <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="7">
                <a href="/service/unmarried" class="text-decoration-none text-dark d-block">
                    <div class="service-box">
                        <div class="icon-circle" style="background-color: #00bcd4;"><i class="fas fa-ring"></i></div>
                        <h3 class="h5 fw-bolder" style="color: var(--darker-color);">অবিবাহিত সনদ</h3>
                    </div>
                </a>
            </div>

            <!-- Service 8: নতুন ট্রেড লাইসেন্স -->
            <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="8">
                <a href="/service/trade-license-new" class="text-decoration-none text-dark d-block">
                    <div class="service-box">
                        <div class="icon-circle" style="background-color: #795548;"><i class="fas fa-store"></i></div>
                        <h3 class="h5 fw-bolder" style="color: var(--darker-color);">নতুন ট্রেড লাইসেন্স</h3>
                    </div>
                </a>
            </div>

            <!-- Service 9: ট্রেড লাইসেন্স নবায়ন -->
            <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="9">
                <a href="/service/trade-license-renewal" class="text-decoration-none text-dark d-block">
                    <div class="service-box">
                        <div class="icon-circle" style="background-color: #9e9e9e;"><i class="fas fa-sync-alt"></i></div>
                        <h3 class="h5 fw-bolder" style="color: var(--darker-color);">ট্রেড লাইসেন্স নবায়ন</h3>
                    </div>
                </a>
            </div>

            <!-- Service 10: কৃষি ভর্তুকির প্রত্যয়ন -->
            <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="10">
                <a href="/service/agriculture-subsidy" class="text-decoration-none text-dark d-block">
                    <div class="service-box">
                        <div class="icon-circle" style="background-color: #4caf50;"><i class="fas fa-leaf"></i></div>
                        <h3 class="h5 fw-bolder" style="color: var(--darker-color);">কৃষি ভর্তুকির প্রত্যয়ন</h3>
                    </div>
                </a>
            </div>
            
            <!-- Service 11: নাগরিকত্ব সনদ -->
            <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="11">
                <a href="/service/citizenship-certificate" class="text-decoration-none text-dark d-block">
                    <div class="service-box">
                        <div class="icon-circle" style="background-color: #ff9800;"><i class="fas fa-flag"></i></div>
                        <h3 class="h5 fw-bolder" style="color: var(--darker-color);">নাগরিকত্ব সনদ</h3>
                    </div>
                </a>
            </div>


            <!-- Service 12: ভূমির খাজনা প্রত্যয়ন -->
            <div class="col-lg-2 col-md-4 col-sm-6 col-6 service-box-container" data-service-id="12">
                <a href="/service/land-tax-certificate" class="text-decoration-none text-dark d-block">
                    <div class="service-box">
                        <div class="icon-circle" style="background-color: #607d8b;"><i class="fas fa-file-invoice-dollar"></i></div>
                        <h3 class="h5 fw-bolder" style="color: var(--darker-color);">ভূমির খাজনা প্রত্যয়ন</h3>
                    </div>
                </a>
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