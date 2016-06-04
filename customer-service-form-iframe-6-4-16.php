<?php
// First, let's use PHP to get all the info we need about the user: Where they're coming from... and what broswer they're using.

// If set, find out which list the user clicked to this form from, by looking at the value of the list= query var in the URL
if (isset($_GET['list'])) {
	$listcode = $_GET['list'];
}

// If set, get the user's email by looking at the value of the email= query var in the URL
if (isset($_GET['email'])) {
	$emailaddress = $_GET['email'];
}

// Assign Free $pubcode
if ($listcode == "mm"){ $pubcode = 'mm'; }
if (strpos($listcode,"oei")!==false){ $pubcode = 'oei'; }
if (strpos($listcode,"sti")!==false){ $pubcode = 'sti'; }
if (strpos($listcode,"twr")!==false){ $pubcode = 'twr'; }
if (strpos($listcode,"wsii")!==false){ $pubcode = 'wsii'; }
if (strpos($listcode,"ppt")!==false){ $pubcode = 'ppt'; }
if (strpos($listcode,"smi")!==false){ $pubcode = 'smi'; }

// Assign Frontend $pubcode
if (strpos($listcode,"ead")!==false){ $pubcode = 'ead'; }
if (strpos($listcode,"mmr")!==false){ $pubcode = 'mmr'; }
if (strpos($listcode,"nvx")!==false){ $pubcode = 'nvx'; }
if (strpos($listcode,"mmp")!==false){ $pubcode = 'mmp'; }

// Assign Backend $pubcode
if (strpos($listcode,"edi")!==false){ $pubcode = 'edi'; }
if (strpos($listcode,"ern")!==false){ $pubcode = 'ern'; }
if (strpos($listcode,"ecl")!==false){ $pubcode = 'ecl'; }
if (strpos($listcode,"tim")!==false){ $pubcode = 'tim'; }
if (strpos($listcode,"spn")!==false){ $pubcode = 'spn'; }
if (strpos($listcode,"sra")!==false){ $pubcode = 'sra'; }
if (strpos($listcode,"chn")!==false){ $pubcode = 'chn'; }
if (strpos($listcode,"sst")!==false){ $pubcode = 'sst'; }
if (strpos($listcode,"met")!==false){ $pubcode = 'met'; }
if (strpos($listcode,"mml")!==false){ $pubcode = 'mml'; }
if (strpos($listcode,"rgd")!==false){ $pubcode = 'rgd'; }
if (strpos($listcode,"mpf")!==false){ $pubcode = 'mpf'; }
if (strpos($listcode,"flx")!==false){ $pubcode = 'flx'; }
if (strpos($listcode,"spf")!==false){ $pubcode = 'spf'; }
if (strpos($listcode,"tmc")!==false){ $pubcode = 'tmc'; }
if (strpos($listcode,"smi")!==false){ $pubcode = 'smi'; }

// Lastly use PHP to get user's browser information and assign it to a variable
$browser = $_SERVER['HTTP_USER_AGENT'];

// Also get the domain
$domain = $_SERVER['SERVER_NAME'];
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Money Map Press</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

<script src="https://carl.pubsvs.com/carl.js"></script>
<script>
    $( document ).ready(function() { //document loaded and ready
        function getParameterByName(name) { //this function takes in a url parameter and returns the value in this case the eamil
            name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
            var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
                    results = regex.exec(location.search);
            return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
        }

        var emailAdd = getParameterByName('email'); //call the function and return the email address from the email param in the url


        if (emailAdd) {
            getCustomerData(emailAdd); //call getCustomerNumber function with the email address
        }

        function getCustomerData(email) {
            var custNumber, custLists, custPubs = null;

            try {
                var custNumber = carl.customerNumber(email, 8);
                if (custNumber.length != null) {
                    custNumber = custNumber;
                    // custNumber is your customernumber
                }
            } catch (err) {
                custNumber = null;
                console.log(err);
            }


            var myPubsList ='';
            try {
                var custPubs = carl.getPubs(email, 8);
                if (custPubs.length !== null) {
                    for (var i = 0; i < custPubs.length; i++) {
                        myPubsList += custPubs[i] + ",";
                    }
                }
                // myPubsList is a list of subs, comma separated
            } catch (err) {
                myPubsList = null;
                console.log(err);
            }


            var myCustList = '';
            try {
                var custLists = carl.getLists(email, 8);
                if (custLists.length !== null) {
                    for (var j = 0; j < custLists.length; j++) {
                        myCustList += custLists [j] +",";
                    }
                }
                // myCustList is a list of subs, comma separated

            } catch (err) {
                myCustList = null;
                console.log(err);
            }
			
		$( "input[name=customernumber]" ).val(custNumber);
		$( "input[name=customerpubs]" ).val(myPubsList);
		$( "input[name=customerlists]" ).val(myCustList);
		
        }

        <!--this script will check if the email is filled in on page load, if not it will fill in on submit-->
        var emailField = $('#email');
        if(emailField.val().length === 0){
            $('#csform').submit(function() {
                var emailValue = $('#email').val();
                getCustomerData(emailValue);
            })
        }

    });
</script>


<style>
body, p, li, ul, tr, td, table {font-family: Arial, Helvetica, sans-serif; font-size: 14px; }

h1, h2, h3, h4, h5 {
	font-family: Georgia, "Times New Roman", Times, serif;
	text-align: center;
	margin-top: 2%;
	margin-bottom: 2%;
	line-height: 120%;
	color: #000000;
	padding:0px 15px;
}


#container {
	max-width: 900px;
	margin: auto;
	background: #FFF;
	overflow: auto;
	text-align: center;
	font-family: Arial, Helvetica, sans-serif;
}
.footer {
	border-top: 3px solid #ddbf4a;
	background-color: #666666;
	padding: 15px;
	text-align: left;
	font-size: 11px;
	color: #CCCCCC;
}
.wrapper {
	padding: 0 3%;
	overflow: hidden;
	margin: auto;
}
input[type="text"], input[type="email"], input[type="tel"], input[type="zip"] {
	border: 1px solid #e8e8e8 !important;
	padding: 5px;
	box-shadow: none;
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
}
.contact-comments {
    width: 200px;
}
#submitButton {
    padding-left: 135px;
}
@media (max-width: 731px) {
    #submitButton {
        padding-left: inherit;
    }
}

[required] {
box-shadow: 0 0 3px rgba(0, 220, 0, 1) !important;
-webkit-box-shadow: 0 0 3px rgba(0, 220, 0, 1) !important;
-moz-box-shadow: 0 0 3px rgba(0, 220, 0, 1) !important;
}
:invalid {
box-shadow: 0 0 0 rgba(255, 0, 0, .5) !important;
-webkit-box-shadow: 0 0 0 rgba(255, 0, 0, .5) !important;
-moz-box-shadow: 0 0 0 rgba(255, 0, 0, .5) !important;
}
:invalid:focus {
box-shadow: 0 0 5px rgba(255, 0, 0, 1) !important;
-webkit-box-shadow: 0 0 5px rgba(255, 0, 0, 1) !important;
-moz-box-shadow: 0 0 5px rgba(255, 0, 0, 1) !important;
}

@media only screen and (max-width: 480px) {
table, thead, tbody, tfoot, th, td, tr { 
display:block;
text-align:left;
}
tr + tr {
margin-top:1em;
}
}
</style>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-47024499-3');
  ga('require', 'displayfeatures');
  ga('send', 'pageview');

</script>

</head>

<body>

<div id="container">

<div class="wrapper">

<center><h2>Contact Customer Service</h2></center>

  <?php
   // Start of the form!
   // The action attribute of the form is a file we control that sends the actual email to CS using a PHP mailer
   // The name and id attributes of the form, equal to "csform", are used in the validate() script below
   // The onsubmit attribute of the form is used to call two scripts that validate the form
  ?>
  <form action="/cs/cs-form-submit.php" method="post" name="csform" id="csform" onsubmit="return checkForm(this) && validate();">
  
    <table align="center" border="0" cellpadding="5" style="text-align:right;">
      <tbody>
        <tr>
          <td width="150"><label for="full_name">Full Name:</label></td>
          <td style="text-align: left;"><input class="responsive" maxlength="50" name="full_name" placeholder="Full Name" size="30" type="text" pattern="^[A-z .]{2,}$" required /><span style="color:red;"> *</span></td>
        </tr>
        <tr>
          <td><label for="email">Email Address:</label></td>
          <td style="text-align: left;"><input id="email" maxlength="80" name="email" size="30" placeholder="Email Address" type="email" value="<?php echo $emailaddress; ?>" required /><span style="color:red;"> *</span></td>
        </tr>
        <tr>
          <td>Select a Publication:</td>
          <td style="text-align: left;">
     <select id="pubselect" name="publication" style="background-color: #F8F8F8; height: 30px; padding:3px; width: 200px;" required>
         	<option value="" selected>Select One</option>
            <option value="ern">Biotech Insider Alert</option>
            <option value="edi">Capital Wave Forecast</option>
            <option value="ead">Energy Advantage</option>
            <option value="ecl">Energy Inner Circle</option>
            <option value="chn">High Velocity Profits</option>
            <option value="met">Micro Energy Trader</option>
            <option value="tmc">Money Calendar Alert</option>
            <option value="mmr">Money Map Report</option>
            <option value="mm">Money Morning</option>
            <option value="nvx">Nova-X Report</option>
            <option value="oei">Oil & Energy Investor</option>
            <option value="mml">Passport Club</option>
            <option value="mpf">Passport Fellowship</option>
            <option value="flx">Passport Select</option>
            <option value="ppt">Power Profit Trades</option>
            <option value="mmp">Private Briefing</option>
            <option value="tim">Radical Technology Profits</option>
            <option value="spn">Short-Side Fortunes</option>
            <option value="sra">Small-Cap Rocket Alert</option>
            <option value="spf">Stealth Profits Trader</option>
            <option value="sti">Strategic Tech Investor</option>
            <option value="smi">Sure Money Investor</option>
            <option value="rgd">The Money Map Project</option>
            <option value="twr">Total Wealth</option>
            <option value="wsii">Wall Street Insights & Indictments</option>
            <option value="wck">Weekly Cash Clock</option>
     </select>
        </td>
        </tr>
        <tr>
          <td>Select a Topic:</td>
          <td style="text-align: left;">
     <select id="reasons" name="reason_primary" style="background-color: #F8F8F8; height: 30px; padding:3px; width: 200px;" required>
         	<option value="" selected>Select One</option>
            <option value="Interested In Product">Product Inquiry</option>
            <option value="Editorial Feedback">Editorial Feedback</option>
            <option value="General Feedback">General Feedback</option>
            <option value="Email Problem">Email Problem</option>
            <option value="Website">Website Feedback</option>
            <option value="Order Status">Order Status</option>
            <option value="Portfolio Question">Portfolio Question</option>
            <option value="Subscription Status">Subscription Status</option>
            <option value="Change Username">Update Username</option>
            <option value="Welcome Package">Welcome Package Status</option>
            <option value="Other">Other</option>
        </select> <span style="color:red;"> *</span>
        </td>
        </tr>
        <tr>
        <td>
        </td>
        </tr>
        <tr><td>Comments:</td>
        <td style="text-align:left; float:left;"><textarea class="contact-comments" name="comments" rows="5" cols="40" placeholder="Provide additional details to expedite your request" /></textarea></td></tr>
        <tr>
			<td><label for="math_problem">What is 10 + 10?<br />
			<span style="color:#999999; font-size:10px;">To prove you are human</span></label></td>
			<td style="text-align:left;"><input maxlength="3" name="math_problem" size="2" type="text" required /> <span style="color:red;"> *</span></td>
		</tr>
        <tr>
          <td align="center" colspan="2" id="submitButton" style="margin-top: 10px;"><center>
              <input type="submit" value="SUBMIT" style="height: 30px; padding: 7px; width: 100px; background-color: grey; color: white;" />
              <br />
              <label><span style="color: rgb(153, 153, 153); font-size: 12px; margin-top: 10px; display: block;">We value your privacy.<br /><span style="color:red;">*required fields</span></span></label>
            </center></td>
        </tr>
      </tbody>
    </table>
    
    <?php
	// Add two more hiddent fields to pass information about the user through the form
	// browserinfo and listcode are necessary and still in use
	// pubtype is a legacy field that is not used anymore so it's commented out.
	?>
      
    <input type="hidden" name="browserinfo" value="<?php echo $browser ?>" />
    <input type="hidden" name="listcode" value="<?php echo $listcode ?>" />
    <input type="hidden" name="domain" value="<?php echo $domain ?>" />
    <input type="hidden" name="customernumber" value="" />
    <input type="hidden" name="customerlists" value="" />
    <input type="hidden" name="customerpubs" value="" />
    <input type="hidden" name="referralUrl" id="referralUrl" value="" />

    <!-- <input type="hidden" name="pubtype" value="<?php // echo $init_pubtype; ?>" id="pubtypeinput" /> -->
  </form>
 
 <!--get the parent url the iframe is laid down on-->
 <script type="text/javascript">
    var parentURL = document.referrer;
    document.getElementById('referralUrl').value = parentURL;
 </script>

<?php
// Use JS to check the value of the Math Problem and prevent spam
?>
<script type="text/javascript">
function checkForm(form) {
	if(form.math_problem.value != 20){
		alert("Please answer the math problem correctly");
		form.math_problem.focus();
		return false;
	} // end if
} // end checkForm
</script>

<?php
// Form validation code!
// This function is called by the onsubmit attribute of the form
// It checks that values of all of the form fields match the required input
?>
<script type="text/javascript">
function validate()
{
 
   if( document.csform.full_name.value == "" )
   {
     alert( "First name required" );
     document.csform.full_name.focus() ;
     return false;
   }
  
   if( document.csform.email.value == "" )
   {
     alert( "Email address required" );
     document.csform.email.focus() ;
     return false;
   }
   
   var asdf=document.csform.email.value;
   var atpos=asdf.indexOf("@");
   var dotpos=asdf.lastIndexOf(".");
   if (atpos<1 || dotpos<atpos+2 || dotpos+2>=asdf.length)
  	{
  		alert("Not a valid e-mail address");
  		return false;
  	}
   
   if( document.csform.phone_number.value == "" )
   {
     alert( "Valid phone number required" );
     document.csform.phone_number.focus() ;
     return false;
   }
   /*if( document.csform.preferred_contact.value == "" )
   {
     alert( "Preferred contact method required" );
     document.csform.preferred_contact.focus() ;
     return false;
   }*/
   if( document.csform.reason_primary.value == "")
   {
     alert( "Issue required" );
     document.csform.reason_primary.focus() ;
     return false;
   }
   return( true );
}

<?php
// Every time the Select a Publication dropdown changes, set the currSelect variable to that value
?>
$("#pubselect").change(function () {  
   var currSelect = "";   
   $("#pubselect option:selected").each(function() {   
       currSelect = $(this).text();
   });
		   // If RGD is selected, disable certain options in the Select a Topic dropdown
		   if(currSelect == "The Money Map Project") {
			   $("#reasons option[value='Cancel Subscription']").attr('disabled','disabled');	
			   $("#reasons option[value='Cancel Auto-Renew']").attr('disabled','disabled');			      
		   } else {
			   $("#reasons option[value='Cancel Subscription']").removeAttr('disabled','disabled');	
			   $("#reasons option[value='Cancel Auto-Renew']").removeAttr('disabled','disabled');			      
		   }
});

<?php
// Every time the Select a Topic dropdown changes, set the currReason variable to that value
?>
$("#reasons").change(function () {  
   var currReason = "";   
   $("#reasons option:selected").each(function() {   
       currReason = $(this).text();
   });

		   <?php
			 // If the Renewal or Cancel topics are selected, disable RGD
		   ?>
		   if(currReason == "Automatic Renewal Status" || currReason == "Cancel Subscription") {
			   $("#pubselect option[value='rgd']").attr('disabled','disabled');	
		   } else {
			   $("#pubselect option[value='rgd']").removeAttr('disabled','disabled');	
		   }
});

<?php
// On page load, set the initial value of the Select a Publication dropdown to the value of the php var $pubcode
?>
$("#pubselect>option[value='<?php echo $pubcode; ?>'").prop('selected', true);
</script>

</div>
</div>

</body>
</html>