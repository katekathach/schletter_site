---
title: Ground Mount Quote
layout: page
---
<?php include('ground-mount-checklist/form.php') ;?>
<?php echo "test"; ?> 
<script type="text/javascript">

$(document).ready(function(e) {

	$('#fs-syst,#pv-max,#park-sol').hide();
	var  fs,pvm,pksol;
	$('#fs-system').click(function(e) {
	var fscheckvl = $('input:radio[name=system]:checked').val();
	console.log("fs system" + fscheckvl);
	if($('#fs-system').is(':checked') && fscheckvl == "Fs-system" ) {
	/* $.get( "fs-system.php", function( data ) {
	 $(".system").html(data);
	});*/
	$('#fs-syst').show();
	$('#pv-max').hide();
	$('#park-sol').hide();
	var fs = $('#fs-syst').is(":visible");
	var pvm = $('#pv-max').is(":visible");
	var psol = $('#park-sol').is(":visible");
	console.log(fs + " fs");
	console.log(pvm + " pvmax");
	console.log(psol + " parksol");
	$('#fs-sys-hidden').val(fs); //assign fs-system hidden

	 $('#pv-max-hidden').val(pvm);
	 $('#park-sol-hidden').val(psol);

 }
});

$('#pvmax').click(function(e) {

	 var pvmaxcheckvl =  $('input:radio[name=system]:checked').val();
	 console.log("pv max" + pvmaxcheckvl);
	 if($('#pvmax').is(':checked') && (pvmaxcheckvl == "Pv-max" ) ) {
     /* $.get( "pvmax.php", function( data ) {
	 $(".system").html(data);
	 });*/
	 $('#pv-max').show();
	 $('#fs-syst').hide()
	 $('#park-sol').hide();
	 var pvm = $('#pv-max').is(":visible");
	 var fs = $('#fs-syst').is(":visible");
	 var psol = $('#park-sol').is(":visible");
	 console.log(fs + " fs");
	 console.log(pvm + " pvmax");
	 console.log(psol + " parksol");
	 $('#fs-sys-hidden').val(fs);
	 $('#pv-max-hidden').val(pvm);
	 $('#park-sol-hidden').val(psol);

}
});

$('#parksol').click(function(e) {

	 var parksolcheckvl  = $('input:radio[name=system]:checked').val();
	 console.log("park sol "  + parksolcheckvl);
	 if($('#parksol').is(':checked') && (parksolcheckvl == "parksol")) {
	 /*$.get( "parksol.php", function( data ) {
	 $(".system").html(data);
	 });*/
	 $('#park-sol').show();
	 $('#fs-syst').hide()
	 $('#pv-max').hide();
	 var fs = $('#fs-syst').is(":visible");
	 var pvm = $('#pv-max').is(":visible");
	 var psol = $('#park-sol').is(":visible");
	 console.log(fs + " fs");
	 console.log(pvm + " pvmax");
	 console.log(psol + " parksol");
	 $('#fs-sys-hidden').val(fs);
	 $('#pv-max-hidden').val(pvm);
	 $('#park-sol-hidden').val(psol);

	}
});

$('#field_19_0,#field_19_1').click(function(){
	if($('#field_19_0').is(':checked')){
		console.log('checked');
		$('#PeStamps').val('true');
		}else if ($('#field_19_1').is(':checked')){
		console.log('no checked');
		$('#PeStamps').val('false');
		}
});

});
</script>

