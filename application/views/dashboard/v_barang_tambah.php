<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Barang
			<small></small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				
				
				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Barang</h3>
					</div>
					<div class="box-body">
						
						
						<form method="post" action="<?php echo base_url('dashboard/barang_aksi') ?>">
							<div class="box-body">
								<div class="form-group">
									<label>Kode Barang</label> 
									<input type="text" name="kd_barang" class="form-control" placeholder="Masukkan kode barang ..">
									<?php echo form_error('kd_barang'); ?>
								</div>
							</div>

							<div class="box-body">
								<div class="form-group">
									<label>Nama Barang</label>
									<input type="text" name="nm_barang" class="form-control" placeholder="Masukkan nama barang ..">
									<?php echo form_error('nm_barang'); ?>
								</div>
							</div>

							<div class="box-body">
								<div class="form-group">
									<label>Harga Barang</label>
									<input type="text" name="harga_barang" class="form-control" placeholder="Masukkan harga barang ..">
									<?php echo form_error('harga_barang'); ?>
								</div>
							</div>


							<div class="box-footer">
								<input type="submit" class="btn btn-success" value="Simpan">
								<input type="reset" class="btn btn-reset" value="Reset">
								<a href="<?php echo base_url().'dashboard/barang'; ?>" class="btn btn-sm btn-primary">Kembali</a>
							</div>
						</form>

					</div>
				</div>

			</div>
		</div>

	</section>

</div>