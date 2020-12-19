@extends('template.index')

@section('title')
Kategori
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
        <h3 class="box-title">Tambah Barang</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" action="{{ route('barang.store') }}" method="post">
        @csrf
        <div class="box-body">
          <div class="form-group">
            <label for="js-barang">Barang</label>
            <select name="kategori_id" class="form-control" id="js-barang">
              <option>Pilih Barang</option>
              @foreach($categories as $category)
              <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="js-distributor">Distributor</label>
            <select name="distributor_id" class="form-control" id="js-distributor">
              <option>Pilih Distributor</option>
              @foreach($distributors as $distributor)
              <option value="{{ $distributor->id }}">{{ $distributor->nama }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="js-harga-beli">Harga Beli</label>
            <input type="text" name="harga_beli" class="form-control" id="js-harga-beli" placeholder="Harga Beli">
          </div>
          <div class="form-group">
            <label for="js-jumlah">Jumlah</label>
            <input type="text" name="jumlah" class="form-control" id="js-jumlah" placeholder="Jumlah">
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