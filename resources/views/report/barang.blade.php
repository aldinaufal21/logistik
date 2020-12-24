<h3>Report data barang {{ Auth::user()->name }}</h3>
<br>

<table id="js-table-kategori" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Distributor</th>
        <th>Tanggal</th>
        <th>Harga Beli</th>
        <th>Jumlah</th>
      </tr>
    </thead>
    <tbody>
      @php
          $no = 1;
      @endphp
      @foreach ($report as $items)
      <tr>
        <td>{{ $no++ }}</td>
        <td>{{ $items->kategori->nama_kategori }}</td>
        <td>{{ $items->distributor->nama }}</td>
        <td>{{ $items->created_at->toDateString() }}</td>
        <td>{{ $items->harga_beli }}</td>
        <td>{{ $items->jumlah }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>