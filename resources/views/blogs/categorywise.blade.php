@extends('layouts.blog')
@section('title-secondary') {{ $name }} | ব্লগ-Blog | BCS Exam - বিসিএস পরীক্ষা | বিসিএস-সহ সরকারি চাকরির পরীক্ষার প্রস্তুতির জন্য সেরা অনলাইন প্ল্যাটফর্ম @endsection

@section('meta-data')
    <meta name="description" content="BCS Exam Aid বাংলাদেশ সিভিল সার্ভিস (BCS) পরীক্ষা এবং অন্যান্য সরকারি চাকরি (NSI, দুদক, বাংলাদেশ ব্যাংক, অন্যান্য ব্যাংক, প্রাথমিক শিক্ষক নিয়োগ) পরীক্ষার প্রস্তুতির জন্য সেরা ডেডিকেটেড অনলাইন প্ল্যাটফর্ম। Developed By A. H. M. Azimul Haque.">
    <meta name="keywords" content="BCS, Bangladesh Civil Service, NSI, দুদক, বাংলাদেশ ব্যাংক, অন্যান্য ব্যাংক, প্রাথমিক শিক্ষক নিয়োগ, Primary Exam, Job Circular, Bank Job Circular, Bank Job Exam, BCS Circular, বিসিএস পরীক্ষা, বার কাউন্সিল পরীক্ষা, জুডিশিয়াল পরীক্ষা, Judicial Exam, bcs book list, bcs book suggestion, BCS Preparation Books, বিসিএস প্রিলিমিনারি বই তালিকা, বিসিএস বই তালিকা, বিসিএস লিখিত বই তালিকা, bcs preliminary book list, bcs written book list, বিসিএস প্রিলিমিনারি পরীক্ষার সিলেবাস, বিসিএস পরীক্ষার সিলেবাস">

    <!-- Structured data JSON-LD (optional but highly recommended) -->
    <script type="application/ld+json">
        {
        "@context": "https://schema.org",
        "@type": "Website",
        "headline": "বিসিএস এক্সাম এইড - ব্লগ - {{ $name }}",
        "description": "{{ $name }}-টপিকের উপরে বিসিএস এক্সাম এইডের সকল ব্লগ পাচ্ছেন এই পাতায়। বিসিএস ও সরকারি চাকরির পূর্ণান্নগ প্রস্তুতি হোক এখানেই!",
        "image": "{{ asset('images/bcs-exam-aid-banner.png') }}",
        "url": "{{ url()->current() }}",
        "author": {
              "@type": "Person",
              "name": "{{  'এ. এইচ. এম. আজিমুল হক' }}"
            }
        }
    </script>
@endsection

@section('third_party_stylesheets-s')
    
@endsection

@section('header-s')
    {{ $name }}
@endsection

@section('content-s')
    {{-- <section style="padding-top: 50px; padding-bottom: 50px;">
        @foreach ($blogs as $blog)
        <div class="blog-listing blog-listing-classic no-margin-top wow fadeIn">
            @if($blog->featured_image != null)
                <div><a class="blog-image" href="{{ route('blog.single', $blog->slug) }}"><img class="img-responsive" src="{{ asset('images/blogs/'.$blog->featured_image) }}" alt="" style="width: 100%;" /></a></div><br/>
            @endif
            <div class="blog-details">
                <div class="blog-date">Posted by <a href="{{ route('blogger.profile', $blog->user->id) }}"><b>{{ $blog->user->name }}</b></a> | {{ date('F d, Y', strtotime($blog->created_at)) }} | <a href="{{ route('blog.categorywise', $blog->blogcategory->name) }}">{{ $blog->blogcategory->name }}</a> </div>
                <div class="blog-title"><a href="{{ route('blog.single', $blog->slug) }}">
                    {{ $blog->title }}
                </a></div>
                <div style="text-align: justify;">
                    @if(strlen(strip_tags($blog->body))>600)
                        {{ mb_substr(strip_tags($blog->body), 0, stripos($blog->body, " ", stripos(strip_tags($blog->body), " ")+500))."... " }}
                    @else
                        {{ strip_tags($blog->body) }}
                    @endif
                </div>
                <div class="separator-line bg-black no-margin-lr margin-four"></div>
                <div style="margin-bottom: 10px;">
                    <a href="#!" class="blog-like"><i class="far fa-heart"></i> {{ $blog->likes }} Like(s)</a>
                    <a href="#!" class="comment"><i class="far fa-comment"></i>
                    <span id="comment_count{{ $blog->id }}"></span>
                     comment(s)</a>
                </div>
                <a class="highlight-button btn btn-small xs-no-margin-bottom" href="{{ route('blog.single', $blog->slug) }}">Read More »</a>
                </br>
                </br>
            </div>
        </div>
        <script type="text/javascript" src="{{ asset('vendor/hcode/js/jquery.min.js') }}"></script>
        <script type="text/javascript">
            // $.ajax({
            //     url: "https://graph.facebook.com/v2.2/?fields=share{comment_count}&id={{ url('/blog/'.$blog->slug) }}",
            //     dataType: "jsonp",
            //     success: function(data) {
            //         $('#comment_count{{ $blog->id }}').text(data.share.comment_count);
            //     }
            // });
        </script>
        @endforeach
    </section> --}}

    <section class="py-5 g-4">
        <div class="row">
            @foreach ($blogs as $blog)

                
                    <div class="col-md-6">
                        <!-- Blog Post Card/Article (Replaced custom classes with BS5 spacing and shadow for visual pop) -->
                        <article class="card mb-5 shadow-sm border-0 wow fadeIn">
                            
                            <!-- Post Image -->
                            @if($blog->featured_image != null)
                                <div class="card-img-top overflow-hidden">
                                    <!-- Use img-fluid, w-100, and object-fit to ensure image responsiveness and consistency -->
                                    <a href="{{ route('blog.single', $blog->slug) }}">
                                        <img class="img-fluid w-100 rounded-top" 
                                             src="{{ asset('images/blogs/'.$blog->featured_image) }}" 
                                             alt="{{ $blog->title }}" 
                                             style="max-height: 400px; object-fit: cover;"
                                        />
                                    </a>
                                </div>
                            @endif
                            
                            <div class="card-body p-4">
                                
                                <!-- Metadata (Author, Date, Category) -->
                                <div class="text-muted small mb-3">
                                    Posted by 
                                    <a href="{{ route('blogger.profile', $blog->user->id) }}" class="text-decoration-none text-primary fw-bold">{{ $blog->user->name }}</a> 
                                    | {{ date('F d, Y', strtotime($blog->created_at)) }} 
                                    | <a href="{{ route('blog.categorywise', str_replace(" ", "-", $blog->blogcategory->name)) }}" class="text-decoration-none text-secondary">{{ $blog->blogcategory->name }}</a>
                                </div>
                                
                                <!-- Blog Title -->
                                <h2 class="h3 fw-bold mb-3">
                                    <a href="{{ route('blog.single', $blog->slug) }}" class="text-decoration-none text-dark hover-link">
                                        {{ $blog->title }}
                                    </a>
                                </h2>
                                
                                <!-- Blog Excerpt / Body -->
                                <div class="mb-4 text-justify">
                                    @if(strlen(strip_tags($blog->body)) > 230)
                                        {{ mb_substr(strip_tags($blog->body), 0, stripos($blog->body, " ", stripos(strip_tags($blog->body), " ")+200))."... " }}
                                    @else
                                        {{ strip_tags($blog->body) }}
                                    @endif
                                </div>
                                
                                <!-- Separator Line (Replaced custom class with Bootstrap border) -->
                                <hr class="my-4"/>
                                
                                <!-- Post Engagement Metrics (Likes, Comments) -->
                                <div class="d-flex align-items-center mb-3">
                                    <span class="text-secondary me-3">
                                        <i class="far fa-heart me-1"></i> {{ $blog->likes }} Like(s)
                                    </span>
                                    
                                    <span class="text-secondary me-3">
                                        <i class="far fa-comment me-1"></i>
                                        <span id="comment_count{{ $blog->id }}"></span> comment(s)
                                    </span>
                                </div>
                                
                                <!-- Read More Button (Replaced custom classes with standard BS5 button) -->
                                <a class="btn btn-primary" href="{{ route('blog.single', $blog->slug) }}">Read More &raquo;</a>

                            </div>
                        </article>
                    </div>

            @endforeach

        </div>

    <!-- Paginating Links -->
    <div class="d-flex justify-content-center mt-5">
        {{ $blogs->links() }}
    </div>


    </section>
@endsection

@section('third_party_scripts-s')

@endsection