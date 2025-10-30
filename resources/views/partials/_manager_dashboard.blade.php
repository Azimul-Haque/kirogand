<!-- Tailwind CSS for minor aesthetic enhancements (AdminLTE is primarily Bootstrap 4) -->
{{-- <script src="https://cdn.tailwindcss.com"></script> --}}

<!-- Custom Style for Bangla Typography and overall look -->
<style>
    .info-box-icon i {
        font-size: 3rem !important;
        line-height: 4.5rem !important;
    }
    .card-header-bangla {
        font-weight: 700;
        color: #343a40;
        border-bottom: 2px solid #007bff; /* Primary color separator */
    }
    
    /* Custom Hover Effect using pure CSS (replaces quick-action-card and shadow from Tailwind) */
    .info-box, .btn-app {
        transition: all 0.3s ease;
        cursor: pointer;
        /* Applying an initial shadow using AdminLTE class in HTML for consistency */
    }

    .info-box:hover, .quick-action-card:hover {
        transform: translateY(-3px);
        /* A clear shadow on hover */
        box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important;
    }

    .btn-app {
        width: 100%; /* Uses Bootstrap w-100 class equivalent in HTML */
        height: 60px; /* Standard button size for better fit */
    }
</style>
<!-- 1. Info Boxes / Summary Metrics -->
<div class="row">
    <!-- Total Certificates Issued -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box bg-gradient-primary shadow quick-action-card">
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
        <div class="info-box bg-gradient-warning shadow quick-action-card">
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
        <div class="info-box bg-gradient-info shadow quick-action-card">
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
        <div class="info-box bg-gradient-success shadow quick-action-card">
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
    <!-- Quick Actions and System Status -->
    <section class="col-lg-5 connectedSortable">
        <!-- Quick Actions -->
        <div class="card shadow">
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
        <div class="card bg-success shadow">
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bold text-white">
                    <i class="fas fa-calendar-times mr-1"></i>
                    প্যাকেজ মেয়াদ
                </h3>
            </div>
            <div class="card-body pt-0 pb-3">
                @if(Auth::user()->localOffice)
                <p class="text-white">

                    আপনার সফটওয়্যার ব্যবহারের প্যাকেজটির মেয়াদ শীঘ্রই শেষ হতে চলেছে।
                </p>
                <p class="text-white text-lg font-weight-bold">
                    মেয়াদ শেষ: {{ Auth::user()->localOffice->package_expiry_date != null ? date('d F, Y', strtotime(Auth::user()->localOffice->package_expiry_date)) : 'কোন প্যাকেজ কেনা নেই!' }}
                </p>
                <a href="{{ route('dashboard.payments.office') }}" class="btn btn-outline-light btn-sm mt-2">প্যাকেজ নবায়ন করুন <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </section>

    <!-- Monthly Issuance Trend Chart -->
    <section class="col-lg-7 connectedSortable">
        <div class="card shadow">
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
        {{-- <div class="card shadow">
            <div class="card-header bg-gradient-light card-header-bangla">
                <h3 class="card-title">
                    <i class="fas fa-chart-line mr-1"></i>
                    মাসিক সনদ ইস্যুর প্রবণতা (গত ৬ মাস)
                </h3>
            </div>
            <div class="card-body">
                <div class="tab-content p-0">
                    <div class="chart">
                      <canvas id="lineChart2" style="min-height: 250px; height: 300px; max-height: 400px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div> --}}
    </section>
</div>
<!-- /.row (Charts and Quick Actions) -->

<!-- 3. Recent Activities / Notifications -->
<div class="row">
    <div class="col-12">
        
    </div>
</div>
<!-- /.row (Activities) -->