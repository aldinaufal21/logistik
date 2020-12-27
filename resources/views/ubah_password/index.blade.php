@extends('template.index')

@section('title')
Kategori
@endsection

@section('content')
<div class="row">
  <div class="col-md-3">
    <!-- Profile Image -->
    <div class="box box-primary">
        <div class="box-body box-profile">
          <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">

          <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

          <p class="text-muted text-center">
            
            @if (Auth::user()->role == 1)
            Pengelola UMKM
            @else
            Pengurus UMKM
            @endif
        
          </p>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#settings" data-toggle="tab">Ubah Password</a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="settings">
            <form class="form-horizontal" action="{{ route('profile.password') }}" method="POST">
                @csrf
                <div class="form-group">
                  <label  class="col-sm-2 control-label">Password Lama</label>
  
                  <div class="col-sm-10">
                    <input type="password" class="form-control" name="password_old" placeholder="Password Lama">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Password Baru</label>
  
                  <div class="col-sm-10">
                    <input type="password" class="form-control" name="password_new" placeholder="Password Baru">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Password baru ulang</label>
                        
                  <div class="col-sm-10">
                    <input type="password" class="form-control" name="repeat_password_new" placeholder="Input Ulang Password Baru">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-danger">Ubah Password</button>
                  </div>
                </div>
              </form>
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
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