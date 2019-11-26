<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Supplier
			<small>Daftar Data Supplier</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-9">
				
				<a href="<?php echo base_url().'dashboard/supplier_tambah'; ?>" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"> </i>Tambah Supplier Baru</a>

				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Tabel Supplier</h3>
					</div>
					<div class="box-body">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th width="1%">NO</th>
									<th>Nama Supplier</th>
									<th width="20%">AKSI</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 1;
								foreach($supplier as $s){ 
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $s->nm_supplier; ?></td>
										<td>
											<a href="<?php echo base_url().'dashboard/supplier_edit/'.$s->kd_supplier; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pencil"></i> Edit </a>
											<a onClick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" href="<?php echo base_url().'dashboard/supplier_hapus/'.$s->kd_supplier; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> Hapus </a>
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