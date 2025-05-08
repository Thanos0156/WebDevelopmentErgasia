<?php
session_start();  // Ξεκινάμε τη συνεδρία

if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}

$is_tutor = ($_SESSION['role'] == 'tutor');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Λήψη δεδομένων από τη φόρμα
    $title = $_POST['title'];
    $description = $_POST['description'];
    $file_name = $_POST['file_name'];

    $servername = "webpagesdb.it.auth.gr:3306"; 
    $username = "papadoak"; 
    $password = "kodikos"; 
    $dbname = "papadoak_database"; 

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Σφάλμα σύνδεσης: " . $conn->connect_error);
    }

    $sql = "INSERT INTO documents (title, description, file_name) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $title, $description, $file_name);
    $stmt->execute();

    
    $stmt->close();
    $conn->close();

    
    header("Location: documents.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="el">
<head>
    <link rel="stylesheet" href="ergasia.css" />
    <title>Προσθήκη νέου εγγράφου</title>
    <meta charset="UTF-8">
    <style>
        .form-container {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .form-container input, .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-container button {
            padding: 10px 20px;
            background-color: green;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: darkgreen;
        }
    </style>
</head>
<body>
    <header>
        <h1>Προσθήκη νέου εγγράφου</h1>
        <a href="logout.php"><button class="logout-button">Αποσύνδεση</button></a>
    </header>

    <div class="content">
        <nav>
            <a href="documents.php">Πίσω στα έγγραφα</a>
        </nav>

        <main>
            <?php if ($is_tutor): ?>
                <!-- Φόρμα για προσθήκη εγγράφου -->
                <div class="form-container">
                    <form method="POST" action="">
                        <label for="title">Τίτλος:</label>
                        <input type="text" name="title" required><br>

                        <label for="description">Περιγραφή:</label>
                        <textarea name="description" rows="5" required></textarea><br>

                        <label for="file_name">Όνομα αρχείου:</label>
                        <input type="text" name="file_name" required><br>

                        <button type="submit">Προσθήκη εγγράφου</button>
                    </form>
                </div>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>
