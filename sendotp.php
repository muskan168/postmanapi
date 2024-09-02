<?php

session_start();
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the country code and mobile number from the form
    $country_code = $_POST['country_code']; 
    $mobile_number = $_POST['mobile_number']; 

    $_SESSION['country_code'] = $country_code;
    $_SESSION['mobile_number'] = $mobile_number;

    // Prepare the data to be sent in the request
    $data = array(
        'country_code' => $country_code, // User-entered country code
        'mobile_number' => $mobile_number // User-entered mobile number
    );

    // Convert the data array to JSON
    $json_data = json_encode($data);

    // cURL setup to send the OTP
    $url = 'http://185.193.19.48:9080/api/v1/send-otp'; // API endpoint

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json'
    ));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

    // Execute the request and get the response
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    } else {
        echo 'Response: ' . $response; // Display the response from the server
        header('Location: verify.html');
        exit(); // I
    }

    // Close the cURL session
    curl_close($ch);
}
?>
s


