@extends('template.index')

@section('title')
Report Data Barang
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
        <h3 class="box-title">Report Data Barang</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" action="{{ route('report.exportData') }}" method="post">
        @csrf
        <div class="box-body">
          <div class="form-group">
            <label for="js-nama">Tanggal Awal</label>
            <input type="text" name="tgl_awal" class="form-control datepicker" placeholder="tanggal awal">
          </div>
          <div class="form-group">
            <label for="js-alamat">Tanggal Akhir</label>
            <input type="text" name="tgl_akhir" class="form-control datepicker" placeholder="tanggal akhir">
          </div>
          <div class="form-group">
            <label for="js-alamat">Report Data</label>
            <select name="data" class="form-control">
              <option value="1">barang</option>
              <option value="2">pengeluaran barang</option>
            </select>
          </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Export Data Report</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /.row -->

@endsection