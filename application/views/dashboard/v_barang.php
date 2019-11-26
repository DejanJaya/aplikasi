<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Barang
			<small>Daftar Data Barang</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-9">
				
				<a href="<?php echo base_url().'dashboard/barang_tambah'; ?>" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"> </i>Tambah Barang Baru</a>

				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Tabel Barang</h3>
					</div>
					<div class="box-body">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th width="1%">NO</th>
									<th>Nama Barang</th>
									<th>Harga Barang</th>
									<th width="20%">AKSI</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 1;
								foreach($barang as $b){ 
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $b->nm_barang; ?></td>
										<td><?php echo $b->harga_barang; ?></td>
										<td>
											<a href="<?php echo base_url().'dashboard/barang_edit/'.$b->kd_barang; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pencil"></i> Edit </a>
											<a onClick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" href="<?php echo base_url().'dashboard/barang_hapus/'.$b->kd_barang; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> Hapus </a>
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