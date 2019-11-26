

var path = window.location.pathname;
var page = path.split("/").pop();

$(document).ready(function ($) {
var menuaktif=document.getElementById("id_menuaktif").innerHTML;
//alert(menuaktif);
$(".open").removeClass('open');
 $("#menu_pertama"+menuaktif).addClass('open');
 });
 
 
	
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
	
	//$aktivasi.prop('disabled', true);
	
	 function simpanData(){
		// alert(page)
	 document.getElementById("btnSave").disabled=true;
 	 var data = $('#form').serializeArray();
			  $.ajax({
				  type: "POST",
				  url: ""+page+"/simpanData",
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
 
 
 
 
	function Capitalize(str){  
	return str.replace (/\w\S*/g, 
      function(txt)
      {  return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase(); } );
	}
	
	function tambahData(){
		var halaman=document.getElementById("judulmenu").innerHTML; 
		//alert(halaman);
		 
     $('#form')[0].reset(); 
	 $('#form').bootstrapValidator('resetForm', true);
      $('#modal_form').modal('show'); 
	  /* $('#modal_form').modal('show')
              .draggable({ handle: ".modal-header" });
			  */
      $('.modal-title').text('Form Tambah '+halaman+''); 
	  document.getElementById('set').value=0;
	  document.getElementById('btnSave').disabled=false;
	 // $("#id_grup_satu").select2("val","");
		
    }
	
	
	
	
	function tutupForm(){
		 $('#form')[0].reset(); // reset form on modals 
      	$('#modal_form').modal('hide'); // show bootstrap modal
	}
	
	
	
    function loadData(number, size,order){
            var offset=(number - 1) * size;
            var limit=size;
			
            $.ajax({
                    type: "POST",
                    url: ""+page+"/loaddataTabel?order="+order+"&limit="+limit+"&offset="+offset,
                    dataType:"JSON",
                    success: function(result){
    				 $table.bootstrapTable('load', result);
    			
                    }
                });
        }
		
   
    
    function editForm(row){
		var halaman=document.getElementById("judulmenu").innerHTML; 
        $('#form')[0].reset(); 
      $('#modal_form').modal('show'); 
      $('.modal-title').text('Form Ubah '+halaman+''); 
	  document.getElementById('set').value=1;
	  document.getElementById('btnSave').disabled=false;
	  
		 var buttonedit=document.getElementById('buttonedit').value;
		 
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
      
		$('#form').bootstrapValidator('resetForm',false);
    }
	
	
	
    
    
   
     var $table = $('#table'),
        $remove = $('#remove'),
		$aktivasi = $('#aktivasi')
    $(function () {
        $table.on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function () {
            $remove.prop('disabled', !$table.bootstrapTable('getSelections').length);
        });
		
        $remove.click(function () {
		var hapus="";
            var ids = $.map($table.bootstrapTable('getSelections'), function (row) {
				hapus=row.id+","+hapus;
            });
			
			hapusArray(hapus);
            $table.bootstrapTable('remove', {
                field: 'id',
                values: ids
            });
            $remove.prop('disabled', true);
        });
		
		
    });
	
	
     $(function () {
        $table.on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function () {
            $aktivasi.prop('disabled', !$table.bootstrapTable('getSelections').length);
        });
		
        $aktivasi.click(function () {
		var aktiv="";
            var ids = $.map($table.bootstrapTable('getSelections'), function (row) {
				aktiv=row.id+","+aktiv;
            });
			
			aktifArray(aktiv);
            $aktivasi.prop('disabled', true);
        });
		
		
    });
	

	
	
   function statusFormat(value, row, index) {
	   	if(row.status=='0'){
			return ['Tidak Aktiv'];
		}else{
			return [' Aktiv'];
		}
    
    }
   
    window.operateEvents = { 
        'click #edit': function (e, value, row, index) {
				editForm(row);
        },'click #profil': function (e, value, row, index) {
				profilPegawai(row);
        },
        'click #remove': function (e, value, row, index) {
            hapusData(row.id);
        },
		'click #aktivasi': function (e, value, row, index) {
            aktivData(row.id);
        },
		'click #menuuser': function (e, value, row, index) {
            menuForm(row);
        },'click #editupl': function (e, value, row, index) {
				editFormupl(row);
        },
		'click #aktivasicom': function (e, value, row, index) {
            aktivDatacom(row);
        },
		'click #printdet': function (e, value, row, index) {
            printData(row);
        }
    };
      
    function hapusData(id){ 
		//alert(id);
		bootbox.confirm("Yakin Data akan di Hapus?", function(result) {
			if(result==true){
				 $.ajax({
                    url: ''+page+'/hapusData?id='+id,
                    type: 'POST',
                    success: function (data) {
					//alert(data);
						try {
						  obj = JSON.parse(data);  
						var pesan=obj['pesan'];
						var status=obj['status'];
						Command: toastr[status](pesan);
						  } catch (e) {
							  keluarLogin();
						}
					
						
						loadData(1, 15,'desc');
                        
                    }
                })
			}
               
        });
	}
	
	 function aktivData(id){
		bootbox.confirm("Yakin Data akan di Aktivasi?", function(result) {
			if(result==true){
				 $.ajax({
                    url: ''+page+'/aktivData?id='+id,
                    type: 'POST',
                    success: function (data) {
						try {
						  obj = JSON.parse(data);  
						var pesan=obj['pesan'];
						var status=obj['status'];
						Command: toastr[status](pesan);
						  } catch (e) {
							  keluarLogin();
						}
						loadData(1, 15,'desc');
                        
                    }
                })
			}
               
        });
	}
	
	
	function hapusArray(hapus){
		bootbox.confirm("Yakin Data akan di Hapus?", function(result) {
			if(result==true){
				 $.ajax({
                    url: ''+page+'/hapusDataarray?data='+hapus,
                    type: 'POST',
                    success: function (data) {
						try {
						  obj = JSON.parse(data);  
						var pesan=obj['pesan'];
						var status=obj['status'];
						Command: toastr[status](pesan);
						  } catch (e) {
							  keluarLogin();
						}
						loadData(1, 15,'desc');
                    }
                })
			}
               
        });
	}
	
	function aktifArray(aktiv){
		bootbox.confirm("Yakin Data akan di Aktivasi?", function(result) {
			if(result==true){
				 $.ajax({
                    url: ''+page+'/aktivDataarray?data='+aktiv,
                    type: 'POST',
                    success: function (data) {
						try {
						  obj = JSON.parse(data);  
						var pesan=obj['pesan'];
						var status=obj['status'];
						Command: toastr[status](pesan);
						  } catch (e) {
							  keluarLogin();
						}
						/*obj = JSON.parse(data);  
						var pesan=obj['pesan'];
						var status=obj['status'];
						Command: toastr[status](pesan);*/
						loadData(1, 15,'desc');
						$aktivasi.prop('disabled', true);
                    }
                })
			}
               
        });
	}
	
	
	// tambah detail upload
	function tambahDatadetail(){
		bersih();
		var halaman=document.getElementById("judulmenu").innerHTML; 
		//alert(halaman);
		 
     $('#formupl')[0].reset(); 
	 $('#formupl').bootstrapValidator('resetForm', true);
      $('#modal_formupl').modal('show'); 
      $('.modal-title').text('Form Tambah '+halaman+''); 
	  document.getElementById('set').value=0;
	  document.getElementById('btnSave').disabled=false;
	 // $("#id_grup_satu").select2("val","");
		
    }
	
	function tutupFormupl(){
		 $('#formupl')[0].reset(); // reset form on modals 
      	$('#modal_formupl').modal('hide'); // show bootstrap modal
	}
	
	function editFormupl(row){ 
		var halaman=document.getElementById("judulmenu").innerHTML; 
        $('#formupl')[0].reset(); 
      $('#modal_formupl').modal('show'); 
      $('.modal-title').text('Form Ubah '+halaman+''); 
	  document.getElementById('set').value=1;
	  document.getElementById('btnSave').disabled=false;
	  
		 var buttonedit=document.getElementById('buttonedit').value;
		 
	    for (var name in row) {
		//alert(name);
			 $('#modal_formupl').find('input[name="' + name + '"]').val(row[name]);
        }
		//alert(row);
		if (buttonedit==1){
			//alert("s");
			editFormtambah(row);
		}
		//$("#idrool").select2("val", 1);
      
		$('#formupl').bootstrapValidator('resetForm',false);
    }
	
	$('#formupl')
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
                }
            }
        })
        .on('status.field.bv', function(e, data) {
		//alert(data.field);
            data.bv.disableSubmitButtons(false);
        }).on('success.form.bv', function(e,data){
		// alert("ok");
		simpanDataupl();
		 e.preventDefault();
		 
		 
    });
	
	function simpanDataupl(){
	 //alert("2")
	 var gambar = document.getElementById('file_foto').value; 
	//alert(gambar);
	if(gambar==""||gambar==null){
		var setgbr=0;
	}else{
		var setgbr=1;
	}
	// document.getElementById("btnSave").disabled=true;
	 var fd = new FormData(document.getElementById("formupl"));
			fd.append("setgbr",setgbr);
			$.ajax({
				 url: ""+page+"/simpanData",
			  type: "POST",
			  data: fd,
			  enctype: 'multipart/form-data',
			  processData: false,  // tell jQuery not to process the data
			  contentType: false   // tell jQuery not to set contentType
			}).done(function( result ) {
				try {
					  obj = JSON.parse(result);  
					var pesan=obj['pesan'];
					var status=obj['status'];
				  	Command: toastr[status](pesan);
					  } catch (e) {
						//  keluarLogin();
					}
					
				//	tutupFormupl();
					loadData(1, 15,'desc');
			});
			return false;	
			
	 
 }
 
 