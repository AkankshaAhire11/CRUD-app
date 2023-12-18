<?php
include 'db.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle the form submission for add
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $hobbies = implode(', ', $_POST['hobbies']); 

    // Handle file upload for display pic 
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["display_pic"]["name"]);
    move_uploaded_file($_FILES["display_pic"]["tmp_name"], $target_file);
    $display_pic = basename($_FILES["display_pic"]["name"]);

    $sql = "INSERT INTO users (name, gender, dob, address, hobbies, display_pic) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $name, $gender, $dob, $address, $hobbies, $display_pic);
    $stmt->execute();
    $stmt->close();

    header("Location: list.php"); // Redirect after adding
    exit();
} elseif ($action === 'edit') {
    $id = isset($_GET['id']) ? $_GET['id'] : 0;

    if ($id > 0 && $_SERVER['REQUEST_METHOD'] === 'POST') {
        // Handle the form submission for edit
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $address = $_POST['address'];
        $hobbies = implode(', ', $_POST['hobbies']); // Convert hobbies array to comma-separated string

        // Handle file upload for display pic if a new file is selected
        if (!empty($_FILES["display_pic"]["name"])) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["display_pic"]["name"]);
            move_uploaded_file($_FILES["display_pic"]["tmp_name"], $target_file);
            $display_pic = basename($_FILES["display_pic"]["name"]);
        } else {
            // If no new file is selected, retain the existing display pic
            $sql_existing_display_pic = "SELECT display_pic FROM users WHERE id = ?";
            $stmt_existing_display_pic = $conn->prepare($sql_existing_display_pic);
            $stmt_existing_display_pic->bind_param("i", $id);
            $stmt_existing_display_pic->execute();
            $stmt_existing_display_pic->bind_result($existing_display_pic);
            $stmt_existing_display_pic->fetch();
            $stmt_existing_display_pic->close();

            $display_pic = $existing_display_pic;
        }

        $sql = "UPDATE users SET name = ?, gender = ?, dob = ?, address = ?, hobbies = ?, display_pic = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $name, $gender, $dob, $address, $hobbies, $display_pic, $id);
        $stmt->execute();
        $stmt->close();

        header("Location: list.php"); // Redirect after editing
        exit();
    } else {
        echo "Invalid user ID or form not submitted";
    }
} elseif ($action === 'delete') {
    $id = isset($_GET['id']) ? $_GET['id'] : 0;

    if ($id > 0) {
        // Process the delete action
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        header("Location: list.php"); // Redirect after deletion
        exit();
    } else {
        echo "Invalid user ID";
    }
} else {
    echo "Invalid action specified";
}
?>
