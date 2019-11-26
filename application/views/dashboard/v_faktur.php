<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Faktur
			<small>Daftar Data Faktur</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-9">
				
				<a href="<?php echo base_url().'dashboard/faktur_tambah'; ?>" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"> </i>Tambah Faktur Baru</a>

				<br/>
				<br/>

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Tabel Faktur</h3>
					</div>
					<div class="box-body">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th width="1%">NO</th>
									<th>Tanggal</th>
									<th>Jatuh Tempo</th>
									<th>Total</th>
									<th>Total Faktur</th>
									<th width="20%">AKSI</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 1;
								foreach($faktur as $f){ 
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $f->tanggal; ?></td>
										<td><?php echo $f->jatuh_tempo; ?></td>
										<td><?php echo $f->total; ?></td>
										<td><?php echo $f->total_faktur; ?></td>
										<td>
											<a href="<?php echo base_url().'dashboard/faktur_edit/'.$f->no_faktur; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pencil"></i> Edit </a>
											<a onClick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" href="<?php echo base_url().'dashboard/faktur_hapus/'.$f->no_faktur; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> Hapus </a>
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