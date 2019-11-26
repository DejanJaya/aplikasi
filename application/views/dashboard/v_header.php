<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>AL-AMIN STORE| Dashboard</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
<!--	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/morris.js/morris.css">-->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/jvectormap/jquery-jvectormap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

	
	

</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

		<header class="main-header">			
			<a href="<?php echo base_url(); ?>" class="logo">
				<span class="logo-mini"><b>AAS</b></span>
				<span class="logo-lg"><b>Al-Amin</b>Store</span>
			</a>
			
			<nav class="navbar navbar-static-top">
				
				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>

				<div class="navbar-custom-menu">
					
					<ul class="nav navbar-nav">
						<li class="dropdown user user-menu">
								<a href="<?php echo base_url().'dashboard/keluar' ?>">
								<i class="fa fa-sign-out"></i>
							<span>KELUAR</span>
							</a>
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
								<span class="hidden-xs">HAK AKSES : <b><?php echo $this->session->userdata('p_akses') ?></b></span>
							</a>
							<ul class="dropdown-menu">
								<li class="user-header">
									<img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
									<p>
										<?php echo $this->session->userdata('p_username') ?>
										<small>Hak akses : <?php echo $this->session->userdata('p_akses') ?></small>
									</p>
								</li>
								
								<li class="user-footer">
									<div class="pull-left">
										<a href="<?php echo base_url().'dashboard/profil' ?>" class="btn btn-default btn-flat">Profil</a>
									</div>
									<div class="pull-right">
										<a href="<?php echo base_url().'dashboard/keluar' ?>" class="btn btn-default btn-flat">Keluar</a>
									</div>
								</li>
							</ul>
						</li>
						
					</ul>
				</div>
			</nav>
		</header>
		<aside class="main-sidebar">
			<section class="sidebar">
				<div class="user-panel">
					<div class="pull-left image">
						<img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
					</div>
					<div class="pull-left info">
						<?php 
						$id_user = $this->session->userdata('p_username');
						$user = $this->db->query("select * from user where username='$id_user'")->row();
						?>
						<p><?php echo $user->nama; ?></p>
						<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
					</div>
				</div>
				
				<ul class="sidebar-menu" data-widget="tree">
					<li class="header">MAIN NAVIGATION</li>
					<li>
						<a href="<?php echo base_url().'dashboard' ?>">
							<i class="fa fa-dashboard"></i>
							<span>DASHBOARD</span>


						</a>
					</li>
					<?php 
					if($this->session->userdata('p_akses') == "admin"){
					?>
					<li>
						<a href="<?php echo base_url().'dashboard/barang' ?>">
							<i class="fa fa-th"></i>
							<span>BARANG</span>
						</a>
					</li>
					
					<li>
						<a href="<?php echo base_url().'dashboard/supplier' ?>">
							<i class="fa fa-truck"></i>
							<span>SUPPLIER</span>
						</a>
					</li>

					
					<li>
						<a href="<?php echo base_url().'dashboard/faktur' ?>">
							<i class="fa fa-files-o"></i>
							<span>FAKTUR</span>
						</a>
					</li>
					<?php
					} 
					?>
					<li>
						<a href="<?php echo base_url().'transaksi' ?>">
							<i class="fa fa-shopping-cart"></i>
							<span>TRANSAKSI</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url().'dashboard/laporan' ?>">
							<i class="fa fa-file"></i>
							<span>LAPORAN</span>
						</a>
					</li>
					<?php
					if($this->session->userdata('p_akses') == "admin"){
					?>
					<li>
						<a href="<?php echo base_url().'dashboard/user' ?>">
							<i class="fa fa-user"></i>
							<span>USER</span>
						</a>
					</li>
					<?php
					}
					?>
				</ul>
			</section>
		</aside>