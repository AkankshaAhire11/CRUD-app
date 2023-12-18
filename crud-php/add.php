<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>ADD USER</h2>
    <!-- specifies the URL to which the form data will be sent -->
    <form action="process.php?action=add" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br> <br>

        <label for="gender">Gender:</label>
        <input type="radio" name="gender" value="Male" required> Male
        <input type="radio" name="gender" value="Female" required> Female<br> <br>

        <label for="dob">Date of Birth:</label>
        <input type="date" name="dob" required><br> <br>

        <label for="address">Address:</label>
        <textarea name="address" required></textarea><br> <br>

        <label for="hobbies">Hobbies:</label>
        <input type="checkbox" name="hobbies[]" value="Reading"> Reading <br> 
        <input type="checkbox" name="hobbies[]" value="Gaming"> Gaming <br> 
        <input type="checkbox" name="hobbies[]" value="Traveling"> Traveling <br>
        <input type="checkbox" name="hobbies[]" value="Dancing"> Dancing<br> <br>

        <label for="display_pic">Display Pic:</label>
        <input type="file" name="display_pic" accept="image/*"><br><br>

        <input type="submit" value="Add User">
    </form>
</body>
</html>
