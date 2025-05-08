<?php
session_start();

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

$sql = "SELECT id, date, subject, content FROM announcement";
$result = $conn->query($sql);
$conn->close();
?>

<!DOCTYPE html>
<html lang="el">
<head>
    <link rel="stylesheet" href="ergasia.css" />
    <title>Ανακοινώσεις</title>
    <meta charset="UTF-8">
    <style>
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

        .button {
            display: inline-block;
            background-color: blue;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            margin: 5px;
        }

        .delete-button {
            background-color: red;
        }

        .edit-button {
            background-color: orange;
        }
    </style>
</head>
<body>
    <header>
        <h1>Ανακοινώσεις</h1>
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
                <a href="add_announcement.php" class="button">Προσθήκη νέας ανακοίνωσης</a>
            <?php endif; ?>

            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<header>';
                    echo '<h2>Ανακοίνωση ' . $row['id'] . '</h2>';
                    echo '</header>';
                    echo '<b>Ημερομηνία: </b>' . $row['date'] . '<p>';
                    echo '<b>Θέμα: </b>' . $row['subject'] . '<p>';
                    echo $row['content'] . '<p>';

                    if ($is_tutor) {
                        echo '<a href="delete_announcement.php?id=' . $row['id'] . '" class="button delete-button">Διαγραφή</a>';
                        echo '<a href="edit_announcement.php?id=' . $row['id'] . '" class="button edit-button">Επεξεργασία</a>';
                    }

                    echo "<br><hr>";
                }
            } else {
                echo "Δεν υπάρχουν ανακοινώσεις.";
            }
            ?>
        </main>
        <a href="#"><img src="topbutton.png" alt="" style="position: fixed; right: 10px; top: 90%; width: 70px;"></a>
    </div>  
</body>
</html>
