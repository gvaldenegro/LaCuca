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
 * Set the subject
 */
$subjectMsg = 'RE: Detalles de reserva para';

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
	$msg = "Nombre: ".$_POST['book-name']."\r\n";
	$msg .= "Personas: ".$_POST['book-guests']."\r\n";
	$msg .= "Fecha: ".$_POST['book-date']."\r\n";
	$msg .= "Hora: ".$_POST['book-time']."\r\n";
	$msg .= "Teléfono: ".$_POST['book-phone']."\r\n";
	
    $success = @mail($mailTo, $subjectMsg . ' ' . $_POST['book-name'] , $msg, 'From: ' . $_POST['book-name'] . '<' . $mailTo . '>');
	
    if ($success) {
		$json_arr = array( "type" => "success", "msg" => $successMsg );
		echo json_encode( $json_arr );
    } else {
		$json_arr = array( "type" => "error", "msg" => $errorMsg );
		echo json_encode( $json_arr );
    }
}