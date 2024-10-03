<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (isset($_POST['submit']) && isset($_FILES['file'])) {
    $username = $_POST['username'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    $file = $_FILES['file']; // Access the file

    // Ensure the file is uploaded
    if ($file['error'] === UPLOAD_ERR_OK) {
        // Upload the file and get the file path
        $uploadDir = 'uploads/';
        $filePath = $uploadDir . basename($file['name']);
        
        // Ensure the directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Move the uploaded file to the server directory
        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            echo "File uploaded successfully<br>";
            $result = signup($username, $password, $email, $filePath);
            if ($result) {
                echo "Data inserted successfully!";
            } else {
                echo "Data insertion failed!";
            }
        } else {
            echo "File upload failed<br>";
        }
    } else {
        echo "File upload error. Error code: " . $file['error'] . "<br>";
    }
} else {
    echo "Form not submitted or file missing.";
}

if(isset($_POST['username']) and isset($_POST['emailid']) and isset($_POST['password']) and isset($_FILES['file'])){
    $username = $_POST['username'];
    $email = $_POST['emailid'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security
    $file = $_FILES['file'];
    $result = signup($username, $password,$email,$file);
}


   // Upload the file and get the file path
   $uploadDir = 'uploads/';
   $filePath = $uploadDir . basename($file['name']);
   
   // Ensure the directory exists
   if (!is_dir($uploadDir)) {
       mkdir($uploadDir, 0777, true);
   }

   // Move the uploaded file to the server directory
   if (move_uploaded_file($file['tmp_name'], $filePath)) {
       $result = signup($username, $password, $email, $filePath);
   } else {
       echo "File upload failed.";
   }

  function signup($username , $password , $email ,$filePath){
    $servername = "localhost";
    $dbusername = "user41"; // Change this to your actual DB username
    $dbpassword = "password";
    $dbname = "student";
     
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        echo "Connected successfully<br>";
    }
    
    $stmt = $conn->prepare("INSERT INTO `fileupload` (`username`, `emailid`, `password`, `file`) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        die("Preparation failed: " . $conn->error);
    }

    $stmt->bind_param("ssss", $username, $email, $password, $filePath);

    if ($stmt->execute()) {
        return true;
    } else {
        echo "Error inserting data: " . $stmt->error . "<br>";
        return false;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}

?>