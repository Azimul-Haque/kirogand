@extends('layouts.app')
@section('title') ড্যাশবোর্ড | ভিডিও টিউটোরিয়ালসমূহ @endsection

@section('third_party_stylesheets')
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css"> --}}

    <style>
        
    </style>
@endsection

@section('content')
	@section('page-header') ভিডিও টিউটোরিয়ালসমূহ @endsection
  @section('page-header-right')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">ড্যাশবোর্ড</a></li>
        <li class="breadcrumb-item active">ভিডিও টিউটোরিয়ালসমূহ</li>
    </ol>
  @endsection
    <div class="container-fluid">
		  

    </div>
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