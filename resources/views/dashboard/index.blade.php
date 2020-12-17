@extends('template.index')

@section('title')
    Dashboard
@endsection

@if (Auth::user()->role == 1)
    @section('content')
        <!-- Main content -->
        <section class="content">
        <div class="row">
            <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                <h3 class="box-title">List Daftar 5 UMKM Terakhir</h3>
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
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($daftarUmkm as $umkm)
                    <tr>
                        <td>{{ $umkm->nama }}</td>
                        <td>{{ $umkm->deskripsi }}</td>
                        <td>{{ $umkm->alamat }}</td>
                        <td><img src='{{ asset("images/$umkm->gambar") }}' width="200"></td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Alamat</th>
                        <th>Foto</th>
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

@else
    @section('content')
        selamat Datang {{ Auth::user()->name }}
    @endsection
@endif

