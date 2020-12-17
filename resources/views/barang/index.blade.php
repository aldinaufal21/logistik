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
          <h3 class="box-title">List Barang</h3>
          <div class="box-tools pull-right">
            <a href="{{ route('barang.create') }}" class="btn btn-primary">
              Tambah Barang
            </a>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="js-table-kategori" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nama Barang</th>
                <th>Distributor</th>
                <th>Harga Beli</th>
                <th>Jumlah</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($items as $items)
              <tr>
                <td>{{ $items->nama_kategori }}</td>
                <td>{{ $items->nama }}</td>
                <td>{{ $items->harga_beli }}</td>
                <td>{{ $items->jumlah }}</td>
                <td>
                  <form action="{{ route('barang.destroy', $items->id) }}" method="POST">
                  <a href="{{ route('barang.edit', $items->id) }}" class="btn btn-primary">Ubah</a>
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
                <th>Nama Barang</th>
                <th>Distributor</th>
                <th>Harga Beli</th>
                <th>Jumlah</th>
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