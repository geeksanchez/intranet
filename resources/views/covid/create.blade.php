@extends('layouts.adminlte.app')

@section('styles')
    
@endsection

@section('content')
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        <!-- form start -->
                    <form action="{{ route('encuestacovid.store') }}" method="POST">
                        @csrf
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Monitoreo Estado de salud - Helpharma</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="doctype">Tipo documento *</label>
                                        <select id="doctype" name="doctype" class="form-control" required aria-required="true">
                                            <option value="" {{ old('doctype') == "" ? "selected" : "" }} disabled hidden></option>
                                            <option value="CC" {{ old('doctype') == "CC" ? "selected" : "" }}>Cédula Ciudadanía</option>
                                            <option value="CE" {{ old('doctype') == "CE" ? "selected" : "" }}>Cédula Extranjería</option>
                                            <option value="PA" {{ old('doctype') == "PA" ? "selected" : "" }}>Pasaporte</option>
                                            <option value="PE" {{ old('doctype') == "PE" ? "selected" : "" }}>Permiso de estadia</option>
                                            <option value="TI" {{ old('doctype') == "TI" ? "selected" : "" }}>Tarjeta de identidad</option>
                                            <option value="RC" {{ old('doctype') == "RC" ? "selected" : "" }}>Registro Civil</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="Document">Documento *</label>
                                        <input type="text" class="form-control" id="document" name="document" value="{{old('document')}}" required aria-required="true">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="worktype">Trabajo a realizar hoy *</label>
                                        <select name="worktype" class="form-control" required aria-required="true">
                                            <option value="" {{ old('worktype') == "" ? "selected" : "" }} disabled hidden></option>
                                            <option value="OFICINA" {{ old('worktype') == "OFICINA" ? "selected" : "" }}>Presencial</option>
                                            <option value="CASA" {{ old('worktype') == "CASA" ? "selected" : "" }}>Trabajo en casa</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="temperature">Temperatura corporal *</label>
                                        <input type="number" step="0.1" class="form-control" name="temperature" value="{{ old('temperature') }}" required aria-required="true">
                                    </div>
                                </div>
                                <div class="checkbox-group">
                                    <label>Síntomas: *</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="symptom[]" value="TOS" @if(is_array(old('symptom')) && in_array('TOS', old('symptom'))) checked @endif>
                                        <label class="form-check-label">Tos (seca o expectoración)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="symptom[]" value="RESPIRAR" @if(is_array(old('symptom')) && in_array('RESPIRAR', old('symptom'))) checked @endif>
                                        <label class="form-check-label">Dificultad para respirar</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="symptom[]" value="GARGANTA" @if(is_array(old('symptom')) && in_array('GARGANTA', old('symptom'))) checked @endif>
                                        <label class="form-check-label">Dolor de garganta</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="symptom[]" value="CABEZA" @if(is_array(old('symptom')) && in_array('CABEZA', old('symptom'))) checked @endif>
                                        <label class="form-check-label">Dolor de cabeza (no migraña)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="symptom[]" value="MUSCULAR" @if(is_array(old('symptom')) && in_array('MUSCULAR', old('symptom'))) checked @endif>
                                        <label class="form-check-label">Dolor muscular</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="symptom[]" value="SENTIDOS" @if(is_array(old('symptom')) && in_array('SENTIDOS', old('symptom'))) checked @endif>
                                        <label class="form-check-label">Pérdida del sentido del olfato o del gusto</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="symptom[]" value="NINGUNO" @if(is_array(old('symptom')) && in_array('NINGUNO', old('symptom'))) checked @endif>
                                        <label class="form-check-label">Ninguno</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Contacto cercano: *</label>
                                    <p>¿ En los últimos 14 días he tenido contacto estrecho 
                                        (por mas de 15 minutos a menos de 2 metros y sin usar elementos de protección personal) 
                                        con alguien en proceso de diagnostico o confirmado de COVID-19 o vivo con alguien que está
                                        en proceso de diagnóstico o diagnosticado COVID-19 ?</p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="close_contact" {{ old('close_contact') == "SI" ? "checked" : "" }} value="SI">
                                        <label class="form-check-label">Si</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="close_contact" {{ old('close_contact') == "NO" ? "checked" : "" }} value="NO" required aria-required="true">
                                        <label class="form-check-label">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card card-primary">
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </div>
                    </form>
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