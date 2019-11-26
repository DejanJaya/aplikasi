<div class="content-wrapper">
	<section class="content-header">
		<h1>
			User
			<small>Tambah User</small>
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
						<h3 class="box-title">User</h3>
					</div>
					<div class="box-body">
						
						<form method="post" action="<?php echo base_url('dashboard/user_aksi') ?>">
							<div class="box-body">
								<div class="form-group">
									<label>Username</label>
									<input type="text" name="username" class="form-control" placeholder="Masukkan Username ..">
									<?php echo form_error('username'); ?>
								</div>
								<div class="form-group">
									<label>Password</label>
									<input type="password" name="password" class="form-control" placeholder="Masukkan Password ..">
									<?php echo form_error('password'); ?>
								</div>
								<div class="form-group">
									<label>Nama</label>
									<input type="text" name="nama" class="form-control" placeholder="Masukkan Nama..">
									<?php echo form_error('nama'); ?>
								</div>
								<div class="form-group">
									<label>Email</label>
									<input type="email" name="email" class="form-control" placeholder="Masukkan Email..">
									<?php echo form_error('email'); ?>
								</div>
								<div class="form-group">
									<label>Akes</label>
									<select class="form-control" name="akses">
										<option value="">- Pilih Level -</option>
										<option value="admin">Admin</option>
										<option value="user">User Biasa</option>
									</select>
									<?php echo form_error('akses'); ?>
								</div>
								<div class="form-group">
									<label>Status</label>
									<select class="form-control" name="status">
										<option value="">- Pilih Status -</option>
										<option value="1">Aktif</option>
										<option value="0">Non-Aktif</option>
									</select>
									<?php echo form_error('status'); ?>
								</div>
							</div>

							<div class="box-footer">
								<input type="submit" class="btn btn-success" value="Simpan">
								<input type="reset" class="btn btn-reset" value="Reset">
							</div>
						</form>

					</div>
				</div>

			</div>
		</div>

	</section>

</div>