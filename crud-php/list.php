<?php
include 'db.php';

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>USER LIST</h2>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Gender</th>
            <th>DOB</th>
            <th>Address</th>
            <th>Hobbies</th>
            <th>Display Pic</th>
            <th>Action</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['name']}</td>
                        <td>{$row['gender']}</td>
                        <td>{$row['dob']}</td>
                        <td>{$row['address']}</td>
                        <td>{$row['hobbies']}</td>
                        <td><img src='uploads/{$row['display_pic']}' alt='Display Pic' style='max-width:100px;'></td>
                        <td>
                            <a href='edit.php?id={$row['id']}'>Edit</a> </br>
                            <a href='view.php?id={$row['id']}'>View</a> </br>
                            <a href='process.php?action=delete&id={$row['id']}' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No users found</td></tr>";
        }
        ?>
    </table>
    <br>
    <a href="add.php" class="add-user-link">Add User</a>
</body>
</html>
