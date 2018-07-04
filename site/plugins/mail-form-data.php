<?php

function mailFormData() {
    // $data (array) contains the form's sent data
    $name = $_POST['yourname'];
    $fieldEmail = $_POST['ctemail'];
    $fieldSubject = $_POST['getsubject'];
    $recieverEmail = $_POST['getemail'];
    $phone = $_POST['contactnum'];
    $message = $_POST['message'];


    $body = <<<BODY

From: {$name}
--------------------------------------------------------
Email: {$fieldEmail}
--------------------------------------------------------
Phone: {$phone}
--------------------------------------------------------
Message:

{$message}
BODY;

    $to = $recieverEmail;
    $from = $fieldEmail;
    $subject = $fieldSubject;

    // send email using php mailFormData
    $email = email(array(
      'to' => $to,
      'from' => $from,
      'subject' => $subject,
      'body' => $body));

    if($email->send()){
        // email was sent successfully
        $result['success'] = true;
    } else {
        // email delivery was not successful - report error
        $result['success'] = false;
        $result['msg'] = "error siya";
    }

    return $result;
}
