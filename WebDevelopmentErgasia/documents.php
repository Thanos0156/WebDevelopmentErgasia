<?php
session_start();  // Ξεκινάμε τη συνεδρία

if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}

$is_tutor = ($_SESSION['role'] == 'tutor');

$servername = "webpagesdb.it.auth.gr:3306"; 
$username = "papadoak"; 
$password = "kodikos"; 
$dbname = "papadoak_database"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Σφάλμα σύνδεσης: " . $conn->connect_error);
}

$sql = "SELECT title, description, file_name FROM documents";
$result = $conn->query($sql);

$documents_html = ""; // Αρχικοποίηση μεταβλητής για την αποθήκευση του HTML περιεχομένου

if ($result->num_rows > 0) {
    // Δημιουργία HTML για κάθε έγγραφο
    while ($row = $result->fetch_assoc()) {
        $documents_html .= '<header>';
        $documents_html .= '<h2>' . htmlspecialchars($row['title']) . '</h2>';
        $documents_html .= '</header>';
        $documents_html .= htmlspecialchars($row['description']) . '<p>';
        $documents_html .= '<a href="' . htmlspecialchars($row['file_name']) . '" download><u>' . htmlspecialchars($row['file_name']) . '</u></a><br><br>';
    }
} else {
    $documents_html = "Δεν υπάρχουν διαθέσιμα έγγραφα.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="el">
<head>
    <link rel="stylesheet" href="ergasia.css" />
    <title>Έγγραφα μαθήματος</title>
    <meta charset="UTF-8">
    <style>
        /* Στυλ για να τοποθετήσουμε το κουμπί δεξιά */
        .logout-button {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: red;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .logout-button:hover {
            background-color: darkred;
        }

        header {
            position: relative;
        }

        /* Στυλ για το κουμπί προσθήκης εγγράφου */
        .add-document-button {
            display: block;
            margin: 20px 0;
            background-color: green;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .add-document-button:hover {
            background-color: darkgreen;
        }
    </style>
</head>
<body>
    <header>
        <h1>Έγγραφα μαθήματος</h1>
        <a href="logout.php"><button class="logout-button">Αποσύνδεση</button></a>
    </header>
    <div class="content">
        <nav>
            <br>
            <a href="index.php">Αρχική σελίδα</a><br><br>
            <a href="announcement.php">Ανακοινώσεις</a><br><br>
            <a href="communication.php">Επικοινωνία</a><br><br>
            <a href="documents.php">Έγγραφα μαθήματος</a><br><br>
            <a href="homework.php">Εργασίες</a>
        </nav>
        <main>
            <?php if ($is_tutor): ?>
                <!-- Προσθήκη κουμπιού για προσθήκη νέου εγγράφου -->
                <a href="add_document.php"><button class="add-document-button">Προσθήκη νέου έγγραφου</button></a>
            <?php endif; ?>

            <?php echo $documents_html; ?>
        </main>
        <a href="#"><img src="topbutton.png" alt="" style="position: fixed; right: 10px; top: 90%; width: 70px;"></a>
    </div>  
</body>
</html>
