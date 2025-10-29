@extends('layouts.app')
@section('title') ড্যাশবোর্ড @endsection

@section('third_party_stylesheets')

@endsection

@section('content')
	@section('page-header') ড্যাশবোর্ড @endsection
  @section('page-header-right')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">ড্যাশবোর্ড</a></li>
        <li class="breadcrumb-item active">ড্যাশবোর্ড</li>
    </ol>
  @endsection
    <div class="container-fluid">
      @if(Auth::user()->role == 'admin')
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h4>{{ $totalpayment }}<sup style="font-size: 20px">৳</sup></h4>

                <p>মোট আয়</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{ route('dashboard.payments') }}" class="small-box-footer">আয় পাতা <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h4>{{ $totalmonthlypayment->totalamount ? $totalmonthlypayment->totalamount : 0 }}<sup style="font-size: 20px">৳</sup></h4>

                <p>মাসিক আয় ({{ date('F Y') }})</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{ route('dashboard.payments') }}" class="small-box-footer">মাসিক আয় পাতা <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h4>
                  {{-- {{ $totalexamsattendedtoday }} বার --}}
                </h4>

                <p>আজ মোট পরীক্ষায়  অংশগ্রহণ ({{ date("F d, Y") }})</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#!" class="small-box-footer">পরীক্ষার্থী তালিকা <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h4>{{ $totalusers }}</h4>

                <p>মোট ব্যবহারকারী</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{ route('dashboard.users') }}" class="small-box-footer">ব্যবহারকারীগণ <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        {{-- <div class="row">
          <div class="col-md-6">
            <a href="" class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-coins"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">দৈনিক জমা</span>
                <span class="info-box-number">৳ {{ 0 }}</span>
              </div>
            </a>
          </div>
          <div class="col-md-6">
            <a href="" class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-hand-holding-usd"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">দৈনিক খরচ</span>
                <span class="info-box-number">৳ {{ 0 }}</span>
              </div>
            </a>
          </div>
        </div> --}}
        <div class="row">
          <div class="col-md-6">
            <button class="btn btn-warning" data-toggle="modal" data-target="#clearQueryCacheModal">
              <i class="fas fa-tools"></i> সকল কোয়েরি ক্যাশ (API) ক্লিয়ার করুন
            </button>
            {{-- Modal Code --}}
            {{-- Modal Code --}}
            <!-- Modal -->
            <div class="modal fade" id="clearQueryCacheModal" tabindex="-1" role="dialog" aria-labelledby="clearQueryCacheModalLabel" aria-hidden="true" data-backdrop="static">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="clearQueryCacheModalLabel">কোয়েরি ক্যাশ ক্লিয়ার</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                      আপনি কি নিশ্চিতভাবে সকল কোয়েরি ক্যাশ ক্লিয়ার করতে চান?<br/>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ফিরে যান</button>
                    <a href="{{ route('dashboard.clearquerycache') }}" class="btn btn-warning">ক্যাশ ক্লিয়ার করুন</a>
                    </div>
                </div>
                </div>
            </div>
            {{-- Modal Code --}}
            {{-- Modal Code --}}
            <br/>
            <br/>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">ব্যবহারকারী যোগদানের হার</h3>
                <div class="card-tools">
                  <small>সর্বশেষ দুই সপ্তাহ</small>
                </div>
              </div>
              <div class="card-body">
              <div class="chart">
                <canvas id="lineChart" style="min-height: 250px; height: 300px; max-height: 400px; max-width: 100%;"></canvas>
              </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">ক্রমবর্ধমান ব্যবহারকারী সংখ্যা</h3>
                <div class="card-tools">
                  <small>সর্বশেষ দুই সপ্তাহ</small>
                </div>
              </div>
              <div class="card-body">
              <div class="chart">
                <canvas id="lineChart2" style="min-height: 250px; height: 300px; max-height: 400px; max-width: 100%;"></canvas>
              </div>
              </div>
            </div>
          </div>
        </div>
      @elseif(Auth::user()->role == 'manager')
        <!-- 1. Info Boxes / Summary Metrics -->
        <div class="row">
            <!-- Total Certificates Issued -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box bg-gradient-primary shadow-lg quick-action-card">
                    <span class="info-box-icon"><i class="fas fa-check-circle"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text text-uppercase font-weight-bold">মোট ইস্যুকৃত সনদ</span>
                        <span class="info-box-number text-3xl font-weight-bold">২৫,৪২০</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 70%"></div>
                        </div>
                        <span class="progress-description">
                            এই মাসে ইস্যু হয়েছে: ১২৫ টি
                        </span>
                    </div>
                </div>
            </div>
            <!-- Pending Applications -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box bg-gradient-warning shadow-lg quick-action-card">
                    <span class="info-box-icon"><i class="fas fa-clock"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text text-uppercase font-weight-bold">অপেক্ষমাণ আবেদন</span>
                        <span class="info-box-number text-3xl font-weight-bold">২০</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 50%"></div>
                        </div>
                        <span class="progress-description">
                            দ্রুত পর্যালোচনা প্রয়োজন
                        </span>
                    </div>
                </div>
            </div>
            <!-- Total Citizens -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box bg-gradient-info shadow-lg quick-action-card">
                    <span class="info-box-icon"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text text-uppercase font-weight-bold">মোট নাগরিক (ইউনিয়ন)</span>
                        <span class="info-box-number text-3xl font-weight-bold">৩০,২০০</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 90%"></div>
                        </div>
                        <span class="progress-description">
                            ভোটার তালিকা অনুযায়ী
                        </span>
                    </div>
                </div>
            </div>
            <!-- Revenue Collected -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box bg-gradient-success shadow-lg quick-action-card">
                    <span class="info-box-icon"><i class="fas fa-hand-holding-usd"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text text-uppercase font-weight-bold">সংগৃহীত রাজস্ব (এই মাসে)</span>
                        <span class="info-box-number text-3xl font-weight-bold">৳ 80,500</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 80%"></div>
                        </div>
                        <span class="progress-description">
                            গত মাসের তুলনায় ১০% বেশি
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row (Info Boxes) -->

        <!-- 2. Main Content Row (Charts and Quick Actions) -->
        <div class="row">
            <!-- Monthly Issuance Trend Chart -->
            <section class="col-lg-7 connectedSortable">
                <div class="card shadow-lg">
                    <div class="card-header bg-gradient-light card-header-bangla">
                        <h3 class="card-title">
                            <i class="fas fa-chart-line mr-1"></i>
                            মাসিক সনদ ইস্যুর প্রবণতা (গত ৬ মাস)
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="tab-content p-0">
                            <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                                <canvas id="monthlyIssuanceChart" height="300" style="height: 300px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Quick Actions and System Status -->
            <section class="col-lg-5 connectedSortable">
                <!-- Quick Actions -->
                <div class="card shadow-lg">
                    <div class="card-header bg-gradient-light card-header-bangla">
                        <h3 class="card-title">
                            <i class="fas fa-bolt mr-1"></i>
                            দ্রুত কার্যসমূহ
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <a href="#" class="btn btn-app bg-primary quick-action-card w-full rounded-lg">
                                    <i class="fas fa-file-signature"></i> সনদ তৈরি করুন
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="#" class="btn btn-app bg-info quick-action-card w-full rounded-lg">
                                    <i class="fas fa-search"></i> আবেদন খুঁজুন
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="#" class="btn btn-app bg-success quick-action-card w-full rounded-lg">
                                    <i class="fas fa-chart-pie"></i> প্রতিবেদন দেখুন
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="#" class="btn btn-app bg-secondary quick-action-card w-full rounded-lg">
                                    <i class="fas fa-cog"></i> প্রোফাইল সেটিংস
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- System Status / Package Expiry Card -->
                <div class="card bg-danger shadow-lg quick-action-card">
                    <div class="card-header border-0">
                        <h3 class="card-title font-weight-bold text-white">
                            <i class="fas fa-calendar-times mr-1"></i>
                            সিস্টেম/প্যাকেজ স্থিতি
                        </h3>
                    </div>
                    <div class="card-body pt-0 pb-3">
                        <p class="text-white">
                            আপনার **সফটওয়্যার ব্যবহারের প্যাকেজটির মেয়াদ** শীঘ্রই শেষ হতে চলেছে।
                        </p>
                        <p class="text-white text-lg font-weight-bold">
                            মেয়াদ শেষ: {{ date('d F, Y', strtotime('+20 days')) }}
                        </p>
                        <a href="#" class="btn btn-outline-light btn-sm mt-2">প্যাকেজ নবায়ন করুন <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </section>
        </div>
        <!-- /.row (Charts and Quick Actions) -->

        <!-- 3. Recent Activities / Notifications -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-lg">
                    <div class="card-header bg-gradient-light card-header-bangla">
                        <h3 class="card-title">
                            <i class="fas fa-history mr-1"></i>
                            সাম্প্রতিক কার্যকলাপ (শেষ ১০টি সনদ ইস্যু)
                        </h3>
                    </div>
                    <div class="card-body p-0">
                        <ul class="products-list product-list-in-card pr-2 pl-2">
                            <li class="item">
                                <div class="product-img">
                                    <i class="fas fa-user-check fa-2x text-success"></i>
                                </div>
                                <div class="product-info">
                                    <a href="javascript:void(0)" class="product-title font-weight-bold">নাগরিক সনদ - আইডি: #৯৮৭৬</a>
                                    <span class="product-description">
                                        ইস্যু করেছেন: আপনি (প্রশাসনিক কর্মকর্তা), সময়: {{ date('H:i A') }}
                                    </span>
                                </div>
                            </li>
                            <li class="item">
                                <div class="product-img">
                                    <i class="fas fa-user-edit fa-2x text-info"></i>
                                </div>
                                <div class="product-info">
                                    <a href="javascript:void(0)" class="product-title font-weight-bold">চারিত্রিক সনদ - আইডি: #৯৮৭৫</a>
                                    <span class="product-description">
                                        অনুমোদিত: চেয়ারম্যান, সময়: {{ date('H:i A', strtotime('-1 hour')) }}
                                    </span>
                                </div>
                            </li>
                            <li class="item">
                                <div class="product-img">
                                    <i class="fas fa-money-bill-wave fa-2x text-warning"></i>
                                </div>
                                <div class="product-info">
                                    <a href="javascript:void(0)" class="product-title font-weight-bold">ট্যাক্স আদায় - রসিদ: #৫৬০</a>
                                    <span class="product-description">
                                        জমা হয়েছে: ৳ ১,২০০, সময়: {{ date('H:i A', strtotime('-3 hours')) }}
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer text-center">
                        <a href="javascript:void(0)" class="uppercase">সকল কার্যকলাপ দেখুন</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row (Activities) -->
      @endif
    </div>
@endsection

@section('third_party_scripts')
  <script src=" https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js "></script>
  <script type="text/javascript">
    var ctx = document.getElementById('lineChart').getContext('2d');
    var lineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! $daysforchartc !!},
            datasets: [{
                label: 'ব্যবহারকারী সংখ্যা',
                borderColor: "#3e95cd",
                fill: true,
                data: {!! $totalusersforchartc !!},
                borderWidth: 2,
                borderColor: "rgba(0,165,91,1)",
                borderCapStyle: 'butt',
                pointBorderColor: "rgba(0,165,91,1)",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(0,165,91,1)",
                pointHoverBorderColor: "rgba(0,165,91,1)",
                pointHoverBorderWidth: 2,
                pointRadius: 5,
                pointHitRadius: 10,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            
        }
    });


    var ctx = document.getElementById('lineChart2').getContext('2d');
    var lineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! $daysforchartc !!},
            datasets: [{
                label: 'ক্রমবর্ধমান ব্যবহারকারী সংখ্যা',
                borderColor: "#112E8A",
                fill: true,
                data: {!! $totaluserscumulitiveforchartc !!},
                borderWidth: 2,
                borderColor: "rgba(17,46,138,1)",
                borderCapStyle: 'butt',
                pointBorderColor: "rgba(17,46,138,1)",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(17,46,138,1)",
                pointHoverBorderColor: "rgba(17,46,138,1)",
                pointHoverBorderWidth: 2,
                pointRadius: 5,
                pointHitRadius: 10,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            
        }
    });
  </script>
@endsection