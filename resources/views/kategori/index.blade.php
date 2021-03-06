@extends('template.index')

@section('title')
Kategori
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">List Kategori Barang</h3>
        <div class="box-tools pull-right">
          <a href="{{ route('kategori.create') }}" class="btn btn-primary">
            Tambah Kategori Barang
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
                <a href="{{ route('kategori.edit', $category->id) }}" class="btn btn-primary">Ubah</a>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#js-remove-modal" data-item="Kategori" data-url="{{ route('kategori.destroy', $category->id) }}" data-item-name="{{ $category->nama_kategori }}" onclick="showWarningModal(event)">
                  Hapus
                </button>
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