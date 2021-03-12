<body class="no-skin">
        <?php
        if (!isset($_SESSION['username']))
    {
       header("location:dashboard.php");
    }
        require_once '../lib/koneksi.php';
         $qupdate = "SELECT * FROM  usertb WHERE username = '".$_SESSION['username']."'";
        $rupdate = mysqli_query($mysqli, $qupdate);
        $dupdate = mysqli_fetch_assoc($rupdate);
        ?>
        <div id="navbar" class="navbar navbar-default ace-save-state">
            <div class="navbar-container ace-save-state" id="navbar-container">
                <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
                <span class="sr-only">Toggle sidebar</span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>
                </button>

            <div class="navbar-header pull-left">
                <a href="adminmainapp.php?unit=dashboard" class="navbar-brand"><small><i class="fa fa-list"></i> APLIKASI EKSTRAKURIKULER BERBASIS WEB </small></a>
            </div>

            <div class="navbar-buttons navbar-header pull-right" role="navigation">
              <ul class="nav ace-nav">
                <li class="light-blue dropdown-modal">
                

                  
                </li>
              </ul>
            </div>
        </div><!-- /.navbar-container -->
    </div>