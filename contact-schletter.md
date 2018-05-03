---
layout: page
title: Contact Schletter
description: Get in touch with us. Get more information.
---
<script>
 function timestamp() { 
 var response = document.getElementById("g-recaptcha-response"); 
 if (response == null || response.value.trim() == "") 
 {
	var elems = JSON.parse(document.getElementsByName("captcha_settings")[0].value);
	elems["ts"] = JSON.stringify(new Date().getTime());
	document.getElementsByName("captcha_settings")[0].value = JSON.stringify(elems);
	} 
} 
setInterval(timestamp, 500); 
</script>
<h4 class="clear"><a class="quote-icon" href="quote.html">Request a Quote</a>, fill out the form below,<br>or call
<span class="callout">(888) 608 - 0234</span> or email <a href="mailto:info.us@schletter-group.com">info.us@schletter-group.com</a> </h4>

<div class="col-md-8 col-sm-8" >
<form action="https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8" method="POST" role="form" class="form-controls">

<input type="hidden" name='captcha_settings' value='{"keyname":"SFWebtoLeadCaptcha","fallback":"true","orgId":"00D15000000N648","ts":""}'>
<input type="hidden" name="oid" value="00D15000000N648">
<input type="hidden" name="retURL" value="https://www.schletter.us/thank-you.html">
<input type="hidden" name="debug" value='0'>
<input type="hidden" name="debugEmail" value="kateka.thach@schletter-group.com">
<!--  ----------------------------------------------------------------------  -->
<!--  NOTE: These fields are optional debugging elements. Please uncomment    -->
<!--  these lines if you wish to test in debug mode.                          -->
<!--  <input type="hidden" name="debug" value=1>                              -->
<!--  <input type="hidden" name="debugEmail"                                  -->
<!--  value="alison.snodgrass@schletter.us">                                  -->
<!--  ----------------------------------------------------------------------  -->

<ul>
<li>
<label for="first_name" class="desc">First Name</label>
<div><input id="first_name" maxlength="40" name="first_name" size="20" type="text" required="true"></div>
</li>

<li>
<label for="last_name " class="desc">Last Name</label>
<div> <input id="last_name" maxlength="80" name="last_name" size="20" type="text" required="true"></div>
</li>

<li>
<label for="company" class="desc">Company</label>
<div><input id="company" maxlength="40" name="company" size="20" type="text" required="true"><br></div>
</li>

<li>
<label for="title" class="desc">Title</label>
<div><input id="title" maxlength="40" name="title" size="20" type="text" required="true"><br></div>
</li>

<li>
<label for="street" class="desc">Street</label>
<div><textarea name="street" required="true"></textarea></div>
</li>

<li>
<label for="city" class="desc">City</label>
<div><input id="city" maxlength="40" name="city" size="20" type="text" required="true"></div>
</li>

<li>
<label for="state" class="desc">State/Province</label>
<div><input id="state" maxlength="20" name="state" size="20" type="text" required="true"></div>
</li>

<li>
<label for="zip" class="desc">Zip</label>
<div><input id="zip" maxlength="20" name="zip" size="20" type="text" required="true"></div>
</li>

<li>
<label for="country" class="desc">Country</label>
<div><input id="country" maxlength="40" name="country" size="20" type="text" required="true"></div>
</li>

<li>  <label for="email" class="desc">Email</label>
<div><input id="email" maxlength="80" name="email" size="20" type="text" required="true"></div>
</li>

<li>  <label for="phone" class="desc">Phone</label>
<div>  <input id="phone" maxlength="40" name="phone" size="20" type="text" required="true"></div>
</li>

<li>  <label for="mobile" class="desc">Mobile</label>
<div><input id="mobile" maxlength="40" name="mobile" size="20" type="text"><br></div>
</li>

<li>  <label for="URL" class="desc">Website</label>
<div>  <input id="URL" maxlength="80" name="URL" size="20" type="text" required="true"><br></div>
</li>


<li>
<label class="desc">  Market Type:</label>
<div>
<select id="00N1500000GCaKv" multiple="multiple" name="00N1500000GCaKv" title="Market Type" required="true"><option value="Residential">Residential</option>
<option value="Commercial">Commercial</option>
<option value="Industrial">Industrial</option>
<option value="Utility">Utility</option>
</select><br>
</div>


</li>

<li>
<label class="desc">  Market Role:</label>
<div>
<select id="00N1500000GCaL0" multiple="multiple" name="00N1500000GCaL0" title="Market Role" required="true"><option value="Contractor">Contractor</option>
<option value="Manufacturer">Manufacturer</option>
<option value="EPC">EPC</option>
<option value="Developer">Developer</option>
</select><br>
</div>
</li>
<li>
<label class="desc">  Project Type: </label>
<div>
 <select id="00N1500000GCaKb" multiple="multiple" name="00N1500000GCaKb" title="Project Type" required="true"><option value="Ground Mount">Ground Mount</option>
<option value="Roof Mount">Roof Mount</option>
<option value="Carport">Carport</option>
<option value="Metal fabrication">Metal fabrication</option>
</select><br>
</div>
</li>
<li>
<label class="desc">  Project Size (kw): </label>
<div><input id="00N1500000GCaKH" name="00N1500000GCaKH" size="20" type="text" required="true"><br></div>
</li>

<li>  <label for="description" class="desc">Questions or Comments</label><div><textarea name="description" required="true"></textarea><br></div></li>
<li>

<div>
<input type="hidden" name="lead_source" id="lead_source" value="Website">
</div>
</li>

<li>
<div class="g-recaptcha" data-sitekey="6Lf--x0TAAAAAHw1zSQVb1u3Cdr8Neq_8i1rjQk4"></div>
</li>
<li>

<div><input type="submit" name="submit"></div>
</li></ul>
</form>
</div>


<div class="col-md-4 col-sm-4 ">
  <h4><a href="team.html">Team Member Contact »</a></h4>
  <br>
<p>Hours: Mon-Thu: 7am - 4:30pm  | Fri: 7am - 1:00pm </p>
<h3>North Carolina</h3>
<p>

U.S. Headquarters - Manufacturing &amp; Sales<br>
1001 Commerce Center Drive<br>
Shelby, NC 28150 | <a href="http://goo.gl/maps/Hg1qW">Map</a> <br>
<i>NC engineering services provided by third party</i> <br>
Tel: (704) 595 - 4200 | Fax:( 704) 595 - 4210 <br>
<a href="mailto:info.us@schletter-group.com">info.us@schletter-group.com</a>
</p>
<h3>Arizona</h3>
<p>
Sales, Training, and Distribution<br>
3865 N Business Center, Drive Suite 109<br>
Tucson, AZ 85705 | <a href="https://goo.gl/maps/Pw78z">Map</a><br>
Tel: (520) 289 - 8700 | Fax: (520) 289 - 8696 <br>
<a href="mailto:info.us@schletter-group.com">info.us@schletter-group.com</a>
</p>
<h3>Canada</h3>
<p>
Sales, Training, Distribution<br>
3155 Howard Ave, Unit 202<br>
Windsor, ON N8X 4Y8<br>
Tel: (519) 946 - 3800 | Fax: (519) 946 - 3805<br>
<a href="mailto:mail.canada@schletter-group.com">mail.canada@schletter-group.com</a>
</p>
<h3><a target="_blank" href="http://contact.schletter.eu/">Global Locations »</a></h3>
</div>