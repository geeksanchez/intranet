@extends('layouts.adminlte.app')

@section('styles')
    
@endsection

@section('content')
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Monitoreo Estado de Salud - Helpharma</h3>
                        </div>
                        <div class="card-body">
                            <h5><i class="fas fa-exclamation"></i> Registro {{ $covid->id }}</h5>
                            <p>Hemos identificado factores de riesgo. Comunícate con tu jefe inmediato y no salgas de casa.</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('welcome') }}">
                                <button type="button" class="btn btn-primary">Regresar</button>
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