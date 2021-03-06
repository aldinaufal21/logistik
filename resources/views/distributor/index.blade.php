@extends('template.index')

@section('title')
Distributor
@endsection

@section('content')
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
                <a href="{{ route('distributor.edit', $distributor->id) }}" class="btn btn-primary">Ubah</a>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#js-remove-modal" data-item="Distributor" data-url="{{ route('distributor.destroy', $distributor->id) }}" data-item-name="{{ $distributor->nama }}" onclick="showWarningModal(event)">
                  Hapus
                </button>
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

@endsection

@section('extra_script')
<script>
  $(function() {
    $('#js-table-kategori').DataTable();
  })
</script>
@endsection