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
        <h3 class="box-title">Tambah Distributor</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" action="{{ route('distributor.store') }}" method="post">
        @csrf
        <div class="box-body">
          <div class="form-group">
            <label for="js-nama">Nama</label>
            <input type="text" name="nama" class="form-control" id="js-nama" placeholder="Nama">
          </div>
          <div class="form-group">
            <label for="js-alamat">Alamat</label>
            <input type="text" name="alamat" class="form-control" id="js-alamat" placeholder="Alamat">
          </div>
          <div class="form-group">
            <label for="js-telefon">Telefon</label>
            <input type="text" name="telefon" class="form-control" id="js-telefon" placeholder="Telefon">
          </div>
          <div class="form-group">
            <label for="js-email">Email</label>
            <input type="email" name="email" class="form-control" id="js-email" placeholder="Email">
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