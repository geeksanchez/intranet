    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
          <h1 class="m-0 text-dark">Buscar PQRS</h1>
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    
        <!-- Main content -->
        <div class="content">
          <div class="container-fluid">
            <form action="{{ route('adminpqrs.find') }}" method="POST">
            {{ csrf_field() }}
              <div class="card">
                <div class="card-body">

                  <div class="form-group col-md-4">
                    <label for="Document">Documento:</label>
                    <input type="text" class="form-control" name="document" required aria-required="true">
                  </div>

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                  </div>

                </div>
              </div>
            </form>

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Casos del documento {{ ($pqrs->isEmpty()) ? '' : $pqrs[0]->document }}</h3>
              </div>
              <div class="card-body">
                <table id="others" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Reporte</th>
                      <th>Documento</th>
                      <th>Nombre</th>
                      <th>Fecha</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($pqrs as $item)
                    <tr>
                      <td><a href="{{ route('adminpqrs.show', $item->id) }}">{{ $item->id }}</a></td>
                      <td>{{ $item->document }}</td>
                      <td>{{ $item->username }}</td>
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