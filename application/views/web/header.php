
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?=$this->Main_model->getSetting()->title_web?></title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?=base_url()?>assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?=base_url()?>assets/modules/datatables/datatables.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.6.0/styles/default.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?=base_url()?>assets/css/style.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/css/components.css">
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
          <ul class="navbar-nav mr-auto">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="<?=base_url()?>assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, <?=$this->session->userdata('nama')?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Logged in 1 min ago</div>
              <a href="<?=base_url('/profile')?>" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?=base_url('/logout')?>" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href=""><?=$this->Main_model->getSetting()->title_web?></a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Menu</li>
            <li><a class="nav-link" href="<?=base_url('/dashboard')?>"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
            <?php
            if($this->session->userdata('role') == 'admin'){
            ?>
            <li><a class="nav-link" href="<?=base_url('/data/user')?>"><i class="fas fa-users"></i> <span>Data User</span></a></li>
            <li><a class="nav-link" href="<?=base_url('/setting/web')?>"><i class="fas fa-cogs"></i> <span>Setting Web</span></a></li>
            <?php
            }
            ?>
            <li><a class="nav-link" href="<?=base_url('/list/game')?>"><i class="fas fa-gamepad"></i> <span>List Game</span></a></li>
            <li><a class="nav-link" href="<?=base_url('/api/documentation')?>"><i class="fas fa-code"></i> <span>API Documentation</span></a></li>
          </ul>
         </aside>
      </div>


