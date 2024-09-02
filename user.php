<?php
session_start(); // strting the session

// Check if the user is logged in

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user's profile data from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $company = $_POST['company'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $sponsorcode = $_POST['sponsorCode'];

    // make the session of name to use this in dashboard page
    $_SESSION['name']=$name;

    // Prepare the data to be sent in the request
    $data = array(
        'name' => $name,
        'email' => $email,
        'company' => $company,
        'state' => $state,
        'city' => $city,
        'sponsorcode' => $sponsorcode
    );

     print_r($data);
    // Convert the data array to JSON
    $json_data = json_encode($data);

    // curl setup to update the profile
    $url = 'http://185.193.19.48:9080/api/v1/create-profile'; // Profile update API endpoint
    $token="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOjc4LCJleHAiOjE3MjYzMjg3NzksImlhdCI6MTcyNTI1Njg2N30.6freCwoeiqAMwSIJA8iVa-DXl4wyrFYtrmVwQVbeCRQ";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $_SESSION['access_token']=$token // Include the access token in the header
    ));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

    // Execute the request and get the response
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // is response runs redirect to dashboard page
   if ($response){
    header("location: dashboard.php");
    
    if ($response) {
        // make array of success profile to print in dashboard page
        $success_data = array(
            'success' => true,
            'message' => "Profile updated successfully"
        );
        $_SESSION['success_data']=$success_data;
    }
    
   }

    // Check for curl errors
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
    } else {
        if ($http_code == 200) {
            echo 'Profile updated successfully.';
            // Redirect to dashboard 
            header('Location: dashboard.html');
            exit();
        } else {
            echo 'Failed to update profile. Please try again.';
        }
    }

    // Close the curl session
    curl_close($ch);
}

?>

