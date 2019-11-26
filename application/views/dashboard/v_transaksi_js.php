<script>
$(document).ready(function() { 
$('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true
		})
		});
		
 var $table = $('#table')
function tambahData(){
	bersih();
     $('#form')[0].reset(); 
	// $('#form').bootstrapValidator('resetForm', true);
      $('#modal_form').modal('show'); 
      $('.modal-title').text('Form Tambah Menu Transaksi'); 
	  document.getElementById('set').value=0;
	  document.getElementById('btnSave').disabled=false;
	 // $("#id_grup_satu").select2("val","");
		
    }
	
	
 $('#form')
        .bootstrapValidator({
		 excluded: ':disabled',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                task: {
                    validators: {
                        notEmpty: {
                            message: 'The task is required'
                        }
                    }
                },
                priority: {
                    validators: {
                        notEmpty: {
                            message: 'The priority is required'
                        }
                    }
                }
            }
        })
        .on('status.field.bv', function(e, data) {
		//alert(data.field);
            data.bv.disableSubmitButtons(false);
        }).on('success.form.bv', function(e,data){
		// alert("ok");
		simpanData();
		 e.preventDefault();
    });
	
	function simpanData(){
 	 var data = $('#form').serializeArray();
			  $.ajax({
				  type: "POST",
				  url:"<?php echo base_url();?>transaksi/simpanData",
				  data: data,
				  success: function(result) { 
				 // alert(result);
					try {
					  obj = JSON.parse(result);  
					var pesan=obj['pesan'];
					var status=obj['status'];
				  	Command: toastr[status](pesan);
					  } catch (e) {
						  keluarLogin();
					}
					
					 tutupForm();
					 loadData(1, 15,'desc');
					// $("#no_grup_satu").val("");
				  }
			  });
			  return false;
 }
	
	
	function tutupForm(){
		 $('#form')[0].reset(); // reset form on modals 
      	$('#modal_form').modal('hide'); // show bootstrap modal
	}
	
	
	
    function loadData(number, size,order){
			//var $table = $('#table');
            var offset=(number - 1) * size;
            var limit=size;
			
            $.ajax({
                    type: "POST",
                    url: "<?php echo base_url();?>transaksi/loaddataTabel?order="+order+"&limit="+limit+"&offset="+offset,
                    dataType:"JSON",
                    success: function(result){
    				 $table.bootstrapTable('load', result);
    			
                    }
                });
        }
		
	$.ajax({
			type: "POST",
			dataType:"JSON",
			url: "<?php echo base_url();?>transaksi/getCombosupplier/supplier",
			success: function(result) {  
			$.each(result, function(key, val) {	
				$("#kd_supplier").append('<option value="'+val.kd_supplier+'">'+val.nm_supplier+'</option>');
			});
			}
		});

		function bersih() {
				var y = totalrow + 1;
				
				for (x = 0; x < y; x++) {
					if (document.getElementById("rowmat" + x)) {
						hapusBaris("rowmat" + x);
					}
				}
				totalrow = 0;
			}
		
		function hapusBaris(x) {
				if (document.getElementById(x) != null) {
					
					var $row    = $(this).parents('.form-group'),
					 $option = $row.find('[name="option[]"]');
					 $('#' + x).remove();
				}
			}

		  var totalrow= 0;
		function addRow() {
			totalrow++;
			var $template = $('#bookTemplate'),
			$clone    = $template
					.clone()
					.removeClass('hide')
					.removeAttr('id')
					.attr('data-book-index', totalrow)
					.attr('id', 'rowmat'+totalrow)
					.insertBefore($template);
			$clone 
				.find('[name="btnDelRowX"]').attr('onClick','hapusBaris("rowmat' + totalrow + '")').end() 
				.find('[name="kd_barang"]').attr('name', 'detail[' + totalrow + '][kd_barang]').attr('id', 'kd_barang'+totalrow).attr('onclick','popupBarang(' + totalrow + ')').end()
				.find('[name="nm_barang"]').attr('name', 'detail[' + totalrow + '][nm_barang]').attr('id', 'nm_barang'+totalrow).end()
				.find('[name="harga"]').attr('name', 'detail[' + totalrow + '][harga]').attr('id', 'harga'+totalrow).end()
				.find('[name="jumlah"]').attr('name', 'detail[' + totalrow + '][jumlah]').attr('id', 'jumlah'+totalrow).attr('onkeyup','jumlahHarga(' + totalrow + ')').end()
				.find('[name="jumlah_total"]').attr('name', 'detail[' + totalrow + '][jumlah_total]').attr('id', 'jumlah_total'+totalrow).end();
				
		}  
		
		function jumlahHarga(baris){	
			var stokcek=$('#stok'+baris).val();
			var harga=$('#harga'+baris).val();
			var jumlah=$('#jumlah'+baris).val();
			var jumlahharga=jumlah*harga;
			$('#jumlah_total'+baris).val(jumlahharga);
			
			var total_harga=0;
			var y = totalrow + 1;
			for (x = 0; x < y; x++) {
					if (document.getElementById("harga" + x)) {
						
						var harga_det=$('#harga'+x).val();
						var jumlah_det=$('#jumlah'+x).val();
						
						var total=harga_det*jumlah_det;
						
						total_harga=total_harga+total;
					}
				}
				$('#total_faktur').val(total_harga);
			
			
			
		}
		
		function popupBarang(baris){
		$("#barispopup").val(baris);
		$('#modalTable').modal('show'); 
			$("#modalTable").css({"z-index":"1060"});
			$('html,body').scrollTop(0);
			//bersihKaryawan();
			loadDatabarang(1, 15,'desc');
	 }
	 
	 function getParambarang(params) {  
		    return {
				limit: params.limit,
				offset: params.offset,
				search: params.search,
				sort: params.sort,
				order: params.order
		    };
		}	
	 
	 function loadDatabarang(number, size,order){
		 var barisdata=$("#barispopup").val();
			 var $table = $('#tabledata');
            var offset=(number - 1) * size;
            var limit=size;
            $.ajax({
                    type: "POST", 
                    url: "<?php echo base_url();?>transaksi/loaddataBarang?order="+order+"&limit="+limit+"&offset="+offset,
                    dataType:"JSON",
                    success: function(result){
    				 $table.bootstrapTable('load', result);
                    }
                });
        }
		
		function tutupFormpopup(){
			$('#modalTable').modal('hide'); // show bootstrap modal
			bukaModal();

		}
		function bukaModal(){
		$("#modal_formupl").css({"overflow-y":"scroll"});
		}
		function operateFormatterPilih(value, row, index) {
		   return [
				'<a class="btn btn-sm btn-primary btn-xs" id="pilih" class="btn btn-sm btn-primary"  href="javascript:void(0)" title="Pilih" >',
				'Pilih',
				'</a> '
			].join('');
		}

  window.operateEventspilih = {
        'click #pilih': function (e, value, row, index) {
			
            cariDatapopup(row);
        }

    };
	
	function cariDatapopup(row){
		 var barisdata=$("#barispopup").val();
		 $("#kd_barang"+barisdata).val(row.kd_barang);
		 $("#nm_barang"+barisdata).val(row.nm_barang);
		 $("#harga"+barisdata).val(row.harga_barang);
		tutupFormpopup();
	 }
	 
	  function operateFormatter(value, row, index) {
       return [
			'<a class="btn btn-sm btn-primary btn-xs" id="edit" class="btn btn-sm btn-primary"  href="javascript:void(0)" title="Ubah" ><i id="edt" class="glyphicon glyphicon-edit" ></i></a> ',
			'<a class="btn btn-sm btn-danger btn-xs" id="remove" href="javascript:void(0)" title="Hapus"><i class="glyphicon glyphicon-trash"></i></a>'
        ].join('');
    }
	
	 window.operateEvents = { 
        'click #edit': function (e, value, row, index) {
				editForm(row);
        },
        'click #remove': function (e, value, row, index) {
            hapusData(row.no_faktur);
        }
		
		
    };
	
	function editForm(row){
		bersih();
		$('#form')[0].reset(); 
      $('#modal_form').modal('show'); 
      $('.modal-title').text('Form Ubah Transaksi'); 
	  document.getElementById('set').value=1;
	  document.getElementById('btnSave').disabled=false;
	  $("#kd_supplier").val(row.kd_supplier);
		 
	    for (var name in row) {
		//alert(name);
			 $('#modal_form').find('input[name="' + name + '"]').val(row[name]);
        }
		//alert(row);
		if (buttonedit==1){
			//=alert("s");
			editFormtambah(row);
		}
		//$("#idrool").select2("val", 1);
      
		
		
		editDatadetail(row.no_faktur);
		
	}
	
	function editDatadetail(no_faktur){
		 var sd="no_faktur="+no_faktur;
				var i=0;
		 		$.ajax({
                    type: "GET",
					  url: '<?php echo base_url();?>transaksi/getDetadetail',
                    data: sd,
                    dataType:"json",
                    success: function(result){
					var x=0;
					$.each(result, function(key, val) {
					x++; 
						addRow();	
							$('#kd_barang'+x).val(val.kd_barang);
							 $("#nm_barang"+x).val(val.nm_barang);
							$("#harga"+x).val(val.harga);
							$("#jumlah"+x).val(val.jumlah);
							$("#jumlah_total"+x).val(val.jumlah_total);
							
					});	
			}
			});
	}
	
	function hapusData(no_faktur){ 
		//alert(id);
		
				 $.ajax({
                    url: '<?php echo base_url();?>transaksi/hapusData?no_faktur='+no_faktur,
                    type: 'POST',
                    success: function (data) {
					//alert(data);
						try {
						  obj = JSON.parse(data);  
						var pesan=obj['pesan'];
						var status=obj['status'];
						Command: toastr[status](pesan);
						  } catch (e) {
							 // keluarLogin();
						}
					
						
						loadData(1, 15,'desc');
                        
                    }
                })
			
	}
	
</script>