    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">Gestión de casos sospechosos</h1>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    
        <!-- Main content -->
        <div class="content">
          <div class="container-fluid">
            <table id="simpletable" class="table table-bordered table-striped">
            <caption>Registros: {{ $covid->total() }}</caption>
              <thead>
                <tr>
                  <th>Reporte</th>
                  <th>Documento</th>
                  <th>Nombre</th>
                  <th>Teléfono</th>
                  <th>Fecha</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($covid as $item)
                <tr>
                  <td>{{ $item->id }}</td>
                  <td>{{ $item->doctype . $item->document }}</td>
                  <td>{{ $item->fullname }}</td>
                  <td>{{ $item->phone }}</td>
                  <td>{{ $item->created_at }}</td>
                  <td>
                    <a class="btn btn-xs {{ ($item->covid_state_id == 2) ? 'btn-warning' : 'btn-danger' }}" href="{{ route('admincovid.edit', $item->id) }}">
                      Gestionar
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
          </table>
          {{ $covid->links() }}
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
  