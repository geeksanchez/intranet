    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
          <h1 class="m-0 text-dark">Contactos estrechos</h1>
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    
        <!-- Main content -->
        <div class="content">
          <div class="container-fluid">
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Información general</h3>
              </div>
              <div class="card-body">
                <table id="simpletable" class="table table-bordered table-striped">
                  <caption>Contactos estrechos</caption>
                  <thead>
                    <tr>
                      <th>Empleado</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($covidrelated as $item)
                    <tr>
                      <td>{{ $item->fullname }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>


          </div><!-- /.container-fluid -->
        </div><!-- /.content -->
      </div><!-- /.content-wrapper -->