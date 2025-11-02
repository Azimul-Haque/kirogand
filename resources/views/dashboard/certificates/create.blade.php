@extends('layouts.app')
@section('title') ড্যাশবোর্ড | সনদের আবেদন @endsection

@section('third_party_stylesheets')
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datepicker.min.css') }}">

    <style>
    

    </style>
@endsection

@section('content')
  @section('page-header') সনদের আবেদন ({{ checkcertificatetype($certificate_type) }}) @endsection
  @section('page-header-right')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">ড্যাশবোর্ড</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('dashboard.certificates.index') }}">সনদের আবেদন</a></li>
        <li class="breadcrumb-item active">{{ checkcertificatetype($certificate_type) }}</li>
    </ol>
  @endsection
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-10 offset-md-1">
          @if($certificate_type == 'heir-certificate')
            @include('dashboard.certificates.forms.heir-certificate')
          @elseif($certificate_type == 'citizen-certificate')
            @include('dashboard.certificates.forms.heir-certificate')
          @endif
        </div>
      </div>
    </div>
@endsection

@section('third_party_scripts')
  <script type="module">

    
  </script>
@endsection