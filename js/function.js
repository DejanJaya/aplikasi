  
    function isNumberKey(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode;
		//alert(charCode);
		if (charCode != 44 && charCode != 46 && charCode > 31 
			&& (charCode < 48 || charCode > 57))
			
			return false;
		
		return true;
	}
					
  function readyToStart() {
    //alert("");
  //  $(".nomor").val("0.00");
    $(".nomor").focus(function () {
        if ($(this).val() == '0.00') {
            $(this).val('');
        } else {
            this.select();
        }
    });
    $(".nomor").focusout(function () {
        if ($(this).val() == '') {
            $(this).val('0.00');
        } else {
            var angka = $(this).val();
            $(this).val(number_format(angka, 2));
        }
    });
    $(".nomor").keyup(function () {
        var val = $(this).val();
        if (isNaN(val)) {
            val = val.replace(/[^0-9\.]/g, '');
            if (val.split('.').length > 2)
                val = val.replace(/\.+$/, "");
        }
        $(this).val(val);

    });
	
	

   //$(".nomor1").val("0.020");
    $(".nomor1").focus(function () {
        if ($(this).val() == '0.00') {
            $(this).val('');
        } else {
            this.select();
        }
    });
	
	$(".nomor1").focusout(function () {
        if ($(this).val() == '') {
            $(this).val('0.00');
        } else {
            var angka = $(this).val();
            $(this).val(number_format(angka, 2));
        }
    });
	
  
    $(".nomor1").keyup(function () {
        var val = $(this).val();
        if (isNaN(val)) {
            val = val.replace(/[^0-9\.]/g, '');
            if (val.split('.').length > 2)
                val = val.replace(/\.+$/, "");
        }
        $(this).val(val);

    });
    
    $(".nomor2").val("");
    $(".nomor2").focus(function () {
        if ($(this).val() == '0') {
            $(this).val('');
        } else {
            this.select();
        }
    });
    $(".nomor2").focusout(function () {
        var val = $(this).val();
        if ($(this).val() == '') {
            $(this).val('');
        } else {
            $(this).val(val);
        }
    });
    $(".nomor2").keyup(function () {
        var val = $(this).val();
        if (isNaN(val)) {
            val = val.replace(/[^0-9\.]/g, '');
            if (val.split('.').length > 2)
                val = val.replace(/\.+$/, "");
        }
        $(this).val(val);

    });
}

function number_format(number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}
function deformaat(number, decimals, dec_point, thousands_sep){
	var deformatter = number.split(",");
            var size = deformatter.length;
            var result='';
            for(i=0;i<size;i++){
                result = result+deformatter[i];
            }
            return parseFloat(result);
}
function CleanNumber(value) {
        newValue = value.replace(/\,/g, '');
        return newValue;
    }
	

function idDebit(evt)
{
    var charCode = (evt.which) ? evt.which : event.keyCode;
    //alert(charCode);
    if (charCode==68||charCode==67||charCode==99||charCode==100)
        return true;
 //   alert("Nomor dan titik saja");
//	alert("Harap masukan angka dan titik saja!");
    return false;
    
}

 function formatRupiah(value, row, index){
	  var nilai=number_format(value,2);
	  return nilai;
  }