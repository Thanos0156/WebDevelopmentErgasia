<?php
session_start();  // Ξεκινάμε τη συνεδρία

if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $servername = "webpagesdb.it.auth.gr:3306";
    $username = "papadoak";
    $password = "kodikos";
    $dbname = "papadoak_database";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Σφάλμα σύνδεσης: " . $conn->connect_error);
    }

    $sql = "DELETE FROM announcement WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id); // Το "i" δηλώνει ότι το id είναι ακέραιος αριθμός
    $stmt->execute();

    $stmt->close();
    $conn->close();

    header("Location: announcement.php");
    exit();
} else {
    // Αν το id δεν είναι ορισμένο στην URL, ανακατευθύνουμε στην αρχική σελίδα ή άλλη σελίδα
    header("Location: announcement.php");
    exit();
}
?>
