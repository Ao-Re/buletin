<?php
if(isset($_POST)){		
	$captcha=$_POST['g-recaptcha-response'];
	$ip = $_SERVER['REMOTE_ADDR'];
	$secretkey = "6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe";					
	$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretkey."&response=".$captcha."&remoteip=".$ip);
	$responseKeys = json_decode($response,true);	     

	if(intval($responseKeys["success"]) !== 1) {
	    echo '<h2>Wrong captcha try again please!</h2>';
	} else {
	    echo '<h2>Success!</h2>';	        	
	}	                
}
?>