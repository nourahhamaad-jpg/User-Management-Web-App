<?php
require "config.php";

$result = $conn->query("SELECT id, name, age, status FROM users ORDER BY id ASC");
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Management</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>User Management</h1>

    <form id="userForm" action="submit.php" method="POST" class="user-form">
        <input type="text" name="name" id="name" placeholder="Name" required>
        <input type="number" name="age" id="age" placeholder="Age" required min="1">
        <button type="submit">Submit</button>
    </form>

    <table id="usersTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr id="row-<?php echo $row['id']; ?>">
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo $row['age']; ?></td>
                <td class="status-cell"><?php echo $row['status']; ?></td>
                <td>
                    <button class="toggle-btn" data-id="<?php echo $row['id']; ?>">
                        Toggle
                    </button>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="script.js"></script>
</body>
</html>
<?php $conn->close(); ?>
