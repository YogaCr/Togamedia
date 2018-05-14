<!doctype html>
<html lang="en">

<head>
	<title><?= $judul;?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="<?= base_url()?>assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url()?>assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url()?>assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="<?= base_url()?>assets/vendor/chartist/css/chartist-custom.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="<?= base_url()?>assets/css/main.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="<?= base_url()?>assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?= base_url()?>assets/img/favicon.png">
	<script src="<?= base_url()?>assets/vendor/jquery/jquery.min.js"></script>
	<script src="<?= base_url()?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?= base_url()?>assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?= base_url()?>assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="<?= base_url()?>assets/vendor/chartist/js/chartist.min.js"></script>
	<script src="<?= base_url()?>assets/scripts/klorofil-common.js"></script>
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="index.html"><img src="<?= base_url()?>assets/img/logo-dark.png" alt="Klorofil Logo" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<?php if($this->session->userdata('level')=='kasir'){?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
								<i class="lnr lnr-cart"></i>
								<span class="badge bg-success"><?= $this->cart->total_items()?></span>
							</a>
							<ul class="dropdown-menu notifications">
								<li><a href="#" class="more" style="text-decoration: none;"><?php $this->load->view('v_daftartransaksi');?></a></li>
								<?php if($this->session->flashdata('pesan_update_cart')!=null){?>
								<li><a href="#" class="more" style="text-decoration: none;color:red"><?= $this->session->flashdata('pesan_update_cart');?></a></li>
								<?php }?>
								<?php if($this->cart->total_items()>0){?>
								<li>
									<form method="POST" action="<?= base_url()?>index.php/Transaksi/ProsesCheckout" style="padding-top: 2%;">
										<input type="text" name="namapembeli" required="" style="float:left;width:20%; margin-left: 5%;margin-bottom: 2%;" class="form-control" placeholder="Nama Pembeli">
										<input type="number" name="bayar" required="" style="float:left;width:20%; margin-left:2%;margin-bottom: 2%;" class="form-control" placeholder="Bayar">
	 										<button type="submit" style="margin-left: 5%;float: left;" class="btn btn-success">Checkout</button>
									</form>
								</li><?php }?>
							</ul>
						</li><?php }?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="lnr lnr-user"></span><span> <?= $this->session->userdata('nama_user');?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="<?= base_url()?>index.php/Home/Logout"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<?php if($this->session->userdata('level')=='kasir'){ ?>
						<li><a href="<?= base_url()?>index.php/Home" class="<?php if($aktif=='statistik'){ echo 'active';}?>"><i class="lnr lnr-chart-bars"></i> <span>Statistik Penjualan</span></a></li>
						<li><a href="<?= base_url()?>index.php/Home/DataBuku" class="<?php if($aktif=='buku'){ echo 'active';}?>"><i class="lnr lnr-dice"></i> <span>Daftar Buku</span></a></li>
						<li><a href="<?= base_url()?>index.php/Transaksi" class="<?php if($aktif=='history'){ echo 'active';}?>"><i class="lnr lnr-cart"></i> <span>History Penjualan</span></a></li>
						<?php }
						else{ ?>
						<li><a href="<?= base_url()?>index.php/Home/DataBuku" class="<?php if($aktif=='buku'){ echo 'active';}?>"><i class="lnr lnr-dice"></i> <span>Kelola Buku</span></a></li>
						<li><a href="<?= base_url()?>index.php/Admin/KelolaKategori" class="<?php if($aktif=='kategori'){ echo 'active';}?>"><i class="lnr lnr-cog"></i> <span>Kelola Kategori</span></a></li>
						<li><a href="<?= base_url()?>index.php/Admin/KelolaKasir" class="<?php if($aktif=='kasir'){ echo 'active';}?>"><i class="lnr lnr-alarm"></i> <span>Kelola Kasir</span></a></li><?php }?>
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
				<?php if ($searchaction!="#") {?>
					
				<div class="row">
					<div class="col-md-6">
					<form style="width:50%;float;left" method="GET" action="<?= $searchaction?>">
					<div class="input-group">
						<input type="text" value="" name="searchBox" class="form-control" placeholder="<?= $phsearch;?>">
						<span class="input-group-btn"><button type="submit" class="btn btn-primary">Go</button></span>
					</div>
				</form>
				</div>
				<?php if($this->session->userdata('level')=='admin'){?>
				<div class="col-md-6"><button style="float:right;" class="btn btn-primary" onclick="tampil('tambahForm')"><?= $btntambah;?></button></div>
				<?php }?>
				</div>
				<?php }?>
				<?php if($this->session->userdata('level')=='admin'){?>
				<center>
				<div id="tambahForm" style="max-width:70%;background: white; padding-top: 2%;padding-bottom:2%;margin-top: 2%;margin-bottom: 2%;position: absolute;visibility: hidden;">
					<?= $form_tambah;?>
				</div></center><?php }?>
				<br>
					<?php $this->load->view($konten);?>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	
	<script type="text/javascript">
		function tampil($id) {
			if($('#'+$id).css('position')=='absolute'){
				$('#'+$id).css({
					'position':'static',
					'visibility':'visible'
				});
			}
			else if($('#'+$id).css('position')=='static'){
				$('#'+$id).css({
					'position':'absolute',
					'visibility':'hidden'
				});
			}
		}
	</script>
	<script type="text/javascript">
	function tampilEdit($id) {
			if($('#formedit'+$id).css('position')=='absolute'){
				$('#formedit'+$id).css({
					'position':'static',
					'visibility':'visible'
				});
			}
			else if($('#formedit'+$id).css('position')=='static'){
				$('#formedit'+$id).css({
					'position':'absolute',
					'visibility':'hidden'
				});
			}
		}
</script>
</body>

</html>
