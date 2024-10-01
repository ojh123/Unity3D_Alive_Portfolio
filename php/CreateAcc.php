<?php

$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "account";

$user_username = $_POST["usernamePost"];
$user_password = $_POST["passwordPost"];
$user_nickname = $_POST["nicknamePost"];

$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}


if (empty($user_username) || empty($user_password) || empty($user_nickname)) {
    $response = array("status" => "empty");
    echo json_encode($response);
    exit();
}



$sql = "SELECT * FROM users WHERE ID = '$user_username' OR nickname = '$user_nickname'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $response = array("status" => "error");
} else {
   
    $sql = "INSERT INTO users (ID, password, nickname) VALUES ('$user_username', '$user_password', '$user_nickname')";
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        $response = array("status" => "success");
    } else {
        $response = array("status" => "error");
    }
}

echo json_encode($response);

mysqli_close($conn);
?>
