<?php
session_start();  // Ξεκινάμε τη συνεδρία

if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="el">
<head>
    <link rel="stylesheet" href="ergasia.css" />
    <title>Αρχική σελίδα</title>
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
    </style>
</head>
<body>
    <header>
        <h1>Αρχική σελίδα</h1>
        <a href="logout.php"><button class="logout-button">Αποσύνδεση</button></a>
    </header>
    <div class="content">
        <nav>
            <br>
            <a href="index.php">Αρχική σελίδα</a><br><br>
            <a href="announcement.php">Ανακοινώσεις</a><br><br>
            <a href="communication.php">Επικοινωνία</a><br><br>
            <a href="documents.php">Έγραφα μαθήματος</a><br><br>
            <a href="homework.php">Εργασίες</a>
        </nav>
        <main>
            <p style="font-size: 20px;">
                Καλώς ορίσατε στο μάθημα εκπαιδευτικά περιβάλλοντα διαδκτύου!</p>

            <p>Σε αυτο το μάθημα θα μάθετε:</p>
            <ul>
                <li>Παιδαγωγικές προσεγγίσεις περιβαλλόντων Διαδικτύου για την υποστήριξη διαδικτυακής μάθησης.</li>
                <li>Δημιουργία παιδαγωγικών σχεδιάσεων με περιπτώσεις χρήσης (use cases).</li>
                <li>Διαδικασία επιλογής ολοκληρωμένων περιβαλλόντων Διαδικτύου για την υποστήριξη διαδικτυακής μάθησης και εκπαίδευσης.</li>
                <li>Εργαλεία, τεχνολογίες και υπηρεσίες του Διαδικτύου και του Παγκόσμιου Ιστού για την υποστήριξη των παιδαγωγικών προσεγγίσεων και παρουσίαση ολοκληρωμένων περιβαλλόντων Διαδικτύου ανοιχτού κώδικα για την υποστήριξη διαδικτυακής μάθησης.</li>
            </ul>
            <img src="eikonaergasia.png" alt="Εικόνα Εργασίας">
        </main>
    </div>
</body>
</html>
