<div id="sidebar" class="sidebar responsive ace-save-state">
  <ul class="nav nav-list">

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
        <span class="menu-text"> Input Event </span>
        <b class="arrow fa fa-angle-down"></b>
      </a>
      <b class="arrow"></b>
      <ul class="submenu">
       
         
         <li <?php if ($page=='event_unit' && $act1=='datagrid') {echo $active;}?>>
          <a href="adminmainapp.php?unit=event_unit&act=datagrid"><i class="menu-icon fa fa-caret-right"></i>Data Event</a>
          <b class="arrow"></b>
        </li>
         
         
      </ul>
    </li>
	
     <!-- produk -->

    

  
    <!-- youtube -->
  
    <li <?php if ($page=='l_siswa') {echo $open;}?>>
      <a href="#" class="dropdown-toggle">
        <i class="menu-icon fa fa-book"></i>
        <span class="menu-text"> Laporan </span>
        <b class="arrow fa fa-angle-down"></b>
      </a>
      <b class="arrow"></b>
      <ul class="submenu">
           <li <?php if ($page=='youtube_unit' && $act1=='datagrid') {echo $active;}?>>
          <a target="_blank" href="unit/l_jadwal.php"><i class="menu-icon fa fa-caret-right"></i>Laporan Jadwal</a>
          <b class="arrow"></b>
        </li> 
        <li <?php if ($page=='l_siswa' && $act1=='datagrid') {echo $active;}?>>
          <a target="_blank" href="unit/l_siswa.php.php"><i class="menu-icon fa fa-caret-right"></i>Laporan Siswa</a>
          <b class="arrow"></b>
        </li> 
        <li <?php if ($page=='youtube_unit' && $act1=='datagrid') {echo $active;}?>>
          <a target="_blank" href="unit/l_pelatih.php"><i class="menu-icon fa fa-caret-right"></i>Laporan Pelatih</a>
          <b class="arrow"></b>
        </li> 
        <li <?php if ($page=='youtube_unit' && $act1=='datagrid') {echo $active;}?>>
          <a target="_blank" href="unit/l_anggota.php"><i class="menu-icon fa fa-caret-right"></i>Laporan Anggota</a>
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
      <a href="adminmainapp.php?unit=user_unit&act=update&kd_siswa=<?php echo $_SESSION['kd_siswa']?>" >
        <i class="menu-icon fa fa-user"></i>
        <span class="menu-text"> Pengaturan </span>
        
      </a>
      <b class="arrow"></b>
     
    </li>
    
     

  
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
