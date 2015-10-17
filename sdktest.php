<?php
require('sdksendmail.php');
$time=date('H:i',time());
$from = "AnSesValidated@email.com";  //Put your actual email address here.
$fromH = "A Human Readable Email Source";  //Optional
$to = ['bounce@simulator.amazonses.com',]; //SES Bounce simulator Address for testing
$cc = [];                               //to,cc,bcc addresses must be arrays
$bcc = [];
$subject = "Test mail $time sent through SES";  //Your preferred subject line
$bodyH = "This message body contains <strong>HTML formatting</strong>. It can, <i>for example</i>, contain links like this one: <a class=\"ulink\" href=\"http://docs.aws.amazon.com/ses/latest/DeveloperGuide\" target=\"_blank\">Amazon SES Developer Guide</a>.";
$bodyT = "This is the message body in text format. It contains no links and no formatting.";
$result = Send_Mail($from,$fromH,$to,$cc,$bcc,$subject,$bodyH,$bodyT);
echo "Email sending...\r\n";
echo $result."\r\n";
?>
