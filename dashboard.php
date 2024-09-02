<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
</head>
<body>
    <div class="container">
   <div class="h1"><h1><?php echo $_SESSION['name'];?></h1></div> 
    <div class="h2"><?php if(isset($_SESSION['success_data']) && is_array($_SESSION['success_data'])) {
        $success_data = $_SESSION['success_data'];

        // Printing the array to show the current status of user's profile 
        echo '<h2>' . htmlspecialchars($success_data['message']) . '</h2>';
     }
    ?></h2></div>
    <a href="logout.php">Logout</a>
</div>

</body>

<style>
  body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #0000ff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 400px;
            padding: 20px;
            margin-left:420px;
            margin-top:260px;
            text-align: center;
            display: inline-block;
        }

        /* Heading styles */
        h1 {
            color: white;
            font-size: 24px;
            margin-top: 40px;
            margin-left:110px;
            float:left;
            width:40%;
            height:40px;
        }

        h2 {
            color: white;
            font-size: 18px;
            margin-left:30px;
            float:left;
            width:80%;
            margin-top: -10px;
            height:40px;        
        }

        /* Button styles */
        a {
            float:left;
            text-decoration: none;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            margin-left:150px;
            margin-top:-30px;
        }

        a:hover {
            background-color: #0056b3;
        }
        @media (max-width:600px){
            .container{
                margin-left:90px;
                height:200px;
                margin-top:160px;

            }
            a{
                margin-left:150px;
                margin-top:-20px;
            }
        }
        
</style>
</html>
