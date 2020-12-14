    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">Farmacoseguridad</h1>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    
        <!-- Main content -->
        <div class="content">
          <div class="container-fluid">
            <table id="simpletable" class="table table-bordered table-striped">
            <caption>Registros: {{ $seguimientos->total() }}</caption>
              <thead>
                <tr>
                  <th>Documento</th>
                  <th>¿síntoma?</th>
                  <th>¿Cuál?</th>
                  <th>e-mail</th>
                  <th>Teléfono</th>
                  <th>Fecha</th>
                  <th>Procesar</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($seguimientos as $seguimiento)
                <tr>
                  <td>{{ $seguimiento->doctype . $seguimiento->document }}</td>
                  <td>{{ $seguimiento->hasSymptom }}</td>
                  <td>{{ $seguimiento->symptom }}</td>
                  <td>{{ $seguimiento->email }}</td>
                  <td>{{ $seguimiento->phone }}</td>
                  <td>{{ $seguimiento->created_at }}</td>
                  <td>
                    <form action="{{ url('/farmacoseguridad/' . $seguimiento->id) }}" method="post">
                      {{ csrf_field() }}
                      {{ method_field('PATCH') }}
                      <button type="submit" onclick="return confirm('¿Procesado?');" class="btn btn-primary">Procesar</button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
          </table>
          {{ $seguimientos->links() }}
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
  