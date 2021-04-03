<?php
if (empty($_POST) || !isset($_POST)) {
    ajaxResponse('error', 'Post cannot be empty.');
} else {

    $postData = $_POST;
    $dataString = implode($postData, ",");
    $mailgun = sendMailgun($postData);
}

function ajaxResponse($status, $message, $data = NULL, $mg = NULL) {
    $response = array(
        'status' => $status,
        'message' => $message,
        'data' => $data,
        'mailgun' => $mg
    );
    $output = json_encode($response);
    exit($output);
}

function sendMailgun($data) {
    $api_key = ' key-528ba6c4648318716d6ec91a51186b8d';
    $api_domain = 'sandbox3cf3d9262677435789073e0fe71cfd9b.mailgun.org';
    $send_to = 'sabahudin.ko@gmail.com';
    $name = $data['name'];
    $email = $data['email'];
    $content = $data['message'];

    $messageBody = "Contact: $name ($email)\n\nMessage: $content";

    $config = array();
    $config['api_key'] = $api_key;
    $config['api_url'] = 'https://api.mailgun.net/v3/' . $api_domain . '/messages';

    $message = array();
    $message['from'] = $email;
    $message['to'] = $send_to;
    $message['h:Reply-To'] = $email;
    $message['subject'] = 'Mail From GagaGugu';
    $message['text'] = $messageBody;

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $config['api_url']);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, "api:{$config['api_key']}");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $message);

    $result = curl_exec($curl);

    curl_close($curl);
    return $result;
}

?>
