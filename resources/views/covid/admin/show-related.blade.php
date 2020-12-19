@extends('layouts.adminlte.app')

@section('styles')
    
@endsection

@section('content')
  <div class="wrapper">

    @include('adminlte.navbar')

    @include('adminlte.sidebar')

    @include('covid.admin.show-related-content')
  
    @include('adminlte.control-sidebar')

    @include('adminlte.footer')

  </div>
  <!-- ./wrapper -->
@endsection

@section('scripts')

@endsection