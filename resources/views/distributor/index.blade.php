@extends('template.index')

@section('title')
Kategori
@endsection

@section('content')

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">List Distributor</h3>
          <div class="box-tools pull-right">
            <a href="{{ route('distributor.create') }}" class="btn btn-primary">
              Tambah Distributor
            </a>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="js-table-kategori" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Telefon</th>
                <th>Email</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($distributors as $distributor)
              <tr>
                <td>{{ $distributor->nama }}</td>
                <td>{{ $distributor->alamat }}</td>
                <td>{{ $distributor->telefon }}</td>
                <td>{{ $distributor->email }}</td>
                <td>
                  <form action="{{ route('distributor.destroy', $distributor->id) }}" method="POST">
                  <a href="{{ route('distributor.edit', $distributor->id) }}" class="btn btn-primary">Ubah</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Telefon</th>
                <th>Email</th>
                <th>Aksi</th>
              </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
@endsection

@section('extra_script')
<script>
  $(function() {
    $('#js-table-kategori').DataTable();
  })
</script>
@endsection