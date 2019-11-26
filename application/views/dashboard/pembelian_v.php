<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/easyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/easyui/themes/icon.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/easyui/demo/demo.css">
<script type="text/javascript" src="<?php echo base_url(); ?>asset/easyui/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/detailgrid.js"></script>

<script type="text/javascript">
	$(function(){
		$('#dg').datagrid({
			view: detailview,
			detailFormatter:function(index,row){
				return '<div style="padding:2px"><table id="dg' + index + '"></table></div>';
			},
			onExpandRow: function(index,row){
				$('#dg'+index).datagrid({
					url:'<?php echo base_url();?>pembelian/loadGreatDet?invoice_no='+row.invoice_no,
					fitColumns:true,
					singleSelect:true,
					idField:'id',
					height:'auto',
					columns:[[
						{field:'kd_barang',title:'Kode Barang',width:50,editor:'text'},
						{field:'jenis_barang',title:'Jenis Barang',width:50,editor:'text'},
						{field:'ukuran',title:'Ukuran',width:50,editor:'text'},
						{field:'harga_satuan',title:'Harga Satuan',width:50,editor:'text'},
						{field:'quantity',title:'Quantity',width:50,editor:'text'},
						{field:'total_harga',title:'Total Harga',width:50,editor:'text'}
					]],
					
					onResize:function(){
						$('#dg').datagrid('fixDetailRowHeight',index);
					},
					onLoadSuccess:function(){
						setTimeout(function(){
							$('#dg').datagrid('fixDetailRowHeight',index);
						},0);
					}
				});
				$('#dg').datagrid('fixDetailRowHeight',index);
			}
		});
	});
	function newData(){
		$('#dlg').dialog('open').dialog('setTitle','Tambah Pembelian');
		$('#fm').form('clear');
	}
	
	function editData(){
		var checked = $('#dg').datagrid('getChecked');
      	if (checked.length == 0){
      		alert('Pilih data yang akan di Ubah.')
      	}else if (checked.length > 1){
         	alert('Pilih 1 data yang akan di Ubah.')
      	}else{   
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Ubah Pembelian');
				$('#fm').form('load',row);
				getDataBarang();
			}
	  	}
	}	

	function getDataBarang(){
		$.post("<?php echo base_url();?>pembelian/getDataBarang",$("form").serialize(),function(hasil){
		 data=hasil.split("|");
		 	var z=1;
		 	for(var i=1;i<=data[0];i++){
		  		addRow();
				$("#kd_barang"+i).val(data[z]);
				z++;
				$("#jenis_barang"+i).val(data[z]);
				z++;
				$("#harga_satuan"+i).val(data[z]);
				z++;
				$("#quantity"+i).val(data[z]);
				z++;
				$("#total_harga"+i).val(data[z]);
				z++;
			}
		  cektotalbayar();
		});
	}
	
	function addSubmit(){ 
		var invoice_no = document.getElementById('invoice_no').value;
		var kd_cust = document.getElementById('kd_cust').value;
		var tgl_invoice = document.getElementById('tgl_invoice').value; 
		var total_pembayaran = document.getElementById('total_pembayaran').value; 
		
		if (invoice_no == '' || invoice_no == null){
			alert("Maaf No Invoice Masih Kosong");
			return false;
       	}
		if (kd_cust == '' || kd_cust == null){
			alert("Maaf Customer Masih Kosong");
			return false;
       	}
		if (tgl_invoice == '' || tgl_invoice == null){
			alert("Maaf Tgl Invoice Masih Kosong");
			return false;
       	}
		
		var dataString = 'invoice_no=' + invoice_no + '&kd_cust=' + kd_cust+ '&tgl_invoice=' + tgl_invoice+ '&total_pembayaran=' + total_pembayaran;
		
		var x=1;
		var totalrowx=totalrow+1;
		dataString=dataString+"&totalrow="+totalrow;
		for(x=1;x<totalrowx;x++){
			if(document.getElementById('kd_barang'+x)!=null){
				dataString=dataString+'&kd_barang'+x+'='+document.getElementById('kd_barang'+x).value;
				dataString=dataString+'&quantity'+x+'='+document.getElementById('quantity'+x).value;
				dataString=dataString+'&total_harga'+x+'='+document.getElementById('total_harga'+x).value;
			}else{
				alert('Isi Kolom Belum Lengkap!');
				return false;	
			}
        }
		
		document.getElementById('save').style.display='none';		
        $.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>pembelian/simpan",
			data: dataString,
			success: function(hasil) {
				$('#dg').datagrid('reload');
				$('#dlg').dialog('close');
				alert(hasil);
				$('form input[type="input"],form input[type="hidden"],form input[type="text"],form select,form textarea').val('');//kosongkan form
				document.getElementById('save').style.display='block';		
			}                    
       });
    }
	
	function removeData(){
		var checked = $('#dg').datagrid('getChecked');
        if (checked.length == 0){
			alert('Pilih Data yang akan di Hapus.');
		}else{
			var selectionRows = $('#dg').datagrid('getSelections'); 
			var ids = [];
			for(var i=0;i<selectionRows.length;i++){
				ids.push(selectionRows[i].invoice_no);
			}
			
			$.messager.confirm('Konfirmasi','Yakin Data Akan di Hapus :',function(r){
				if (r){
					for(var i=0;i<selectionRows.length;i++){
						$.post('<?php echo base_url();?>pembelian/removeData',{invoice_no:selectionRows[i].invoice_no},function(result){  
							alert('Data Berhasil di Hapus');
							document.location='pembelian'; 
						});
					}
				} 
			});
		}
	}  

	
	function caridata(){
		var searchby = document.getElementById('searchby').value; 
		$('#dg').datagrid('load',{
            inputnama: $('#inputnama').val(),
			searchby: $('#searchby').val()
			
		});
	}
</script>
<table id="dg" title="Data Pembelian" class="easyui-datagrid" style=" width:auto; height:480px" data-options="collapsible:true" url="<?php echo base_url(); ?>pembelian/loadGrit" toolbar="#tbgr"  idField="tgl_invoice" 
                   rownumbers="true" pagination="true" checkOnSelect="true" striped="true"  pageSize=20 fitColumns="true">
                <thead>
                    <tr>
                        <th field="ck" checkbox="true"></th> 
                        <th field="invoice_no" width="150" sortable="true" >No Invoice</th>
                        <th field="nama_cust" width="150" sortable="true" >Customer</th>
                        <th field="tgl_invoice" width="150" sortable="true" >Tgl Invoice</th>
                        <th field="total_pembayaran" width="150" sortable="true" >Total Pembayaran</th> 
                    </tr>
                </thead>
            </table>
            <div id="tbgr" style="padding:3px">
                <span>Cari Berdasar:</span>
				<select id="searchby" style="width:200px;" class="combobkgr">
                    <option value="">--Pilih--</option>
                    <option value="invoice_no">No Invoice</option>
                    <option value="tgl_invoice">Tgl Invoice</option>
                    <option value="total_pembayaran">Total Pembayaran</option>
                </select>
                <input id="inputnama" class="easyui-validatebox">
                      
                <a href="#" class="easyui-linkbutton" plain="true" onClick="caridata()">Cari</a>
                <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onClick="newData()">Tambah</a>
                <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onClick="editData()">Ubah </a> 
                <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onClick="removeData()">Hapus</a>
            </div>

<div id="dlg" class="easyui-dialog" style="width:950px;height:500px;padding:10px 20px"
	closed="true" buttons="#dlg-buttons">
	<form name="fm" id="fm" method="post" action="">
	<table>
    <tr>
		<td width="250" class="labl">No Invoice</td>
		<td width="10">:</td>
		<td>
        <input type="text" name="invoice_no" id="invoice_no" class="easyui-validatebox" style="width:260px;" />
        </td>
	</tr>
	<tr>
		<td width="250" class="labl">Customer</td>
		<td width="10">:</td>
		<td>
        <select name="kd_cust" id="kd_cust" class="easyui-validatebox" style="width:260px;height:26px;">
  			<?php foreach($customer as $dt):?>
    			<option <?php echo 'selected';?> value='<?php echo $dt->kd_cust?>'><?php echo $dt->nama_cust;?> </option>
    		<?php endforeach ?>
  		</select>
        </td>
	</tr>
    <tr>
		<td width="250" class="labl">Tanggal Invoice</td>
		<td width="10">:</td>
		<td>
        <input type="date" name="tgl_invoice" id="tgl_invoice" class="easyui-validatebox" style="width:260px;" />
        </td>
	</tr>
	</table>
    <table cellpadding="1" class="tabrow" width ="900" id="pattern-style-a" align="center">
    	<thead>
        	<tr bgcolor="#666666">
            	<th colspan ="8" align="center">
                	<input type="button" align="left" value="Tambah" class="tomboltab" style="width:100px;" onClick="addRow();" />
                    <input class="txtcari" type="hidden" name="texsem" id="texsem"  >
               		<input name="totalrow" id="totalrow" type="hidden" />
                </th> 
             </tr>                
        </thead>
        <tbody bgcolor="#CCCCCC" id="theBody">
             <tr>
             	<td width="22"><b></b>No</td>
                <td><left>Kode Barang</left></td>
                <td><left>Barang</left></td>
                <td><left>Harga Satuan</left></td>
                <td><center>Quantity</center></td>
                <td><center>Total Harga</center></td>
              	<td width="51" ><center>Action</center></td>
             </tr>
        </tbody>
	  </table>
	<div id="dlg-buttons">
    <table width ="900" align="center">
          <tr>
            <td width="700" align="right">Total Pembayaran</td>
            <td width="100"><input type="text" name="total_pembayaran" readonly="readonly" id="total_pembayaran" class="easyui-validatebox"/></td>
            <td width="51"></td>
          </tr>
      </table>
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onClick="addSubmit()" id="save">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onClick="javascript:$('#dlg').dialog('close')">Cancel</a>
	</div>
	</form>
</div>
<script type="text/javascript">
	var totalrow=0;
	var nativerow=0;
	function addRow(){
		totalrow++;
		nativerow++;
		
		$('#pattern-style-a tr:last').after('<tr id=\"row'+totalrow+'\" bgcolor="#fff"><td align=\"center\">'+totalrow+'<input type=\"hidden\" id="nourut'+totalrow+'" name="nourut'+totalrow+'" value=\"'+totalrow+'\" ></td><td><input type=\"text\" id="kd_barang'+totalrow+'" name="kd_barang'+totalrow+'" value=\"\"><input type="button" onclick="CariBarang('+totalrow+')" value="Cari" class="tomboltab" /></td><td><input type=\"text\" id="jenis_barang'+totalrow+'" name="jenis_barang'+totalrow+'" value=\"\" ></td><td><input type=\"text\" id="harga_satuan'+totalrow+'" name="harga_satuan'+totalrow+'" value=\"\" ></td><td><input type=\"text\" id="quantity'+totalrow+'" name="quantity'+totalrow+'" value=\"0\" onkeyup=\"cektotalharga('+totalrow+')\"></td><td><input type=\"text\" id="total_harga'+totalrow+'" name="total_harga'+totalrow+'" value=\"0\"></td><td align=\"center\"><input type=\"button\" value=\"Hapus\" class=\"tomboltab\"  onclick=\"removeTableRow('+totalrow+');\"  /></td></tr>');
				  
				  document.getElementById('totalrow').value = totalrow;
				  
 }

//tombol remove
function removeTableRow(trId){
	$('#row' + trId).remove();
	totalrow--;
	document.getElementById('totalrow').value = totalrow;
	totaljurnal();
}
function cektotalharga(idrow){
	var x=idrow;
	var hargasatuan=parseInt(document.getElementById('harga_satuan'+x).value);
	var quantity=parseInt(document.getElementById('quantity'+x).value);
	var totalharga=parseInt(hargasatuan)*parseInt(quantity);
	document.getElementById('total_harga'+x).value=totalharga;
	cektotalbayar();
}

function cektotalbayar(){
	var x=1;
	var total_harga=0;
	for(x=1;x<=totalrow;x++){
		total_harga=parseInt(total_harga)+parseInt(document.getElementById('total_harga'+x).value);
	}
	document.getElementById('total_pembayaran').value=total_harga;
}
</script>

<!----- grit popup Customer------>
<script type="text/javascript">
var hasil='';
function CariBarang(id){
	hasil=id;
	$('#grakses').datagrid({
		url:'<?php echo base_url();?>pembelian/GetBarang',
		fitColumns:true,
		singleSelect:true,
		idField:'id',
		columns:[[
			{field:'kd_barang',title:'Kode Barang',editor:'text'},
			{field:'jenis_barang',title:'Jenis Barang',editor:'text'},
			{field:'harga_satuan',title:'Harga Satuan',editor:'text'},
			{field:'ukuran',title:'Ukuran',editor:'text'},
			{field:'stok',title:'Stok',editor:'text'},
			{field:'stok_min',title:'Stok Min',editor:'text'},
			{field:'stok_max',title:'Stok Max',editor:'text'}
		]],

	});
	$('#grakses').datagrid('load');
    $('#inputakses').dialog('open').dialog('Grid','Manipulated Grid');


}
	
$(document).ready(function() {  
	$('#grakses').datagrid({
		onDblClickRow:function(){
			var baris = $(this).datagrid('getSelected');
			document.getElementById('kd_barang'+hasil).value = baris.kd_barang;
			document.getElementById('jenis_barang'+hasil).value = baris.jenis_barang;
			document.getElementById('harga_satuan'+hasil).value = baris.harga_satuan;
			$('#inputakses').window('close');
        }
	}); 
 });

function caridtBarang(){
	$('#grakses').datagrid('load',{
    	inputcaribarang: $('#inputcaribarang').val(),
		pilihdatabarang: $('#pilihdatabarang').val()
	});
}
	</script>
		 <div id="inputakses" class="easyui-dialog" style="width:800px;height:420px;padding:10px 15px"
                 closed="true"  title="Data Acount">
                <table id="grakses" class="easyui-datagrid" style="width:757px;height:350px" toolbar="#tbakses"
                       rownumbers="true" pagination="true" singleSelect="true" >
                    	
                </table>
                <div id="tbakses" style="padding:3px">
                   <span>Cari Berdasar:</span>
				<select id="pilihdatabarang" style="width:100px;" class="combobkgr">
                    <option value="">--Pilih--</option>
                    <option value="kd_barang">Kode Barang</option>
                    <option value="jenis_barang">Jenis Barang</option>
                    <option value="harga_satuan">Harga Satuan</option>
                    <option value="ukuran">Ukuran</option>
                    <option value="stok">Stok</option>
                    <option value="stok_min">Stok Min</option>
                    <option value="stok_max">Stok Max</option>
                </select>
                <input id="inputcaribarang" class="easyui-validatebox">
                           
                <a href="#" class="easyui-linkbutton" plain="true" onClick="caridtBarang()">Search</a>

                </div>
            </div>	
