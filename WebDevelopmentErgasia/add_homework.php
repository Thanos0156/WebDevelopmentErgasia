<?php
session_start();

if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'tutor') {
    header("Location: homework.php");
    exit();
}

$host = "webpagesdb.it.auth.gr";
$username = "papadoak";
$password = "kodikos";
$database = "papadoak_database";

$conn = new mysqli($host, $username, $password, $database);


if ($conn->connect_error) {
    die("Σφάλμα σύνδεσης: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $objectives = $_POST['objectives'];
    $file_name_homework = $_POST['file_name_homework'];
    $deliverables = $_POST['deliverables'];
    $due_date = $_POST['due_date'];

    $result = $conn->query("SELECT MAX(id) AS max_id FROM homework");
    $row = $result->fetch_assoc();
    $new_id = $row['max_id'] + 1;
    if (!$new_id) {
        $new_id = 1;
    }

 
    $stmt = $conn->prepare("INSERT INTO homework (id, objectives, file_name_homework, deliverables, due_date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $new_id, $objectives, $file_name_homework, $deliverables, $due_date);
    $stmt->execute();
    $stmt->close();

  
    $today_date = date("Y-m-d");
    $announcement_subject = "Υποβλήθηκε η εργασία " . $new_id;
    $announcement_content = "Η ημερομηνία παράδοσης της εργασίας είναι: " . $due_date;

    $stmt = $conn->prepare("INSERT INTO announcement (date, subject, content) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $today_date, $announcement_subject, $announcement_content);
    $stmt->execute();
    $stmt->close();

   
    header("Location: homework.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <title>Προσθήκη Εργασίας</title>
    <link rel="stylesheet" href="ergasia.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }

        .form-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        input[type="text"], input[type="date"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Προσθήκη Εργασίας</h2>
        <form action="add_homework.php" method="post">
            <label for="objectives">Στόχος:</label>
            <input type="text" id="objectives" name="objectives" required>

            <label for="file_name_homework">Εκφώνηση (URL αρχείου):</label>
            <input type="text" id="file_name_homework" name="file_name_homework" required>

            <label for="deliverables">Παραδοτέα:</label>
            <input type="text" id="deliverables" name="deliverables" required>

            <label for="due_date">Ημερομηνία Παράδοσης:</label>
            <input type="date" id="due_date" name="due_date" required>

            <input type="submit" value="Προσθήκη Εργασίας">
        </form>
    </div>
</body>
</html>
