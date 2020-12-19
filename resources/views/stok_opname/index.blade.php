@extends('template.index')

@section('title')
Stok Opname
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">List Stok Opname</h3>
        <div class="box-tools pull-right">
          <a href="{{ route('stok_opname.create') }}" class="btn btn-primary">
            Tambah Stok Opname
          </a>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="js-table-kategori" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Nama Barang</th>
              <th>Jumlah</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($stokOpnames as $stokOpname)
            <tr>
              <td>{{ $stokOpname->kategori->nama_kategori }}</td>
              <td>{{ $stokOpname->jumlah }}</td>
              <td>
                <a href="{{ route('stok_opname.edit', $stokOpname->id) }}" class="btn btn-primary">Ubah</a>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#js-remove-modal" data-item="Stok Opname" data-url="{{ route('stok_opname.destroy', $stokOpname->id) }}" data-item-name="{{ $stokOpname->kategori->nama_kategori }}" onclick="showWarningModal(event)">
                  Hapus
                </button>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>Nama Barang</th>
              <th>Distributor</th>
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