@extends('template.index')

@section('title')
Kategori
@endsection

@section('content')

<!-- Main content -->
<section class="content">
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
          <h3 class="box-title">Tambah Kategori Barang</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="{{ route('kategori.store') }}" method="post">
          @csrf
          <div class="box-body">
            <div class="form-group">
              <label for="js-nama-kategori">Nama Kategori Barang</label>
              <input type="text" name="nama_kategori" class="form-control" id="js-nama-kategori" placeholder="Nama Kategori Barang">
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
</section>
<!-- /.content -->
@endsection