<?php
// define variables and set to empty values
$email = $name = $capresponse = $comment = "";

$error="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //collect data from post html post request.
  $email = test_input($_POST["Email"]);
  $name = test_input($_POST["name"]);
  $capresponse = test_input($_POST["g-recaptcha-response"]);
  $comment = test_input($_POST["comment"]);
}

if ($email!="" && $name!="" && $comment!="" && $capresponse!="")
  {
  if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
      //your site secret key
      $secret = 'Your secret code goes here';
      //get verify response data
      $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
      $responseData = json_decode($verifyResponse);
      if($responseData->success)
      {
          //contact form submission code
          //destination email
          $to = 'youremail@youremail.com';
          //subject line will look like this
          $subject = 'New comment from '.$name.' via the website!';
          //this is what the email will look like.
          $htmlContent = "
              <h1>Message:</h1>
              <h2>Contactor details</h2>
              <p><b>Name: </b>".$name."</p>
              <p><b>email: </b>".$email."</p>
              <h2>Content: </h2>
              <p><b>Comment: </b>".$comment."</p>
          ";
          // Always set content-type when sending HTML email
          $headers = "MIME-Version: 1.0" . "\n";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\n";
          // More headers
          $headers .= 'From:'.$name.' <donotreply@yoursite.com>' . "\n";
          //send email
          if (mail($to,$subject,$htmlContent,$headers))
          {
             $error="Success! Your message is on its way. Our team will respond when they can.";
          }
          else
          {
              $error="Something went wrong while sending the message on our end. We'll sort it out. Try again in a few hours.";
          }
  
  
      }
      else
      {
        $error="Google error code! Code type: ".($responsedata->error-codes);
      }
    }
    else
    {$error="Sorry! We couldn't verify if you were a bot or not. Please go back and make sure you entered the CAPTCHA.";}
  }
else
{
  $error="Please ensure all form inputs are filled. Press back and make sure to do so.";
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$ech=$error;
echo $error;
?>

