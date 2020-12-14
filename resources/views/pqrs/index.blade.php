@extends('layouts.adminlte.app')

@section('styles')
    
@endsection

@section('content')
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">PQRS Helpharma</h3>
                        </div>
                        <div class="card-body">
                            <h3 class="row justify-content-center">Ingresar un registro PQRS</h3>
                            <a href="{{ route('pqrs.create') }}">
                                <button type="button" class="btn btn-block btn-primary btn-lg">Ingresar</button>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.col-md -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- ./wrapper -->
@endsection

@section('scripts')

@endsection