    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
          <h1 class="m-0 text-dark">Gestionar reporte {{ $covid->id }}</h1>
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    
        <!-- Main content -->
        <div class="content">
          <div class="container-fluid">
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Información general</h3>
              </div>
              <div class="card-body">
                <table id="simpletable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Documento</th>
                      <th>Nombre</th>
                      <th>Edad (años)</th>
                      <th>Género</th>
                      <th>Teléfono</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{ $employee->doctype . $employee->document }}</td>
                      <td>{{ $employee->fullname }}</td>
                      <td>{{ $employee->age }}</td>
                      <td>{{ $employee->gender }}</td>
                      <td>{{ $employee->phone }}</td>
                    </tr>
                  </tbody>
                </table>
                <table id="simpletable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>EPS</th>
                      <th>ARL</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{ $employee->eps }}</td>
                      <td>{{ $employee->arl }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Seguimiento de caso confirmado</h3>
              </div>
              <div class="card-body">
                <form action="{{ url('/admincovid/' . $covid_positive->id) }}" method="post">
                  {{ csrf_field() }}
                  {{ method_field('PATCH') }}

                  <input type="hidden" name="state" value="3">

                  <div class="form-group row">
                    <div class="col">
                      <label for="contact_type">Tipo de contagio</label>
                      <select class="form-control" name="contact_type">
                        <option value="" {{ old('contact_type') == "" ? "selected" : "" }} disabled hidden></option>
                        <option value="SOCIAL" {{ $covid_positive->contact_type == "SOCIAL" ? "selected" : "" }}>Contagio social</option>
                        <option value="LABORAL" {{ $covid_positive->contact_type == "LABORAL" ? "selected" : "" }}>Exposición laboral</option>
                      </select>
                    </div>

                    <div class="col">
                      <label for="treatment">Tratamiento</label>
                      <select class="form-control" name="treatment">
                        <option value="" {{ old('treatment') == "" ? "selected" : "" }} disabled hidden></option>
                        <option value="CASA" {{ $covid_positive->treatment == "CASA" ? "selected" : "" }}>En casa</option>
                        <option value="HOSPITAL" {{ $covid_positive->treatment == "HOSPITAL" ? "selected" : "" }}>Hospitalario</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="description">Descripción del contagio</label>
                    <textarea class="form-control" name="description">{{ $covid_positive->description }}</textarea>
                  </div>

                  <div class="form-group">
                    <label for="symptoms">Síntomas</label>
                    <textarea class="form-control" name="symptoms">{{ $covid_positive->description }}</textarea>
                  </div>

                    <div class="form-group">
                      <label for="positive_notes">Seguimientos anteriores</label>
                      <textarea class="form-control" name="positive_notes" readonly>{{ $covid_follow->notes . $covid_positive->notes }}</textarea>
                    </div>

                  <div class="form-group">
                    <label for="follow">Actualización:</label>
                    <textarea class="form-control" name="follow"></textarea>
                  </div>

                  <div class="callout callout-success">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" name="cerrar">
                      <label class="form-check-label" for="cerrar">
                        Cerrar caso
                      </label>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
              </div>
            </div>

            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Seguimiento de caso sospechoso</h3>
              </div>
              <div class="card-body">

                <div class="form-group row">
                  <div class="col">
                    <label for="disability">Tipo de ausencia</label>
                    <select class="form-control" name="disability">
                      <option value="" {{ old('disability') == "" ? "selected" : "" }} disabled hidden></option>
                      <option value="TELETRABAJO" {{ $covid_follow->disability == "TELETRABAJO" ? "selected" : "" }}>Teletrabajo</option>
                      <option value="INCAPACIDAD" {{ $covid_follow->disability == "INCAPACIDAD" ? "selected" : "" }}>Incapacidad</option>
                    </select>
                  </div>
                  <div class="col">
                    <label for="disability_date">Fecha inicio de ausencia</label>
                    <input type="date" class="form-control" name="disability_date" value="{{ $covid_follow->disability_date }}">
                  </div>
                  <div class="col">
                    <label for="return_date">Fecha final de ausencia</label>
                    <input type="date" class="form-control" name="return_date" value="{{ $covid_follow->return_date }}">
                  </div>
                </div>

                <div class="form-group">
                  <label for="diagnosis">Diagnóstico</label>
                  <textarea class="form-control" name="diagnosis" readonly>{{ $covid_follow->diagnosis }}</textarea>
                </div>

                <div class="callout callout-danger">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="covid_positivo" checked onclick="return false;">
                    <label class="form-check-label" for="covid_positivo">
                      Covid-19 Positivo
                    </label>
                  </div>
                </div>

              </div>
            </div>

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Otros casos COVID-19 de la persona</h3>
              </div>
              <div class="card-body">
                <table id="simpletable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Reporte</th>
                      <th>Tipo de caso</th>
                      <th>Fecha</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($other_covid as $item)
                    <tr>
                      <td><a href="{{ route('admincovid.show', $item->id) }}">{{ $item->id }}</a></td>
                      <td>{{ $item->name }}</td>
                      <td>{{ $item->created_at }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->