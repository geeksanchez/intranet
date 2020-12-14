@extends('layouts.adminlte.app')

@section('styles')
    
@endsection

@section('content')
  <div class="wrapper">

    @include('adminlte.navbar')

    @include('adminlte.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    </div>
    <!-- /.content-wrapper -->

    @include('adminlte.control-sidebar')

    @include('adminlte.footer')

  </div>
  <!-- ./wrapper -->
@endsection

@section('scripts')
    
@endsection