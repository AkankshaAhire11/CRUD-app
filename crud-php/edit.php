<?php
include 'db.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;

if ($id > 0) {
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Display the form for editing
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit User</title>
            <link rel="stylesheet" href="styles.css">
        </head>
        <body>
            <h2>Edit User</h2>
            <form action="process.php?action=edit&id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                <label for="name">Name:</label>
                <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br>

                <label for="gender">Gender:</label>
                <input type="radio" name="gender" value="Male" <?php echo ($row['gender'] == 'Male') ? 'checked' : ''; ?> required> Male
                <input type="radio" name="gender" value="Female" <?php echo ($row['gender'] == 'Female') ? 'checked' : ''; ?> required> Female<br>

                <label for="dob">Date of Birth:</label>
                <input type="date" name="dob" value="<?php echo $row['dob']; ?>" required><br>

                <label for="address">Address:</label>
                <textarea name="address" required><?php echo $row['address']; ?></textarea><br>

                <label for="hobbies">Hobbies:</label>
                <select name="hobbies[]">
                    <option value="Reading" <?php echo (strpos($row['hobbies'], 'Reading') !== false) ? 'selected' : ''; ?>>Reading</option>
                    <option value="Gaming" <?php echo (strpos($row['hobbies'], 'Gaming') !== false) ? 'selected' : ''; ?>>Gaming</option>
                    <option value="Traveling" <?php echo (strpos($row['hobbies'], 'Traveling') !== false) ? 'selected' : ''; ?>>Traveling</option>
                    <option value="Dancing" <?php echo (strpos($row['hobbies'], 'Dancing') !== false) ? 'selected' : ''; ?>>Dancing</option>
                    
                </select><br>

                <label for="display_pic">Choose New Display Pic (Optional):</label>
                <input type="file" name="display_pic" accept="image/*"><br>

                <p>Current Display Pic:</p>
                <img src="uploads/<?php echo $row['display_pic']; ?>" alt="Display Pic" style="max-width: 200px;"><br>

                <input type="submit" value="Update User">
            </form>
        </body>
        </html>
        <?php
    } else {
        echo "User not found";
    }

    $stmt->close();
} else {
    echo "Invalid user ID";
}
?>
