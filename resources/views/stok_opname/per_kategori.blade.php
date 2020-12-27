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
          <a href="{{ route('stok_opname.index') }}" class="btn btn-primary">
            <i class="glyphicon glyphicon-arrow-left"></i> Kembali
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
            @foreach ($items as $item)
            <tr>
              <td>{{ $item->kategori->nama_kategori }}</td>
              <td>{{ $item->jumlah }}</td>
              <td>
                @if(date('Y-m-d', strtotime($item->created_at)) == date('Y-m-d'))
                <a href="{{ route('barang.edit', $item->id) }}" class="btn btn-primary">Ubah</a>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#js-remove-modal" data-item="Stok Barang" data-url="{{ route('barang.destroy', $item->id) }}" data-item-name="{{ $item->kategori->nama_kategori }}" onclick="showWarningModal(event)">
                  Hapus
                </button>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>Nama Barang</th>
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

@endsection

@section('extra_script')
<script>
  $(function() {
    $('#js-table-kategori').DataTable();
  })
</script>
@endsection