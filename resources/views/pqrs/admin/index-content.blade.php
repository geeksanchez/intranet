    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">PQRS</h1>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    
        <!-- Main content -->
        <div class="content">
          <div class="container-fluid">
            <table id="simpletable" class="table table-bordered table-striped">
            <caption>Registros: {{ $pqrs->total() }}</caption>
              <thead>
                <tr>
                  <th>PQRS</th>
                  <th>Documento</th>
                  <th>Nombre</th>
                  <th>Teléfono</th>
                  <th>Celular</th>
                  <th>Tipo PQRS</th>
                  <th>Servicio</th>
                  <th>Sede</th>
                  <th>Fecha</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($pqrs as $item)
                <tr>
                  <td>{{ $item->id }}</td>
                  <td>{{ $item->doctype . $item->document }}</td>
                  <td>{{ $item->username }}</td>
                  <td>{{ $item->phone }}</td>
                  <td>{{ $item->cellphone }}</td>
                  <td>{{ $item->pqrstype }}</td>
                  <td>{{ $item->service }}</td>
                  <td>{{ $item->branch }}</td>
                  <td>{{ $item->created_at }}</td>
                  <td>
                    <a class="btn btn-xs {{ ($item->active == 1) ? 'btn-primary' : 'btn-warning' }}" href="{{ route('adminpqrs.edit', $item->id) }}">
                      Editar
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
          </table>
          {{ $pqrs->links() }}
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
  