@extends('template.index')

@section('title')
Dashboard
@endsection

@section('content')
<div class="row">
  <div class="col-md-6">

    <!-- DONUT CHART -->
    <div class="box box-danger">
      <div class="box-header with-border">
        <h3 class="box-title">Jumlah per kategori</h3>
      </div>
      <div class="box-body">
        <canvas id="pieChart" style="height:250px"></canvas>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

  </div>
  <!-- /.col (LEFT) -->
  <div class="col-md-6">

    <!-- BAR CHART -->
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Jumlah Biaya Kategori</h3>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="barChart" style="height:230px"></canvas>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

  </div>
  <!-- /.col (RIGHT) -->
</div>

<!-- 5 Barang Terakhir Input -->
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">List Daftar 5 Barang Terakhir</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="js-table-5-barang-terakhir" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Nama Barang</th>
              <th>Distributor</th>
              <th>Harga Beli</th>
              <th>Jumlah</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($items as $items)
            <tr>
              <td>{{ $items->kategori->nama_kategori }}</td>
              <td>{{ $items->distributor->nama }}</td>
              <td>{{ $items->harga_beli }}</td>
              <td>{{ $items->jumlah }}</td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>Nama Barang</th>
              <th>Distributor</th>
              <th>Harga Beli</th>
              <th>Jumlah</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>

<!-- 5 Stok Kategori Terbanyak -->
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">List Daftar 5 Stok Kategori Terbanyak</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="js-table-kategori-terbanyak" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Nama Kategori Barang</th>
              <th>Stok</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($top5Categories as $category)
            <tr>
              <td>{{ $category->nama_kategori }}</td>
              <td>{{ $category->stok }}</td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>Nama Kategori</th>
              <th>Stok</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>
<!-- /.row -->
@endsection

@section('extra_script')
<script src="{{ asset('bower_components/chart.js/Chart.js') }}"></script>
<script>
  let umkmId = {{ Auth::user()->umkm()->first()->id }}
  $(function() {
    $('#js-table-5-barang-terakhir, #js-table-kategori-terbanyak').DataTable();
    renderJumlahPerKategoriChart();
    renderJumlahBiayaPerKategoriChart();
  });

  function renderJumlahPerKategoriChart() {
    let pieData = [];
    $.ajax({
      url: `/api/dashboard/jumlah_per_kategori/${umkmId}`,
      method: 'get',
      async: false,
      success: (res) => {
        res.forEach(item => {
          pieData.push({
            value: item.stok,
            label: item.nama_kategori
          });
        });
      }
    });

    //-------------
    //- PIE CHART -
    //-------------
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
    var pieChart = new Chart(pieChartCanvas)

    var pieOptions = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke: true,
      //String - The colour of each segment stroke
      segmentStrokeColor: '#fff',
      //Number - The width of each segment stroke
      segmentStrokeWidth: 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps: 100,
      //String - Animation easing effect
      animationEasing: 'easeOutBounce',
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate: true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale: false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //String - A legend template
      legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(pieData, pieOptions)
  }

  function renderJumlahBiayaPerKategoriChart() {
    let barChartData = {};
    $.ajax({
      url: `/api/dashboard/jumlah_biaya_kategori/${umkmId}`,
      method: 'get',
      async: false,
      success: (res) => {
        let labels = [];
        let labelValues = [];

        res.forEach(item => {
          labels.push(item.nama_kategori);
          labelValues.push(item.biaya);
        });

        barChartData = {
          labels: labels,
          datasets: [{
            label: 'Digital Goods',
            fillColor: 'rgba(60,141,188,0.9)',
            strokeColor: 'rgba(60,141,188,0.8)',
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba(60,141,188,1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data: labelValues
          }]
        }
      }
    });
    
    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChart = new Chart(barChartCanvas)

    var barChartOptions = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: true,
      //String - Colour of the grid lines
      scaleGridLineColor: 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - If there is a stroke on each bar
      barShowStroke: true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth: 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing: 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing: 1,
      //String - A legend template
      legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive: true,
      maintainAspectRatio: true
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
  }
</script>
<script>
  $(function() {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    
  });
</script>
@endsection