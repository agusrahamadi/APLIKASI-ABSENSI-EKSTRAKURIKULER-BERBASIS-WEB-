<div id="sidebar" class="sidebar responsive ace-save-state">
  <ul class="nav nav-list">
      <?php
                                if ($_SESSION['islevel'] == "admin"){
                                    ?>
    <li <?php if ($page=='dashboard') {echo $active;}?>>
        <a href="adminmainapp.php?unit=dashboard">
        <i class="menu-icon fa fa-home"></i>
        <span class="menu-text"> Home </span>
      </a>

      <b class="arrow"></b>
    </li>

    <!-- <li><a href='../mainapp.php?unit=home_unit' target="_blank"><i class="menu-icon fa fa-globe"></i><span class="menu-text"> Lihat Website </span></a>
      <b class="arrow"></b>
    </li>-->
        
   
	 <!-- kategori -->
    <li  <?php if ($page=='kategori_unit' or $page=='jadwal_unit' or $page=='pelatih_unit' or $page=='anggota_unit' or $page=='eskul_unit'or $page=='absen_unit'or $page=='nilai_unit'or $page=='prestasi_unit'or $page=='event_unit') {echo $open;}?>>
      <a href="#" class="dropdown-toggle">
        <i class="menu-icon fa fa-tags"></i>
        <span class="menu-text"> Master </span>
        <b class="arrow fa fa-angle-down"></b>
      </a>
      <b class="arrow"></b>
      <ul class="submenu">
        <li <?php if ($page=='kategori_unit' && $act1=='datagrid') {echo $active;}?>>
          <a href="adminmainapp.php?unit=kategori_unit&act=datagrid"><i class="menu-icon fa fa-caret-right"></i>Master Siswa</a>
          <b class="arrow"></b>
        </li>
		
         <li <?php if ($page=='pelatih_unit' && $act1=='datagrid') {echo $active;}?>>
          <a href="adminmainapp.php?unit=pelatih_unit&act=datagrid"><i class="menu-icon fa fa-caret-right"></i> Master Pelatih </a>
          <b class="arrow"></b>
        </li>
         <li <?php if ($page=='eskul_unit' && $act1=='datagrid') {echo $active;}?>>
          <a href="adminmainapp.php?unit=eskul_unit&act=datagrid"><i class="menu-icon fa fa-caret-right"></i>Master Eskul</a>
          <b class="arrow"></b>
        </li>
        <li <?php if ($page=='anggota_unit' && $act1=='datagrid') {echo $active;}?>>
          <a href="adminmainapp.php?unit=anggota_unit&act=datagrid"><i class="menu-icon fa fa-caret-right"></i>Master Anggota </a>
          <b class="arrow"></b>
        </li>
		<li <?php if ($page=='jadwal_unit' && $act1=='datagrid') {echo $active;}?>>
          <a href="adminmainapp.php?unit=jadwal_unit&act=datagrid"><i class="menu-icon fa fa-caret-right"></i>Master Jadwal </a>
          <b class="arrow"></b>
        </li>
		  <li <?php if ($page=='absen_unit' && $act1=='datagrid') {echo $active;}?>>
          <a href="adminmainapp.php?unit=absen_unit&act=datagrid"><i class="menu-icon fa fa-caret-right"></i>Master Absensi</a>
          <b class="arrow"></b>
        </li>
          <li <?php if ($page=='nilai_unit' && $act1=='datagrid') {echo $active;}?>>
          <a href="adminmainapp.php?unit=nilai_unit&act=datagrid"><i class="menu-icon fa fa-caret-right"></i>Master Nilai </a>
          <b class="arrow"></b>
        </li>
         <li <?php if ($page=='event_unit' && $act1=='datagrid') {echo $active;}?>>
          <a href="adminmainapp.php?unit=event_unit&act=datagrid"><i class="menu-icon fa fa-caret-right"></i>Master Event</a>
          <b class="arrow"></b>
        </li>
          <li <?php if ($page=='prestasi_unit' && $act1=='datagrid') {echo $active;}?>>
          <a href="adminmainapp.php?unit=prestasi_unit&act=datagrid"><i class="menu-icon fa fa-caret-right"></i>Master Prestasi</a>
          <b class="arrow"></b>
        </li>
         
         
      </ul>
    </li>
	
     <!-- produk -->

    <li <?php if ( $page=='t_event_unit' ) {echo $open;}?>>
        <a href="#" class="dropdown-toggle">
        <i class="menu-icon fa fa-shopping-cart"></i>
        <span class="menu-text"> Transaksi </span>
        <b class="arrow fa fa-angle-down"></b>
      </a>
      <b class="arrow"></b>
      <ul class="submenu">
          <li <?php if ($page=='t_event_unit' && $act1=='datagrid') {echo $active;}?>>
          <a href="adminmainapp.php?unit=t_event_unit&act=datagrid"><i class="menu-icon fa fa-caret-right"></i>Data Event</a>
          <b class="arrow"></b>
        </li>
		
      </ul>
    </li>

  
    <!-- youtube -->
  
    <li <?php if ($page=='l_siswa') {echo $open;}?>>
      <a href="#" class="dropdown-toggle">
        <i class="menu-icon fa fa-book"></i>
        <span class="menu-text"> Laporan </span>
        <b class="arrow fa fa-angle-down"></b>
      </a>
      <b class="arrow"></b>
      <ul class="submenu">
        <li <?php if ($page=='l_siswa' && $act1=='datagrid') {echo $active;}?>>
          <a target="_blank" href="unit/l_siswa.php.php"><i class="menu-icon fa fa-caret-right"></i>Laporan Siswa</a>
          <b class="arrow"></b>
        </li> 
        <li <?php if ($page=='youtube_unit' && $act1=='datagrid') {echo $active;}?>>
          <a target="_blank" href="unit/l_pelatih.php"><i class="menu-icon fa fa-caret-right"></i>Laporan Pelatih</a>
          <b class="arrow"></b>
        </li> 
        <li <?php if ($page=='youtube_unit' && $act1=='datagrid') {echo $active;}?>>
          <a target="_blank" href="unit/l_eskul.php"><i class="menu-icon fa fa-caret-right"></i>Laporan Eskul</a>
          <b class="arrow"></b>
        </li> 
        <li <?php if ($page=='youtube_unit' && $act1=='datagrid') {echo $active;}?>>
          <a target="_blank" href="unit/l_anggota.php"><i class="menu-icon fa fa-caret-right"></i>Laporan Anggota</a>
          <b class="arrow"></b>
        </li> 
        <li <?php if ($page=='youtube_unit' && $act1=='datagrid') {echo $active;}?>>
          <a target="_blank" href="unit/l_jadwal.php"><i class="menu-icon fa fa-caret-right"></i>Laporan Jadwal</a>
          <b class="arrow"></b>
        </li> 
        <li <?php if ($page=='youtube_unit' && $act1=='datagrid') {echo $active;}?>>
          <a target="_blank" href="unit/l_absen.php"><i class="menu-icon fa fa-caret-right"></i>Laporan Absensi</a>
          <b class="arrow"></b>
        </li> 
        <li <?php if ($page=='youtube_unit' && $act1=='datagrid') {echo $active;}?>>
          <a target="_blank" href="unit/l_nilai.php"><i class="menu-icon fa fa-caret-right"></i>Laporan Nilai</a>
          <b class="arrow"></b>
        </li> 
        <li <?php if ($page=='youtube_unit' && $act1=='datagrid') {echo $active;}?>>
          <a target="_blank" href="unit/l_event.php"><i class="menu-icon fa fa-caret-right"></i>Laporan Event</a>
          <b class="arrow"></b>
        </li> 
        <li <?php if ($page=='youtube_unit' && $act1=='datagrid') {echo $active;}?>>
          <a target="_blank" href="unit/l_prestasi.php"><i class="menu-icon fa fa-caret-right"></i>Laporan Prestasi</a>
          <b class="arrow"></b>
        </li> 
		
      </ul>
    </li>
    
    <!-- Use -->
    <li <?php if ($page=='user_unit') {echo $open;}?>>
      <a href="adminmainapp.php?unit=user_unit&act=update&userid=1" >
        <i class="menu-icon fa fa-user"></i>
        <span class="menu-text"> Pengaturan Admin </span>
        
      </a>
      <b class="arrow"></b>
     
    </li>
    
     

    <?php
                                }
                                else {
                                     ?>
<li <?php if ($page=='dashboard') {echo $active;}?>>
        <a href="adminmainapp.php?unit=dashboard">
        <i class="menu-icon fa fa-home"></i>
        <span class="menu-text"> Dashboard </span>
      </a>

      <b class="arrow"></b>
    </li>
    
   
    
    <li <?php if ($page=='produk_unitwa') {echo $active;}?>>
        <a href="adminmainapp.php?unit=produk_unitwa&act=datagrid">
        <i class="menu-icon fa fa-home"></i>
        <span class="menu-text"> Pengajuan Harga </span>
      </a>

      <b class="arrow"></b>
    </li>
    
     <li <?php if ($page=='produk_unitbb') {echo $active;}?>>
        <a href="adminmainapp.php?unit=produk_unitbb&act=datagrid">
        <i class="menu-icon fa fa-home"></i>
        <span class="menu-text"> Status </span>
      </a>

      <b class="arrow"></b>
    </li>

   
    

     <?php
                                }
                                ?>
        <!-- logout -->
    <li>
        <a href="logout.php">
        <i class="menu-icon fa fa-power-off"></i>
        <span class="menu-text"> Logout </span>
      </a>

      <b class="arrow"></b>
    </li>
  </ul><!-- /.nav-list -->

  <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
    <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
  </div>
</div>
