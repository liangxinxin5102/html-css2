<?php
    
    $formType = $_POST["formType"];
    $MailTo = 'your domain/personal mail address';

    $txtName = $_POST["txtName"];
    $txtEmail = $_POST["txtEmail"];
    $txtRating = "";
    $txtWebsite = "";
    $txtMessage = $_POST["txtMessage"];
    
    if ($formType == "comments") {
        $txtWebsite = $_POST["txtWebsite"];
    }
    
    if ($formType == "reviews") {
        $txtRating = $_POST["txtRating"];
    }
    
    $success = TRUE;    
    
    try{
        if(trim($txtEmail)==NULL){
            throw new Exception("Please enter your e-mail id.");
        }
        else
        {
            if (!preg_match("/\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/", trim($txtEmail)))
            {
                throw new Exception("Please enter the valid e-mail.");
            }
        }

        if(trim($txtName)==NULL){
            throw new Exception("Please enter your name.");
        }
    
        if(trim($txtMessage)==NULL){
            throw new Exception("Please enter your message.");
        }
    
        if($formType == "contact") {   
            $MailSubject = "New Contact Mail";
            $MailBody = "<strong>Email: </strong> ".$txtEmail."<br />";
            $MailBody .= "<strong>Name: </strong> ".$txtName."<br />";
            $MailBody .= "<strong>Message: </strong> ".$txtMessage."<br />";
        }

        if($formType == "comments") {   
            $MailSubject = "New Comment Mail";
            $MailBody = "<strong>Email: </strong> ".$txtEmail."<br />";
            $MailBody .= "<strong>Name: </strong> ".$txtName."<br />";
            $MailBody .= "<strong>Website: </strong> ".$txtWebsite."<br />";
            $MailBody .= "<strong>Comment: </strong> ".$txtMessage."<br />";
        }

        if($formType == "reviews") {   
            $MailSubject = "New Review Mail";
            $MailBody = "<strong>Email: </strong> ".$txtEmail."<br />";
            $MailBody .= "<strong>Name: </strong> ".$txtName."<br />";
            $MailBody .= "<strong>Rating: </strong> ".$txtRating."<br />";
            $MailBody .= "<strong>Review: </strong> ".$txtMessage."<br />";
        }
    
        $MailFrom = $txtEmail;
    
        $MailHeaders = 'MIME-Version: 1.0' . "\r\n";
        $MailHeaders .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    
        $MailHeaders .= "From: <".$txtEmail.">"."\r\n";
    
    
        $result =  mail($MailTo, $MailSubject, $MailBody, $MailHeaders);
    
        if(!$result){
            throw new Exception("Mail was not sent :(");
        }
    
        $success = TRUE;
    }
    catch (Exception $e){
        header("Status: 400 Bad Request", TRUE, 400);
        echo($e->getMessage());
        $success = FALSE;
    }
    
    if ($success)
    {
        header("Status: 200 OK", TRUE, 200);    
        // add your custom success message here
        echo("Mail sent successfully :)");
    }
    else
    {
        header("Status: 400 Bad Request", TRUE, 400);
    }
?>