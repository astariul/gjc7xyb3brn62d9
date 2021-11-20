<?php
// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['phone']) 		||
   empty($_POST['message'])) {
	  echo "No arguments Provided!";
	  return false;
   }
	
$name = $_POST['name'];
$email_address = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];
$rsvp = $_POST['rsvp'];

if ($rsvp == "oui") {
   $reponse = "Oui je viendrais";
}
if ($rsvp == "nesaispas") {
   $reponse = "Je ne sais pas";
}
if ($rsvp == "non") {
   $reponse = "Non je ne viendrais pas";
}

function mailFree($to , $subject , $message , $additional_headers=null , $additional_parameters=null) {
   $start_time = time();
   $resultat=mail ( $to , $subject, $message, $additional_headers, $additional_parameters);
   $time= time()-$start_time;
   return $resultat & ($time>1);
}

$out='';
$res=false;

// Create the email and send the message
$to = 'mariage.mira.nicolas@gmail.com';
$email_subject = "[RSVP] - $name a repondu a l'invitation";
$email_body = "
   <h4>$name a répondu à l'invitation !!</h4>
   <dl>
      <dt>Sa réponse :</dt>
      <dd><strong>$reponse</strong></dd>
      <dt>Son message :</dt>
      <dd><span style='color:#777;font-style:italic'>$message</span></dd>
      <dt>Ses informations de contact :</dt>
      <dd>
         $email_address<br/>
         $phone
      </dd>
   </dl>";
$headers  = "From: noreply@remond.co\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n";
$headers .= "Return-Path: remondnicola@gmail.com\r\n";
//mail($to,$email_subject,$email_body,$headers);
if (mailFree( $to, $email_subject , $email_body, $headers )==false) {
   echo "<pre style='border: 1px dotted #666666;padding:10px;'><code>L'envoi du message n'a pas été réalisé en raison des limitations des serveurs de Free, merci de réessayer un peu plus tard.</code></pre>";
   $res=false;
}
return $res;
?>