<div class="content-wrapper">
	<section class="content-header">
		<h1>
			User
			<small>User Website</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">
				
				<a href="<?php echo base_url().'dashboard/user_tambah'; ?>" class="btn btn-sm btn-primary">Buat User baru</a>

				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">User</h3>
					</div>
					<div class="box-body">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th width="1%">NO</th>
									<th>Username</th>
									<th>Email</th>
									<th>Nama</th>
									<th>Akses</th>
									<th>Status</th>
									<th width="12%">AKSI</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 1;
								foreach($user as $u){ 
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $u->username; ?></td>
										<td><?php echo $u->email; ?></td>
										<td><?php echo $u->nama; ?></td>
										<td><?php echo $u->akses; ?></td>
										<td>
											<?php 
											if($u->status == 1){
												echo "Aktif";
											}else{
												echo "Non Aktif";
											}
											?>
										</td>
										<td>
											<a href="<?php echo base_url().'dashboard/user_edit/'.$u->username; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pencil">Edit</i> </a>
											<a onClick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" href="<?php echo base_url().'dashboard/user_hapus/'.$u->username; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash">Hapus</i> </a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
						

					</div>
				</div>

			</div>
		</div>

	</section>

</div>