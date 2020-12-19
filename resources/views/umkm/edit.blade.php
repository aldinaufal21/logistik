@extends('template.index')

@section('title')
UMKM
@endsection

@section('content')
@if ($errors->any())
<div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Whoops!</strong> There were some problems with your input.<br><br>
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<div class="row">
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Ubah Kategori Barang</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" action="{{ route('umkm.update', $umkm->id) }}" enctype="multipart/form-data" method="post">
        @csrf
        @method('PUT')
        <div class="box-body">
          <div class="form-group">
            <label for="js-nama">Nama UMKM</label>
            <input type="text" name="nama" class="form-control" id="js-nama" value="{{ $umkm->nama }}">
          </div>
          <div class="form-group">
            <label for="js-deskripsi">Deskripsi UMKM</label>
            <textarea class="form-control" name="deskripsi" id="js-deskripsi" rows="10">{{ $umkm->deskripsi }}</textarea>
          </div>
          <div class="form-group">
            <label for="js-alamat">Alamat</label>
            <textarea class="form-control" name="alamat" id="js-alamat" rows="10">{{ $umkm->alamat }}</textarea>
          </div>
          <div class="form-group">
            <label for="js-gambar">Foto UMKM</label>
            <input type="file" name="gambar" class="form-control" id="js-gambar">
          </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /.row -->

@endsection