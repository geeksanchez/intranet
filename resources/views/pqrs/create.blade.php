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
                    <form action="{{ route('pqrs.store') }}" method="POST">
                        @csrf
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">PQRS Helpharma</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col">
                                        <label>Tipo documento *</label>
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
                                <div class="form-group">
                                <label for="username">Nombre completo *</label>
                                <input type="text" class="form-control" id="username" name="username" value="{{old('username')}}" required aria-required="true">
                                </div>
                                <div class="form-group">
                                <label for="email">Correo electrónico *</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" required aria-required="true">
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <label for="phone">Teléfono</label>
                                        <input type="number" class="form-control" id="phone" name="phone" max="9999999" value="{{old('phone')}}">
                                    </div>
                                    <div class="col">
                                        <label for="cellphone">Teléfono celular *</label>
                                        <input type="number" class="form-control" id="cellphone" name="cellphone" min="3000000000" max="3999999999" value="{{old('cellphone')}}" required aria-required="true">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col">
                                        <label>Asegurador *</label>
                                        <select id="insurer" name="insurer" class="form-control" required aria-required="true">
                                            <option value="" {{ old('insurer') == "" ? "selected" : "" }} disabled hidden></option>
                                            <option value="EPS SURA" {{ old('insurer') == "EPS SURA" ? "selected" : "" }}>EPS Sura</option>
                                            <option value="VOLUNTAARIOS SURA" {{ old('insurer') == "VOLUNTARIOS SURA" ? "selected" : "" }}>Seguros Voluntarios Sura</option>
                                            <option value="SAVIA SALUD" {{ old('insurer') == "SAVIA SALUD" ? "selected" : "" }}>Savia Salud</option>
                                            <option value="COOSALUD" {{ old('insurer') == "COOSALUD" ? "selected" : "" }}>Coosalud</option>
                                            <option value="GLOBAL SERVICE" {{ old('insurer') == "GLOBAL SERVICE" ? "selected" : "" }}>Global Service</option>
                                            <option value="LICORERA CALDAS" {{ old('insurer') == "LICORERA CALDAS" ? "selected" : "" }}>Industria Licorera Caldas</option>
                                            <option value="SOS EVEDISA" {{ old('insurer') == "SOS EVEDISA" ? "selected" : "" }}>S.O.S. - Evedisa</option>
                                            <option value="SALUD TOTAL" {{ old('insurer') == "SALUD TOTAL" ? "selected" : "" }}>Salud Total</option>
                                            <option value="SANOFI" {{ old('insurer') == "SANOFI" ? "selected" : "" }}>Sanofi</option>
                                            <option value="RED VITAL" {{ old('insurer') == "RED VITAL" ? "selected" : "" }}>Sumimedical - Red Vital</option>
                                            <option value="OTRO" {{ old('insurer') == "OTRO" ? "selected" : "" }}>Otro</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label>Tipo de manifestación *</label>
                                        <select id="pqrstype" name="pqrstype" class="form-control" required aria-required="true">
                                            <option value="" {{ old('pqrstype') == "" ? "selected" : "" }} disabled hidden></option>
                                            <option value="PETICION" {{ old('pqrstype') == "PETICION" ? "selected" : "" }}>Petición</option>
                                            <option value="QUEJA" {{ old('pqrstype') == "QUEJA" ? "selected" : "" }}>Queja</option>
                                            <option value="RECLAMO" {{ old('pqrstype') == "RECLAMO" ? "selected" : "" }}>Reclamo</option>
                                            <option value="SUGERENCIA" {{ old('pqrstype') == "SUGERENCIA" ? "selected" : "" }}>Sugerencia</option>
                                            <option value="FELICITACION" {{ old('pqrstype') == "FELICITACION" ? "selected" : "" }}>Felicitación</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <label>Sede de atención *</label>
                                        <select id="branch" name="branch" class="form-control" required aria-required="true">
                                            <option value="" {{ old('branch') == "" ? "selected" : "" }} disabled hidden></option>
                                            <option value="ALMACENTRO 285" {{ old('branch') == "ALMACENTRO 285" ? "selected" : "" }}>Farmacia Almacentro (local 285)</option>
                                            <option value="IPS MEDELLIN" {{ old('branch') == "IPS MEDELLIN" ? "selected" : "" }}>IPS Almacentro piso 11 (Medellín)</option>
                                            <option value="IPS BARRANQUILLA" {{ old('branch') == "IPS BARRANQUILLA" ? "selected" : "" }}>IPS Mall San Vicente (Barranquilla)</option>
                                            <option value="IPS BOGOTA" {{ old('branch') == "IPS BOGOTA" ? "selected" : "" }}>IPS Panorama (Bogotá)</option>
                                            <option value="IPS CALI" {{ old('branch') == "IPS CALI" ? "selected" : "" }}>IPS Tequendama (Cali)</option>
                                            <option value="LA AMERICA" {{ old('branch') == "LA AMERICA" ? "selected" : "" }}>Farmacia La América (Medellín)</option>
                                            <option value="IPS MANIZALES" {{ old('branch') == "IPS MANIZALES" ? "selected" : "" }}>IPS Centro de Especialistas DASHA (Manizales)</option>
                                            <option value="IPS RIONEGRO" {{ old('branch') == "IPS RIONEGRO" ? "selected" : "" }}>IPS City Médica (Rionegro)</option>
                                            <option value="FARMAALMACENTRO" {{ old('branch') == "FARMAALMACENTRO" ? "selected" : "" }}>Farma Almacentro</option>
                                            <option value="FARMANIQUIA" {{ old('branch') == "FARMANIQUIA" ? "selected" : "" }}>Farma Niquia</option>
                                            <option value="FARMANORTE" {{ old('branch') == "FARMANORTE" ? "selected" : "" }}>Farma Norte</option>
                                            <option value="FORMASUR" {{ old('branch') == "FARMASUR" ? "selected" : "" }}>Farma Sur</option>
                                            <option value="FARMAARMENIA" {{ old('branch') == "FARMAARMENIA" ? "selected" : "" }}>Farma Armenia</option>
                                            <option value="FARMABARRANQUILLA" {{ old('branch') == "FARMABARRANQUILLA" ? "selected" : "" }}>Farma Barranquilla</option>
                                            <option value="FARMABOGOTA" {{ old('branch') == "FARMABOGOTA" ? "selected" : "" }}>Farma Bogotá</option>
                                            <option value="FARMACALI" {{ old('branch') == "FARMACALI" ? "selected" : "" }}>Farma Cali</option>
                                            <option value="FARMACARTAGENA" {{ old('branch') == "FARMACARTAGENA" ? "selected" : "" }}>Farma Cartagena</option>
                                            <option value="FARMAMANIZALES" {{ old('branch') == "FARMAMANIZALES" ? "selected" : "" }}>Farma Manizales</option>
                                            <option value="FARMAPEREIRA" {{ old('branch') == "FARMAPEREIRA" ? "selected" : "" }}>Farma Pereira</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label>Servicio recibido *</label>
                                        <select id="service" name="service" class="form-control" required aria-required="true">
                                            <option value="" {{ old('service') == "" ? "selected" : "" }} disabled hidden></option>
                                            <option value="DOMICILIO" {{ old('service') == "DOMICILIO" ? "selected" : "" }}>Domicilio de medicamentos</option>
                                            <option value="DISPENSACION" {{ old('service') == "DISPENSACION" ? "selected" : "" }}>Dispensación de medicamentos</option>
                                            <option value="CALLCENTER" {{ old('service') == "CALLCENTER" ? "selected" : "" }}>Atención Call Center</option>
                                            <option value="APLICACION SEDE" {{ old('service') == "APLICACION SEDE" ? "selected" : "" }}>Aplicación Medicamentos en sede</option>
                                            <option value="APLICACION DOMICILIO" {{ old('service') == "APLICACION DOMICILIO" ? "selected" : "" }}>Aplicación domiciliaria</option>
                                            <option value="CONSULTA GENERAL" {{ old('service') == "CONSULTA GENERAL" ? "selected" : "" }}>Consulta Medicina General</option>
                                            <option value="CONSULTA ESPECIALIZADA" {{ old('service') == "CONSULTA ESPECIALIZADA" ? "selected" : "" }}>Consulta Medicina Especializada</option>
                                            <option value="CONSULTA OTROS" {{ old('service') == "CONSULTA OTROS" ? "selected" : "" }}>Consulta otros profesionales</option>
                                            <option value="CONSULTA QF" {{ old('service') == "CONSULTA QF" ? "selected" : "" }}>Consulta Químico Farmacéutico</option>
                                            <option value="OTRO" {{ old('service') == "OTRO" ? "selected" : "" }}>Otro</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <label>Clasificación de la PQRS *</label>
                                        <select id="classification" name="classification" class="form-control" required aria-required="true">
                                            <option value="" {{ old('classification') == "" ? "selected" : "" }} disabled hidden></option>
                                            <option value="DOMICILIO DEMORADO"{{ old('classification') == "DOMICILIO DEMORADO" ? "selected" : "" }}>Domicilio entregado en un tiempo mayor a 48 horas hábiles después de la solicitud</option>
                                            <option value="DOMICILIO INCOMPLETO"{{ old('classification') == "DOMICILIO INCOMPLETO" ? "selected" : "" }}>Medicamento no entregado o entrega incompleta (pendientes)</option>
                                            <option value="DOMICILIO COBRADO VULNERABLE"{{ old('classification') == "DOMICILIO COBRADO VULNERABLE" ? "selected" : "" }}>Domicilio cobrado (población vulnerable)</option>
                                            <option value="ERROR ENTREGA MEDICAMENTO"{{ old('classification') == "ERROR ENTREGA MEDICAMENTO" ? "selected" : "" }}>Error en la entrega del medicamento</option>
                                            <option value="NOVEDAD EN FORMULARIO"{{ old('classification') == "NOVEDAD EN FORMULARIO" ? "selected" : "" }}>Dificultad para la solicitud de medicamentos en el formulario</option>
                                            <option value="CALIDAD ATENCION"{{ old('classification') == "CALIDAD ATENCION" ? "selected" : "" }}>Calidad en la atención</option>
                                            <option value="CALIDAD MENSAJERIA"{{ old('classification') == "CALIDAD MENSAJERIA" ? "selected" : "" }}>Calidad del servicio de mensajería</option>
                                            <option value="DIFICULTAD CITAS"{{ old('classification') == "DIFICULTAD CITAS" ? "selected" : "" }}>Dificultad en asignación de citas</option>
                                            <option value="DEMORA ATENCION"{{ old('classification') == "DEMORA ATENCION" ? "selected" : "" }}>Demora en la atención</option>
                                            <option value="DIFICULTAD COMUNICACION"{{ old('classification') == "DIFICULTAD COMUNICACION" ? "selected" : "" }}>Dificultad en la comunicación</option>
                                            <option value="FALTA INFORMACION"{{ old('classification') == "FALTA INFORMACION" ? "selected" : "" }}>Falta de información</option>
                                            <option value="OTRO"{{ old('classification') == "OTRO" ? "selected" : "" }}>Otro</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="notes">Descripción de la solicitud</label>
                                    <textarea class="form-control" name="notes" id="notes" value="{{old('notes')}}"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Diligenciado por *</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="filledby" value="PACIENTE" {{ old('filledby') == "PACIENTE" ? "checked" : "" }} required aria-required="true">
                                        <label class="form-check-label">Paciente</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="filledby" value="ACUDIENTE"{{ old('filledby') == "ACUDIENTE" ? "checked" : "" }}>
                                        <label class="form-check-label">Cuidador o Acudiente</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="filledby" value="HELPHARMA"{{ old('filledby') == "HELPHARMA" ? "checked" : "" }}>
                                        <label class="form-check-label">Funcionario Helpharma</label>
                                    </div>
                                </div>
                                <label>AUTORIZACIÓN Y TRATAMIENTO DE DATOS PERSONALES *</label>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="legal" name="legal" {{ old('legal') != "" ? "checked" : "" }} required aria-required="true">
                                    <label class="form-check-label" for="legal">
                                        He leído y acepto el tratamiento de mis datos personales 
                                        conforme a la Política de Tratamiento de Datos Personales 
                                        dispuestas en el siguiente link: <a href="https://www.helpharma.com.co/app/webroot/img/generals/file/(Publicaci%C3%B3n%20Web)%20Pol%C3%ADtica%20de%20Tratamiento%20de%20Datos%20Personales%20Helpharma.pdf">Política de tratamiento de datos personales</a>
                                    </label>
                                </div>
                                <div>
                                    <input type="hidden" id="active" name="active" value="1">
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