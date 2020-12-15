    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
          <h1 class="m-0 text-dark">Reporte {{ $covid->id }}</h1>
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
                      <th>Temperatura</th>
                      <th>Síntomas</th>
                      <th>Contacto cercano</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{ $covid->temperature }}</td>
                      <td>{{ $covid->symptoms }}</td>
                      <td>{{ $covid->close_contact }}</td>
                    </tr>
                  </tbody>
                </table>
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
                      <select class="form-control" name="disability" disabled>
                        <option value="" {{ old('disability') == "" ? "selected" : "" }} disabled hidden></option>
                        <option value="TELETRABAJO" {{ $covid_follow->disability == "TELETRABAJO" ? "selected" : "" }}>Teletrabajo</option>
                        <option value="INCAPACIDAD" {{ $covid_follow->disability == "INCAPACIDAD" ? "selected" : "" }}>Incapacidad</option>
                      </select>
                    </div>
                    <div class="col">
                      <label for="disability_date">Fecha inicio de ausencia</label>
                      <input type="date" class="form-control" name="disability_date" value="{{ $covid_follow->disability_date }}" readonly>
                    </div>
                    <div class="col">
                      <label for="return_date">Fecha final de ausencia</label>
                      <input type="date" class="form-control" name="return_date" value="{{ $covid_follow->return_date }}" readonly>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="diagnosis">Diagnóstico</label>
                    <textarea class="form-control" name="diagnosis" readonly>{{ $covid_follow->diagnosis }}</textarea>
                  </div>

                  <div class="callout callout-danger">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" name="covid_positivo" {{ $covid->covid_state_id == "3" ? "checked" : "" }}>
                      <label class="form-check-label" for="covid_positivo">
                        Covid-19 Positivo
                      </label>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="notes">Seguimiento</label>
                    <textarea class="form-control" name="notes" readonly>{{ $covid_follow->notes }}</textarea>
                  </div>

              </div>
            </div>

          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->