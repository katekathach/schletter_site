<?php

# This block must be placed at the very top of page.
# --------------------------------------------------
require_once( dirname(__FILE__).'/form.lib.php' );
phpfmg_display_form();
# --------------------------------------------------
function phpfmg_form( $sErr = false ){
		$style=" class='form_text' ";

?>
<?php
echo '<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />';
echo "<script type='text/javascript' src='//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js'></script>";
echo "<script type='text/javascript' src='//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js'></script>";
echo "<script type='text/javascript' src='//fast.fonts.com/jsapi/af8a1a24-871f-4397-94c7-46abd773ff48.js'></script>";
echo "<script type='text/javascript' src='js/formToWizard.js'></script>";

echo "<script> $(document).ready(function(){
  $('#project-checklist').formToWizard({ submitButton: 'SaveAccount' });

});
$(document).ready(function(){

 if (($('#step1 .form_error_highlight').length > 0 ) && ($('#step0 .form_error_highlight').length === 0 )) {
$('#step1').show();
$('#step0').hide();
}

if($('.form_error_highlight').length > 0){
	alert('If you uploaded a file, please re-upload your file again before submitting.');

}
console.log($.find('.form_error_highlight'));

 //If terrain D is checked, show additional field

 $('#field_31_0,#field_31_1,#field_31_2').click(function(){

	 if($('#field_31_2').is(':checked')){

		 $('#field_35_div').show();
		 $('#terrainD').val(true)
		 }else{
		 $('#field_35_div').hide();}
	 });


//If park@sol system radio is checked, ask for additional field (carport type)

	   $('#field_41_0,#field_41_1,#field_41_2').click(function(){
	 if($('#field_41_2').is(':checked')){

		 $('#park-sol').show();
		 }else{
		 $('#park-sol').hide();}
	 });

//Add terrain images to radios

	$('#field_31_0' ).after( '<br><img src=".'images/terrain-B.png'." />' );
	$('#field_31_1' ).after( '<br><img src=".'images/terrain-C.png'." />' );
	$('#field_31_2' ).after( '<br><img src=".'images/terrain-D.png'." />' );

//Add carport type images to carport

	$('#field_62_0' ).after( '<br><img src=".'images/project-checklist-carport-b1.png'." />' );
	$('#field_62_1' ).after( '<br><img src=".'images/project-checklist-carport-b2.png'." />' );
	$('#field_62_2' ).after( '<br><img src=".'images/project-checklist-carport-b3.png'." />' );

	$('#field_75').change(function(){
		  //alert(this.files[0].size);
		if(this.files[0].size > 2097152){
			$('#submitButton').attr('disabled','disabled');
			alert('File Size Must Be < 2 MB');

		}else{
			$('#submitButton').removeAttr('disabled');
			}
		})


 });

$(function() {
$( '.question').tooltip({
show: {
effect: 'slideDown',
delay: 110

},
position: {
	my: 'left top',
at: 'right top'
}
});
$( '#hide-option' ).tooltip({
hide: {
effect: 'explode',
delay: 250
}
});
$( '#open-event' ).tooltip({
show: null,
position: {
my: 'left top',
at: 'left bottom'
},
open: function( event, ui ) {
ui.tooltip.animate({ top: ui.tooltip.position().top + 10 }, 'fast' );
}
});
});


</script>";

?>
<style>
#phpfmg_captcha_div {
    width: 304px !important;
}
</style>
<!--<script src='http://www.google.com/recaptcha/api.js'></script>-->


<div class="content-bg content-detail">
<!--<div class="">-->
<div class="logo right">
<a href="../index.html">
<!--<img width="190" height="51" alt="Schletter Solar Mounting Systems" title="Schletter Solar Mounting Systems" src="../images/schletter-logo.png">-->
</a>
</div><ul class="related-links right">
            Not sure of your project details?
            <li><a href="contact-schletter.html">Contact Us &raquo;</a> </li>

        </ul>
<h1 class="ground-icon">Ground Mount Project Quote</h1>
<h2>Fill out the form below to receive a project quote.</h2>
<div class="section"></div>
<form name="frmFormMail" action='<?php echo PHPFMG_ADMIN_URL . '' ; ?>' method='post' enctype='multipart/form-data' onsubmit='return fmgHandler.onsubmit(this);' id='project-checklist'  >
<input type='hidden' name='formmail_submit' value='Y'>
<input type='hidden' name='mod' value='ajax'>
<input type='hidden' name='func' value='submit'>
<div id='err_required' class="form_error" style='display:none;'>
    <label class='form_error_title'>Please check the required fields</label>
</div>

<ol class='phpfmg_form' >
<fieldset id="contact">
<div class="col40 left">
<legend class="contact-icon">Contact</legend>
<li class='field_block' id='field_11_div'><div class='col_label'>
	<label class='form_field'>Company Legal Name:</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_11"  id="field_11" value="<?php  phpfmg_hsc("field_11", ""); ?>"   class='text_box '   >
	<div id='field_11_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_2_div'><div class='col_label'>
	<label class='form_field'>Company Address:</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_2"  id="field_2" value="<?php  phpfmg_hsc("field_2", ""); ?>"   class='text_box '   >
	<div id='field_2_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_12_div'><div class='col_label'>
	<label class='form_field'>Company DBA (if applicable):</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<input type="text" name="field_12"  id="field_12" value="<?php  phpfmg_hsc("field_12", ""); ?>"   class='text_box'  >
	<div id='field_12_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_13_div'><div class='col_label'>
	<label class='form_field'>Contact Name:</label>  <label class='form_required' >*</label><label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<input type="text" name="field_13"  id="field_13" value="<?php  phpfmg_hsc("field_13", ""); ?>" class='text_box'>
	<div id='field_13_tip' class='instruction'></div>
	</div>
</li>



<li class='field_block' id='field_15_div'><div class='col_label'>
	<label class='form_field'>Contact E-mail:</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_15"  id="field_15" value="<?php  phpfmg_hsc("field_15", ""); ?>"  class='text_box ' placeholder="Quote will be sent here" >
	<div id='field_15_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_16_div'><div class='col_label'>
	<label class='form_field'>Contact Phone Number:</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_16"  id="field_16" value="<?php  phpfmg_hsc("field_16", ""); ?>"  class='text_box' >
	<div id='field_16_tip' class='instruction'></div>
	</div>
</li>
</div>
<div class="col40 left ">
<legend class="project-icon">Project</legend>

<li class='field_block' id='field_4_div'><div class='col_label'>
	<label class='form_field'>Total Project Size (kW):</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_4"  id="field_4" value="<?php  phpfmg_hsc("field_4", ""); ?>"  class='text_box ' >
	<div id='field_4_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_5_div'><div class='col_label'>
	<label class='form_field'>Project Name:</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_5"  id="field_5" value="<?php  phpfmg_hsc("field_5", ""); ?>"  class='text_box ' >
	<div id='field_5_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_6_div'><div class='col_label'>
	<label class='form_field'>Project Address:</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_6"  id="field_6" value="<?php  phpfmg_hsc("field_6", ""); ?>"  class='text_box '  >
	<div id='field_6_tip' class='instruction'></div>
	</div>
</li>
<li class='field_block' id='field_0_div'><div class='col_label'>
	<label class='form_field'>Schletter Sales Associate:</label> </div>
	<div class='col_field'>
	<?php phpfmg_dropdown( 'field_0',  "New Customer|Blaz Ruzic|Christian Savaia|David Johnson|Daniel Rodriguez|Fernando Figueroa|George Varney|Justin Smith|Other");?>
	<div id='field_0_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_19_div'><div class='col_label'>
	<label class='form_field'>PE Structural Stamps Required:</label> <label class='form_required' >* <img class="question" src="images/help.png" alt="help" title="If project requires stamped drawings by an engineer, select 'Yes'." /></label> </div>
	<div class='col_field'>
	<?php phpfmg_radios( 'field_19', "Yes|No" );?>
	<div id='field_19_tip' class='instruction'></div>
	</div>
</li>

</div>
<div class="col40 left">
<legend class="project-site-icon">Project Site</legend>
<li class='field_block' id='field_31_div'><div class='col_label'>
<label  class='form_field'>Terrain Category:</label> <label class='form_required' >* <img class="question" src="images/help.png" alt="help" title="TERRAIN B: Urban and suburban areas. TERRAIN C: Open terrain with scattered obstructions with heights generally < 30 ft. TERRAIN D: Unobstructed areas and water surfaces outside hurricane prone regions. View ASCE 7-05 6.5.6.3 " /></label> </div>
	<div class='col_field terrain'>


  <?php  phpfmg_radios( 'field_31', "Terrain B|Terrain C|Terrain D" );?>

</div>
</li>
<div class="col20 left">


<li class='field_block' id='field_33_div'><div class='col_label'>
	<label class='form_field'>Wind Load(mph):</label> <label class='form_required' >* <img class="question" src="images/help.png" alt="help" title="Check with the city or county officials of the project location." /></label> </div>
	<div class='col_field'>
	<input type="text" name="field_33"  id="field_33" value="<?php  phpfmg_hsc("field_33", ""); ?>" class='text_box'>
	<div id='field_33_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_34_div'><div class='col_label'>
	<label class='form_field'>Snow Load(psf):</label> <label class='form_required' >* <img class="question" src="images/help.png" alt="help" title="Check with the city or county officials of the project location." /></label> </div>
	<div class='col_field'>
	<input type="text" name="field_34"  id="field_34" value="<?php  phpfmg_hsc("field_34", ""); ?>" class='text_box'>
	<div id='field_34_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_35_div'><div class='col_label'>
	<label class='form_field'>Proximity to Coast(mi):</label> </div>
	<div class='col_field'>
	<input type="text" name="field_35"  id="field_35" value="<?php  phpfmg_hsc("field_35", ""); ?>" class='text_box'>
	<div id='field_35_tip' class='instruction'></div>
	</div>
</li>
</div>
<div class="col20 left">
<li class='field_block' id='field_32_div'><div class='col_label'>
	<label class='form_field'>Occupancy Category:</label> <label class='form_required' >* <img class="question" src="images/help.png" alt="help" title="II: All residential houses, buildings, and structures except those listed in categories III and IV. III: Structures that represent a substantial hazard to human life or serious economic impact in the event of failure, including but not limited to: where more than 300 people congregate in one area. IV: Structures designated as essential facilities, including, but not limited to: hospitals, fire and police stations, earthquake shelters.

    See ASCE 7-05 Table 1-1" /></label> </div>
	<div class='col_field'>
	<?php phpfmg_dropdown( 'field_32', "I|II|III|IV" );?>
	<div id='field_32_tip' class='instruction'></div>
	</div>
</li>
<li class='field_block' id='field_30_div'><div class='col_label'>
	<label class='form_field'>ASCE Version:</label><img class="question" src="images/help.png" alt="help" title="ASCE 7-05:(IBC 2003, 2006 & 2009). ASCE 7-10:(IBC 2012). Check with local building officials to verify the applicable version for your project location. "
 /></div>
	<div class='col_field'>
	<?php phpfmg_dropdown( 'field_30', "|7-05|7-10" );?>
	</div>
</li>
</div>
</div>

</fieldset>



<fieldset id="module" >

<div class="col40 left">
<legend class="module-icon">Module</legend>
<li class='field_block' id='field_37_div'><div class='col_label'>
	<label class='form_field'>Module Model / Brand / Wattage:</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_37"  id="field_37" value="<?php  phpfmg_hsc("field_37", ""); ?>" class='text_box'>
	<div id='field_37_tip' class='instruction'></div>
	</div>
</li>
    <div id='field_42_tip' style="font-style:italic; color:#888888">Module dimensions: measure exterior of frame.</div>
<div class="col20 left">
<li class='field_block' id='field_39_div'><div class='col_label'>
	<label class='form_field'>Module Quantity:</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_39"  id="field_39" value="<?php  phpfmg_hsc("field_39", ""); ?>" class='text_box'>
	<div id='field_39_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_42_div'><div class='col_label'>
	<label class='form_field'>Height (mm):</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_42"  id="field_42" value="<?php  phpfmg_hsc("field_42", ""); ?>" class='text_box'>
	<div id='field_42_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_43_div'><div class='col_label'>
	<label class='form_field'>Width (mm):</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_43"  id="field_43" value="<?php  phpfmg_hsc("field_43", ""); ?>" class='text_box'>
	<div id='field_43_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_47_div'><div class='col_label'>
	<label class='form_field'>Orientation:</label> <label class='form_required' >* <img class="question" src="images/help.png" alt="help" title="Portrait: Vertical position of modules Landscape: Horizontal position of modules" /></label></div>
	<div class='col_field'>
	<?php phpfmg_checkboxes( 'field_47', "Portrait|Landscape" );?>
	<div id='field_47_tip' class='instruction'></div>
	</div>
</li>

</div>
<div class="col20 left">
<li class='field_block' id='field_44_div'><div class='col_label'>
	<label class='form_field'>Thickness (mm):</label> <label class='form_required' >*</label></div>
	<div class='col_field'>
	<input type="text" name="field_44"  id="field_44" value="<?php  phpfmg_hsc("field_44", ""); ?>" class='text_box'>
	<div id='field_44_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_45_div'><div class='col_label'>
	<label class='form_field'>Weight (kg):</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_45"  id="field_45" value="<?php  phpfmg_hsc("field_45", ""); ?>" class='text_box'>
	<div id='field_45_tip' class='instruction'></div>
	</div>
</li>


<li class='field_block' id='field_46_div'><div class='col_label'>
	<label class='form_field'>Module Tilt (°):</label> <label class='form_required' >* <img class="question" src="images/help.png" alt="help" title="Desired angle (in degrees) of the system" /></label> </div>
	<div class='col_field'>
	<input type="text" name="field_46"  id="field_46" value="<?php  phpfmg_hsc("field_46", ""); ?>" class='text_box'>
	<div id='field_46_tip' class='instruction'></div>
	</div>
</li>



</div>
</div>
<div class="col40 left">
<legend class="system-ground-icon">System</legend><li class='field_block' id='field_40_div'><div class='col_label'>
	<label class='form_field'>Describe Array Configuration:</label> <label class='form_required' >* <img class="question" src="images/help.png" alt="help" title="Describe the rack size, such as 4 modules wide by 2 modules high" /></label> </label> </div>
	<div class='col_field'>
	<input type="text" name="field_40"  id="field_40" value="<?php  phpfmg_hsc("field_40", ""); ?>" class='text_box' placeholder='ex: 8 Racks of 2V X 10'>
	<div id='field_40_tip' class='instruction'></div>
	</div>
</li>
<li class='field_block' id='field_41_div'>
<div class='col_label'>

  <label class='form_field'>Select Your System:</label><label class='form_required' >* <img class="question" src="images/help.png" title="FS System: Pile driven, used for larger projects PvMax/PvMini: Ballasted, rocky soil or landfills Park@Sol: Carport or shading structures" /></label></div>

    	<div class='col_field'>
   <?php  phpfmg_radios( 'field_41', "G-Max|FS Uno|FS System|PvMax/PvMini (Ballasted)|Park@Sol Carport" );?>
</div></li><div class="clear"></div>
<li class='field_block' id='field_54_div'><div class='col_label'>
	<label class='form_field'>Describe other site or rack characteristics:</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<textarea name="field_54" id="field_54" rows=4 cols=25 class='text_area' placeholder='slope, ground clearance, frost depth, rocky soil, foundation type...'><?php phpfmg_hsc("field_54"); ?></textarea>

	<div id='field_54_tip' class='instruction'></div>

</li>
<div class="clear"></div>

<!-- system div -->
<div class="system">
<!-- Fs system and fs uno -->


<!-- end of fs system -->

<!-- pv max -->

<!-- end pv max -->
<!-- park sol -->
<div id="park-sol">
<div class="col40 left">

<li class='field_block' id='field_62_div'><div class='col_label'>
	<label class='form_field'>Carport Type</label> </div>
    	<div class='col_field'>
         <?php  phpfmg_radios( 'field_62', "B1 - 1 row|B2 - 2 row|B3 - 2 row" );?>

	</div>
</li>
</div>
</div></div>

</div>
<!-- end of parksol -->

<div class="col40 left">

<legend class="submit-icon">Submit</legend>
<li class='field_block' id='field_75_div'><div class='col_label'>
	<label class='form_field'>Upload Layout Drawings:</label> <label class='form_required' >* <img class="question" src="images/help.png" alt="help" title="If your file is too large or a different file type: email the file to sales.us@schletter-group.com along with your project name and company." /></label> </div>
    <div id='field_75_tip' style="font-style:italic; color:#888888">2MB max.(.pdf, .jpg, .png, .gif, .xlsx, .csv, .dwg)</div>
	<div class='col_field'>
	<input type="file" name="field_75"  id="field_75" value="" class='text_box' onchange="fmgHandler.check_upload(this);">
    <input type="hidden" name="upload" id="upload_path" value="" />
	<a href type="button" id="remove" name="Delete" value="Delete" style="text-decoration:underline; font-style:italic;">Remove</a>
<?php //echo "<a id=\"remove\" href=\"form.lib.php?file=".$file."\">".$file."</a>&nbsp;<img style=\"margin-bottom:0px;\" src=\"images/delete-1-icon.png\" /></a>";  ?>
	</div>
</li>
<script type="text/javascript">
$(document).ready(function(e) {
var upload = $("#field_75");
var uploadpath, uploaded;
$(upload).change(function(e) {

	uploadpath = $(this).val();
	$('#upload_path').val("uploaded");
		//alert($('#upload_path').val());

	$.ajax({
  	type: "POST",
  	url: "Ground-Mount-Checklist/form.lib.php",
  	data: { uploaded : $('#upload_path').val()}
	})

  	.done(function( msg ) {
		uploaded = msg;
    	console.log( "Data Saved: " + msg );
  	});

});
//alert(uploaded);
//if(uploaded == 'Required'){
	//console.log("Please upload your file again.");
	//$('#field_75_div').addClass('form_error_highlight');
//}

$("#remove").on("click", function (event) {
upload.replaceWith( upload = upload.clone( true ) );
upload.val("");
event.preventDefault();
$.ajax({
  type: "POST",
  url: "Ground-Mount-Checklist/form.lib.php",
  data: { path : uploadpath }
})
  .done(function( msg ) {
    console.log( "Data Saved: " + msg );
  });
});

});



var size = $('#field_4');
  var inputval;
  size.focusout(function() {
  var input = $(this).val();
  //do your ajax call here
  inputval = input;
    if(input < '50' ){
     alert('Custom projects under 50 kW please refer to Powersite or one of our distribution partners')
    }
});

</script>

<br/>
<!--<li class='field_block'  id='phpfmg_captcha_div' >-->
	<!--<div class='col_label'><label class='form_field'>Enter the Security Code:</label> <label class='form_required' >*</label> </div><div class='col_field'>-->
<!--<div  class="g-recaptcha field_block" data-sitekey="6Lf--x0TAAAAAHw1zSQVb1u3Cdr8Neq_8i1rjQk4"></div>-->
	<?php //phpfmg_show_captcha(); ?>
	<!--</div>
</li>-->
<li class='field_block' id='phpfmg_captcha_div'>
	<div class='col_label'></div><div class='col_field'>
	<?php phpfmg_show_captcha(); ?>
	</div>
</li>
   <li><br/>

       <h2 style="font-size:1.8em;line-height:1.3em;">Your project details will be sent to Schletter sales and to the contact email you provided. </h2>
    <div class='form_submit_block col_field'>

                <!--<input type='submit' value='Submit Project' class='form_button'>-->
              <input type="submit" id="submitButton" class="small button" value="Submit Project &raquo;"/>

                <span id='phpfmg_processing' style='display:none;'>
                    <label id='phpfmg_processing_dots'></label>
                </span>
            </div>
            </li>

</ol>



    </fieldset>
</fieldset>
  <!-- </div> content-detail-->
  <!--</div> content-category-->




</form>

<p class="description section">*Schletter is not responsible for specifying load criteria. Missing or incorrect information will result in delays in the design and pricing process.</p></div>  </div>


<?php

    phpfmg_javascript($sErr);

}
# end of form




function phpfmg_form_css(){
?>
<style type='text/css'>


select, option{
    font-size:12px;

}

ol.phpfmg_form{
    list-style-type:none;

    margin:0px;
	/*border:1px solid #BCBCBC;*/
}

ol.phpfmg_form li{
    margin-bottom:0px;
    clear:both;
    display:block;
    overflow:hidden;
	width: 100%
}


.form_field, .form_required{
    font-weight : bold;
}

.form_required{
    color:red;
   /* margin-right:8px;*/
}

.field_block_over{
}

.form_submit_block{
    padding-top: 3px;
}

/*.text_box, .text_area, .text_select {
    width:250px;
}*/
.col_field {
	margin-bottom:15px;
}
.text_area{
    height:100px;
	width:250px;
}

.form_error_title{
    font-weight: bold;
    color: #ba130d;
}

.form_error{
    margin-bottom: 10px;
}

.form_error_highlight{
    background-color: #FBE4E4;
    border: 1px dashed #ba130d;
}


div.instruction_error{
    color: red;
    font-weight:bold;
}

hr.sectionbreak{
    height:1px;
    color: #ccc;
}

#one_entry_msg{
    background-color: #F4F6E5;
    border: 1px dashed #ff0000;
    padding: 10px;
    margin-bottom: 10px;
}
#submitButton{
	background-color: #004628;
    border-radius: 3px;
    color: #FFFFFF;
    font-size: 14px;
    font-weight: bold;
	box-shadow:none;
	border:none;
	padding:7px 8px;
	font-family:Arial, Helvetica, sans-serif;
	border-bottom:1px solid #012918;
	cursor:pointer;
}
#submitButton:hover{
	background-color: #023923;
	color:#D9D9D9;
}

select.text_select {
	width:250px;
	    font-size: 12px;
		height:23px;
}

.terrain img {vertical-align:middle; padding-right:10px}
.question{position:absolute;}

#phpfmg_captcha_div {
width: 160px;


}
.form_submit_block{
	width: 160px;
 margin-left: 170px;

}

.form_button{
width:160px;
background-color:#004628;
color:#fff;
border:none;
height:40px;class="terrain"
border-radius:3px;
}
.terrain{padding: 6px; }
#field_35_div{display:none}
#field_20_div,#field_21_div,#field_22_div,#field_23_div{display:none}
#field_26_div,#field_27_div{display:none;}
#project-checklist .terrain label {
	display:inline-block;
}


#project-checklist input#field_41,  #project-checklist input#field_39,
#project-checklist input#field_42, #project-checklist input#field_43, #project-checklist input#field_44,
#project-checklist input#field_45, #project-checklist input#field_46, #project-checklist input#field_47,
#project-checklist input#field_38 {
	width:100px;
}

#project-checklist select#field_32, #project-checklist input#field_33, #project-checklist input#field_34, #project-checklist input#field_4, #project-checklist input#field_35, #project-checklist select#field_30{
	width:60px;
}


#project-checklist input[type=radio],#project-checklist input[type=checkbox]{
	float:left;
}
#project-checklist input[type="checkbox"] {
    width: 20px;
}

#phpfmg_captcha_div img {
	margin:0;
}

.phpfmg_form .col20 {
	margin-top:0;
}

#field_12_div .form_field, #field_0_div .form_field, #field_30_div .form_field, #field_54_div .form_field, #field_75_div .form_field {
	font-weight:normal;
}
<?php phpfmg_text_align();?>



</style>

<?php
}
# end of css

# By: formmail-maker.com
?>
