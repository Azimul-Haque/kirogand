@extends('layouts.app')
@section('title') ড্যাশবোর্ড | ব্যবহারকারী সনদ তালিকা @endsection

@section('third_party_stylesheets')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')
	@section('page-header') ব্যবহারকারী সনদ তালিকা@endsection
  @section('page-header-right')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">ড্যাশবোর্ড</a></li>
        <li class="breadcrumb-item active">ব্যবহারকারী সনদ তালিকা</li>
    </ol>
  @endsection
    <div class="container-fluid">
		  
        
    </div>
@endsection

@section('third_party_scripts')
    
@endsection