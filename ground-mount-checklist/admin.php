<?php
require_once( dirname(__FILE__).'/form.lib.php' );

define( 'PHPFMG_USER', "katekalthach@gmail.com" ); // must be a email address. for sending password to you.
define( 'PHPFMG_PW', "444274" );

?>
<?php
/**
 * GNU Library or Lesser General Public License version 2.0 (LGPLv2)
*/

# main
# ------------------------------------------------------
error_reporting( E_ERROR ) ;
phpfmg_admin_main();
# ------------------------------------------------------




function phpfmg_admin_main(){
    $mod  = isset($_REQUEST['mod'])  ? $_REQUEST['mod']  : '';
    $func = isset($_REQUEST['func']) ? $_REQUEST['func'] : '';
    $function = "phpfmg_{$mod}_{$func}";
    if( !function_exists($function) ){
        phpfmg_admin_default();
        exit;
    };

    // no login required modules
    $public_modules   = false !== strpos('|captcha|', "|{$mod}|");
    $public_functions = false !== strpos('|phpfmg_mail_request_password||phpfmg_filman_download||phpfmg_image_processing||phpfmg_dd_lookup|', "|{$function}|") ;   
    if( $public_modules || $public_functions ) { 
        $function();
        exit;
    };
    
    return phpfmg_user_isLogin() ? $function() : phpfmg_admin_default();
}

function phpfmg_admin_default(){
    if( phpfmg_user_login() ){
        phpfmg_admin_panel();
    };
}



function phpfmg_admin_panel()
{    
    phpfmg_admin_header();
    phpfmg_writable_check();
?>    
<table cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td valign=top style="padding-left:280px;">

<style type="text/css">
    .fmg_title{
        font-size: 16px;
        font-weight: bold;
        padding: 10px;
    }
    
    .fmg_sep{
        width:32px;
    }
    
    .fmg_text{
        line-height: 150%;
        vertical-align: top;
        padding-left:28px;
    }

</style>

<script type="text/javascript">
    function deleteAll(n){
        if( confirm("Are you sure you want to delete?" ) ){
            location.href = "admin.php?mod=log&func=delete&file=" + n ;
        };
        return false ;
    }
</script>


<div class="fmg_title">
    1. Email Traffics
</div>
<div class="fmg_text">
    <a href="admin.php?mod=log&func=view&file=1">view</a> &nbsp;&nbsp;
    <a href="admin.php?mod=log&func=download&file=1">download</a> &nbsp;&nbsp;
    <?php 
        if( file_exists(PHPFMG_EMAILS_LOGFILE) ){
            echo '<a href="#" onclick="return deleteAll(1);">delete all</a>';
        };
    ?>
</div>


<div class="fmg_title">
    2. Form Data
</div>
<div class="fmg_text">
    <a href="admin.php?mod=log&func=view&file=2">view</a> &nbsp;&nbsp;
    <a href="admin.php?mod=log&func=download&file=2">download</a> &nbsp;&nbsp;
    <?php 
        if( file_exists(PHPFMG_SAVE_FILE) ){
            echo '<a href="#" onclick="return deleteAll(2);">delete all</a>';
        };
    ?>
</div>

<div class="fmg_title">
    3. Form Generator
</div>
<div class="fmg_text">
    <a href="http://www.formmail-maker.com/generator.php" onclick="document.frmFormMail.submit(); return false;" title="<?php echo htmlspecialchars(PHPFMG_SUBJECT);?>">Edit Form</a> &nbsp;&nbsp;
    <a href="http://www.formmail-maker.com/generator.php" >New Form</a>
</div>
    <form name="frmFormMail" action='http://www.formmail-maker.com/generator.php' method='post' enctype='multipart/form-data'>
    <input type="hidden" name="uuid" value="<?php echo PHPFMG_ID; ?>">
    <input type="hidden" name="external_ini" value="<?php echo function_exists('phpfmg_formini') ?  phpfmg_formini() : ""; ?>">
    </form>

		</td>
	</tr>
</table>

<?php
    phpfmg_admin_footer();
}



function phpfmg_admin_header( $title = '' ){
    header( "Content-Type: text/html; charset=" . PHPFMG_CHARSET );
?>
<html>
<head>
    <title><?php echo '' == $title ? '' : $title . ' | ' ; ?>PHP FormMail Admin Panel </title>
    <meta name="keywords" content="PHP FormMail Generator, PHP HTML form, send html email with attachment, PHP web form,  Free Form, Form Builder, Form Creator, phpFormMailGen, Customized Web Forms, phpFormMailGenerator,formmail.php, formmail.pl, formMail Generator, ASP Formmail, ASP form, PHP Form, Generator, phpFormGen, phpFormGenerator, anti-spam, web hosting">
    <meta name="description" content="PHP formMail Generator - A tool to ceate ready-to-use web forms in a flash. Validating form with CAPTCHA security image, send html email with attachments, send auto response email copy, log email traffics, save and download form data in Excel. ">
    <meta name="generator" content="PHP Mail Form Generator, phpfmg.sourceforge.net">

    <style type='text/css'>
    body, td, label, div, span{
        font-family : Verdana, Arial, Helvetica, sans-serif;
        font-size : 12px;
    }
    </style>
</head>
<body  marginheight="0" marginwidth="0" leftmargin="0" topmargin="0">

<table cellspacing=0 cellpadding=0 border=0 width="100%">
    <td nowrap align=center style="background-color:#024e7b;padding:10px;font-size:18px;color:#ffffff;font-weight:bold;width:250px;" >
        Form Admin Panel
    </td>
    <td style="padding-left:30px;background-color:#86BC1B;width:100%;font-weight:bold;" >
        &nbsp;
<?php
    if( phpfmg_user_isLogin() ){
        echo '<a href="admin.php" style="color:#ffffff;">Main Menu</a> &nbsp;&nbsp;' ;
        echo '<a href="admin.php?mod=user&func=logout" style="color:#ffffff;">Logout</a>' ;
    }; 
?>
    </td>
</table>

<div style="padding-top:28px;">

<?php
    
}


function phpfmg_admin_footer(){
?>

</div>

<div style="color:#cccccc;text-decoration:none;padding:18px;font-weight:bold;">
	:: <a href="http://phpfmg.sourceforge.net" target="_blank" title="Free Mailform Maker: Create read-to-use Web Forms in a flash. Including validating form with CAPTCHA security image, send html email with attachments, send auto response email copy, log email traffics, save and download form data in Excel. " style="color:#cccccc;font-weight:bold;text-decoration:none;">PHP FormMail Generator</a> ::
</div>

</body>
</html>
<?php
}


function phpfmg_image_processing(){
    $img = new phpfmgImage();
    $img->out_processing_gif();
}


# phpfmg module : captcha
# ------------------------------------------------------
function phpfmg_captcha_get(){
    $img = new phpfmgImage();
    $img->out();
    //$_SESSION[PHPFMG_ID.'fmgCaptchCode'] = $img->text ;
    $_SESSION[ phpfmg_captcha_name() ] = $img->text ;
}



function phpfmg_captcha_generate_images(){
    for( $i = 0; $i < 50; $i ++ ){
        $file = "$i.png";
        $img = new phpfmgImage();
        $img->out($file);
        $data = base64_encode( file_get_contents($file) );
        echo "'{$img->text}' => '{$data}',\n" ;
        unlink( $file );
    };
}


function phpfmg_dd_lookup(){
    $paraOk = ( isset($_REQUEST['n']) && isset($_REQUEST['lookup']) && isset($_REQUEST['field_name']) );
    if( !$paraOk )
        return;
        
    $base64 = phpfmg_dependent_dropdown_data();
    $data = @unserialize( base64_decode($base64) );
    if( !is_array($data) ){
        return ;
    };
    
    
    foreach( $data as $field ){
        if( $field['name'] == $_REQUEST['field_name'] ){
            $nColumn = intval($_REQUEST['n']);
            $lookup  = $_REQUEST['lookup']; // $lookup is an array
            $dd      = new DependantDropdown(); 
            echo $dd->lookupFieldColumn( $field, $nColumn, $lookup );
            return;
        };
    };
    
    return;
}


function phpfmg_filman_download(){
    if( !isset($_REQUEST['filelink']) )
        return ;
        
    $info =  @unserialize(base64_decode($_REQUEST['filelink']));
    if( !isset($info['recordID']) ){
        return ;
    };
    
    $file = PHPFMG_SAVE_ATTACHMENTS_DIR . $info['recordID'] . '-' . $info['filename'];
    phpfmg_util_download( $file, $info['filename'] );
}


class phpfmgDataManager
{
    var $dataFile = '';
    var $columns = '';
    var $records = '';
    
    function phpfmgDataManager(){
        $this->dataFile = PHPFMG_SAVE_FILE; 
    }
    
    function parseFile(){
        $fp = @fopen($this->dataFile, 'rb');
        if( !$fp ) return false;
        
        $i = 0 ;
        $phpExitLine = 1; // first line is php code
        $colsLine = 2 ; // second line is column headers
        $this->columns = array();
        $this->records = array();
        $sep = chr(0x09);
        while( !feof($fp) ) { 
            $line = fgets($fp);
            $line = trim($line);
            if( empty($line) ) continue;
            $line = $this->line2display($line);
            $i ++ ;
            switch( $i ){
                case $phpExitLine:
                    continue;
                    break;
                case $colsLine :
                    $this->columns = explode($sep,$line);
                    break;
                default:
                    $this->records[] = explode( $sep, phpfmg_data2record( $line, false ) );
            };
        }; 
        fclose ($fp);
    }
    
    function displayRecords(){
        $this->parseFile();
        echo "<table border=1 style='width=95%;border-collapse: collapse;border-color:#cccccc;' >";
        echo "<tr><td>&nbsp;</td><td><b>" . join( "</b></td><td>&nbsp;<b>", $this->columns ) . "</b></td></tr>\n";
        $i = 1;
        foreach( $this->records as $r ){
            echo "<tr><td align=right>{$i}&nbsp;</td><td>" . join( "</td><td>&nbsp;", $r ) . "</td></tr>\n";
            $i++;
        };
        echo "</table>\n";
    }
    
    function line2display( $line ){
        $line = str_replace( array('"' . chr(0x09) . '"', '""'),  array(chr(0x09),'"'),  $line );
        $line = substr( $line, 1, -1 ); // chop first " and last "
        return $line;
    }
    
}
# end of class



# ------------------------------------------------------
class phpfmgImage
{
    var $im = null;
    var $width = 73 ;
    var $height = 33 ;
    var $text = '' ; 
    var $line_distance = 8;
    var $text_len = 4 ;

    function phpfmgImage( $text = '', $len = 4 ){
        $this->text_len = $len ;
        $this->text = '' == $text ? $this->uniqid( $this->text_len ) : $text ;
        $this->text = strtoupper( substr( $this->text, 0, $this->text_len ) );
    }
    
    function create(){
        $this->im = imagecreate( $this->width, $this->height );
        $bgcolor   = imagecolorallocate($this->im, 255, 255, 255);
        $textcolor = imagecolorallocate($this->im, 0, 0, 0);
        $this->drawLines();
        imagestring($this->im, 5, 20, 9, $this->text, $textcolor);
    }
    
    function drawLines(){
        $linecolor = imagecolorallocate($this->im, 210, 210, 210);
    
        //vertical lines
        for($x = 0; $x < $this->width; $x += $this->line_distance) {
          imageline($this->im, $x, 0, $x, $this->height, $linecolor);
        };
    
        //horizontal lines
        for($y = 0; $y < $this->height; $y += $this->line_distance) {
          imageline($this->im, 0, $y, $this->width, $y, $linecolor);
        };
    }
    
    function out( $filename = '' ){
        if( function_exists('imageline') ){
            $this->create();
            if( '' == $filename ) header("Content-type: image/png");
            ( '' == $filename ) ? imagepng( $this->im ) : imagepng( $this->im, $filename );
            imagedestroy( $this->im ); 
        }else{
            $this->out_predefined_image(); 
        };
    }

    function uniqid( $len = 0 ){
        $md5 = md5( uniqid(rand()) );
        return $len > 0 ? substr($md5,0,$len) : $md5 ;
    }
    
    function out_predefined_image(){
        header("Content-type: image/png");
        $data = $this->getImage(); 
        echo base64_decode($data);
    }
    
    // Use predefined captcha random images if web server doens't have GD graphics library installed  
    function getImage(){
        $images = array(
			'8768' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nGNYhQEaGAYTpIn7WANEQx1CGaY6IImJTGFodHR0CAhAEgtoZWh0bXB0EEFV18rawABTB3bS0qhV05ZOXTU1C8l9QHUBrBjmMTqwNgSimBcANA1dTGSKSAMjml7WAKAKNDcPVPhREWJxHwCmm8x2YRor8wAAAABJRU5ErkJggg==',
			'398E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXklEQVR4nGNYhQEaGAYTpIn7RAMYQxhCGUMDkMQCprC2Mjo6OqCobBVpdG0IRBWbItLoiFAHdtLKqKVLs0JXhmYhu28KY6AjhnkMmOa1smCIYXMLNjcPVPhREWJxHwAyV8nMLw72LgAAAABJRU5ErkJggg==',
			'C3BE' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAVklEQVR4nGNYhQEaGAYTpIn7WEOAMJQxNABJTKRVpJW10dEBWV1AI0Oja0MgqlgDA7I6sJOiVq0KWxq6MjQLyX1o6mBimOZhsQObW7C5eaDCj4oQi/sA7SrLNnRwHVcAAAAASUVORK5CYII=',
			'4D6D' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZUlEQVR4nGNYhQEaGAYTpI37poiGMIQyhjogi4WItDI6OjoEIIkxhog0ujY4OoggibFOAYkxwsTATpo2bdrK1Kkrs6YhuS8ApM4RVW9oKEhvIIoYwxSsYhhuwermgQo/6kEs7gMAe7/LxQh2P+cAAAAASUVORK5CYII=',
			'3AD3' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7RAMYAlhDGUIdkMQCpjCGsDY6OgQgq2xlbWVtCGgQQRabItLoChQLQHLfyqhpK1NXRS3NQnYfqjqoeaKhrujmtULUiaC4BSiG5hbRAKAYmpsHKvyoCLG4DwCJf85hFILFGwAAAABJRU5ErkJggg==',
			'7FC4' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7QkNFQx1CHRoCkEVbRRoYHQIa0cVYGwRaUcSmgMQYpgQguy9qathSIBmF5D5GB5A6oIlIelkbwGKhIUhiImAxARS3BDSA3YIhxoDu5gEKPypCLO4DALRFzX2jOmJTAAAAAElFTkSuQmCC',
			'59DF' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7QkMYQ1hDGUNDkMQCGlhbWRsdHRhQxEQaXRsCUcQCA1DEwE4Km7Z0aeqqyNAsZPe1Mgai62VoZcAwL6CVBUNMZAqmW1gDwG5GNW+Awo+KEIv7ABUPywntqvVZAAAAAElFTkSuQmCC',
			'ED0B' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWUlEQVR4nGNYhQEaGAYTpIn7QkNEQximMIY6IIkFNIi0MoQyOgSgijU6Ojo6iKCJuTYEwtSBnRQaNW1l6qrI0Cwk96GpQxFDNw+LHRhuwebmgQo/KkIs7gMAmAHNU8xJ8l4AAAAASUVORK5CYII=',
			'C880' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAX0lEQVR4nGNYhQEaGAYTpIn7WEMYQxhCGVqRxURaWVsZHR2mOiCJBTSKNLo2BAQEIIs1gNQ5OogguS9q1cqwVaErs6YhuQ9NHVQMZF4gqhgWO7C5BZubByr8qAixuA8AV5vMYVR9y2oAAAAASUVORK5CYII=',
			'4F7C' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpI37poiGuoYGTA1AFgsRAZIBASJIYoxgsUAHFiQx1ilAsUZHB2T3TZs2NWzV0pVZyO4LAKmbwuiAbG9oKFAsAFWMAaiO0YERxQ6QGCtQpQimGKqbByr8qAexuA8A1ebK8Q9bgb4AAAAASUVORK5CYII=',
			'9C69' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7WAMYQxlCGaY6IImJTGFtdHR0CAhAEgtoFWlwbXB0EEETY21ghImBnTRt6rRVS6euigpDch+rK1Cdo8NUZL0MYL0BDchiAmA7AlDswOYWbG4eqPCjIsTiPgA/csw7pbcJZgAAAABJRU5ErkJggg==',
			'B49F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaElEQVR4nGNYhQEaGAYTpIn7QgMYWhlCGUNDkMQCpjBMZXR0dEBWFwBUxdoQiCo2hdEVSQzspNCopUtXZkaGZiG5L2CKSCtDCJreVtFQB3TzWhlaGTHsAIqhuQXqZhSxgQo/KkIs7gMAUeXKnbpeB6cAAAAASUVORK5CYII=',
			'4EF9' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpI37poiGsoYGTHVAFgsRaWBtYAgIQBJjBIsxOoggibFOQREDO2natKlhS0NXRYUhuS8ArI5hKrLe0FCwWIMIilvAYg5YxFDcAnYz0DwUNw9U+FEPYnEfACgjyq1hKls1AAAAAElFTkSuQmCC',
			'629E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbElEQVR4nGNYhQEaGAYTpIn7WAMYQxhCGUMDkMREprC2Mjo6OiCrC2gRaXRtCEQVa2BAFgM7KTJq1dKVmZGhWUjuC5nCMIUhBE1vK0MAA7p5rYwOjGhiQLc0oLuFNUA01AHNzQMVflSEWNwHAKbJyiBNGjL/AAAAAElFTkSuQmCC',
			'6644' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbElEQVR4nGNYhQEaGAYTpIn7WAMYQxgaHRoCkMREprC2MrQ6NCKLBbSINDJMdWhFEWsQaWAIdJgSgOS+yKhpYSszs6KikNwXMkW0lbXR0QFFb6tIo2toYGgImpgDNregiWFz80CFHxUhFvcBAK4xzxlFewsEAAAAAElFTkSuQmCC',
			'3B24' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaElEQVR4nGNYhQEaGAYTpIn7RANEQxhCGRoCkMQCpoi0Mjo6NCKLMbSKNLo2BLSiiAHVgVQHILlvZdTUsFUrs6KikN0HUtfK6IBunsMUxtAQdLEALG5xQBUDuZk1NABFbKDCj4oQi/sA2dDNfenTJOcAAAAASUVORK5CYII=',
			'5BE7' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZ0lEQVR4nGNYhQEaGAYTpIn7QkNEQ1hDHUNDkMQCGkRaWYG0CKpYoyuaWGAARF0AkvvCpk0NWxq6amUWsvtawepaUWxuBZs3BVksACIWgCwmMgWkl9EBWYw1AOxmFLGBCj8qQizuAwANCcu4fQneMgAAAABJRU5ErkJggg==',
			'1C25' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbklEQVR4nGNYhQEaGAYTpIn7GB0YQxlCGUMDkMRYHVgbHR0dHZDViTqINLg2BDqg6hUBkoGuDkjuW5k1DUhkRkUhuQ+srpWhQQRd7xRMMYcAiKkIMaBbHBgCkN0nGsIYyhoaMNVhEIQfFSEW9wEAlAzIo5DVAK4AAAAASUVORK5CYII=',
			'6FC4' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7WANEQx1CHRoCkMREpog0MDoENCKLBbSINLA2CLSiiDWAxBimBCC5LzJqatjSVauiopDcFzIFpA5oIrLeVrBYaAiGmAA2t6CIsQaINDCguXmgwo+KEIv7AJNjzhpv01zAAAAAAElFTkSuQmCC',
			'38E4' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXUlEQVR4nGNYhQEaGAYTpIn7RAMYQ1hDHRoCkMQCprC2sjYwNCKLMbSKNLoCSRQxiLopAUjuWxm1Mmxp6KqoKGT3gdUxOmCaxxgagmkHNregiGFz80CFHxUhFvcBAEkKzRtw2sv/AAAAAElFTkSuQmCC',
			'5790' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpIn7QkNEQx1CGVqRxQIaGBodHR2mOqCJuTYEBAQgiQUGMLSyNgQ6iCC5L2zaqmkrMyOzpiG7r5UhgCEErg4qxujA0IAqFgA0jRHNDpEpIg2MaG5hDQDqQnPzQIUfFSEW9wEAd2/MJ8Iori4AAAAASUVORK5CYII=',
			'3C54' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbElEQVR4nGNYhQEaGAYTpIn7RAMYQ1lDHRoCkMQCprA2ujYwNCKLMbSKNADFWlHEpog0sE5lmBKA5L6VUdNWLc3MiopCdh9QHUNDoAO6eUCx0BAMOwIw3OLoiOo+kJsZQhlQxAYq/KgIsbgPAKlQzi7Dh0RvAAAAAElFTkSuQmCC',
			'B9B1' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7QgMYQ1hDGVqRxQKmsLayNjpMRRFrFWl0bQgIRVUHFGt0gOkFOyk0aunS1NBVS5HdFzCFMRBJHdQ8BpB5aGIsmGIQt6CIQd0cGjAIwo+KEIv7AF6gzsh48kkyAAAAAElFTkSuQmCC',
			'5538' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaElEQVR4nGNYhQEaGAYTpIn7QkNEQxlDGaY6IIkFNIg0sDY6BASgiTE0BDqIIIkFBoiEMCDUgZ0UNm3q0lVTV03NQnZfK1AVmnlgMTTzAlpFMMREprC2oruFNYAxBN3NAxV+VIRY3AcAHGbNovogEPgAAAAASUVORK5CYII=',
			'D3A9' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7QgNYQximMEx1QBILmCLSyhDKEBCALNbK0Ojo6OgggirWytoQCBMDOylq6aqwpauiosKQ3AdRFzAVTW+ja2hAA4ZYQwCqHUC3APWiuAXkZpB5yG4eqPCjIsTiPgCmns5y1ql3EwAAAABJRU5ErkJggg==',
			'3F85' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7RANEQx1CGUMDkMQCpog0MDo6OqCobBVpYG0IRBWDqHN1QHLfyqipYatCV0ZFIbsPrM6hQQTDvAAsYoEOIhhucQhAdp9oAFBFKMNUh0EQflSEWNwHAHOJyvlOxYK4AAAAAElFTkSuQmCC',
			'69CA' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7WAMYQxhCHVqRxUSmsLYyOgRMdUASC2gRaXRtEAgIQBZrAIkxOogguS8yaunS1FUrs6YhuS9kCmMgkjqI3lYGkN7QEBQxFqCYIIo6iFsCUcQgbnZEERuo8KMixOI+ADHYzAJSJhhlAAAAAElFTkSuQmCC',
			'4EBF' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWklEQVR4nGNYhQEaGAYTpI37poiGsoYyhoYgi4WINLA2Ojogq2MEiTUEooixTkFRB3bStGlTw5aGrgzNQnJfwBRM80JDMc1jmIJDDE0v1M2oYgMVftSDWNwHACW0ycF2YxCXAAAAAElFTkSuQmCC',
			'2371' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbklEQVR4nGNYhQEaGAYTpIn7WANYQ1hDA1qRxUSmiAD5AVORxYAqGh0aAkJRdLcygERheiFumrYqbNVSIER2XwBQ3RQGFDsYHYA6A1DFWBsYGh0dUMVEGkRaWRtQxUJDgW5uYAgNGAThR0WIxX0Ap13LllHe60MAAAAASUVORK5CYII=',
			'4C31' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZ0lEQVR4nGNYhQEaGAYTpI37pjCGMoYytKKIhbA2ujY6TEUWYwwRaXBoCAhFFmOdItLA0OgA0wt20rRp01atmrpqKbL7AlDVgWFoqAhIBtXeKWA70MTAbkETA7s5NGAwhB/1IBb3AQCi4s2Cd21pSgAAAABJRU5ErkJggg==',
			'2ECC' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYUlEQVR4nGNYhQEaGAYTpIn7WANEQxlCHaYGIImJTBFpYHQICBBBEgtoFWlgbRB0YEHWDRZjdEBx37SpYUtXrcxCcV8AijowZHTAFGNtwLRDpAHTLaGhmG4eqPCjIsTiPgBoq8nx02rGEAAAAABJRU5ErkJggg==',
			'1161' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAX0lEQVR4nGNYhQEaGAYTpIn7GB0YAhhCGVqRxVgdGAMYHR2mIouJOrAGsDY4hKLrZW2A6wU7aWXWqqilU1ctRXYfWJ2jQyum3gCixBjR9IqGsIYC3RwaMAjCj4oQi/sAT9nG01CTO8kAAAAASUVORK5CYII=',
			'AC8B' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZElEQVR4nGNYhQEaGAYTpIn7GB0YQxlCGUMdkMRYA1gbHR0dHQKQxESmiDS4NgQ6iCCJBbSKNDAi1IGdFLV02qpVoStDs5Dch6YODENDRRpYsZiHaQemWwJaMd08UOFHRYjFfQDgbcw++RnOWgAAAABJRU5ErkJggg==',
			'D2DE' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYklEQVR4nGNYhQEaGAYTpIn7QgMYQ1hDGUMDkMQCprC2sjY6OiCrC2gVaXRtCEQTY0AWAzspaumqpUtXRYZmIbkPqG4KK6beAEwxRgcMMaBOdLeEBoiGuqK5eaDCj4oQi/sAprvMgJ1US90AAAAASUVORK5CYII=',
			'5982' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAeElEQVR4nGNYhQEaGAYTpIn7QkMYQxhCGaY6IIkFNLC2Mjo6BASgiIk0ujYEOoggiQUGiDQ6Ojo0iCC5L2za0qVZoatWRSG7r5UxEKiuEdkOhlYGoHkBrchuCWhlAYlNQRYTmQJxC7IYawDIzYyhIYMg/KgIsbgPAOsZzJeaXvu7AAAAAElFTkSuQmCC',
			'18E0' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXklEQVR4nGNYhQEaGAYTpIn7GB0YQ1hDHVqRxVgdWFtZGximOiCJiTqINLo2MAQEoOgFqWN0EEFy38qslWFLQ1dmTUNyH5o6qBjIPGxi2OxAc0sIppsHKvyoCLG4DwCoIsikpS5uNgAAAABJRU5ErkJggg==',
			'828E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7WAMYQxhCGUMDkMREprC2Mjo6OiCrC2gVaXRtCEQRE5nC0OiIUAd20tKoVUtXha4MzUJyH1DdFEzzGAJY0cwLaGV0QBcDuqUBXS9rgGioA5qbByr8qAixuA8AQ2bJ1qVCeTIAAAAASUVORK5CYII=',
			'A218' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAc0lEQVR4nGNYhQEaGAYTpIn7GB0YQximMEx1QBJjDWBtZQhhCAhAEhOZItLoGMLoIIIkFtDK0OgwBa4O7KSopauWrpq2amoWkvuA6qYwTEE1LzSUIYBhCrp5jA6YYqwN6HoDWkVDHUMdUNw8UOFHRYjFfQDbIMw8KwvQrAAAAABJRU5ErkJggg==',
			'8F48' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZUlEQVR4nGNYhQEaGAYTpIn7WANEQx0aHaY6IImJTBFpYGh1CAhAEgtoBYpNdXQQQVcXCFcHdtLSqKlhKzOzpmYhuQ+kjrUR0zzW0EAU88B2NGKxA00vawBYDMXNAxV+VIRY3AcA4kvNi6QOXjAAAAAASUVORK5CYII=',
			'8BBD' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAVklEQVR4nGNYhQEaGAYTpIn7WANEQ1hDGUMdkMREpoi0sjY6OgQgiQW0ijS6NgQ6iGBRJ4LkvqVRU8OWhq7MmobkPjR1OM3DZweyW7C5eaDCj4oQi/sAn6TMmKACkyAAAAAASUVORK5CYII=',
			'6F92' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7WANEQx1CGaY6IImJTBFpYHR0CAhAEgtoEWlgbQh0EEEWawCJgUiE+yKjpoatzIxaFYXkvhCgeQwhAY3IdgS0ioBJBjQxxoaAKQxY3ILqZqDeUMbQkEEQflSEWNwHANENzKIrknJQAAAAAElFTkSuQmCC',
			'C75F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbElEQVR4nGNYhQEaGAYTpIn7WENEQ11DHUNDkMREWhkaXRsYHZDVBTRiEWtgaGWdChcDOylq1appSzMzQ7OQ3AdUF8DQEIimF6QPTayRtYEVTUykVaSB0dERRYw1RKSBIRTVLQMVflSEWNwHAKc3yebA2DUIAAAAAElFTkSuQmCC',
			'4ED2' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpI37poiGsoYyTHVAFgsRaWBtdAgIQBJjBIk1BDqIIImxTgGJBTSIILlv2rSpYUtXRQEhwn0BEHWNyHaEhoLFWlHdAhabgiEGdAummxlDQwZD+FEPYnEfALSQzKp/D0t8AAAAAElFTkSuQmCC',
			'BF94' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7QgNEQx1CGRoCkMQCpog0MDo6NKKItYo0sAJJdHVAsSkBSO4LjZoatjIzKioKyX0gdQwhgQ7o5jE0BIaGoIkxAl2CxS0oYqEBQL1obh6o8KMixOI+ABCbz0p4ouwdAAAAAElFTkSuQmCC',
			'1981' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7GB0YQxhCGVqRxVgdWFsZHR2mIouJOog0ujYEhKLqFWl0dHSA6QU7aWXW0qVZoauWIrsPaEcgkjqoGAPIPDQxFixiYLegiImGgN0cGjAIwo+KEIv7AGi4yUeXoqhUAAAAAElFTkSuQmCC',
			'3F3B' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXUlEQVR4nGNYhQEaGAYTpIn7RANEQx1DGUMdkMQCpog0sDY6OgQgq2wVAZKBDiLIYkB1DAh1YCetjJoatmrqytAsZPehqsNtHhYxbG4RDRBpYERz80CFHxUhFvcBAAmPzAxQ6CHyAAAAAElFTkSuQmCC',
			'2AF1' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYUlEQVR4nGNYhQEaGAYTpIn7WAMYAlhDA1qRxUSmMIawNjBMRRYLaGVtBYqFouhuFWl0BZIo7ps2bWVq6KqlKO4LQFEHhowOoqHoYqwNmOpEsIiFhoLFQgMGQfhREWJxHwApccupIp0KGAAAAABJRU5ErkJggg==',
			'7D31' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYUlEQVR4nGNYhQEaGAYTpIn7QkNFQxhDGVpRRFtFWlkbHaaiiTU6NASEoohNAYo1OsD0QtwUNW1l1tRVS5Hdx+iAog4MWRvA5qGIiWARC2gAuwVNDOzm0IBBEH5UhFjcBwD82s3MzUELqgAAAABJRU5ErkJggg==',
			'C904' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbElEQVR4nGNYhQEaGAYTpIn7WEMYQximMDQEIImJtLK2MoQyNCKLBTSKNDo6OrSiiDWINLo2BEwJQHJf1KqlS1NXRUVFIbkvoIEx0LUh0AFVLwNQb2BoCIodLCA7sLkFRQybmwcq/KgIsbgPABebzoZ3PRivAAAAAElFTkSuQmCC',
			'624B' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdklEQVR4nGNYhQEaGAYTpIn7WAMYQxgaHUMdkMREprC2MrQ6OgQgiQW0iDQ6THV0EEEWa2BodAiEqwM7KTJq1dKVmZmhWUjuC5nCMIW1Ec28VoYA1tBAVPNaGR2AbkERA7qlgQFNL2uAaKgDmpsHKvyoCLG4DwCticyOKLWPWAAAAABJRU5ErkJggg==',
			'393C' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYklEQVR4nGNYhQEaGAYTpIn7RAMYQxhDGaYGIIkFTGFtZW10CBBBVtkq0ujQEOjAgiw2BSjW6OiA7L6VUUuXZk1dmYXivimMgUjqoOYxgM1DFWPBsAObW7C5eaDCj4oQi/sAKUHMJpbzu5UAAAAASUVORK5CYII=',
			'6ED9' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYUlEQVR4nGNYhQEaGAYTpIn7WANEQ1lDGaY6IImJTBFpYG10CAhAEgtoAYo1BDqIIIs1oIiBnRQZNTVs6aqoqDAk94WAzGsImIqitxUs1oBFDMUObG7B5uaBCj8qQizuAwDxyszgM6t3UQAAAABJRU5ErkJggg==',
			'7912' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdUlEQVR4nM2QwQ2AMAhFP4luwEB1g5rQiyM4BT10A3QDL05pe6PRoybyDyQvEF7AeSvFn/KJX0okMGzB0zIWCGLsGOdJKLBnxjkYlL3fchzrXpvzo0Bzncv+xqhou8W7sA6NmWdRq4sh9oyE0pTkB/97MQ9+F7/oy/INnSHQAAAAAElFTkSuQmCC',
			'911B' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZ0lEQVR4nGNYhQEaGAYTpIn7WAMYAhimMIY6IImJTGEMYAhhdAhAEgtoZQ1gBIqJoIiB9cLUgZ00beqqqFXTVoZmIbmP1RVFHQRC9SKbJ4BFTGQKpl7WANZQxlBHFDcPVPhREWJxHwAttcgw+VR10wAAAABJRU5ErkJggg==',
			'5071' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7QkMYAlhDA1qRxQIaGEOA5FRUMVagmoBQZLHAAJFGh0YHmF6wk8KmTVuZtXTVUhT3tQLVTWFAsQMsFoAqFtDK2srogComMoUxhLUBVYw1AOjmBobQgEEQflSEWNwHAGLNzAgCgGjLAAAAAElFTkSuQmCC',
			'FE1F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAUUlEQVR4nGNYhQEaGAYTpIn7QkNFQxmmMIaGIIkFNIg0MIQwOjCgiTFiEQPqhYmBnRQaNTVs1bSVoVlI7kNTRwUx0VDGUEcUsYEKPypCLO4DAHQiygAUXc8AAAAAAElFTkSuQmCC',
			'43C0' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpI37prCGMIQ6tKKIhYi0MjoETHVAEmMMYWh0bRAICEASY53C0MrawOggguS+adNWhS1dtTJrGpL7AlDVgWFoKMg8VDGGKZh2MEzBdAtWNw9U+FEPYnEfAHFuy7gg6mvoAAAAAElFTkSuQmCC',
			'CFEC' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWElEQVR4nGNYhQEaGAYTpIn7WENEQ11DHaYGIImJtIo0sDYwBIggiQU0gsQYHViQxRogYsjui1o1NWxp6MosZPehqcMthsUObG5hDQGKobl5oMKPihCL+wCfY8rnme854gAAAABJRU5ErkJggg==',
			'4F33' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpI37poiGOoYyhDogi4WINLA2OjoEIIkxAsUYGgIaRJDEWKcAeY0ODQFI7ps2bWrYqqmrlmYhuS8AVR0YhoZimscwBbsYultAYozobh6o8KMexOI+AM7ozZb9fWuaAAAAAElFTkSuQmCC',
			'6818' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7WAMYQximMEx1QBITmcLayhDCEBCAJBbQItLoGMLoIIIs1gBUNwWuDuykyKiVYaumrZqaheS+kCko6iB6W0UaHaagmYdFTASLXpCbGUMdUNw8UOFHRYjFfQAlpMxHZKlNWQAAAABJRU5ErkJggg==',
			'4BE3' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAX0lEQVR4nGNYhQEaGAYTpI37poiGsIY6hDogi4WItLI2MDoEIIkxhog0ugJpESQx1ikgdQwNAUjumzZtatjS0FVLs5DcF4CqDgxDQzHNY5iCVQzDLVjdPFDhRz2IxX0ATBvMaUx/Ei4AAAAASUVORK5CYII=',
			'1E55' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZ0lEQVR4nGNYhQEaGAYTpIn7GB1EQ1lDHUMDkMRYHUQaWIEyyOpEsYgxgsSmMro6ILlvZdbUsKWZmVFRSO4DqWNoCGgQQdOLTYy1IdABXYzR0SEA2X2iIaKhDKEMUx0GQfhREWJxHwC1zcgHon7BZQAAAABJRU5ErkJggg==',
			'D13F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYUlEQVR4nGNYhQEaGAYTpIn7QgMYAhhDGUNDkMQCpjAGsDY6OiCrC2hlDWBoCEQTYwhgQKgDOylq6aqoVVNXhmYhuQ9NHUIMm3noYlMYMNwSGsAKdDEjithAhR8VIRb3AQCDVsnsCDkRKgAAAABJRU5ErkJggg==',
			'5FE8' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXElEQVR4nGNYhQEaGAYTpIn7QkNEQ11DHaY6IIkFNIg0sDYwBARgiDE6iCCJBQagqAM7KWza1LCloaumZiG7rxXTPIgYqnkBWMREpmDqZQXZi+bmgQo/KkIs7gMA9ITL1URHmVUAAAAASUVORK5CYII=',
			'8B61' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXUlEQVR4nGNYhQEaGAYTpIn7WANEQxhCGVqRxUSmiLQyOjpMRRYLaBVpdG1wCEVXx9oA1wt20tKoqWFLp65aiuw+sDpHh1ZM8wIIikHdgiIGdXNowCAIPypCLO4DALXNzLsxogWxAAAAAElFTkSuQmCC',
			'5428' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdklEQVR4nGNYhQEaGAYTpIn7QkMYWhlCGaY6IIkFNDBMZXR0CAhAFQtlbQh0EEESCwxgdAXKwNSBnRQ2benSVSuzpmYhu69VpBVoC4p5DK2ioQ5TGFHMCwCrQhUTmcLQyuiAqpc1gKGVNTQAxc0DFX5UhFjcBwCNd8uDNgc7UQAAAABJRU5ErkJggg==',
			'836F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXUlEQVR4nGNYhQEaGAYTpIn7WANYQxhCGUNDkMREpoi0Mjo6OiCrC2hlaHRtQBUTmcLQytrACBMDO2lp1KqwpVNXhmYhuQ+sDqt5gQTFsLkF6mYUsYEKPypCLO4DADasycD1TxqIAAAAAElFTkSuQmCC',
			'394F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7RAMYQxgaHUNDkMQCprC2MrQ6OqCobBVpdJiKJjYFKBYIFwM7aWXU0qWZmZmhWcjum8IY6NqIbh5Do2toIJoYS6MDmjqwW9DEoG5G1TtA4UdFiMV9AHa2yqxPKiJaAAAAAElFTkSuQmCC',
			'9AC3' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7WAMYAhhCHUIdkMREpjCGMDoEOgQgiQW0srayNgg0iKCIiTS6gmgk902bOm1l6qpVS7OQ3MfqiqIOAltFQ0FiyOYJgM1DtUNkikijI5pbWANEGh3Q3DxQ4UdFiMV9ADFDzTSDbQYBAAAAAElFTkSuQmCC',
			'5F29' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcklEQVR4nGNYhQEaGAYTpIn7QkNEQx1CGaY6IIkFNIg0MDo6BASgibE2BDqIIIkFBoB4cDGwk8KmTQ1btTIrKgzZfa1AFa0MU5H1gsWmMDQgiwWAxAIYUOwQmQJ0iwMDiltYgfayhgaguHmgwo+KEIv7AKagy5QHW1CGAAAAAElFTkSuQmCC',
			'7A8A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nGNYhQEaGAYTpIn7QkMZAhhCGVpRRFsZQxgdHaY6oIixtrI2BAQEIItNEWl0dHR0EEF2X9S0lVmhK7OmIbmP0QFFHRiyNoiGujYEhoYgiYk0iDQCxVDUBTRg6gWJOYQyoogNVPhREWJxHwBJu8u4ZxmP8gAAAABJRU5ErkJggg==',
			'7D07' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbElEQVR4nGNYhQEaGAYTpIn7QkNFQximMIaGIIu2irQyhDI0iKCKNTo6OqCKTRFpdG0IAEIk90VNW5m6KmplFpL7GB3A6lqR7WVtAItNQRYTaQDbEYAsFtAAcgujA6oY2M0oYgMVflSEWNwHAI6ZzFtIcHREAAAAAElFTkSuQmCC',
			'07DE' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7GB1EQ11DGUMDkMRYAxgaXRsdHZDViUwBijUEoogFtDK0siLEwE6KWrpq2tJVkaFZSO4DqgtgxdDL6IAuJjKFtQFdjDVApIEVzS2MDkAxNDcPVPhREWJxHwAHNspXl5XWOwAAAABJRU5ErkJggg==',
			'DBC8' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXUlEQVR4nGNYhQEaGAYTpIn7QgNEQxhCHaY6IIkFTBFpZXQICAhAFmsVaXRtEHQQQRVrZW1ggKkDOylq6dSwpatWTc1Cch+aOiTzGNHNw7QDi1uwuXmgwo+KEIv7ANPDzksevU43AAAAAElFTkSuQmCC',
			'84FE' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYklEQVR4nGNYhQEaGAYTpIn7WAMYWllDA0MDkMREpjBMZW1gdEBWF9DKEIouJjKF0RVJDOykpVFLly4NXRmaheQ+kSkirZjmiYa6YtqBoQ7oFgwxsJsbGFHcPFDhR0WIxX0AZ4fJK0x+v64AAAAASUVORK5CYII=',
			'6432' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdElEQVR4nM2QMQrAIAxFv4M3sPfJ0j0FHeppFOoN9AgunrJ2i9ixBfMhkEcgj6BNFbBSfvHTjKQcCglmMoqOxCwYX3AIBxnJgtoRKRjhd/paW2nNCz+bTep7Ud7gtDnqHQNDnzljdEmPy+ysnF3gfx/mxe8GijPNSM1tuVAAAAAASUVORK5CYII=',
			'01A0' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7GB0YAhimMLQii7EGMAYwhDJMdUASE5kCFHV0CAhAEgtoZQhgbQh0EEFyX9RSEIrMmobkPjR1CLFQVDGRKSB1ASh2sAaAxVDcwujAGsoKMmEQhB8VIRb3AQAkRsoC99va8QAAAABJRU5ErkJggg==',
			'2321' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7WANYQxhCGVqRxUSmiLQyOjpMRRYLaGVodG0ICEXR3QrSFwDTC3HTtFVhq1ZmLUVxXwBYJYodjA4MjQ5TUMVYG4BiAWhuaQC6xQFVLDSUNYQ1NCA0YBCEHxUhFvcBAKEkyvBIkcxqAAAAAElFTkSuQmCC',
			'EB3F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAVklEQVR4nGNYhQEaGAYTpIn7QkNEQxhDGUNDkMQCGkRaWRsdHRhQxRodGgLRxVoZEOrATgqNmhq2aurK0Cwk96Gpw2ceVjvQ3QJ1M4rYQIUfFSEW9wEAOK/MHyJtkooAAAAASUVORK5CYII=',
			'72AB' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdElEQVR4nGNYhQEaGAYTpIn7QkMZQximMIY6IIu2srYyhDI6BKCIiTQ6Ojo6iCCLTWFodG0IhKmDuClq1dKlqyJDs5Dcx+jAMIUVoQ4MWRsYAlhDA1HMEwGqBKlDFgsAqkTXG9AgGgq0F9XNAxR+VIRY3AcASATLvc48698AAAAASUVORK5CYII=',
			'191D' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7GB0YQximMIY6IImxOrC2MoQwOgQgiYk6iDQ6AsVEUPSKNDpMgYuBnbQya+nSrGkrs6YhuQ9oRyCSOqgYQyOmGAsWMaBbpqC5JYQxhDHUEcXNAxV+VIRY3AcA2brICKk6AmkAAAAASUVORK5CYII=',
			'8C35' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7WAMYQ0EwAElMZApro2ujowOyuoBWkQaHhkAUMZEpIg0MjY6uDkjuWxo1bdWqqSujopDcB1Hn0CCCZh6QxBAD2SHSgO4WhwBk90HczDDVYRCEHxUhFvcBAGKpzVUVToJvAAAAAElFTkSuQmCC',
			'A835' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcklEQVR4nGNYhQEaGAYTpIn7GB0YQxhDGUMDkMRYA1hbWRsdHZDViUwRaXRoCEQRC2hlbWVodHR1QHJf1NKVYaumroyKQnIfRJ1DgwiS3tBQkHkBKGIBrRA7RNDsYG10CAhAEQO5mWGqwyAIPypCLO4DAKxRzRGLLVuUAAAAAElFTkSuQmCC',
			'01AB' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaElEQVR4nGNYhQEaGAYTpIn7GB0YAhimMIY6IImxBjAGMIQyOgQgiYlMAYo6OjqIIIkFtDIEsDYEwtSBnRS1FIQiQ7OQ3IemDiEWGohinsgUiDoRFLdg6mV0YA0FiqG4eaDCj4oQi/sAMf7JPWSjXJsAAAAASUVORK5CYII=',
			'A5DA' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAc0lEQVR4nGNYhQEaGAYTpIn7GB1EQ1lDGVqRxVgDRBpYGx2mOiCJiUwBijUEBAQgiQW0ioSwNgQ6iCC5L2rp1KVLV0VmTUNyX0ArQ6MrQh0YhoaCxUJDUM3DUBfQytrK2uiIJsYYwhrKiCI2UOFHRYjFfQArrs0jLG2c6gAAAABJRU5ErkJggg==',
			'B0F7' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYElEQVR4nGNYhQEaGAYTpIn7QgMYAlhDA0NDkMQCpjCGsAJpEWSxVtZWDLEpIo2uIBrJfaFR01amhq5amYXkPqi6VgYU88BiUxgw7QhAEQO7hdEBw81oYgMVflSEWNwHAKUXzEUJx643AAAAAElFTkSuQmCC',
			'0FEB' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAV0lEQVR4nGNYhQEaGAYTpIn7GB1EQ11DHUMdkMRYA0QaWIEyAUhiIlMgYiJIYgGtKOrATopaOjVsaejK0Cwk96GpQxETIWAHNreAVLCiuXmgwo+KEIv7AKQPyiL3PGiXAAAAAElFTkSuQmCC',
			'FE05' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYElEQVR4nGNYhQEaGAYTpIn7QkNFQxmmMIYGIIkFNIg0MIQyOjCgiTE6OmKIsTYEujoguS80amrY0lWRUVFI7oOoA5uKphdTDGQHuhhDKEMAqvtAbmaY6jAIwo+KEIv7AP00zEA49UhxAAAAAElFTkSuQmCC',
			'66A6' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdElEQVR4nGNYhQEaGAYTpIn7WAMYQximMEx1QBITmcLayhDKEBCAJBbQItLI6OjoIIAs1iDSwNoQ6IDsvsioaWFLV0WmZiG5L2SKaCtQHap5rSKNrqGBDiLoYg2oYiC3sDYEoOgFuRkohuLmgQo/KkIs7gMAd1/MwZ5iUZIAAAAASUVORK5CYII=',
			'7605' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdElEQVR4nGNYhQEaGAYTpIn7QkMZQximMIYGIIu2srYyhDI6oKhsFWlkdHREFZsi0sDaEOjqgOy+qGlhS1dFRkUhuY/RQbSVtSGgQQRJL2uDSKMrmpgIUMwRaAeyWEADyC0MAQEoYiA3M0x1GAThR0WIxX0APK3K+TXUONQAAAAASUVORK5CYII=',
			'D089' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZUlEQVR4nGNYhQEaGAYTpIn7QgMYAhhCGaY6IIkFTGEMYXR0CAhAFmtlbWVtCHQQQRETaXR0dISJgZ0UtXTayqzQVVFhSO6DqHOYiq7XtSGgQQTDjgBUO7C4BZubByr8qAixuA8AL0rNEKsmp2AAAAAASUVORK5CYII=',
			'F7C9' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7QkNFQx1CHaY6IIkFNDA0OjoEBASgibk2CDqIoIq1sjYwwsTATgqNWjVt6apVUWFI7gOqC2BtYJiKqpfRASjWgCrGCoQCaHaIAFWiuwWoAs3NAxV+VIRY3AcAdjbNJkY0XuIAAAAASUVORK5CYII=',
			'685D' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7WAMYQ1hDHUMdkMREprC2sjYwOgQgiQW0iDS6AsVEkMUagOqmwsXAToqMWhm2NDMzaxqS+0KA5jE0BKLqbRVpdMAi5oomBnILo6MjiltAbmYIZURx80CFHxUhFvcBADf4y3ZZzAdcAAAAAElFTkSuQmCC',
			'DD20' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7QgNEQxhCGVqRxQKmiLQyOjpMdUAWaxVpdG0ICAhAE3NoCHQQQXJf1NJpK7NWZmZNQ3IfWF0rI0wdQmwKFrEABlQ7QG5xYEBxC8jNrKEBKG4eqPCjIsTiPgDGRs4wJwWT1QAAAABJRU5ErkJggg==',
			'1E8C' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXElEQVR4nGNYhQEaGAYTpIn7GB1EQxlCGaYGIImxOog0MDo6BIggiYkCxVgbAh1YUPSC1Dk6ILtvZdbUsFWhK7OQ3YemDi4GMg+bGKYdaG4JwXTzQIUfFSEW9wEAOnjHfn0uUBMAAAAASUVORK5CYII=',
			'8C5A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7WAMYQ1lDHVqRxUSmsDa6NjBMdUASC2gVaQCKBQSgqBNpYJ3K6CCC5L6lUdNWLc3MzJqG5D6QOoaGQJg6uHlAsdAQDDtQ1YHc4ujoiCIGcjNDKCOK2ECFHxUhFvcBAHROzD26b3r5AAAAAElFTkSuQmCC',
			'A4BF' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZUlEQVR4nGNYhQEaGAYTpIn7GB0YWllDGUNDkMRYAximsjY6OiCrE5nCEMraEIgiFtDK6IqkDuykqKVAELoyNAvJfQGtIq3o5oWGioa6YpgHdAs2MTS9YLFQRhSxgQo/KkIs7gMA24bKi+iulTUAAAAASUVORK5CYII=',
			'C432' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcklEQVR4nM2QMQ6AIAxFPwM3wPt0ca8JXTxNO3ADOQILp1QmIThqYv/Q9CftfynqVIo/6RM+H5GcIFPnhYTsjZg7jw0C3Sj0nroVRho6vr2WUnPrNx+3i0ZGw+4ipJwwZlwzHxhZUmOZmZ3EH/zvRT3wnawXzV8jLJO+AAAAAElFTkSuQmCC',
			'AB46' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcklEQVR4nGNYhQEaGAYTpIn7GB1EQxgaHaY6IImxBoi0MrQ6BAQgiYlMEQGqcnQQQBILaAWqC3R0QHZf1NKpYSszM1OzkNwHUsfa6IhiXmioSKNraKCDCKp5jQ6NjuhirUD3oegNaMV080CFHxUhFvcBAJlvzatbKbK+AAAAAElFTkSuQmCC',
			'2461' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7WAMYWhlCgRhJTGQKw1RGR4epyGIBQFWsDQ6hKLpbGV1ZG+B6IW6atnTp0qmrlqK4L0CkldXRAcUORgfRUFeQqchuAZrFiiYmArIFTW9oKNjNoQGDIPyoCLG4DwCfVMsPFwSBHwAAAABJRU5ErkJggg=='        
        );
        $this->text = array_rand( $images );
        return $images[ $this->text ] ;    
    }
    
    function out_processing_gif(){
        $image = dirname(__FILE__) . '/processing.gif';
        $base64_image = "R0lGODlhFAAUALMIAPh2AP+TMsZiALlcAKNOAOp4ANVqAP+PFv///wAAAAAAAAAAAAAAAAAAAAAAAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFCgAIACwAAAAAFAAUAAAEUxDJSau9iBDMtebTMEjehgTBJYqkiaLWOlZvGs8WDO6UIPCHw8TnAwWDEuKPcxQml0Ynj2cwYACAS7VqwWItWyuiUJB4s2AxmWxGg9bl6YQtl0cAACH5BAUKAAgALAEAAQASABIAAAROEMkpx6A4W5upENUmEQT2feFIltMJYivbvhnZ3Z1h4FMQIDodz+cL7nDEn5CH8DGZhcLtcMBEoxkqlXKVIgAAibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkphaA4W5upMdUmDQP2feFIltMJYivbvhnZ3V1R4BNBIDodz+cL7nDEn5CH8DGZAMAtEMBEoxkqlXKVIg4HibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpjaE4W5tpKdUmCQL2feFIltMJYivbvhnZ3R0A4NMwIDodz+cL7nDEn5CH8DGZh8ONQMBEoxkqlXKVIgIBibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpS6E4W5spANUmGQb2feFIltMJYivbvhnZ3d1x4JMgIDodz+cL7nDEn5CH8DGZgcBtMMBEoxkqlXKVIggEibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpAaA4W5vpOdUmFQX2feFIltMJYivbvhnZ3V0Q4JNhIDodz+cL7nDEn5CH8DGZBMJNIMBEoxkqlXKVIgYDibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpz6E4W5tpCNUmAQD2feFIltMJYivbvhnZ3R1B4FNRIDodz+cL7nDEn5CH8DGZg8HNYMBEoxkqlXKVIgQCibbK9YLBYvLtHH5K0J0IACH5BAkKAAgALAEAAQASABIAAAROEMkpQ6A4W5spIdUmHQf2feFIltMJYivbvhnZ3d0w4BMAIDodz+cL7nDEn5CH8DGZAsGtUMBEoxkqlXKVIgwGibbK9YLBYvLtHH5K0J0IADs=";
        $binary = is_file($image) ? join("",file($image)) : base64_decode($base64_image); 
        header("Cache-Control: post-check=0, pre-check=0, max-age=0, no-store, no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: image/gif");
        echo $binary;
    }

}
# end of class phpfmgImage
# ------------------------------------------------------
# end of module : captcha


# module user
# ------------------------------------------------------
function phpfmg_user_isLogin(){
    return ( isset($_SESSION['authenticated']) && true === $_SESSION['authenticated'] );
}


function phpfmg_user_logout(){
    session_destroy();
    header("Location: admin.php");
}

function phpfmg_user_login()
{
    if( phpfmg_user_isLogin() ){
        return true ;
    };
    
    $sErr = "" ;
    if( 'Y' == $_POST['formmail_submit'] ){
        if(
            defined( 'PHPFMG_USER' ) && strtolower(PHPFMG_USER) == strtolower($_POST['Username']) &&
            defined( 'PHPFMG_PW' )   && strtolower(PHPFMG_PW) == strtolower($_POST['Password']) 
        ){
             $_SESSION['authenticated'] = true ;
             return true ;
             
        }else{
            $sErr = 'Login failed. Please try again.';
        }
    };
    
    // show login form 
    phpfmg_admin_header();
?>
<form name="frmFormMail" action="" method='post' enctype='multipart/form-data'>
<input type='hidden' name='formmail_submit' value='Y'>
<br><br><br>

<center>
<div style="width:380px;height:260px;">
<fieldset style="padding:18px;" >
<table cellspacing='3' cellpadding='3' border='0' >
	<tr>
		<td class="form_field" valign='top' align='right'>Email :</td>
		<td class="form_text">
            <input type="text" name="Username"  value="<?php echo $_POST['Username']; ?>" class='text_box' >
		</td>
	</tr>

	<tr>
		<td class="form_field" valign='top' align='right'>Password :</td>
		<td class="form_text">
            <input type="password" name="Password"  value="" class='text_box'>
		</td>
	</tr>

	<tr><td colspan=3 align='center'>
        <input type='submit' value='Login'><br><br>
        <?php if( $sErr ) echo "<span style='color:red;font-weight:bold;'>{$sErr}</span><br><br>\n"; ?>
        <a href="admin.php?mod=mail&func=request_password">I forgot my password</a>   
    </td></tr>
</table>
</fieldset>
</div>
<script type="text/javascript">
    document.frmFormMail.Username.focus();
</script>
</form>
<?php
    phpfmg_admin_footer();
}


function phpfmg_mail_request_password(){
    $sErr = '';
    if( $_POST['formmail_submit'] == 'Y' ){
        if( strtoupper(trim($_POST['Username'])) == strtoupper(trim(PHPFMG_USER)) ){
            phpfmg_mail_password();
            exit;
        }else{
            $sErr = "Failed to verify your email.";
        };
    };
    
    $n1 = strpos(PHPFMG_USER,'@');
    $n2 = strrpos(PHPFMG_USER,'.');
    $email = substr(PHPFMG_USER,0,1) . str_repeat('*',$n1-1) . 
            '@' . substr(PHPFMG_USER,$n1+1,1) . str_repeat('*',$n2-$n1-2) . 
            '.' . substr(PHPFMG_USER,$n2+1,1) . str_repeat('*',strlen(PHPFMG_USER)-$n2-2) ;


    phpfmg_admin_header("Request Password of Email Form Admin Panel");
?>
<form name="frmRequestPassword" action="admin.php?mod=mail&func=request_password" method='post' enctype='multipart/form-data'>
<input type='hidden' name='formmail_submit' value='Y'>
<br><br><br>

<center>
<div style="width:580px;height:260px;text-align:left;">
<fieldset style="padding:18px;" >
<legend>Request Password</legend>
Enter Email Address <b><?php echo strtoupper($email) ;?></b>:<br />
<input type="text" name="Username"  value="<?php echo $_POST['Username']; ?>" style="width:380px;">
<input type='submit' value='Verify'><br>
The password will be sent to this email address. 
<?php if( $sErr ) echo "<br /><br /><span style='color:red;font-weight:bold;'>{$sErr}</span><br><br>\n"; ?>
</fieldset>
</div>
<script type="text/javascript">
    document.frmRequestPassword.Username.focus();
</script>
</form>
<?php
    phpfmg_admin_footer();    
}


function phpfmg_mail_password(){
    phpfmg_admin_header();
    if( defined( 'PHPFMG_USER' ) && defined( 'PHPFMG_PW' ) ){
        $body = "Here is the password for your form admin panel:\n\nUsername: " . PHPFMG_USER . "\nPassword: " . PHPFMG_PW . "\n\n" ;
        if( 'html' == PHPFMG_MAIL_TYPE )
            $body = nl2br($body);
        mailAttachments( PHPFMG_USER, "Password for Your Form Admin Panel", $body, PHPFMG_USER, 'You', "You <" . PHPFMG_USER . ">" );
        echo "<center>Your password has been sent.<br><br><a href='admin.php'>Click here to login again</a></center>";
    };   
    phpfmg_admin_footer();
}


function phpfmg_writable_check(){
 
    if( is_writable( dirname(PHPFMG_SAVE_FILE) ) && is_writable( dirname(PHPFMG_EMAILS_LOGFILE) )  ){
        return ;
    };
?>
<style type="text/css">
    .fmg_warning{
        background-color: #F4F6E5;
        border: 1px dashed #ff0000;
        padding: 16px;
        color : black;
        margin: 10px;
        line-height: 180%;
        width:80%;
    }
    
    .fmg_warning_title{
        font-weight: bold;
    }

</style>
<br><br>
<div class="fmg_warning">
    <div class="fmg_warning_title">Your form data or email traffic log is NOT saving.</div>
    The form data (<?php echo PHPFMG_SAVE_FILE ?>) and email traffic log (<?php echo PHPFMG_EMAILS_LOGFILE?>) will be created automatically when the form is submitted. 
    However, the script doesn't have writable permission to create those files. In order to save your valuable information, please set the directory to writable.
     If you don't know how to do it, please ask for help from your web Administrator or Technical Support of your hosting company.   
</div>
<br><br>
<?php
}


function phpfmg_log_view(){
    $n = isset($_REQUEST['file'])  ? $_REQUEST['file']  : '';
    $files = array(
        1 => PHPFMG_EMAILS_LOGFILE,
        2 => PHPFMG_SAVE_FILE,
    );
    
    phpfmg_admin_header();
   
    $file = $files[$n];
    if( is_file($file) ){
        if( 1== $n ){
            echo "<pre>\n";
            echo join("",file($file) );
            echo "</pre>\n";
        }else{
            $man = new phpfmgDataManager();
            $man->displayRecords();
        };
     

    }else{
        echo "<b>No form data found.</b>";
    };
    phpfmg_admin_footer();
}


function phpfmg_log_download(){
    $n = isset($_REQUEST['file'])  ? $_REQUEST['file']  : '';
    $files = array(
        1 => PHPFMG_EMAILS_LOGFILE,
        2 => PHPFMG_SAVE_FILE,
    );

    $file = $files[$n];
    if( is_file($file) ){
        phpfmg_util_download( $file, PHPFMG_SAVE_FILE == $file ? 'form-data.csv' : 'email-traffics.txt', true, 1 ); // skip the first line
    }else{
        phpfmg_admin_header();
        echo "<b>No email traffic log found.</b>";
        phpfmg_admin_footer();
    };

}


function phpfmg_log_delete(){
    $n = isset($_REQUEST['file'])  ? $_REQUEST['file']  : '';
    $files = array(
        1 => PHPFMG_EMAILS_LOGFILE,
        2 => PHPFMG_SAVE_FILE,
    );
    phpfmg_admin_header();

    $file = $files[$n];
    if( is_file($file) ){
        echo unlink($file) ? "It has been deleted!" : "Failed to delete!" ;
    };
    phpfmg_admin_footer();
}


function phpfmg_util_download($file, $filename='', $toCSV = false, $skipN = 0 ){
    if (!is_file($file)) return false ;

    set_time_limit(0);


    $buffer = "";
    $i = 0 ;
    $fp = @fopen($file, 'rb');
    while( !feof($fp)) { 
        $i ++ ;
        $line = fgets($fp);
        if($i > $skipN){ // skip lines
            if( $toCSV ){ 
              $line = str_replace( chr(0x09), ',', $line );
              $buffer .= phpfmg_data2record( $line, false );
            }else{
                $buffer .= $line;
            };
        }; 
    }; 
    fclose ($fp);
  

    
    /*
        If the Content-Length is NOT THE SAME SIZE as the real conent output, Windows+IIS might be hung!!
    */
    $len = strlen($buffer);
    $filename = basename( '' == $filename ? $file : $filename );
    $file_extension = strtolower(substr(strrchr($filename,"."),1));

    switch( $file_extension ) {
        case "pdf": $ctype="application/pdf"; break;
        case "exe": $ctype="application/octet-stream"; break;
        case "zip": $ctype="application/zip"; break;
        case "doc": $ctype="application/msword"; break;
        case "xls": $ctype="application/vnd.ms-excel"; break;
        case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
        case "gif": $ctype="image/gif"; break;
        case "png": $ctype="image/png"; break;
        case "jpeg":
        case "jpg": $ctype="image/jpg"; break;
        case "mp3": $ctype="audio/mpeg"; break;
        case "wav": $ctype="audio/x-wav"; break;
        case "mpeg":
        case "mpg":
        case "mpe": $ctype="video/mpeg"; break;
        case "mov": $ctype="video/quicktime"; break;
        case "avi": $ctype="video/x-msvideo"; break;
        //The following are for extensions that shouldn't be downloaded (sensitive stuff, like php files)
        case "php":
        case "htm":
        case "html": 
                $ctype="text/plain"; break;
        default: 
            $ctype="application/x-download";
    }
                                            

    //Begin writing headers
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: public"); 
    header("Content-Description: File Transfer");
    //Use the switch-generated Content-Type
    header("Content-Type: $ctype");
    //Force the download
    header("Content-Disposition: attachment; filename=".$filename.";" );
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".$len);
    
    while (@ob_end_clean()); // no output buffering !
    flush();
    echo $buffer ;
    
    return true;
 
    
}
?>