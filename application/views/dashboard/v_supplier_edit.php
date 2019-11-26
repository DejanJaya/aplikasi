<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Edit Supplier
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
						<h3 class="box-title">Supplier</h3>
					</div>
					<div class="box-body">
						
						<?php foreach($supplier as $s){ ?>

							<form method="post" action="<?php echo base_url('dashboard/supplier_update') ?>">
								<div class="box-body">
									<div class="form-group">
										<label>Kode Supplier</label> 	
										<input type="text" name="kd_supplier" value="<?php echo $s->kd_supplier; ?>" readonly class="form-control">
										<?php echo form_error('kd_supplier'); ?>
									</div>
								</div>

								<div class="box-body">
									<div class="form-group">
										<label>Nama Supplier</label>
										<input type="text" name="nm_supplier" class="form-control" placeholder="Masukkan nama supplier .." value="<?php echo $s->nm_supplier; ?>">
										<?php echo form_error('nm_supplier'); ?>
									</div>
								</div>

								<div class="box-footer">
									<input type="submit" class="btn btn-success" value="Update">
									<input type="reset" class="btn btn-reset" value="Reset">
									<a href="<?php echo base_url().'dashboard/supplier'; ?>" class="btn btn-sm btn-primary">Kembali</a>
								</div>
							</form>

						<?php } ?>

					</div>
				</div>

			</div>
		</div>

	</section>

</div>