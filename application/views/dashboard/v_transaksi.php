
<script src="<?php echo base_url();?>assets/js/jquery-2.2.3.min.js"></script>
	
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-table.css">
	<script src="<?php echo base_url();?>assets/js/bootstrap-table.js"></script>
	
	<script src="<?php echo base_url();?>assets/js/toastr.js"></script>
 <link href="<?php echo base_url();?>assets/css/toastr.css" rel="stylesheet" type="text/css" />
  <script src="<?php echo base_url();?>js/bootbox.js"></script>
 <script src="<?php echo base_url();?>js/bootstrapValidator.min.js"></script>
 

</script>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Transaksi
			<small>Daftar Transaksi</small>
		</h1>
	</section>
	
	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				
				<div id="toolbar">
					 <input type="hidden" value="1" name="buttonedit" id="buttonedit"/>
					 <button id="tbh" type="button" class="btn btn-primary " data-toggle="modal" onclick="tambahData()" >
					  <i class="glyphicon glyphicon-plus"> </i>   Tambah
					</button>
               
                    </div>
					<table id="table" 
                     data-toolbar="#toolbar"
                           data-toggle="table"
                           data-search="true"
                           data-show-refresh="true"
                           data-show-columns="true"
                           data-show-export="true"
                           data-minimum-count-columns="2"
						    data-filter-control="true"
                           data-pagination="true"
                           data-url="transaksi/loaddataTabel"
                           data-side-pagination="server"
                           data-pagination="true"
						   data-sort-name="no_faktur"
						   data-sort-order="desc">
                        <thead>	<tr>
                            <th data-field="state" data-checkbox="true" data-halign="center" data-align="center"></th>
							<th data-field="selling"  data-halign="center" data-align="center" data-formatter="operateFormatter" data-events="operateEvents">Action</th>
							<th data-field="no_faktur"  data-halign="center" data-align="left"  data-sortable="true" data-filter-control="input">NO Faktur  </th>
							
							<th data-field="nm_supplier"  data-halign="center" data-align="left"  data-sortable="true" data-filter-control="input">Supplier </th>
							<th data-field="tanggal"  data-halign="center" data-align="left"  data-sortable="true" data-filter-control="input">Tanggal Faktur  </th>
							<th data-field="total_faktur"  data-halign="center" data-align="left"  data-sortable="true" data-filter-control="input">Total Pembayaran  </th>
                  
                             
                        </tr></thead>
                    </table>
				
			
			
			</div>
		</div>
	</section>

</div>



<div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog" style="width:50%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title"></h4>
      </div>
      <div class="modal-body form">
        <form  id="form" name="form" class="form-horizontal" onsubmit="return false;"     >
		  <input type="hidden" value="" name="set" id="set"/> 
          <input type="hidden" value="" name="barispopup" id="barispopup"/> 
		  
		  <div class="form-body">
		  <div class="form-group ">
			  <label class="control-label col-md-3" >No Faktur</label>
			  <div class="col-md-9">
				<input subtype="text" name="no_faktur" class="form-control text-input" id="no_faktur" required="required" type="text">
			  </div>
			</div>
			<div class="form-group ">
			  <label class="control-label col-md-3" >Supplier</label>
			  <div class="col-md-9">
				<select type="select" name="kd_supplier" class="form-control select2 input-sm" id="kd_supplier" required="required"  style="width: 100%;"  >
				<option value="" selected="selected">Pilih</option>
			  </select>						
			  </div>
			</div>
			
		  <div class="form-group field-date">
			  <label class="control-label col-md-3" for1="date">Tanggal  </label>
			  <div class="col-md-6">
				<div class="input-group">
					<input class="form-control date-picker" id="tanggal" name="tanggal" type="text" data-date-format="yyyy-mm-dd" />
					<span class="input-group-addon">
						<i class="fa fa-calendar bigger-110"></i>
					</span>
					</div>
			  </div>
		  </div>

          <div >
		 <div class="panel panel-default">
							<div class="panel-heading" >
							   <button type="button" id="btnNewRow" name="btnNewRow" class="btn btn-xs btn-success" onclick="addRow();"><i class="fa fa-plus"></i>
								Baris Baru
								</button>
							</div>
							
							<div class="panel-body">
								<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover" id="tabeleliminasi">
										<thead> 
											<tr>
												<td align="center" style="width:3%">Action </td>
												<td align="center" style="width:10%">Kode Barang  </td>
												<td align="center" style="width:20%">Barang</td>
												<td align="center" style="width:15%">Harga Barang </td>
												<td align="center" style="width:15%">Jumlah  </td>
												<td align="center" style="width:20%">Total Harga  </td>
												
											</tr>

											<tr id="bookTemplate" name="rowda" class="hide">
												<td  style="text-align: center;" valign="top">
												<button type='button' style='text-align: center; padding:8px 15px;' id='btnDelRowX' name='btnDelRowX' class='btn btn-sm btn-danger btn-xs btn-round' title='Hapus' ><i class='fa fa-minus'></i></button> </td>
												<td align="center" style="text-align: center;" class="form-group " valign="top">	
												<input  class='form-control input-sm '  type='text'  name='kd_barang' id='kd_barang' readonly >	
												</td>
												<td align="center" style="text-align: center;" class="form-group " valign="top">	
												<input  class='form-control input-sm '  type='text'  name='nm_barang' id='nm_barang' readonly >	
												</td>
												<td align="center" style="text-align: center;" class="form-group " valign="top">
												<input  class='form-control input-sm '  type='text'  name='harga' id='harga' readonly >	
												</td>
												<td align="center" style="text-align: center;" class="form-group " valign="top">
												<input  class='form-control input-sm '  type='text'  name='jumlah' id='jumlah' >	
												</td> 	
												<td align="center" style="text-align: center;" class="form-group " valign="top">
												<input  class='form-control input-sm nomor '  type='text'  name='jumlah_total' id='jumlah_total' >	
												</td> 
												
												
											</tr>
											
											<tr>
												<td colspan='5' align="center"  >Total Pembayaran </td>
												<td align="center" style="width:20%">
												<input  class='form-control input-sm nomor '  type='text'  name='total_faktur' id='total_faktur' > </td>
												
											</tr>
											
									
										</thead>
										<tbody>
										</tbody>
											
									</table>
                                    
								</div>
								<!-- /.table-responsive -->
								
							</div>
							<!-- /.panel-body -->
						</div>
						
			</div> 
		  
          
        
          </div>

		  <div class="form-group field-line">
		  
		
		  </div>
		 
		
			
          </div>
        
          
          <div class="modal-footer">
            <button type="submit" id="btnSave" class="btn btn-primary"   >
			<i class="fa fa-save"></i>
			Simpan</button>
            <button type="button" id="btl" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-repeat"></i> 
			Batal</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
	</form>
	
	<div class="modal fade" id="modalTable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width:75%">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4>Data Barang </h4>
                    </div>
                    <div class="modal-body">
                        <table id="tabledata"
                           data-toggle="table"
                           data-search="true"
                           data-show-export="true"
                           data-minimum-count-columns="2"
                           data-pagination="true"
						   data-height="500"
                           data-url="<?php echo base_url();?>transaksi/loaddataBarang"
                           data-side-pagination="server"
                           data-pagination="true"
						   data-query-params="getParambarang"
						   data-sort-name="kd_barang"
						   data-sort-order="asc">
                            <thead>
                            <tr>
							<th data-field="kd_barang"  data-halign="center" data-align="left"  data-sortable="true" >Kode Barang  </th>
								<th data-field="nm_barang"  data-halign="center" data-align="left"  data-sortable="true" >Nama Barang  </th>
								<th data-field="harga_barang"  data-halign="center" data-align="left"  data-sortable="true" >Harga  </th>
								<th data-field="cari"  id="pilih" data-halign="center" data-align="center"
                    data-formatter="operateFormatterPilih" data-events="operateEventspilih">Pilih Data</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->		



            
