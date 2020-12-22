    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
          <h1 class="m-0 text-dark">Contactos estrechos para {{ $covid->fullname }}</h1>
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    
        <!-- Main content -->
        <div class="content">
          <div class="container-fluid">
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Reportados</h3>
              </div>
              <div class="card-body">
                <table id="simpletable" class="table table-bordered table-striped">
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

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Agregar contacto estrecho</h3>
              </div>
              <form action="{{ route('admincovid.related.update', $covid->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
              <div class="card-body">

                <div class="form-group">
                  <label for="employee">Empleados</label>
                  <select class="form-control" name="employee">
                    <option value="" {{ old('employee') == "" ? "selected" : "" }} disabled hidden></option>
                    @foreach ($employee as $person)
                      <option value="{{ $person->id }}">{{ $person->fullname }}</option>
                    @endforeach
                  </select>
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