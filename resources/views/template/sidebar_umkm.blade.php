<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="{{ (request()->is('/')) ? 'active' : '' }}">
          <a href="/"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
        </li>
        <li class="{{ (request()->routeIs('distributor.*')) ? 'active' : '' }}">
            <a href="{{ route('distributor.index') }}"><i class="fa fa-users"></i> <span>Kelola Distributor</span></a>
        </li>
        <li class="{{ (request()->routeIs('kategori.*')) ? 'active' : '' }}">
            <a href="{{ route('kategori.index') }}"><i class="fa fa-cube"></i> <span>Kelola kategori barang</span></a>
        </li>
        <li class="{{ (request()->routeIs('barang.*')) ? 'active' : '' }}">
            <a href="{{ route('barang.index') }}"><i class="fa fa-cube"></i> <span>Kelola barang</span></a>
        </li>
        <li class="{{ (request()->routeIs('barang_keluar.*')) ? 'active' : '' }}">
            <a href="{{ route('barang_keluar.index') }}"><i class="fa fa-cart-arrow-down "></i> <span>Kelola barang keluar</span></a>
        </li>
        <li class="{{ (request()->routeIs('stok_opname.*')) ? 'active' : '' }}">
            <a href="{{ route('stok_opname.index') }}"><i class="fa fa-file-text "></i> <span>Stok Opname</span></a>
        </li>
        <li class="{{ (request()->is('report*')) ? 'active' : '' }}">
            <a href="/report"><i class="fa fa-print "></i> <span>Report Data</span></a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>