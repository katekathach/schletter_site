<?php

// if the from is loaded from WordPress form loader plugin,
// the phpfmg_display_form() will be called by the loader
if( !defined('FormmailMakerFormLoader') ){
    # This block must be placed at the very top of page.
    # --------------------------------------------------
	require_once( dirname(__FILE__).'/form.lib.php' );
    phpfmg_display_form();
    # --------------------------------------------------
};


function phpfmg_form( $sErr = false ){
		$style=" class='form_text' ";

?>




<div id='frmFormMailContainer'>

<form name="frmFormMail" id="frmFormMail" target="submitToFrame" action='<?php echo PHPFMG_ADMIN_URL . '' ; ?>' method='post' enctype='multipart/form-data' onsubmit='return fmgHandler.onSubmit(this);'>

<input type='hidden' name='formmail_submit' value='Y'>
<input type='hidden' name='mod' value='ajax'>
<input type='hidden' name='func' value='submit'>

            
<ol class='phpfmg_form' >

<li class='field_block' id='field_0_div'><div class='col_label'>
	<label class='form_field'>Sales Person:</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<?php phpfmg_dropdown( 'field_0', "New Customer|Aman Tekbali|Blaz Ruzic|Bryce Frits|George Varney|Jim Fay|John Hayes|Jorge Luque|Joshua Parmentir|Justin Smith|Kevin Kessler|Kyle Petty|Other" );?>
	<div id='field_0_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_1_div'><div class='col_label'>
	<label class='form_field'>Date</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	
<?php
    $field_1 = array(
        'month' => "-MM- =,|1|2|3|4|5|6|7|8|9|10|11|12",
        'day' => "-DD- =,|01|02|03|04|05|06|07|08|09|10|11|12|13|14|15|16|17|18|19|20|21|22|23|24|25|26|27|28|29|30|31",
        'startYear' => date("Y")+0,
        'endYear' => date("Y")+20,
        'yearPrompt' => '-YYYY-',
        'format' => "mm/dd/yyyy",
        'separator' => "-",
        'field_name' => "field_1",
    );
    phpfmg_date_dropdown( $field_1 );
?>

	<div id='field_1_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_2_div'><div class='col_label'>
	<label class='form_field'>Requested Delivery Date</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	
<?php
    $field_2 = array(
        'month' => "-MM- =,|1|2|3|4|5|6|7|8|9|10|11|12",
        'day' => "-DD- =,|1|2|3|4|5|6|7|8|9|10|11|12|13|14|15|16|17|18|19|20|21|22|23|24|25|26|27|28|29|30|31",
        'startYear' => date("Y")+0,
        'endYear' => date("Y")+20,
        'yearPrompt' => '-YYYY-',
        'format' => "mm/dd/yyyy",
        'separator' => "-",
        'field_name' => "field_2",
    );
    phpfmg_date_dropdown( $field_2 );
?>

	<div id='field_2_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_3_div'><hr class='sectionbreak'>
Section Break Text Goes Here</li>
<li class='field_block' id='field_4_div'><div class='col_label'>
	<label class='form_field'>Total Project Size(kW):</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_4"  id="field_4" value="<?php  phpfmg_hsc("field_4", ""); ?>" class='text_box'>
	<div id='field_4_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_5_div'><div class='col_label'>
	<label class='form_field'>Project Name:</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_5"  id="field_5" value="<?php  phpfmg_hsc("field_5", ""); ?>" class='text_box'>
	<div id='field_5_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_6_div'><div class='col_label'>
	<label class='form_field'>Street Address or Location:</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_6"  id="field_6" value="<?php  phpfmg_hsc("field_6", ""); ?>" class='text_box'>
	<div id='field_6_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_7_div'><div class='col_label'>
	<label class='form_field'>Owner Name:</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_7"  id="field_7" value="<?php  phpfmg_hsc("field_7", ""); ?>" class='text_box'>
	<div id='field_7_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_8_div'><div class='col_label'>
	<label class='form_field'>Customer will contract with about Owner</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<?php phpfmg_radios( 'field_8', "Yes |No" );?>
	<div id='field_8_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_9_div'><div class='col_label'>
	<label class='form_field'>Project requires compliance with:</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<?php phpfmg_checkboxes( 'field_9', "The American Recovery and Reinvestment Act of 2009|The Buy American Act|Other", true );?>
	<div id='field_9_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_10_div'><div class='col_label'>
	<label class='form_field'>Project Will:</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<?php phpfmg_checkboxes( 'field_10', "Receive federal or other government funding|Be bonded" );?>
	<div id='field_10_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_11_div'><div class='col_label'>
	<label class='form_field'>Legal Name:</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_11"  id="field_11" value="<?php  phpfmg_hsc("field_11", ""); ?>" class='text_box'>
	<div id='field_11_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_12_div'><div class='col_label'>
	<label class='form_field'>DBA (if applicable)</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<input type="text" name="field_12"  id="field_12" value="<?php  phpfmg_hsc("field_12", ""); ?>" class='text_box'>
	<div id='field_12_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_13_div'><div class='col_label'>
	<label class='form_field'>Contact Name:</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<input type="text" name="field_13"  id="field_13" value="<?php  phpfmg_hsc("field_13", ""); ?>" class='text_box'>
	<div id='field_13_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_14_div'><div class='col_label'>
	<label class='form_field'>Street Address:</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<input type="text" name="field_14"  id="field_14" value="<?php  phpfmg_hsc("field_14", ""); ?>" class='text_box'>
	<div id='field_14_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_15_div'><div class='col_label'>
	<label class='form_field'>E-mail:</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_15"  id="field_15" value="<?php  phpfmg_hsc("field_15", ""); ?>" class='text_box'>
	<div id='field_15_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_16_div'><div class='col_label'>
	<label class='form_field'>Phone Number</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_16"  id="field_16" value="<?php  phpfmg_hsc("field_16", ""); ?>" class='text_box'>
	<div id='field_16_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_17_div'><div class='col_label'>
	<label class='form_field'>Fax:</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<input type="text" name="field_17"  id="field_17" value="<?php  phpfmg_hsc("field_17", ""); ?>" class='text_box'>
	<div id='field_17_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_18_div'><hr class='sectionbreak'>
Section Break Text Goes Here</li>
<li class='field_block' id='field_19_div'><div class='col_label'>
	<label class='form_field'>PE Structural Stamps Needed</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<?php phpfmg_radios( 'field_19', "PE Structural Stamps Needed" );?>
	<div id='field_19_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_20_div'><div class='col_label'>
	<label class='form_field'>No. hard copies:</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_20"  id="field_20" value="<?php  phpfmg_hsc("field_20", ""); ?>" class='text_box'>
	<div id='field_20_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_21_div'><div class='col_label'>
	<label class='form_field'>Hard Copy Mailing Address (no PO Box please)</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<?php phpfmg_checkboxes( 'field_21', "Same as Customer Address|Same as Project Address" );?>
	<div id='field_21_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_22_div'><div class='col_label'>
	<label class='form_field'>Contact Name:</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_22"  id="field_22" value="<?php  phpfmg_hsc("field_22", ""); ?>" class='text_box'>
	<div id='field_22_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_23_div'><div class='col_label'>
	<label class='form_field'>Street Address</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_23"  id="field_23" value="<?php  phpfmg_hsc("field_23", ""); ?>" class='text_box'>
	<div id='field_23_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_24_div'><hr class='sectionbreak'>
Section Break Text Goes Here</li>
<li class='field_block' id='field_25_div'><div class='col_label'>
	<label class='form_field'>Material Delivery Information</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<?php phpfmg_checkboxes( 'field_25', "Sames as Delivery Address|Same as Project Address" );?>
	<div id='field_25_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_26_div'><div class='col_label'>
	<label class='form_field'>Contact and Address:</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<input type="text" name="field_26"  id="field_26" value="<?php  phpfmg_hsc("field_26", ""); ?>" class='text_box'>
	<div id='field_26_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_27_div'><div class='col_label'>
	<label class='form_field'>Country</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<input type="text" name="field_27"  id="field_27" value="<?php  phpfmg_hsc("field_27", ""); ?>" class='text_box'>
	<div id='field_27_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_28_div'><div class='col_label'>
	<label class='form_field'>Material Delivery Information</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<?php phpfmg_checkboxes( 'field_28', "Residential|Lift gate needed|24 hr. notification" );?>
	<div id='field_28_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_29_div'><div class='col_label'>
	<label class='form_field'>Special delivery instructions:</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<textarea name="field_29" id="field_29" rows=4 cols=25 class='text_area'><?php  phpfmg_hsc("field_29"); ?></textarea>

	<div id='field_29_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_30_div'><hr class='sectionbreak'>
Section Break Text Goes Here</li>
<li class='field_block' id='field_31_div'><div class='col_label'>
	<label class='form_field'>Terrain Category</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<?php phpfmg_dropdown( 'field_31', "B|C|D" );?>
	<div id='field_31_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_32_div'><div class='col_label'>
	<label class='form_field'>Occupancy Cat:</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<?php phpfmg_dropdown( 'field_32', "II|III|IV" );?>
	<div id='field_32_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_33_div'><div class='col_label'>
	<label class='form_field'>Wind Load(mph)</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_33"  id="field_33" value="<?php  phpfmg_hsc("field_33", ""); ?>" class='text_box'>
	<div id='field_33_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_34_div'><div class='col_label'>
	<label class='form_field'>Snow Load(psf):</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_34"  id="field_34" value="<?php  phpfmg_hsc("field_34", ""); ?>" class='text_box'>
	<div id='field_34_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_35_div'><div class='col_label'>
	<label class='form_field'>if option D: Proximity to Coast(mi):</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_35"  id="field_35" value="<?php  phpfmg_hsc("field_35", ""); ?>" class='text_box'>
	<div id='field_35_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_36_div'><hr class='sectionbreak'>
Section Break Text Goes Here</li>
<li class='field_block' id='field_37_div'><div class='col_label'>
	<label class='form_field'>Module Model:</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_37"  id="field_37" value="<?php  phpfmg_hsc("field_37", ""); ?>" class='text_box'>
	<div id='field_37_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_38_div'><div class='col_label'>
	<label class='form_field'>Module Power (W):</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_38"  id="field_38" value="<?php  phpfmg_hsc("field_38", ""); ?>" class='text_box'>
	<div id='field_38_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_39_div'><div class='col_label'>
	<label class='form_field'>String Size:</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_39"  id="field_39" value="<?php  phpfmg_hsc("field_39", ""); ?>" class='text_box'>
	<div id='field_39_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_40_div'><div class='col_label'>
	<label class='form_field'>No. of Rows:</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_40"  id="field_40" value="<?php  phpfmg_hsc("field_40", ""); ?>" class='text_box'>
	<div id='field_40_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_41_div'><div class='col_label'>
	<label class='form_field'>Modules Per Row:</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_41"  id="field_41" value="<?php  phpfmg_hsc("field_41", ""); ?>" class='text_box'>
	<div id='field_41_tip' class='instruction'></div>
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

<li class='field_block' id='field_44_div'><div class='col_label'>
	<label class='form_field'>Thickness (mm)</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_44"  id="field_44" value="<?php  phpfmg_hsc("field_44", ""); ?>" class='text_box'>
	<div id='field_44_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_45_div'><div class='col_label'>
	<label class='form_field'>Weight (kg)</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_45"  id="field_45" value="<?php  phpfmg_hsc("field_45", ""); ?>" class='text_box'>
	<div id='field_45_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_46_div'><div class='col_label'>
	<label class='form_field'>Module Tilt(< 45)</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_46"  id="field_46" value="<?php  phpfmg_hsc("field_46", ""); ?>" class='text_box'>
	<div id='field_46_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_47_div'><div class='col_label'>
	<label class='form_field'>Module Orientation</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<?php phpfmg_checkboxes( 'field_47', "Portrait|Landscape" );?>
	<div id='field_47_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_48_div'><hr class='sectionbreak'>
FS System and FS Uno/Duo</li>
<li class='field_block' id='field_49_div'><div class='col_label'>
	<label class='form_field'>Material</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<?php phpfmg_checkboxes( 'field_49', "Aluminum|Steel 1-Post (Uno)|Steel 2-Post (Duo)" );?>
	<div id='field_49_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_50_div'><div class='col_label'>
	<label class='form_field'>Foundation</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<?php phpfmg_checkboxes( 'field_50', "Concrete|Pile Driven (geotechnical testing required)" );?>
	<div id='field_50_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_51_div'><div class='col_label'>
	<label class='form_field'>Sloping to:</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<?php phpfmg_dropdown( 'field_51', "Flat (0)|East|West|North|South" );?>
	<div id='field_51_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_52_div'><div class='col_label'>
	<label class='form_field'>Slope %:</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_52"  id="field_52" value="<?php  phpfmg_hsc("field_52", ""); ?>" class='text_box'>
	<div id='field_52_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_53_div'><div class='col_label'>
	<label class='form_field'>Ground Clearance to Lower Edge of Module (ft)</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_53"  id="field_53" value="<?php  phpfmg_hsc("field_53", ""); ?>" class='text_box'>
	<div id='field_53_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_54_div'><div class='col_label'>
	<label class='form_field'>Describe other site or rack characteristics:</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<textarea name="field_54" id="field_54" rows=4 cols=25 class='text_area'><?php  phpfmg_hsc("field_54"); ?></textarea>

	<div id='field_54_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_55_div'><hr class='sectionbreak'>
Section Break Text Goes Here</li>
<li class='field_block' id='field_56_div'><div class='col_label'>
	<label class='form_field'>Foundation</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<?php phpfmg_checkboxes( 'field_56', "Ballast Block|Ground Screws" );?>
	<div id='field_56_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_57_div'><div class='col_label'>
	<label class='form_field'>Ground Clearance to Lower Edge of Module (ft)</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<input type="text" name="field_57"  id="field_57" value="<?php  phpfmg_hsc("field_57", ""); ?>" class='text_box'>
	<div id='field_57_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_58_div'><div class='col_label'>
	<label class='form_field'>Sloping to:</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<?php phpfmg_dropdown( 'field_58', "Flat|East|West|North|South" );?>
	<div id='field_58_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_59_div'><div class='col_label'>
	<label class='form_field'>Slope %</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<input type="text" name="field_59"  id="field_59" value="<?php  phpfmg_hsc("field_59", ""); ?>" class='text_box'>
	<div id='field_59_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_60_div'><div class='col_label'>
	<label class='form_field'>Frost Depth(ft):</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_60"  id="field_60" value="<?php  phpfmg_hsc("field_60", ""); ?>" class='text_box'>
	<div id='field_60_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_61_div'><div class='col_label'>
	<label class='form_field'>Describe other site or rack characteristics</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<textarea name="field_61" id="field_61" rows=4 cols=25 class='text_area'><?php  phpfmg_hsc("field_61"); ?></textarea>

	<div id='field_61_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_62_div'><div class='col_label'>
	<label class='form_field'>1-row Vehicle arrangement(max. depth 6 meters)</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<?php phpfmg_checkboxes( 'field_62', "B1" );?>
	<div id='field_62_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_63_div'><div class='col_label'>
	<label class='form_field'>2-row Vehicle arrangement (max. depth 12.5 meters)</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<?php phpfmg_checkboxes( 'field_63', "B2" );?>
	<div id='field_63_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_64_div'><div class='col_label'>
	<label class='form_field'>2-row vehicle arrangement (max. depth 12.5 meters)</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<?php phpfmg_checkboxes( 'field_64', "B3" );?>
	<div id='field_64_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_65_div'><div class='col_label'>
	<label class='form_field'>Sloping to:</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<?php phpfmg_checkboxes( 'field_65', "Flat(0)|East|West|North|South" );?>
	<div id='field_65_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_66_div'><div class='col_label'>
	<label class='form_field'>Slope %:</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_66"  id="field_66" value="<?php  phpfmg_hsc("field_66", ""); ?>" class='text_box'>
	<div id='field_66_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_67_div'><div class='col_label'>
	<label class='form_field'>Frost Depth:</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_67"  id="field_67" value="<?php  phpfmg_hsc("field_67", ""); ?>" class='text_box'>
	<div id='field_67_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_68_div'><div class='col_label'>
	<label class='form_field'>Foundation Type</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<?php phpfmg_checkboxes( 'field_68', "Slab Foundation|Micro Pile|Drill Shaft (may require soil report)" );?>
	<div id='field_68_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_69_div'><div class='col_label'>
	<label class='form_field'>Minimum Spacing between Support (ft)</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_69"  id="field_69" value="<?php  phpfmg_hsc("field_69", ""); ?>" class='text_box'>
	<div id='field_69_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_70_div'><div class='col_label'>
	<label class='form_field'>Desired Spacing Between Support (ft)</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_70"  id="field_70" value="<?php  phpfmg_hsc("field_70", ""); ?>" class='text_box'>
	<div id='field_70_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_71_div'><div class='col_label'>
	<label class='form_field'>Ground Clearance to Lower Edge of Module (ft):</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_71"  id="field_71" value="<?php  phpfmg_hsc("field_71", ""); ?>" class='text_box'>
	<div id='field_71_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_72_div'><div class='col_label'>
	<label class='form_field'>Describe other site or rack characteristics</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<textarea name="field_72" id="field_72" rows=4 cols=25 class='text_area'><?php  phpfmg_hsc("field_72"); ?></textarea>

	<div id='field_72_tip' class='instruction'></div>
	</div>
</li>


<li class='field_block' id='phpfmg_captcha_div'>
	<div class='col_label'></div><div class='col_field'>
	<?php phpfmg_show_captcha(); ?>
	</div>
</li>


            <li>
            <div class='col_label'>&nbsp;</div>
            <div class='form_submit_block col_field'>
	

                <input type='submit' value='Submit' class='form_button'>

				<div id='err_required' class="form_error" style='display:none;'>
				    <label class='form_error_title'>Please check the required fields</label>
				</div>
				


                <span id='phpfmg_processing' style='display:none;'>
                    <img id='phpfmg_processing_gif' src='<?php echo PHPFMG_ADMIN_URL . '?mod=image&amp;func=processing' ;?>' border=0 alt='Processing...'> <label id='phpfmg_processing_dots'></label>
                </span>
            </div>
            </li>

</ol>
</form>

<iframe name="submitToFrame" id="submitToFrame" src="javascript:false" style="position:absolute;top:-10000px;left:-10000px;" /></iframe>

</div>
<!-- end of form container -->


<!-- [Your confirmation message goes here] -->
<div id='thank_you_msg' style='display:none;'>
Your form has been sent. Thank you!
</div>


            






<?php

    phpfmg_javascript($sErr);

}
# end of form




function phpfmg_form_css(){
    $formOnly = isset($GLOBALS['formOnly']) && true === $GLOBALS['formOnly'];
?>
<style type='text/css'>
<?php 
if( !$formOnly ){
    echo"
body{
    margin-left: 18px;
    margin-top: 18px;
}

body{
    font-family : Verdana, Arial, Helvetica, sans-serif;
    font-size : 13px;
    color : #474747;
    background-color: transparent;
}

select, option{
    font-size:13px;
}
";
}; // if
?>

ol.phpfmg_form{
    list-style-type:none;
    padding:0px;
    margin:0px;
}

ol.phpfmg_form input, ol.phpfmg_form textarea, ol.phpfmg_form select{
    border: 1px solid #ccc;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
}

ol.phpfmg_form li{
    margin-bottom:5px;
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
    margin-right:8px;
}

.field_block_over{
}

.form_submit_block{
    padding-top: 3px;
}

.text_box,.text_select {
    height: 32px;
}

.text_box, .text_area, .text_select {
    min-width:160px;
    max-width:300px;
    width: 100%;
    margin-bottom: 10px;
}

.text_area{
    height:80px;
}

.form_error_title{
    font-weight: bold;
    color: red;
}

.form_error{
    background-color: #F4F6E5;
    border: 1px dashed #ff0000;
    padding: 10px;
    margin-bottom: 10px;
}

.form_error_highlight{
    background-color: #F4F6E5;
    border-bottom: 1px dashed #ff0000;
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


#frmFormMailContainer input[type="submit"]{
    padding: 10px 25px; 
    font-weight: bold;
    margin-bottom: 10px;
    background-color: #FAFBFC;
}

#frmFormMailContainer input[type="submit"]:hover{
    background-color: #E4F0F8;
}

<?php phpfmg_text_align();?>    



</style>

<?php
}
# end of css
 
# By: formmail-maker.com
?>