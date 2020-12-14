@extends('layouts.adminlte.app')

@section('styles')
    
@endsection

@section('content')
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Monitoreo Estado de Salud - Helpharma</h3>
                        </div>
                        <div class="card-body">
                            <h5><i class="fas fa-thumbs-down"></i> Registro no permitido</h5>
                            <p>El reporte no se puede aceptar.  Por favor revise los datos e intente de nuevo.</p>
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