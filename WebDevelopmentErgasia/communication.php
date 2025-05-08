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
    <title>Επικοινωνία</title>
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
        <h1>Επικοινωνία</h1>
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
            <p>Η συγκεκριμένη ιστοσελίδα θα περιέχει δύο δυνατότητες για την αποστολή e-mail στον καθηγητή:</p>
            <ul>
                <li>Μέσω web φόρμας</li>
                <li>Με χρήση e-mail διεύθυνσης</li>
            </ul>

            <header>
                <h2>Αποστολή e-mail μέσω web φόρμας</h2>
            </header>  

            <b>Αποστολέας: </b> <br>
            <textarea id="message" name="message" rows="1" cols="30"> username@gmail.com </textarea>
            <p>
            <b>Θέμα: </b> <br>
            <textarea id="message" name="message" rows="1" cols="30"></textarea>
            <p>
            <b>Κείμενο: </b> <br>
            <textarea id="message" name="message" rows="3" cols="50"></textarea>
            <p>
            <button type="button">
                Αποστολή
            </button>

            <header>
                <h2>Αποστολή e-mail με χρήση e-mail διεύθυνσης</h2>
            </header>  

            Εναλλακτικά μπορείτε να αποστείλετε e-mail στην παρακάτω διεύθυνση ηλεκτρονικού ταχυδρομείου <a href="mailto:thanosp@gmail.com">thanosp@gmail.com</a>
        </main>
    </div>
</body>
</html>
