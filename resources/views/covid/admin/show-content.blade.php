    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
          <h1 class="m-0 text-dark">Datos de PQRS {{ $pqrs->id }}</h1>
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
                      <th>e-mail</th>
                      <th>Teléfono</th>
                      <th>Celular</th>
                      <th>Registrante</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{ $pqrs->doctype . $pqrs->document }}</td>
                      <td>{{ $pqrs->username }}</td>
                      <td>{{ $pqrs->email }}</td>
                      <td>{{ $pqrs->phone }}</td>
                      <td>{{ $pqrs->cellphone }}</td>
                      <td>{{ $pqrs->filledby }}</td>
                    </tr>
                  </tbody>
                </table>
                <table id="simpletable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Sede</th>
                      <th>Tipo PQRS</th>
                      <th>Servicio</th>
                      <th>Clasificación</th>
                      <th>Fecha</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{ $pqrs->branch }}</td>
                      <td>{{ $pqrs->pqrstype }}</td>
                      <td>{{ $pqrs->service }}</td>
                      <td>{{ $pqrs->classification }}</td>
                      <td>{{ $pqrs->created_at }}</td>
                    </tr>
                  </tbody>
                </table>
                <table id="simpletable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Notas</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{ $pqrs->notes }}</td>
                    </tr>
                  </tbody>
                </table>
                <div class="form-group">
                  <label for="notes">Respuesta:</label>
                  <textarea class="form-control" name="feedback" id="feedback">{{ $pqrs->feedback }}</textarea>
                </div>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->