 <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('assets/img/user2-160x160.jpg'); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>filo chan</p>
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
      <ul class="sidebar-menu">
        <li class="header">主選單</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>報表管理</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('index/report'); ?>"><i class="fa fa-circle-o"></i> dg 報表</a></li>
          </ul>
        </li>
        <li>
          <a href="<?php echo base_url('index.php/Admin/apitests'); ?>">
            <i class="fa fa-th"></i> <span>api測試</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">DG API</small>
            </span>
          </a>
        </li>
        <li>
          <a href="<?php echo base_url('Admin/newmember'); ?>">
            <i class="fa fa-th"></i> <span>會員註冊</span>
          </a>
        </li>
        <li>
          <a href="<?php echo base_url('Admin/getBalance/test1234'); ?>">
            <i class="fa fa-th"></i> <span>會員資料</span>
          </a>
        </li>
        <li>
          <a href="<?php echo base_url('Admin/trans'); ?>">
            <i class="fa fa-th"></i> <span>會員轉帳</span>
          </a>
        </li>
        <li>
          <a href="<?php echo base_url('Admin/reports'); ?>">
            <i class="fa fa-th"></i> <span>表單報表</span>
          </a>
        </li>
        <li>
          <a href="<?php echo base_url('Admin/member'); ?>">
            <i class="fa fa-th"></i> <span>在線會員</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
