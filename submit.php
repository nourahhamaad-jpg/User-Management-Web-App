<?php
require "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $age  = intval($_POST["age"] ?? 0);

    if ($name !== "" && $age > 0) {
        $stmt = $conn->prepare("INSERT INTO users (name, age, status) VALUES (?, ?, 0)");
        $stmt->bind_param("si", $name, $age);
        $stmt->execute();
        $stmt->close();
    }
}

$conn->close();

header("Location: index.php");
exit;
?>
