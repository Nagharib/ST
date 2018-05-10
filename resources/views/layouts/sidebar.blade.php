 <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('dist/img/avatar5.png')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
          <a href="#">{{date("F j, Y")}}</a>
        </div>
      </div>
      <!-- search form -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
 <!--        <li class="treeview">
          <a href="#">
            <i class="fa fa-key"></i> <span>Check In / Out</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('checkin.index')}}"><i class="fa fa-circle-o"></i> Check In</a></li>
            <li><a href="{{route('checkin.checkout')}}""><i class="fa fa-circle-o"></i> Check Out</a></li>
            <li><a href="#""><i class="fa fa-circle-o"></i> Reservasi / Booking</a></li>
            <li><a href="{{route('checkin.tamu')}}""><i class="fa fa-circle-o"></i> Tamu In House</a></li>
          </ul>
        </li> 
        <li><a href="{{route('berita.index')}}"><i class="fa fa-newspaper-o"></i> <span>Berita</span></a></li>-->
        @if(Gate::check('dev-access') || Gate::check('super-access') || Gate::check('admin-access'))
        <li class="header">ADMINISTRASI PERUMAHAN</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-database"></i> <span>Data Promo</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('promo2.index')}}"><i class="fa fa-circle-o"></i>Promo Terkini</a></li>
            <!--  -->
            <li><a href="{{route('promokota.index')}}""><i class="fa fa-circle-o"></i>Kota Terpopuler</a></li>
          </ul>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-database"></i> <span>Data Produk</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('hotel.index')}}"><i class="fa fa-circle-o"></i> Hotel</a></li>
            <li><a href="{{route('hotel_room.index')}}"><i class="fa fa-circle-o"></i> Kamar Hotel</a></li>
  
          </ul>
        </li> 
<!-- 
    <li class="treeview">
          <a href="#">
            <i class="fa fa-database"></i> <span>Data Karyawan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('employee.index')}}"><i class="fa fa-circle-o"></i> Nama Karyawan</a></li>
  
          </ul>
        </li> -->                

<!--         <li class="treeview">
        <a href="#">
            <i class="fa fa-database"></i> <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('kamar.index')}}"><i class="fa fa-circle-o"></i> Konsumen</a></li>
            <li><a href="{{route('typekamar.index')}}""><i class="fa fa-circle-o"></i> Pemesanan</a></li>

            <li><a href="{{route('kamar.index')}}"><i class="fa fa-circle-o"></i> Penjualan</a></li>
            <li><a href="{{route('kamar.index')}}"><i class="fa fa-circle-o"></i> Pembayaran</a></li>
          </ul>
        </li> -->
        

      
        @if(Gate::check('dev-access'))
        <li><a href="{{route('perusahaan.index')}}"><i class="fa fa-user"></i> <span>Perusahaan</span></a></li>
        @endif
        @endif
      </ul>
    </section>

 
    <!-- /.sidebar -->
