<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Dashboard
			<small>Control panel</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">

			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3><?php echo $jumlah_barang ?></h3>

						<p>Barang</p>
					</div>
					<div class="icon">
						<i class="fa fa-th"></i>
					</div>
				</div>
			</div>
			
			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-green">
					<div class="inner">
						<h3><?php echo $jumlah_supplier ?></h3>

						<p>Supplier</p>
					</div>
					<div class="icon">
						<i class="fa fa-truck"></i>
					</div>
				</div>
			</div>
			
			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-red">
					<div class="inner">
						<h3><?php echo $jumlah_faktur ?></h3>

						<p>Faktur</p>
					</div>
					<div class="icon">
						<i class="fa fa-files-o"></i>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3><?php echo $jumlah_transaksi ?></h3>

						<p>Transaksi</p>
					</div>
					<div class="icon">
						<i class="fa fa-shopping-cart"></i>
					</div>
				</div>
			</div>
			
		</div>

		<div class="row">
			<div class="col-lg-6">
				
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Dashboard</h3>
					</div>
					<div class="box-body">
						<h3>Selamat Datang !</h3>

						<div class="table-responsive">
							<table class="table table-bordered table-hover">
								<tr>
									<th width="%">Nama</th>
									<th width="1px">:</th>
									<td>
										<?php 
										$id_user = $this->session->userdata('p_username');
										$user = $this->db->query("select * from user where username='$id_user'")->row();
										?>
										<p><?php echo $user->nama; ?></p>
									</td>
								</tr>
								<tr>
									<th width="20%">Username</th>
									<th width="1px">:</th>
									<td><?php echo $this->session->userdata('p_username') ?></td>
								</tr>
								<tr>
									<th width="20%">akses</th>
									<th width="1px">:</th>
									<td><?php echo $this->session->userdata('p_akses') ?></td>
								</tr>
								<tr>
									<th width="20%">Status</th>
									<th width="1px">:</th>
									<td>Aktif</td>
								</tr>
							</table>
						</div>
					</div>
				</div>

			</div>
			<img src="<?php echo base_url(); ?>gambar/merek-hardware.jpg" style="margin:0;width:30%;height:30%;">
		</div>

	</section>

</div>