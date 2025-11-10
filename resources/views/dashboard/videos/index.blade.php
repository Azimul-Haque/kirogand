@extends('layouts.app')
@section('title') ড্যাশবোর্ড | ভিডিও টিউটোরিয়াল @endsection

@section('third_party_stylesheets')
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css"> --}}

    <style>
        
    </style>
@endsection

@section('content')
	@section('page-header') ভিডিও টিউটোরিয়াল @endsection
  @section('page-header-right')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">ড্যাশবোর্ড</a></li>
        <li class="breadcrumb-item active">ভিডিও টিউটোরিয়াল</li>
    </ol>
  @endsection
    <div class="container-fluid">
		  <div class="row">             
        <!-- VIDEO CARD 1 -->
        <div class="col-md-6 col-lg-4 mb-5">
            <div class="card h-100 video-card shadow-lg">
                <div class="thumbnail-container" data-toggle="modal" data-target="#videoModal" data-youtube-id="eOb0MwGJh5c">
                    <img src="https://img.youtube.com/vi/eOb0MwGJh5c/hqdefault.jpg" alt="প্রোফাইল আপডেট থাম্বনেইল">
                    <div class="play-overlay">
                        <i class="fab fa-youtube"></i>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="video-tutorial-title">প্রোফাইল আপডেট: ব্যক্তিগত ও কার্যালয় তথ্য</h5>
                    <p class="card-text">ডি-নাগরিক প্ল্যাটফর্মে আপনার প্রোফাইল কীভাবে সঠিকভাবে আপডেট করবেন, ব্যক্তিগত ও কার্যালয়ের তথ্য যোগ করবেন এবং সনদ তৈরির জন্য মনোগ্রাম আপলোড করবেন, তা জানুন।</p>
                    <button type="button" class="btn btn-watch btn-block mt-auto" 
                            data-toggle="modal" data-target="#videoModal" data-youtube-id="eOb0MwGJh5c">
                        <i class="fas fa-video mr-2"></i> ভিডিও দেখুন
                    </button>
                </div>
            </div>
        </div>

        <!-- VIDEO CARD 2 -->
        <div class="col-md-6 col-lg-4 mb-5">
            <div class="card h-100 video-card shadow-lg">
                <div class="thumbnail-container" data-toggle="modal" data-target="#videoModal" data-youtube-id="v-XtAT9CDQg">
                    <img src="https://img.youtube.com/vi/v-XtAT9CDQg/hqdefault.jpg" alt="প্যাকেজ নবায়ন থাম্বনেইল">
                    <div class="play-overlay">
                        <i class="fab fa-youtube"></i>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="video-tutorial-title">প্যাকেজ নবায়ন: সাশ্রয়ী মূল্যে সার্ভিস চালু রাখুন</h5>
                    <p class="card-text">আপনার ডি-নাগরিক সার্ভিসের মেয়াদ বাড়াতে এবং আনলিমিটেড সার্টিফিকেট তৈরির সুবিধা চালু রাখতে প্যাকেজ নবায়নের সম্পূর্ণ প্রক্রিয়া ও সাশ্রয়ের টিপস জানুন।</p>
                    <button type="button" class="btn btn-watch btn-block mt-auto" 
                            data-toggle="modal" data-target="#videoModal" data-youtube-id="v-XtAT9CDQg">
                        <i class="fas fa-video mr-2"></i> ভিডিও দেখুন
                    </button>
                </div>
            </div>
        </div>

        <!-- VIDEO CARD 3 -->
        {{-- <div class="col-md-6 col-lg-4 mb-5">
            <div class="card h-100 video-card shadow-lg">
                <div class="thumbnail-container" data-toggle="modal" data-target="#videoModal" data-youtube-id="VIDEO_ID_3">
                    <img src="https://img.youtube.com/vi/VIDEO_ID_3/hqdefault.jpg" alt="নতুন সনদ তৈরি থাম্বনেইল">
                    <div class="play-overlay">
                        <i class="fab fa-youtube"></i>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="video-tutorial-title">কীভাবে একটি নতুন ডিজিটাল সনদ তৈরি করবেন?</h5>
                    <p class="card-text">ধাপে ধাপে শিখুন কীভাবে ডি-নাগরিক প্ল্যাটফর্ম ব্যবহার করে বিভিন্ন ডিজিটাল প্রত্যয়নপত্র বা সনদ তৈরি ও বিতরণ করবেন।</p>
                    <button type="button" class="btn btn-watch btn-block mt-auto" 
                            data-toggle="modal" data-target="#videoModal" data-youtube-id="VIDEO_ID_3">
                        <i class="fas fa-video mr-2"></i> ভিডিও দেখুন
                    </button>
                </div>
            </div>
        </div> --}}

        <!-- VIDEO CARD 4 -->
        <div class="col-md-6 col-lg-4 mb-5">
            <div class="card h-100 video-card shadow-lg">
                <div class="thumbnail-container" data-toggle="modal" data-target="#videoModal" data-youtube-id="VIDEO_ID_4">
                    <img src="https://img.youtube.com/vi/VIDEO_ID_4/hqdefault.jpg" alt="নিবন্ধন পদ্ধতি থাম্বনেইল">
                    <div class="play-overlay">
                        <i class="fab fa-youtube"></i>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="video-tutorial-title">ডি-নাগরিক প্ল্যাটফর্মে নিবন্ধন পদ্ধতি</h5>
                    <p class="card-text">ডি-নাগরিকে প্রশাসনিক কর্তৃপক্ষ হিসেবে দ্রুত এবং সফলভাবে নিবন্ধন করার জন্য প্রয়োজনীয় সব ধাপ এই ভিডিওতে দেখুন।</p>
                    <button type="button" class="btn btn-watch btn-block mt-auto" 
                            data-toggle="modal" data-target="#videoModal" data-youtube-id="VIDEO_ID_4">
                        <i class="fas fa-video mr-2"></i> ভিডিও দেখুন
                    </button>
                </div>
            </div>
        </div>

      </div>

    </div>

    <!-- Video Modal (Reused for all cards) -->
    <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title font-weight-bold text-white" id="videoModalLabel">
                        <i class="fas fa-play-circle mr-2"></i> ভিডিও টিউটোরিয়াল
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe id="youtube-video-iframe" 
                                class="embed-responsive-item"
                                src=""
                                allow="autoplay; encrypted-media"
                                allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Video Modal -->
@endsection

@section('third_party_scripts')
  <script>
      $(document).ready(function() {
          const $modal = $('#videoModal');
          const $iframe = $('#youtube-video');
          const videoSrc = $iframe.data('src');

          // Event 1: When the modal is fully shown (opened)
          $modal.on('shown.bs.modal', function () {
              // Load the full video URL with autoplay=1 to start playback
              $iframe.attr('src', videoSrc); 
          });

          // Event 2: When the modal is completely hidden (closed)
          $modal.on('hidden.bs.modal', function () {
              // Stop the video by clearing the source
              $iframe.attr('src', '');
          });
      });
  </script>
@endsection