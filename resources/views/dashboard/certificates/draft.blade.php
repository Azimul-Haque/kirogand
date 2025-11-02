@extends('layouts.app')
@section('title') ড্যাশবোর্ড | সনদের ড্রাফট @endsection

@section('third_party_stylesheets')
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datepicker.min.css') }}">

    <style>
    

    </style>
@endsection

@section('content')
  @section('page-header') সনদের ড্রাফট  ({{ checkcertificatetype($certificate->certificate_type) }}) @endsection
  @section('page-header-right')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">ড্যাশবোর্ড</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('dashboard.certificates.index') }}">সনদের ড্রাফট</a></li>
        <li class="breadcrumb-item active">{{ checkcertificatetype($certificate->certificate_type) }}</li>
    </ol>
  @endsection
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-10 offset-md-1">
          @if($certificate->certificate_type == 'heir-certificate')
            @include('dashboard.certificates.draft.heir-certificate')
          @elseif($certificate->certificate_type == 'citizen-certificate')
            @include('dashboard.certificates.draft.citizen-certificate')
            @elseif($certificate->certificate_type == 'permanent-resident')
            @include('dashboard.certificates.draft.permanent-resident')
          @endif
        </div>
      </div>
    </div>
@endsection

@section('third_party_scripts')
  <script type="module">

    
  </script>
@endsection