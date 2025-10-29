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
      <div class="card">
          <div class="card-header">
            <h3 class="card-title">প্রোফাইল তালিকা (মোট: {{ $localofficescount }})</h3>

            <div class="card-tools">
              {{-- <button type="button" class="btn btn-success btn-sm"  data-toggle="modal" data-target="#addPackageModal" title="" rel="tooltip" data-original-title="প্রোফাইল যোগ করুন">
                <i class="fas fa-clipboard-check"></i> নতুন প্রোফাইল
              </button> --}}
              <div class="card-tools">
                <form class="form-inline form-group-lg" action="">
                  <div class="form-group">
                    <input type="search-param" class="form-control form-control-sm" placeholder="প্রোফাইল খুঁজুন" id="search-param" required>
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
            
          </div>
          <!-- /.card-body -->
        </div>
    </div>
@endsection

@section('third_party_scripts')

@endsection