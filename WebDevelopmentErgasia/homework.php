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

$sql = "SELECT id, objectives, file_name_homework, deliverables, due_date FROM homework";
$result = $conn->query($sql);

$homework_html = ""; 

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $homework_html .= '<header>';
        $homework_html .= '<h2>Εργασία ' . htmlspecialchars($row['id']) . '</h2>';
        $homework_html .= '</header>';
        $homework_html .= '<b>Στόχος: </b>' . htmlspecialchars($row['objectives']) . '<p>';
        $homework_html .= '<b>Εκφώνηση: </b><a href="' . htmlspecialchars($row['file_name_homework']) . '" download><u>' . htmlspecialchars($row['file_name_homework']) . '</u></a><p>';
        $homework_html .= '<b>Παραδοτέα: </b>' . htmlspecialchars($row['deliverables']) . '<p>';
        $homework_html .= '<b>Ημερομηνία παράδοσης: </b>' . htmlspecialchars($row['due_date']) . '<p><br>';
    }
} else {
    $homework_html = "Δεν υπάρχουν διαθέσιμες εργασίες.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="el">
<head>
    <link rel="stylesheet" href="ergasia.css" />
    <title>Εργασίες</title>
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

        .add-homework-button {
            display: block;
            margin-bottom: 20px;
            background-color: green;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .add-homework-button:hover {
            background-color: darkgreen;
        }
    </style>
</head>
<body>
    <header>
        <h1>Εργασίες</h1>
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
                <a href="add_homework.php"><button class="add-homework-button">Προσθήκη Εργασίας</button></a>
            <?php endif; ?>

            <?php echo $homework_html; ?>
        </main>
		<a href="#"><img src="topbutton.png" alt="" style="position: fixed; right: 10px; top: 90%; width: 70px;"></a>
    </div>  
</body>
</html>
