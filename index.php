<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        form {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            width: 100%;
            max-width: 600px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #444;
        }

        input[type="text"],
        select,
        input[type="file"],
        input[type="radio"],
        input[type="checkbox"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="radio"],
        input[type="checkbox"] {
            width: auto;
            margin-top: 0;
            margin-right: 10px;
        }

        fieldset {
            border: none;
            padding: 0;
            margin-bottom: 15px;
        }

        .form-row {
            display: flex;
            gap: 20px;
            justify-content: space-between;
        }

        .form-row > div {
            flex: 1;
        }

        .form-row input[type="text"] {
            width: 100%;
        }

        .form-row select {
            width: 100%;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
        }

        .checkbox-container input {
            width: auto;
        }

        .checkbox-container label {
            margin-left: 10px;
            font-weight: normal;
        }

    </style>
</head>
<body>

<form method="POST" enctype="multipart/form-data" action="">
    <h2>Personal Information Form</h2>

    <div class="form-row">
        <div>
            <label for="name">Given name</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="surname">Family name</label>
            <input type="text" name="surname" id="surname" required>
        </div>
    </div>
    <label for="profession">Profession</label>
    <select name="profession" id="profession" required>
        <option value="developer">Developer</option>
        <option value="designer">Designer</option>
        <option value="manager">Manager</option>
        <option value="teacher">Teacher</option>
    </select>

    <label for="hobbies">Hobbies</label>
    <select name="hobbies[]" id="hobbies" multiple required>
        <option value="reading">Reading</option>
        <option value="travelling">Travelling</option>
        <option value="sports">Sports</option>
        <option value="cooking">Cooking</option>
    </select>

    <fieldset>
        <legend>Gender</legend>
        <label for="male">
            <input type="radio" id="male" name="gender" value="male" required> Male
        </label>
        <label for="female">
            <input type="radio" id="female" name="gender" value="female" required> Female
        </label>
        <label for="other">
            <input type="radio" id="other" name="gender" value="other"> Other
        </label>
    </fieldset>

    <label for="file">Upload file</label>
    <input type="file" name="file" id="file" required>

    <div class="checkbox-container">
        <input type="checkbox" name="agreement" id="agreement" required>
        <label for="agreement">I agree to the terms and conditions</label>
    </div>

    <input type="submit" value="Submit">
</form>


<?php
if (!empty($_POST)) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $profession = $_POST['profession'];
    $hobbies = isset($_POST['hobbies']) ? $_POST['hobbies'] : [];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : 'Not selected';

    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $file_name = $_FILES['file']['name'];
        $file_tmp_name = $_FILES['file']['tmp_name'];
        $file_size = $_FILES['file']['size'];
        $file_type = $_FILES['file']['type'];

        $upload_dir = "uploads/";
        $upload_path = $upload_dir . basename($file_name);

        $allowed_types = ['image/jpeg', 'image/png', 'application/pdf'];
        if (in_array($file_type, $allowed_types)) {
            if (move_uploaded_file($file_tmp_name, $upload_path)) {
                echo "File uploaded successfully: " . $file_name . "<br>";
            } else {
                echo "Failed to upload the file.<br>";
            }
        } else {
            echo "Invalid file type. Only JPG, PNG, and PDF are allowed.<br>";
        }
    } else {
        echo "No file uploaded or file error.<br>";
    }

    $agreement = isset($_POST['agreement']) ? 'Agreed' : 'Not agreed';

    echo "<h3>Submitted Data:</h3>";
    echo "<p><strong>Given name:</strong> $name</p>";
    echo "<p><strong>Family name:</strong> $surname</p>";
    echo "<p><strong>Profession:</strong> $profession</p>";
    echo "<p><strong>Gender:</strong> $gender</p>";

    if (!empty($hobbies)) {
        echo "<p><strong>Hobbies:</strong> " . join(', ', $hobbies) . "</p>";
    } else {
        echo "<p><strong>Hobbies:</strong> None selected</p>";
    }

    echo "<p><strong>Agreement:</strong> $agreement</p>";
}
?>
</body>
</html>