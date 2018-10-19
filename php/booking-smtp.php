<?php
/**
* @package   gaucho
* @author    arrowthemes https://arrowthemes.com
* @copyright Copyright (C) arrowthemes
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

/**
* @package   gaucho
* @author    arrowthemes https://arrowthemes.com
* @copyright Copyright (C) arrowthemes
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

/**
 * EDIT THE VALUES BELOW THIS LINE TO ADJUST THE CONFIGURATION
 * EACH OPTION HAS A COMMENT ABOVE IT WITH A DESCRIPTION
 */
/**
 * Specify the email address to which all mail messages are sent.
 * The script will try to use PHP's mail() function,
 * so if it is not properly configured it will fail silently (no error).
 */
 
ini_set("include_path", '/home3/alfrescofoods/php:' . ini_get("include_path") );
require_once "Mail.php";
 
$mailTo   = "info@arrowthemes.com";
$from 	  = "info@alfrescofoods.in";
$host 	  = "mail.alfrescofoods.in";
$username = "info@alfrescofoods.in";
$password = "u5aPqtVdX;CB";

/**
 * Set the subject
 */
$subjectMsg = 'RE: Reservation details for';

/**
 * Set the message that will be shown on success
 */
$successMsg = 'Thank you, mail sent successfully!';

/**
 * Set the message that will be shown if not all fields are filled
 */
$fillMsg    = 'Please fill all fields!';

/**
 * Set the message that will be shown on error
 */
$errorMsg   = 'Hmmm... there seems to be a problem, sorry!';

/**
 * DO NOT EDIT ANYTHING BELOW THIS LINE, UNLESS YOU'RE SURE WHAT YOU'RE DOING
 */

?>
<?php
if(
    !isset($_POST['book-name']) ||
	!isset($_POST['book-guests']) ||
	!isset($_POST['book-date']) ||
	!isset($_POST['book-time']) ||
	!isset($_POST['book-phone']) ||
    empty($_POST['book-name']) ||
    empty($_POST['book-guests']) ||
    empty($_POST['book-date']) ||
    empty($_POST['book-time']) ||
	empty($_POST['book-phone'])
) {
	$json_arr = array( "type" => "error", "msg" => "$fillMsg" );
	echo json_encode( $json_arr );
} else {

    ?>
    <?php
	$msg = "Name: ".$_POST['book-name']."\r\n";
	$msg .= "No. of Guests: ".$_POST['book-guests']."\r\n";
	$msg .= "Date: ".$_POST['book-date']."\r\n";
	$msg .= "Time: ".$_POST['book-time']."\r\n";
	$msg .= "Phone number: ".$_POST['book-phone']."\r\n";
    
 $smtp = Mail::factory('smtp',
   array ('host' => $host,
     'auth' => true,
     'username' => $username,
     'password' => $password));
 
 $headers = array ('From' => $from,
   'To' => $mailTo,
   'Subject' => $subjectMsg . ' ' . $_POST['book-name']);
 
 	$mail = $smtp->send($mailTo, $headers, $msg);
	if (PEAR::isError($mail)) {
	   $json_arr = array( "type" => "error", "msg" => $mail->getMessage() );
		echo json_encode( $json_arr );
	} else {
   	   $json_arr = array( "type" => "success", "msg" => $successMsg );
		echo json_encode( $json_arr ); 
	}
}