<?php
session_start();

$host = "webpagesdb.it.auth.gr";
$username = "papadoak";
$password = "kodikos";
$database = "papadoak_database";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Σφάλμα σύνδεσης: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, first_name, last_name, role, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        echo "Λάθος email ή κωδικός!";
        exit();
    }

    $stmt->bind_result($id, $first_name, $last_name, $role, $stored_password);
    $stmt->fetch();

    if ($password === $stored_password) { // Ελέγχει αν είναι ίδια τα passwords (ΑΝ δεν είναι hashed)
        // Αποθήκευση των στοιχείων στη session
        $_SESSION['user_id'] = $id;
        $_SESSION['email'] = $email;
        $_SESSION['first_name'] = $first_name;
        $_SESSION['role'] = $role; // Αποθήκευση του role

        // Ανακατεύθυνση στην index.php
        header("Location: index.php");
        exit();
    } else {
        echo "Λάθος κωδικός!";
        exit();
    }
}

$conn->close();
?>
