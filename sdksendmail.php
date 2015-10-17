<?php
// SES SendMail demo
// Using AWS SDK for PHP V3
// -kyle138

require(dirname(__FILE__).'/include/aws/aws-autoloader.php');
require(dirname(__FILE__).'/sescredentials.php');

use Aws\Ses\SesClient;
use Aws\Ses\Exception\SesException;

// Initialize SES Credentials
// Stored separately in sescredentials.php for security reasons
// sescredentials.php are NOT kept in the git repo (see security reasons above)
$credentials = new Aws\Credentials\Credentials($key,$secret);

function Send_Mail($from,$fromH=NULL,$to=[],$cc=[],$bcc=[],$subject,$bodyH,$bodyT)
{
  // Initialization of initializing the initial variables, initially.
  global $credentials;  //Considering the scope of things. Get it? Scope?
  $fromAdrs=$from;
  $sourceAdrs=isset($fromH)?$fromH.'<'.$fromAdrs.'>':$fromAdrs;
  $toAdrs=$to;
  $ccAdrs=$cc;
  $bccAdrs=$bcc;
  $Subject = [
    'Charset' => 'UTF-8',
    'Data' => $subject,
  ];
  $body = [
    'Html' => [
      'Charset' => 'UTF-8',
      'Data' => $bodyH,
    ],
    'Text' => [
      'Charset' => 'UTF-8',
      'Data' => $bodyT,
    ],
  ];

  //Create AWS connection and SesClient
  $SesClient = new Aws\Ses\SesClient([
    'version'   =>  'latest',     // I'm told that using 'latest' is dangerous,
    'region'    =>  'us-east-1',  // Danger is my middle name.  o.O
    'credentials' =>  $credentials
  ]);

  $result = $SesClient->sendEmail([
    'Destination' => [
      'BccAddresses' => $bccAdrs,
      'CcAddresses' => $ccAdrs,
      'ToAddresses' => $toAdrs,
    ],
    'Message' => [
      'Body' => $body,
      'Subject' => $Subject,
    ],
    'ReplyToAddresses' => [$fromAdrs],
    'ReturnPath' => $fromAdrs,
    'Source' => $sourceAdrs,
  ]);
//  echo "Result: $result\r\n";   //DEBUG

  return $result['MessageId'];
}
?>
