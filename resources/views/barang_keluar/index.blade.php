@extends('template.index')

@section('title')
Barang Keluar
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">List Barang Keluar</h3>
        <div class="box-tools pull-right">
          <a href="{{ route('barang_keluar.create') }}" class="btn btn-primary">
            Tambah Barang Keluar
          </a>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="js-table-kategori" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Nama Kategori Barang</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categories as $category)
            <tr>
              <td>{{ $category->nama_kategori }}</td>
              <td>
                <a href="{{ route('barang_keluar.kategori', $category->id) }}" class="btn btn-primary">Lihat</a>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>Nama Kategori</th>
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

@endsection

@section('extra_script')
<script>
  $(function() {
    $('#js-table-kategori').DataTable();
  })
</script>
@endsection