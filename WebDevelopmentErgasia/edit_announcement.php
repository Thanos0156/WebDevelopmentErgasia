<?php
session_start();

if (!isset($_SESSION['email']) || $_SESSION['role'] != 'tutor') {
    header("Location: login.html");
    exit();
}

$servername = "webpagesdb.it.auth.gr:3306";
$username = "papadoak";
$password = "kodikos";
$dbname = "papadoak_database";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Σφάλμα σύνδεσης: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "SELECT * FROM announcement WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject = $conn->real_escape_string($_POST['subject']);
    $content = $conn->real_escape_string($_POST['content']);

    $update_sql = "UPDATE announcement SET subject='$subject', content='$content' WHERE id=$id";
    $conn->query($update_sql);
    $conn->close();

    header("Location: announcement.php");
    exit();
}
?>

<form method="post">
    <label>Θέμα:</label><br>
    <input type="text" name="subject" value="<?= $row['subject'] ?>" required><br><br>
    <label>Κυρίως κείμενο:</label><br>
    <textarea name="content" required><?= $row['content'] ?></textarea><br><br>
    <button type="submit">Αποθήκευση</button>
</form>
