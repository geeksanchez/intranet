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
            <div class="card">
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
                <textarea name="follow">{{ $covid_follow->notes }}</textarea>
                <form action="{{ url('/admincovid/' . $covid->id) }}" method="post">
                  {{ csrf_field() }}
                  {{ method_field('PATCH') }}
                  <div class="form-group">
                    <label for="notes">Seguimiento:</label>
                    <textarea class="form-control" name="feedback"></textarea>
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
            <div class="card">
              <div class="card-header border-0">
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