<?php

	// GET NEEDED DATA
	$mclc6397_to = get_bloginfo('admin_email');
	$mclc6397_from = get_bloginfo('name'); 
	$mclc6397_fromName = get_bloginfo('name'); 
	$mclc6397_subject = "Settings Updated on Plugin: MC Login Code"; 
	$mclc6397_graphicUrl = plugins_url( 'mc-login-code/assets/MC-LC-Head.jpg', _FILE_ );

 
	// SET CONTENT-TYPE HEADER
	$mclc6397_headers  = 'MIME-Version: 1.0' . "\r\n";
	$mclc6397_headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 

	// CREATE THE EMAIL HEADERS
	$mclc6397_headers .= 'From: '.$mclc6397_from."\r\n".
    'Reply-To: '.$mclc6397_from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
 
	// CREATE THE EMAIL MESSAGE

	$mclc6397_message = '<html><body>';
	$mclc6397_message .= '<img src="'.$mclc6397_graphicUrl.'">';
	$mclc6397_message .= "<h2> On your website, $mclc6397_fromName, settings have been updated on the plugin: MC Login Code. Your third-field login code</h2>";
	$mclc6397_message .= "<h2 style='color:blue;'>Is Now Disabled</h2>";
	$mclc6397_message .= ' 
    <html> 
    <body> 
        <table cellspacing="0" style="font-size:18px; "border: 1px solid #FB4314; width: 100%;"> 

	<td><p>The Login Code field has been removed from your website login form. No third-field Login Code is now needed to log in.</p> <p>You can add a Login Code at any time by again saving a Login Code in the plugin settings page. The third field will again appear on your login form along with your username and password fields.</p></td> 
            </tr> 
        </table> 
    </body> 
    </html>'; 
 
	// SEND THE EMAIL
	mail($mclc6397_to, $mclc6397_subject, $mclc6397_message, $mclc6397_headers)
?>
