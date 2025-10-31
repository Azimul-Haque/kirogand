@extends('layouts.app')
@section('title') ড্যাশবোর্ড | সনদের আবেদন @endsection

@section('third_party_stylesheets')
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datepicker.min.css') }}">

    <style>
    

    </style>
@endsection

@section('content')
  @section('page-header') সনদের আবেদন @endsection
  @section('page-header-right')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">ড্যাশবোর্ড</a></li>
        <li class="breadcrumb-item active">সনদের আবেদন</li>
    </ol>
  @endsection
    <div class="container-fluid">
      <div class="card">
          <div class="card-header">
            <h3 class="card-title">সনদের আবেদন</h3>

            <!-- resources/views/dashboard/certificate_form.blade.php -->
            

            
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
          
          </div>
          <!-- /.card-body -->
        </div>
    </div>
@endsection

@section('third_party_scripts')
  <script type="module">

    
  </script>
@endsection