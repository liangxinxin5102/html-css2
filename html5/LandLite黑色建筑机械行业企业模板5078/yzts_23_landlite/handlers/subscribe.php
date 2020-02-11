<?php
require_once("MailChimp.class.php");
$email = $_POST['email'];
$MailChimp = new MailChimp('YOUR API KEY HERE');
$result = $MailChimp->call('lists/subscribe', array(
                'id'                => 'YOUR MAILChimp List ID HERE',
                'email'             => array('email'=>$email),
                'double_optin'      => false,
                'update_existing'   => true,
                'replace_interests' => false,
                'send_welcome'      => false,
            ));

$data = json_decode($result);

if ($data->error){
    echo $data->error;
	throw new Exception();
} else {
    echo "Got it, you've been added to our email list.";
}
?>