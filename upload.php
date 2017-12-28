<?php
$servername = "localhost";
$username = "root";
$password = "seuJ4JBS";
$dbname = "applicationform";


$value1 = addslashes($_POST['teamName']);
$value2 = addslashes($_POST['universityName']);
$value3 = addslashes($_POST['student1']);
$value4 = addslashes($_POST['student2']);
$value5 = addslashes($_POST['email1']);
$value6 = addslashes($_POST['email2']);
$value7 = addslashes($_POST['student3']);
$value8 = addslashes($_POST['student4']);
$value9 = addslashes($_POST['email3']);
$value10 = addslashes($_POST['email4']);
$value11 = addslashes($_POST['student5']);
$value12 = addslashes($_POST['student6']);
$value13 = addslashes($_POST['email5']);
$value14 = addslashes($_POST['email6']);


$target_dir = "/usr/share/nginx/html/iot-challenge/upload/";

$filename = $value1 . "_" . basename($_FILES['fileToUpload']['tmp_name']) . "_" .  basename($_FILES["fileToUpload"]["name"]) ;

$uploadPath = $target_dir . $filename ;

$value15 = addslashes($filename) ;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "INSERT INTO form (teamName, universityName, student1, student2, email1, email2, student3, student4, email3, email4, student5, student6, email5, email6, fileToUpload)
VALUES ('$value1', '$value2', '$value3', '$value4', '$value5', '$value6', '$value7', '$value8', '$value9', '$value10', '$value11', '$value12', '$value13', '$value14', '$value15');";



// prepare and bind
//$stmt = $conn->prepare("IINSERT INTO form (teamName, universityName, student1, student2, email1, email2, student3, student4, email3, email4, student5, student6, email5, email6, fileToUpload)
//VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
//$stmt->bind_param("sssssssssssssss", $teamName, $universityName, $student1, $student2, $email1, $email2, $student3, $student4, $email3, $email4, $student5, $student6, $email5, $email6, $fileToUpload );

if ($conn->query($sql) === TRUE) {

    if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploadPath)) {

        echo "Your application has been successfully submitted ! You will be redirected to our homepage in a few seconds... ";
        header( "refresh:15;url=/" );
    } else {
        echo "Sorry, Something went wrong , please try later \n";
        echo "Failed to upload file !\n";
        echo 'Here is some more debugging info:';
        print_r($_FILES);
    }


} else {
    //    echo "Error: " . $sql . "<br>" . $conn->error;
    echo "Sorry, Something went wrong , please try later";
}

$stmt->close();
$conn->close();


?>
