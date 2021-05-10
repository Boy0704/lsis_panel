<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="image/user/<?php echo $this->session->userdata('foto'); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('nama'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
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
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        
        <?php if ($this->session->userdata('level') == 'admin'){ ?>
        <li><a href="app"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li><a href="app/pengembangan"><i class="fa fa-calendar-check-o"></i> <span>Jadwal Satpam </span></a></li></li>
        <li><a href="app/pengembangan"><i class="fa fa-clone"></i> <span>Online Agreement  </span></a></li></li>
        <li><a href="app/pengembangan"><i class="fa fa-map"></i> <span>Fruit Tracking  </span></a></li></li>
        <li><a href="app/pengembangan"><i class="fa fa-object-group"></i> <span>History Tracking Satpam</span></a></li></li>
        <li><a href="perizinan"><i class="fa fa-bank"></i> <span>Daftar Perizinan</span></a></li></li>
        <li><a href="kasus"><i class="fa fa-balance-scale"></i> <span>Daftar Kasus Hukum</span></a></li></li>
        <li><a href="jabatan"><i class="fa fa-cube"></i> <span>Master Jabatan </span></a></li></li>
        <li><a href="users"><i class="fa fa-users"></i> <span>Users </span></a></li>

        <?php } elseif ($this->session->userdata('level') == 'user') {?>

        <li><a href="app"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li><a href="asset"><i class="fa fa-book"></i> <span>Data Asset </span></a></li></li>
        <?php } ?>
        
        

        <!-- <li class="header">LABELS</li> -->
        <!-- <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Faqs</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>About</span></a></li> -->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>