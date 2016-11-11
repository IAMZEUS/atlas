 <?php
if(isset($_POST['submit'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "ethan@paywithatlas.com";
    $email_subject = "Atlas Demo Form Submission";
 
    // validation expected data exists
    if(!isset($_POST['name']) ||        
        !isset($_POST['email']) ||        
        !isset($_POST['phone']) ||        
        !isset($_POST['organization']) ||        
        !isset($_POST['role']) ||        
        !isset($_POST['providers']) ||        
        !isset($_POST['patients'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted. Please try filling in all fields');       
    }
 
    $name_from = $_POST['name']; // required
    $email_from = $_POST['email']; // required    
    $phone_from = $_POST['phone']; // required    
    $organization_from = $_POST['organization']; // required    
    $role_from = $_POST['role']; // required
	$providers_from = $_POST['providers']; // required 
	$patients_from = $_POST['patients']; // required     
    // $comments = $_POST['comments']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
    $string_exp = "/^[A-Za-z\s.'-]+$/";
  if(!preg_match($string_exp,$name_from)) {
    $error_message .= 'The Name you entered does not appear to be valid.<br />';
  }

  if(strlen($error_message) > 0) {
    died($error_message);
  }
  
    $email_message = "Form details below.\n\n";
 
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
    $email_message .= "Name: ".clean_string($name_from)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";   
    $email_message .= "Phone: ".clean_string($phone_from)."\n";
    $email_message .= "Organization: ".clean_string($organization_from)."\n";
    $email_message .= "Role: ".clean_string($role_from)."\n";
	$email_message .= "Providers: ".clean_string($providers_from)."\n";
	$email_message .= "Patients: ".clean_string($patients_from)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);
sleep(1);

echo "<script>alert('Thank You. An Atlas representative will contact you soon.')</script> <meta http-equiv='refresh' content=\"0; url=http://paywithatlas.com\">";
?>
 