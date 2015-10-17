# SesSdkDemo
Demo using AWS SDK for PHP V3 to send emails through SES. 

This demo requires a sescredentials.php file to be created with the following format:
<?php
$key = "YourAccessKey";
$secret = "YourSecretKey";
?>

The IAM entity associated with the key pair will need ses:SendEmail action allowed.
