<?php 
/**
 * Create the array to be used later
 * and stringified
 * @var array
 */

switch($_POST['formtype']):

	case "contact":
		$data = array(
			'fields_email' => $_POST['fields_email'],
			'fields_fname' => $_POST['fields_fname'],
			'fields_lname' => $_POST['fields_lname'],
			'fields_phone' => $_POST['fields_phone'],
			'listid' => 123424,
			'specialid:123424' => 'NWT7',
			'clientid' => 470377,
			'formid' => 7386,
			'reallistid' => 1,
			'doubleopt' => 0,
			'redirect'=>'none',
			'errorredirect'=>'none'
		);
		$subjectText = 'Arizona United Contact Inquiry';
		$message = array(
			'First Name' => $_POST['fields_fname'],
			'Last Name' => $_POST['fields_lname'],
			'Email Address' => $_POST['fields_email'],
			'Phone Number' => $_POST['fields_phone'],
			'Comments' => $_POST['comments']
		);
	break;

	case "group":
		$data = array(
			'fields_email' => $_POST['fields_email'],
			'fields_fname' => $_POST['fields_fname'],
			'fields_lname' => $_POST['fields_lname'],
			'fields_phone' => $_POST['fields_phone'],
			'fields_games' => $_POST['fields_games'],
			'fields_amountoftickets' => $_POST['fields_amountoftickets'],
			'fields_questions' => $_POST['fields_questions'],
			'listid' => 123710,
			'specialid:123710' => 'NWT7',
			'clientid' => 470377,
			'formid' => 7405,
			'reallistid' => 1,
			'doubleopt' => 0,
			'redirect'=>'none',
			'errorredirect'=>'none'
		);
		$subjectText = 'Arizona United Group Tickets Inquiry';
		$message = array(
			'First Name' => $_POST['fields_fname'],
			'Last Name' => $_POST['fields_lname'],
			'Email Address' => $_POST['fields_email'],
			'Phone Number' => $_POST['fields_phone'],
			'Chosen Game' => $_POST['fields_games'],
			'Amount of Tickets Requested' => $_POST['fields_amountoftickets'],
			'Questions / Comments' => $_POST['fields_questions']
		);
	break;

	case "family":
		$data = array(
			'fields_email' => $_POST['fields_email'],
			'fields_fname' => $_POST['fields_fname'],
			'fields_lname' => $_POST['fields_lname'],
			'fields_games' => $_POST['fields_games'],
			'fields_amountoftickets' => $_POST['fields_amountoftickets'],
			'fields_questions' => $_POST['fields_questions'],
			'listid' => 123712,
			'specialid:123712' => 'NWT7',
			'clientid' => 470377,
			'formid' => 7406,
			'reallistid' => 1,
			'doubleopt' => 0,
			'redirect'=>'none',
			'errorredirect'=>'none'
		);
		$subjectText = 'Arizona United Family 4 Pack Inquiry';
		$message = array(
			'First Name' => $_POST['fields_fname'],
			'Last Name' => $_POST['fields_lname'],
			'Email Address' => $_POST['fields_email'],
			'Phone Number' => $_POST['fields_phone'],
			'Chosen Game' => $_POST['fields_games'],
			'Amount of Tickets Requested' => $_POST['fields_amountoftickets'],
			'Questions / Comments' => $_POST['fields_questions']
		);
	break;

	case "volunteer":
		$data = array(
			'fields_email' => $_POST['fields_email'],
			'fields_fname' => $_POST['fields_fname'],
			'fields_lname' => $_POST['fields_lname'],
			'fields_tellusalittleaboutyourself' => $_POST['fields_tellusalittleaboutyourself'],
			'fields_workedwithsportsteamsbefore' => $_POST['fields_workedwithsportsteamsbefore'],
			'fields_questions' => $_POST['fields_questions'],
			'listid' => 123713,
			'specialid:123713' => 'NWT7',
			'clientid' => 470377,
			'formid' => 7407,
			'reallistid' => 1,
			'doubleopt' => 0,
			'redirect'=>'none',
			'errorredirect'=>'none'
		);
		$subjectText = 'Arizona United Volunteer Inquiry';
		$message = array(
			'First Name' => $_POST['fields_fname'],
			'Last Name' => $_POST['fields_lname'],
			'Email Address' => $_POST['fields_email'],
			'Tell us about yourself' => $_POST['fields_tellusalittleaboutyourself'],
			'Have you worked with a sports team before' => $_POST['fields_amountoftickets'],
			'Questions / Comments' => $_POST['fields_questions']
		);
	break;

	case "newsletter":
		$data = array(
			'fields_email' => $_POST['email'],
			'listid' => 123311,
			'specialid:123311' => '3VM1',
			'clientid' => 470377,
			'formid' => 7386,
			'reallistid' => 1,
			'doubleopt' => 0,
			'redirect'=>'none',
			'errorredirect'=>'none'
		);
		$subjectText = 'Arizona United Newsletter';
		$message = array(
			'Email Address' => $_POST['email']
		);
	break;

endswitch;


$url = 'https://app.icontact.com/icp/signup.php';
$urlify = http_build_query($data, '&');

/**
 * post to iContact
 * @var array + string
 */
$ch = curl_init(); // initiate curl
$url = $url; // where you want to post data
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST, true);  // tell curl you want to post something
curl_setopt($ch, CURLOPT_POSTFIELDS, $urlify); // define what you want to post
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return the output in string format
$output = curl_exec ($ch); // execute
curl_close ($ch); // close curl handle


/**
 * Send an email to the admin
 */
//$to = 'tickets@arizonaunited.com'; // live email
$to = 'ehsanmarco@gmail.com'; // test email

$subject = $subjectText;

$headers = "From: Arizona United <noreply@arizonaunited.com>\r\n";
$headers .= "Reply-To: noreply@arizonaunited.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$html .= '<html><body>';
foreach ($message as $key => $info):
	$html .= '<p><strong>'.$key.'</strong> '.$info.'</p>';
endforeach;
$html .= '</body></html>';

mail($to, $subject, $html, $headers);


echo json_encode(array('status' => 'success', 'type' => $urlify));


