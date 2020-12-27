@extends('template.index')

@section('title')
Stok Opname
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
        <h3 class="box-title">Ubah Stok Opname</h3>
        <div class="box-tools pull-right">
          <a href="{{ url()->previous() }}" class="btn btn-primary">
            <i class="glyphicon glyphicon-arrow-left"></i> Kembali
          </a>
        </div>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" action="{{ route('stok_opname.update', $stokOpname->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="box-body">
          <div class="form-group">
            <label for="js-barang-keluar">Barang</label>
            <select name="kategori_id" class="form-control" id="js-barang-keluar">
              <option>Pilih Barang</option>
              @foreach($categories as $category)
              <option value="{{ $category->id }}" {{ $stokOpname->kategori_id == $category->id ? "selected" : "" }}>{{ $category->nama_kategori }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="js-jumlah">Jumlah</label>
            <input type="text" name="jumlah" value="{{ $stokOpname->jumlah }}" class="form-control" id="js-jumlah" placeholder="Jumlah">
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