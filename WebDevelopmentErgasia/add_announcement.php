<?php
session_start();

if (!isset($_SESSION['email']) || $_SESSION['role'] != 'tutor') {
    header("Location: login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "webpagesdb.it.auth.gr:3306";
    $username = "papadoak";
    $password = "kodikos";
    $dbname = "papadoak_database";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Σφάλμα σύνδεσης: " . $conn->connect_error);
    }

    $subject = $conn->real_escape_string($_POST['subject']);
    $content = $conn->real_escape_string($_POST['content']);
    $date = date("Y-m-d");

    $sql = "INSERT INTO announcement (date, subject, content) VALUES ('$date', '$subject', '$content')";
    $conn->query($sql);
    $conn->close();

    header("Location: announcement.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="el">
<head>
    <title>Προσθήκη Ανακοίνωσης</title>
    <meta charset="UTF-8">
    <style>
        .form-container {
            text-align: center;
            margin-top: 100px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Προσθήκη Ανακοίνωσης</h2>
        <form method="post">
            <label>Θέμα:</label><br>
            <input type="text" name="subject" required><br><br>
            <label>Κυρίως κείμενο:</label><br>
            <textarea name="content" required></textarea><br><br>
            <button type="submit">Αποθήκευση</button>
        </form>
    </div>
</body>
</html>
