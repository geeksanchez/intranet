    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
          <h1 class="m-0 text-dark">Prueba COVID-19 para {{ $employee->fullname }}</h1>
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    
        <!-- Main content -->
        <div class="content">
          <div class="container-fluid">

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Agregar prueba COVID-19</h3>
              </div>
              <form action="{{ route('admincovid.sample.update', $covid->id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
              <div class="card-body">

                  <div class="form-group col-md-4">
                    <label for="sample_date">Fecha</label>
                    <input type="date" class="form-control" name="sample_date" required>
                  </div>

                  <div class="form-group col">
                      <label>Resultado:</label>
                      <div class="form-check">
                          <input class="form-check-input" type="radio" name="sample_result" value="POSITIVO">
                          <label class="form-check-label">Positivo</label>
                      </div>
                      <div class="form-check">
                          <input class="form-check-input" type="radio" name="sample_result" value="NEGATIVO" required aria-required="true">
                          <label class="form-check-label">Negativo</label>
                      </div>
                  </div>


              </div>
              <div class="card-footer">
                <a class="btn btn-primary" href="{{ route('admincovid.edit', $covid->id) }}">Cerrar</a>
                <button type="submit" class="btn btn-warning">Agregar</button>
              </div>
              </form>
            </div>

          </div><!-- /.container-fluid -->
        </div><!-- /.content -->
      </div><!-- /.content-wrapper -->