<?php
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
$mailTo     = 'reservascucavina@gmail.com';

/**
 * Set the message that will be shown on success
 */
$successMsg = 'Muchas gracias, hemos recibido su mensaje!';

/**
 * Set the message that will be shown if not all fields are filled
 */
$fillMsg    = 'Por favor complete todos los campos!';

/**
 * Set the message that will be shown on error
 */
$errorMsg   = 'Hmmm ... parece que hay un problema!, por favor intentelo nuevamente';

/**
 * DO NOT EDIT ANYTHING BELOW THIS LINE, UNLESS YOU'RE SURE WHAT YOU'RE DOING
 */

?>
<?php
if(
    !isset($_POST['contact-name']) ||
	!isset($_POST['contact-email']) ||
	!isset($_POST['contact-subject']) ||
	!isset($_POST['contact-message']) ||
    empty($_POST['contact-name']) ||
    empty($_POST['contact-email']) ||
    empty($_POST['contact-subject']) ||
	empty($_POST['contact-message'])
) {
	$json_arr = array( "type" => "error", "msg" => $fillMsg );
	echo json_encode( $json_arr );
} else {

    ?>
    <?php
	$msg = "Nombre: ".$_POST['contact-name']."\r\n";
	$msg .= "Email: ".$_POST['contact-email']."\r\n";
	$msg .= "Asunto: ".$_POST['contact-subject']."\r\n";
	$msg .= "Mensaje: ".$_POST['contact-message']."\r\n";
	
    $success = @mail($mailTo, $_POST['contact-subject'], $msg, 'From: ' . $_POST['contact-name'] . '<' . $_POST['contact-email'] . '>');
	
    if ($success) {
		$json_arr = array( "type" => "success", "msg" => $successMsg );
		echo json_encode( $json_arr );
    } else {
		$json_arr = array( "type" => "error", "msg" => $errorMsg );
		echo json_encode( $json_arr );
    }
}