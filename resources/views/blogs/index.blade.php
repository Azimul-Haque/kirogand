@extends('layouts.blog')
@section('title-secondary') ব্লগ-Blog | BCS Exam Aid - বিসিএস ও সরকারি চাকরির সেরা প্ল্যাটফর্ম @endsection

@section('meta-data')
    <meta name="description" content="BCS Exam Aid বাংলাদেশ সিভিল সার্ভিস (BCS) পরীক্ষা এবং অন্যান্য সরকারি চাকরি (NSI, দুদক, বাংলাদেশ ব্যাংক, অন্যান্য ব্যাংক, প্রাথমিক শিক্ষক নিয়োগ) পরীক্ষার প্রস্তুতির জন্য সেরা ডেডিকেটেড অনলাইন প্ল্যাটফর্ম। Developed By A. H. M. Azimul Haque.">
    <meta name="keywords" content="BCS, Bangladesh Civil Service, NSI, দুদক, বাংলাদেশ ব্যাংক, অন্যান্য ব্যাংক, প্রাথমিক শিক্ষক নিয়োগ, Primary Exam, Job Circular, Bank Job Circular, Bank Job Exam, BCS Circular, বিসিএস পরীক্ষা, বার কাউন্সিল পরীক্ষা, জুডিশিয়াল পরীক্ষা, Judicial Exam, bcs book list, bcs book suggestion, BCS Preparation Books, বিসিএস প্রিলিমিনারি বই তালিকা, বিসিএস বই তালিকা, বিসিএস লিখিত বই তালিকা, bcs preliminary book list, bcs written book list, বিসিএস প্রিলিমিনারি পরীক্ষার সিলেবাস, বিসিএস পরীক্ষার সিলেবাস">
    <!-- Structured data JSON-LD (optional but highly recommended) -->
    <script type="application/ld+json">
        {
        "@context": "https://schema.org",
        "@type": "Website",
        "headline": "বিসিএস এক্সাম এইড - ব্লগ তালিকা",
        "description": "বিসিএস এক্সাম এইড এর ব্লগ তালিকায় পাচ্ছেন শীর্ষ ক্যাডারদের লেখা বিসিএস ও সরকারি সংক্রান্ত গুরুত্বপূর্ণ টিপস, অভিজ্ঞতা, সাজেশনস ও জব মার্কেটের তথ্য!",
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
    ব্লগ সমূহ
@endsection

@section('content-s')
    <section class="py-5">
    @foreach ($blogs as $blog)

        <div class="row">
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
                        @if(strlen(strip_tags($blog->body)) > 600)
                            {{ mb_substr(strip_tags($blog->body), 0, stripos($blog->body, " ", stripos(strip_tags($blog->body), " ")+500))."... " }}
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

        <!-- The original commented-out jQuery logic is removed as it relies on specific external scripts, 
             but the containing script tag is kept in case you use other necessary JS. 
             Note: The comment count logic inside the script remains commented out. -->
        <script type="text/javascript" src="{{ asset('vendor/hcode/js/jquery.min.js') }}"></script>
        <script type="text/javascript">
            // The original Facebook comment count logic is commented out here:
            /*
            $.ajax({
                 url: "https://graph.facebook.com/v2.2/?fields=share{comment_count}&id={{ url('/blog/'.$blog->slug) }}",
                 dataType: "jsonp",
                 success: function(data) {
                     $('#comment_count{{ $blog->id }}').text(data.share.comment_count);
                 }
            });
            */
        </script>

    @endforeach

    <!-- Paginating Links -->
    <div class="d-flex justify-content-center mt-5">
        {{ $blogs->links() }}
    </div>


    </section>
@endsection

@section('third_party_scripts-s')

@endsection