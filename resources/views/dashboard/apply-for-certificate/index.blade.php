@extends('layouts.app')
@section('title') ড্যাশবোর্ড | সনদের আবেদন @endsection

@section('third_party_stylesheets')
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css"> --}}

    <style>
    

    </style>
@endsection

@section('content')
  @section('page-header') সনদের আবেদন @endsection
    
@endsection

@section('third_party_scripts')
  {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
  <script type="module">

    $(document).on('click', '#search-button', function() {
      if($('#search-param').val() != '') {
        var urltocall = '{{ route('dashboard.local-offices') }}' +  '/' + $('#search-param').val();
        location.href= urltocall;
      } else {
        $('#search-param').css({ "border": '#FF0000 2px solid'});
        Toast.fire({
            icon: 'warning',
            title: 'কিছু লিখে খুঁজুন!'
        })
      }
    });
    $("#search-param").keyup(function(e) {
      if(e.which == 13) {
        if($('#search-param').val() != '') {
          var urltocall = '{{ route('dashboard.local-offices') }}' +  '/' + $('#search-param').val();
          location.href= urltocall;
        } else {
          $('#search-param').css({ "border": '#FF0000 2px solid'});
          Toast.fire({
              icon: 'warning',
              title: 'কিছু লিখে খুঁজুন!'
          })
        }
      }
    });
  </script>
@endsection