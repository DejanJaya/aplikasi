<div class="content-wrapper">
	<section class="content-header">
		<h1>
			User
			<small>Edit User</small>
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
						
						<?php foreach($user as $u){ ?>

							<form method="post" action="<?php echo base_url('dashboard/user_update') ?>">
								<div class="box-body">
									<div class="form-group">
										<label>Username</label>
										<input type="text" name="username" class="form-control" placeholder="Masukkan Username.." value="<?php echo $u->username; ?>">
										<?php echo form_error('username'); ?>
										<small>Kosongkan jika tidak ingin mengubah password</small>
									</div>
									<div class="form-group">
										<label>Password</label>
										<input type="password" name="password" class="form-control" placeholder="Masukkan Password.." value="<?php echo $u->password; ?>">
										<?php echo form_error('password'); ?>
										<small>Kosongkan jika tidak ingin mengubah password</small>
									</div>
									<div class="form-group">
										<label>Nama</label>
										<input type="hidden" name="nama" value="<?php echo $u->nama; ?>">
										<input type="text" name="nama" class="form-control" placeholder="Masukkan Nama .." value="<?php echo $u->nama; ?>">
										<?php echo form_error('nama'); ?>
									</div>
									<div class="form-group">
										<label>Email</label>
										<input type="email" name="email" class="form-control" placeholder="Masukkan email  .." value="<?php echo $u->email; ?>">
										<?php echo form_error('email'); ?>
									</div>
									
									<div class="form-group">
										<label>Akses</label>
										<select class="form-control" name="akses">
											<option value="">- Pilih Akses -</option>
											<option <?php if($u->akses == "admin"){ echo "selected='selected'";} ?> value="admin">Admin</option>
											<option <?php if($u->akses == "user"){ echo "selected='selected'";} ?> value="user">User Biasa</option>
										</select>
										<?php echo form_error('akses'); ?>
									</div>
									<div class="form-group">
										<label>Status</label>
										<select class="form-control" name="status">
											<option value="">- Pilih Status -</option>
											<option <?php if($u->status == "1"){ echo "selected='selected'"; } ?> value="1">Aktif</option>
											<option <?php if($u->status == "0"){ echo "selected='selected'"; } ?> value="0">Non-Aktif</option>
										</select>
										<?php echo form_error('status'); ?>
									</div>
								</div>

								<div class="box-footer">
									<input type="submit" class="btn btn-success" value="Simpan">
									<input type="reset" class="btn btn-reset" value="Reset">
								</div>
							</form>

						<?php } ?>

					</div>
				</div>

			</div>
		</div>

	</section>

</div>