<?php  //print_r($supplier);  exit; ?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Edit Faktur
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
						
						<?php foreach($faktur as $f){ ?>
						<form method="post" action="<?php echo base_url('dashboard/faktur_update') ?>">
							<div class="box-body">
								<div class="form-group">
									<label>No Faktur</label> 
									<input type="text" name="no_faktur" value="<?php echo $f->no_faktur; ?>" readonly class="form-control" >
									<?php echo form_error('no_faktur'); ?>
								</div>
							</div>

							<div class="box-body">
								<div class="form-group">
									<label>Kode Supplier1</label>
									<select class="form-control" name="kd_supplier">
										<?php  //print_r($supplier);
										foreach($supplier as $s){ ?>
										<option <?php if($f->kd_supplier == $s->kd_supplier){echo "selected='selected'";} ?> value="<?php echo $s->kd_supplier ?>"><?php echo $s->kd_supplier; ?> -- <?php echo $s->nm_supplier; ?></option>
										
										<?php } ?>
									</select>
										<?php echo form_error('kd_supplier'); ?>
								</div>
							</div>

							<div class="box-body">
								<div class="form-group">
									<label>Tanggal</label> 
									<input type="date" name="tanggal" value="<?php echo $f->tanggal; ?>" class="form-control">
									<?php echo form_error('tanggal'); ?>
								</div>
							</div>

							<div class="box-body">
								<div class="form-group">
									<label>Jatuh Tempo</label> 
									<input type="date" name="jatuh_tempo" value="<?php echo $f->jatuh_tempo; ?>" class="form-control">
									<?php echo form_error('jatuh_tempo'); ?>
								</div>
							</div>

							<div class="box-body">
								<div class="form-group">
									<label>Total</label> 
									<input type="text" name="total" value="<?php echo $f->total; ?>" class="form-control">
									<?php echo form_error('total'); ?>
								</div>
							</div>

							<div class="box-body">
								<div class="form-group">
									<label>Total Faktur</label> 
									<input type="text" name="total_faktur" value="<?php echo $f->total_faktur; ?>" class="form-control">
									<?php echo form_error('total_faktur'); ?>
								</div>
							</div>

							<div class="box-footer">
								<input type="submit" class="btn btn-success" value="Simpan">
								<input type="reset" class="btn btn-reset" value="Reset">
								<a href="<?php echo base_url().'dashboard/faktur'; ?>" class="btn btn-sm btn-primary">Kembali</a>
							</div>
						</form>
						<?php } ?>

					</div>
				</div>

			</div>
		</div>

	</section>

</div>