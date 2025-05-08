-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: webpagesdb.it.auth.gr:3306
-- Generation Time: Feb 10, 2025 at 03:23 AM
-- Server version: 10.1.48-MariaDB-0ubuntu0.18.04.1
-- PHP Version: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `papadoak_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `date`, `subject`, `content`) VALUES
(1, '2024-11-25', 'Εργασίες', 'Γεια χαρά. Ανακοινώθηκαν οι υποχρεωτικές εργασίες, με προθεσμία το τέλος της ημέρας γραπτής εξέτασης του μαθήματος: στην Εξεταστική Φεβρουαρίου 2025, στην Εξεταστική Ιουνίου 2025 (για τους επι πτυχίω), στην Εξεταστική Σεπτεμβρίου 2025. Καλή επιτυχία!'),
(2, '2024-12-23', 'Διεξαγωγή διάλεξης εξ αποστάσεως την Δευτέρα 23/12/2024', 'Καλημέρα σας. Η διάλεξη της Δευτέρας 23/12/2024 θα γίνει διαδικτυακά μέσω zoom και θα ξεκινήσει στις 13.15. Καλή συνέχεια'),
(3, '2025-01-12', 'Διάλεξη 13/1/2025', 'Καλή χρονιά και χρόνια πολλά! Καλή πρόοδο Λόγω της πρόγνωσης του καιρού η διάλεξη 13/1/2025 θα διεξαχθεί διαδικτυακά μέσω zoom. Ώρες 13:15-16.00. Καλή συνέχεια');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `file_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `title`, `description`, `file_name`) VALUES
(1, 'Εισαγωγή στο μάθημα', 'Βασικές εισαγωγικές γνώσεις', 'Eisagwgh.doc'),
(2, 'Κεφάλαιο 1', 'Ανάλυση πρώτου κεφάλαιου', 'Kefalaio1.doc');

-- --------------------------------------------------------

--
-- Table structure for table `homework`
--

CREATE TABLE `homework` (
  `id` int(11) NOT NULL,
  `objectives` text NOT NULL,
  `file_name_homework` varchar(255) NOT NULL,
  `deliverables` text NOT NULL,
  `due_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `homework`
--

INSERT INTO `homework` (`id`, `objectives`, `file_name_homework`, `deliverables`, `due_date`) VALUES
(1, 'Δημιουργία στατικού ιστότοπου με html', 'Ergasia1.doc', 'Τα files του site και ενα word αναφορας', '2025-01-12'),
(2, 'Δημιουργία δυναμικού ιστότοπου με html, php, mysql', 'Ergasia2.doc', 'Τα files του site και ενα word αναφορας', '2025-01-25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('tutor','student') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role`) VALUES
(1, 'Thanos', 'Papadopoulos', 'thanosp@gmail.com', 'thanosp', 'tutor'),
(2, 'Kostas', 'Papadopoulos', 'kostasp@gmail.com', 'kostasp', 'student'),
(3, 'Maria', 'Papadopoulou', 'mariap@gmail.com', 'mariap', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homework`
--
ALTER TABLE `homework`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `homework`
--
ALTER TABLE `homework`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
