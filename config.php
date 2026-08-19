<?php
$db_host = "sql301.infinityfree.com";
$db_user = "if0_42690302";
$db_pass = "FmeLLeQ6LQ";
$db_name = "if0_42690302_norah60";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

$conn->set_charset("utf8mb4");
?>
