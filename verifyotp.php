<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $otp = $_POST['otp']; 


    // Retrieve the phone number from the session
    $country_code = $_SESSION['country_code'];
    $mobile_number = $_SESSION['mobile_number'];


    // Verify OTP via API
    $url = "http://185.193.19.48:9080/api/v1/verify-otp"; 
    $data = json_encode([
        "country_code" => $country_code,
        "mobile_number" => $mobile_number,
        "otp" => $otp,
    // $_SESSION['token']=='4821',

    ]);

    $options = [
        "http" => [
            "header"  => "Content-Type: application/json\r\n" .
                         "device-type: Mobile\r\n", 
            "method"  => "POST",
            "content" => $data,
        ],
        "ssl" => [
            "verify_peer" => false,
            "verify_peer_name" => false,
        ]
    ];

    $context = stream_context_create($options);
    $response = @file_get_contents($url, false, $context);
    
    if ($response === FALSE) {
        $error = error_get_last();
        die('Error verifying OTP: ' . $error['message']);
    }

    // Process the response
    $result = json_decode($response, true);
    
    if (isset($result['success']) == true) {
        header("Location: user.html"); // Redirect to the dashboard on success
        exit();
    } else {
        echo "OTP verification failed. Please try again.";
    }
}
?>

