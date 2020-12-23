    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
          <h1 class="m-0 text-dark">Gestionar PQRS {{ $pqrs->id }}</h1>
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
                  <label for="feedback">Seguimiento:</label>
                  <textarea class="form-control" name="feedback" readonly>{{ $pqrs->feedback }}</textarea>
              </div>
                <form action="{{ url('/adminpqrs/' . $pqrs->id) }}" method="post">
                  {{ csrf_field() }}
                  {{ method_field('PATCH') }}
                  <div class="form-group">
                    <label for="newfeedback">Respuesta:</label>
                    <textarea class="form-control" name="newfeedback"></textarea>
                  </div>
                  <div class="callout callout-success">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="cerrar" name="cerrar">
                      <label class="form-check-label" for="cerrar">
                        Cerrar PQRS
                      </label>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
              </div>
            </div>
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Otras PQRS del usuario</h3>
              </div>
              <div class="card-body">
                <table id="simpletable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>PQRS</th>
                      <th>Tipo PQRS</th>
                      <th>Servicio</th>
                      <th>Clasificación</th>
                      <th>Sede</th>
                      <th>Fecha</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($other_pqrs as $item)
                    <tr>
                      <td><a href="{{ route('adminpqrs.show', $item->id) }}">{{ $item->id }}</a></td>
                      <td>{{ $item->pqrstype }}</td>
                      <td>{{ $item->service }}</td>
                      <td>{{ $item->classification }}</td>
                      <td>{{ $item->branch }}</td>
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