<div class="content-wrapper">
	<section class="content-header">
		<h1>
			User
			<small>Konfirmasi Hapus User</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				<a href="<?php echo base_url().'dashboard/user'; ?>" class="btn btn-sm btn-primary">Kembali</a>
				
				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Konfirmasi Hapus</h3>
					</div>
					<div class="box-body">
						
						<p><b><?php echo $user_hapus->nama; ?></b> akan dihapus <b><?php echo $user_hapus->nama; ?></b> </p>
						
						<form method="post" action="<?php echo base_url('dashboard/user_hapus_aksi') ?>">
							<div class="box-body">
								<div class="form-group">
									<label>Nama User</label>
									<input type="hidden" name="user_hapus" value="<?php echo $user_hapus->username; ?>">

									<select class="form-control" name="user_tujuan" required="required">
										<option value="">- Pilih Akses -</option>
										<?php foreach($user_lain as $ul){ ?>
											<option value="<?php echo $ul->username ?>"><?php echo $ul->nama; ?></option>
										<?php } ?>
									</select>
								</div>

							</div>

							<div class="box-footer">
								<input type="submit" class="btn btn-success" value="Hapus">
								<input type="reset" class="btn btn-reset" value="Reset">
							</div>
						</form>

					</div>
				</div>

			</div>
		</div>

	</section>

</div>