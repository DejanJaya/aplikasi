<?php  //print_r($supplier);  exit; ?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Faktur
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
						<h3 class="box-title">Faktur</h3>
					</div>
					<div class="box-body">
						
						
						<form method="post" action="<?php echo base_url('dashboard/faktur_aksi') ?>">
							<div class="box-body">
								<div class="form-group">
									<label>No Faktur</label> 
									<input type="text" name="no_faktur" class="form-control" placeholder="Masukkan No Faktur ..">
									<?php echo form_error('no_faktur'); ?>
								</div>
							</div>

							<div class="box-body">
								<div class="form-group">
									<label>Kode Supplier</label>
									<select class="form-control" name="kd_supplier">
										<option value="">- Pilih Kode Supplier</option>
										<?php  //print_r($supplier);
										foreach($supplier as $s){ ?>
										
										<option <?php if(set_value('kd_supplier') == $s->kd_supplier){echo "selected='selected'";} ?> value="<?php echo $s->kd_supplier ?>"><?php echo $s->kd_supplier; ?> -- <?php echo $s->nm_supplier; ?></option>
										<?php } ?>
									</select>
										<?php echo form_error('kd_supplier'); ?>
								</div>
							</div>

							<div class="box-body">
								<div class="form-group">
									<label>Tanggal</label> 
									<input type="date" name="tanggal" class="form-control">
									<?php echo form_error('tanggal'); ?>
								</div>
							</div>

							<div class="box-body">
								<div class="form-group">
									<label>Jatuh Tempo</label> 
									<input type="date" name="jatuh_tempo" class="form-control">
									<?php echo form_error('jatuh_tempo'); ?>
								</div>
							</div>

							<div class="box-body">
								<div class="form-group">
									<label>Total</label> 
									<input type="text" name="total" class="form-control">
									<?php echo form_error('total'); ?>
								</div>
							</div>

							<div class="box-body">
								<div class="form-group">
									<label>Total Faktur</label> 
									<input type="text" name="total_faktur" class="form-control">
									<?php echo form_error('total_faktur'); ?>
								</div>
							</div>

							<div class="box-footer">
								<input type="submit" class="btn btn-success" value="Simpan">
								<input type="reset" class="btn btn-reset" value="Reset">
								<a href="<?php echo base_url().'dashboard/faktur'; ?>" class="btn btn-sm btn-primary">Kembali</a>
							</div>
						</form>

					</div>
				</div>

			</div>
		</div>

	</section>

</div>