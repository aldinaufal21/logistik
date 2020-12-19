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
          <h3 class="box-title">List UMKM</h3>
          <div class="box-tools pull-right">
            <a href="{{ route('umkm.create') }}" class="btn btn-primary">
              Tambah UMKM
            </a>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="js-table-umkm" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Alamat</th>
                <th>Foto</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($umkms as $umkm)
              <tr>
                <td>{{ $umkm->nama }}</td>
                <td>{{ $umkm->deskripsi }}</td>
                <td>{{ $umkm->alamat }}</td>
                <td><img src='{{ asset("$umkm->gambar") }}' width="200"></td>
                <td>
                  <a href="{{ route('umkm.edit', $umkm->id) }}" class="btn btn-primary">Ubah</a>
                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#js-remove-modal" data-item="UMKM" data-url="{{ route('umkm.destroy', $umkm->id) }}" data-item-name="{{ $umkm->nama }}" onclick="showWarningModal(event)">
                    Hapus
                  </button>
                </td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Alamat</th>
                <th>Foto</th>
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
    $('#js-table-umkm').DataTable();
  })
</script>
@endsection