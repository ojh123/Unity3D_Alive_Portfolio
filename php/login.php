<?php

$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "account";

$user_username = $_POST["usernamePost"];
$user_password = $_POST["passwordPost"];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM users WHERE ID = '".$user_username."'";
$result = mysqli_query($conn, $sql);

$response = array();

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    if ($row['password'] == $user_password) {
        $response["status"] = "login";
        $response["nickname"] = $row['nickname'];
    } else {
        // 비밀번호가 틀렸을 때 처리
        $response["status"] = "password";
        $response["message"] = "Password is incorrect";
    }
} else {
    // 아이디가 존재하지 않을 때 처리
    $response["status"] = "user";
    $response["message"] = "User Not Found";
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);

$conn->close();
?>
