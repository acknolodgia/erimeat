<?php
require_once '../config/database.php';
require_once '../config/Models.php';

$action = $_GET['action'];

switch ($action) {

	case 'create' :
		create();
		break;

	case 'clientRequest' :
		clientRequest();
		break;

	case 'submitResume' :
		submitResume();
		break;

	case 'submitApplication' :
		submitApplication();
		break;

	case 'sendInquiry' :
		sendInquiry();
		break;

	default :
}

function create()
{

	// This is if you want to get the last 6 digits
	/*
substr(round(microtime(true)), -6)

	*/

	$job = job();
	$job->obj['refNum'] = round(microtime(true));
	$job->obj['jobFunctionId'] = $_POST['jobFunctionId'];
	$job->obj['positionTypeId'] = $_POST['positionTypeId'];
	$job->obj['contactName'] = $_POST['contactName'];
	$job->obj['position'] = $_POST['position'];
	$job->obj['company'] = $_POST['company'];
	$job->obj['abn'] = $_POST['abn'];
	$job->obj['comment'] = $_POST['comment'];
	$job->obj['address'] = $_POST['address'];
	$job->obj['workEmail'] = $_POST['workEmail'];
	$job->obj['jobTitle'] = $_POST['jobTitle'];
	$job->obj['businessPhone'] = $_POST['businessPhone'];
	$job->obj['zipCode'] = $_POST['zipCode'];
	$job->obj['requiredExperience'] = $_POST['requiredExperience'];
	$job->create();

	// Send email
	$content = __talentRequestEmailMessage();
	$hrmessage = __hrEmailMessage();
	$adminmessage = __adminEmailMessage();

	sendEmail($obj->workEmail, $content);
	//for HR
	sendEmail('rgmak12@gmail.com',$hrmessage);
	//for admin
	sendEmail('torredale1014@gmail.com',$adminmessage);


	header('Location: ../company/');
}

function clientRequest()
{

	// This is if you want to get the last 6 digits
	/*
substr(round(microtime(true)), -6)

	*/
	$com = company();
	$com->obj['username'] = '';
	$com->obj['jobFunctionId'] = $_POST['jobFunctionId'];
	$com->obj['department'] = $_POST['department'];
	$com->obj['name'] = $_POST['name'];
	$com->obj['abn'] = $_POST['abn'];
	$com->obj['contactPerson'] = $_POST['contactPerson'];
	$com->obj['email'] = $_POST['email'];
	$com->obj['address'] = $_POST['address'];
	$com->obj['phoneNumber'] = $_POST['phoneNumber'];
	$com->obj['>mobileNumber'] = $_POST['mobileNumber'];
	$com->obj['description ']= $_POST['description'];
	$com->create();

	// Send email
	$content = __clientRequestEmailMessage();
	/* should also send email to hr and admin */
	sendEmail($obj->email, $content);

	header('Location: ../home/?view=success');
}

function submitResume(){

		$upload = uploadFile($_FILES['upload_file']);
		if ($upload)
		{
			$res = resume();
			$res->['jobId'] = "0";
			$res->['jobFunctionId'] = $_POST["jobFunctionId"];
			$res->['firstName'] = $_POST["firstName"];
			$res->['lastName']= $_POST["lastName"];
			$res->['abn'] = $_POST["abn"];
			$res->['taxNumber'] = $_POST["taxNumber"];
			$res->['email'] = $_POST["email"];
			$res->['phoneNumber'] = $_POST["phoneNumber"];
			$res->['address1'] = $_POST["address1"];
			$res->['address2'] = $_POST["address2"];
			$res->['city'] = $_POST["city"];
			$res->['state'] = $_POST["state"];
			$res->['zipCode'] = $_POST["zipCode"];
			$res->['speedtest'] = $_POST["speedtest"];
			$res->['coverLetter'] = $_POST["coverLetter"];
			$res->['uploadedResume'] = $upload;
			$res->['uploadedSpecs'] = $_POST["upload_specs"];
			$res->create();

			// Send email
			$content = __submitResumeEmailMessage();
			/* should also send email to hr and admin */
			sendEmail($obj->email, $content);

			header('Location: ../home/?view=success');
		}
		else{
			header('Location: ../home/?error=Not uploaded');
		}
}

function submitApplication()
{
		$upload = uploadFile($_FILES['upload_file']);
		if ($upload)
		{
			$obj = new Resume;
			$res = resume();
			$res->obj['jobId'] = $_POST["jobId"];
			$res->obj['jobFunctionId'] = $_POST["jobFunctionId"];
			$res->obj['firstName'] = $_POST["firstName"];
			$res->obj['lastName']= $_POST["lastName"];
			$res->obj['abn'] = $_POST["abn"];
			$res->obj['taxNumber'] = $_POST["taxNumber"];
			$res->obj['email'] = $_POST["email"];
			$res->obj['phoneNumber'] = $_POST["phoneNumber"];
			$res->['address1'] = $_POST["address1"];
			$res->['address2'] = $_POST["address2"];
			$res->['city'] = $_POST["city"];
			$res->['state'] = $_POST["state"];
			$res->['zipCode'] = $_POST["zipCode"];
			$res->['speedtest'] = $_POST["speedtest"];
			$res->['coverLetter'] = $_POST["coverLetter"];
			$res->['uploadedResume'] = $upload;
			$res->['uploadedSpecs'] = $_POST["upload_specs"];
			$res->create();
			// Send Email
			$content = __submitApplicationEmailMessage();
			/* should also send email to hr and admin */
			sendEmail($obj->email, $content);
			header('Location: ../home/?view=success');
		}
		else{
			header('Location: ../home/?error=Not uploaded');
		}
}

function sendInquiry()
{
		$inq = inquiries();
		$inq->obj['firstName'] = $_POST["firstName"];
		$inq->obj['lastName'] = $_POST["lastName"];
		$inq->obj['phoneNumber'] = $_POST["phoneNumber"];
		$inq->obj['jobFunctionId'] = $_POST["jobFunctionId"];
		$inq->obj['workEmail'] = $_POST["workEmail"];
		$inq->obj['zipCode'] $_POST["zipCode"];
		$inq->obj['message'] = $_POST["message"];
		$inq->create());

		header('Location: ../home/?view=success');
}


/* ======================== Email Messages ==============================*/

function __talentRequestEmailMessage(){
	return "We have received your request. Thank you for showing interest in our company in looking for your candidate.<br>
					Please be informed that we are in the midst of processing your request and shall get<br>
					in touch with you again if your request has met our condition.<br><br>
					Teamire";
}

function __submitResumeEmailMessage(){
	return "Thank you for submiting your resume to Teamire. As of now, we are still reviewing your documents.<br>
					If we find any of our current opportunities that match your qualifications, we will contact you with the<br>
					next steps of your application.<br><br>
					We look forward to assisting you with your job search!<br><br>
					Teamire";
}

function __submitApplicationEmailMessage(){
	return "We have recieved your application. Thank you for the interest shown in our company.<br><br>
					Please be informed that we are in the midst of processing the applications and shall get<br>
					in touch with you again if you are shortlisted for an interview.<br><br>
					Teamire";
}

function __clientRequestEmailMessage(){
	return "We have received your request. Thank you for the interest shown in our company.<br><br>
					Please be informed that we are in the midst of processing your request and shall get<br>
					in touch with you again once you've meet our requirements.<br><br>
					Teamire";
}
function __hrEmailMessage(){
	return "hr ni";
}
function __adminEmailMessage(){
	return "admin ni";
}
?>
