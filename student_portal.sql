-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2024 at 10:34 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `capacity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `semester_id`, `name`, `description`, `capacity`, `created_at`, `updated_at`) VALUES
(24, 1, 'Introduction to Quantum Mechanics', 'This course provides an introduction to the fundamental principles of quantum mechanics, including wave-particle duality, the Schrödinger equation, and quantum entanglement. Students will explore the applications of quantum mechanics in modern technology.', 30, '2024-08-28 02:09:28', '2024-08-28 02:09:28'),
(25, 2, 'Introduction to Quantum Mechanics', 'This course provides an introduction to the fundamental principles of quantum mechanics, including wave-particle duality, the Schrödinger equation, and quantum entanglement. Students will explore the applications of quantum mechanics in modern technology.', 30, '2024-08-28 02:09:28', '2024-08-28 02:09:28'),
(26, 2, 'Creative Writing: Science Fiction and Fantasy', 'This course focuses on the art of writing science fiction and fantasy stories. Students will learn about world-building, character development, and plot structure while creating their own original works. Guest lectures from published authors will be included.', 25, '2024-08-28 02:09:28', '2024-08-28 02:09:28'),
(27, 1, 'Advanced Robotics and AI', 'This course covers advanced topics in robotics and artificial intelligence, including machine learning algorithms, robotic vision, and autonomous systems. Students will work on hands-on projects to design and program their own robots.', 20, '2024-08-28 02:09:28', '2024-08-28 02:09:28'),
(28, 1, 'History of Ancient Civilizations', 'This course explores the history and culture of ancient civilizations such as Mesopotamia, Egypt, Greece, and Rome. Students will examine archaeological evidence, historical texts, and the impact of these civilizations on modern society.', 40, '2024-08-28 02:09:28', '2024-08-28 02:09:28'),
(29, 2, 'History of Ancient Civilizations', 'This course explores the history and culture of ancient civilizations such as Mesopotamia, Egypt, Greece, and Rome. Students will examine archaeological evidence, historical texts, and the impact of these civilizations on modern society.', 40, '2024-08-28 02:09:28', '2024-08-28 02:09:28'),
(30, 2, 'Environmental Science and Sustainability', 'This course examines the principles of environmental science and the challenges of sustainability. Topics include climate change, renewable energy, conservation, and sustainable development. Students will participate in field trips and research projects.', 35, '2024-08-28 02:09:28', '2024-08-28 02:09:28'),
(31, 1, 'Digital Art and Animation', 'This course introduces students to the techniques and tools used in digital art and animation. Topics include digital painting, 3D modeling, and animation principles. Students will create their own digital art projects and animations.', 25, '2024-08-28 02:09:28', '2024-08-28 02:09:28'),
(32, 1, 'Introduction to Cybersecurity', 'This course covers the basics of cybersecurity, including network security, cryptography, and ethical hacking. Students will learn how to protect systems and data from cyber threats.', 30, '2024-08-28 02:09:28', '2024-08-28 02:09:28'),
(33, 2, 'Introduction to Cybersecurity', 'This course covers the basics of cybersecurity, including network security, cryptography, and ethical hacking. Students will learn how to protect systems and data from cyber threats.', 30, '2024-08-28 02:09:28', '2024-08-28 02:09:28'),
(34, 1, 'Modern Art History', 'This course explores the development of modern art from the late 19th century to the present. Students will study major movements such as Impressionism, Cubism, and Abstract Expressionism.', 40, '2024-08-28 02:09:28', '2024-08-28 02:09:28'),
(35, 2, 'Introduction to Data Science', 'This course introduces students to the field of data science, including data analysis, visualization, and machine learning. Students will work with real-world datasets to gain practical experience.', 35, '2024-08-28 02:09:28', '2024-08-28 02:09:28'),
(36, 1, 'Philosophy of Mind', 'This course examines philosophical questions about the nature of the mind, consciousness, and personal identity. Topics include dualism, physicalism, and the mind-body problem.', 25, '2024-08-28 02:09:28', '2024-08-28 02:09:28'),
(37, 2, 'Introduction to Astrobiology', 'This course explores the possibility of life beyond Earth, including the study of extremophiles, the search for exoplanets, and the potential for extraterrestrial intelligence.', 30, '2024-08-28 02:09:28', '2024-08-28 02:09:28'),
(38, 1, 'Advanced Organic Chemistry', 'This course covers advanced topics in organic chemistry, including reaction mechanisms, synthesis, and spectroscopy. Students will conduct laboratory experiments to reinforce theoretical concepts.', 20, '2024-08-28 02:09:28', '2024-08-28 02:09:28'),
(39, 2, 'Introduction to Game Design', 'This course introduces students to the principles of game design, including gameplay mechanics, storytelling, and user experience. Students will create their own game prototypes.', 25, '2024-08-28 02:09:28', '2024-08-28 02:09:28'),
(40, 1, 'Environmental Ethics', 'This course examines ethical issues related to the environment, including climate change, animal rights, and conservation. Students will explore different philosophical perspectives on environmental responsibility.', 30, '2024-08-28 02:09:28', '2024-08-28 02:09:28'),
(41, 2, 'Introduction to Machine Learning', 'This course provides an introduction to machine learning algorithms and techniques, including supervised and unsupervised learning, neural networks, and deep learning.', 35, '2024-08-28 02:09:28', '2024-08-28 02:09:28'),
(42, 1, 'History of Modern Europe', 'This course covers the history of Europe from the Enlightenment to the present, including major events such as the French Revolution, World Wars, and the European Union.', 40, '2024-08-28 02:09:28', '2024-08-28 02:09:28'),
(43, 2, 'Introduction to Bioinformatics', 'This course introduces students to the field of bioinformatics, including the analysis of biological data, genome sequencing, and computational biology.', 30, '2024-08-28 02:09:28', '2024-08-28 02:09:28'),
(44, 1, 'Creative Writing: Poetry', 'This course focuses on the art of writing poetry, including techniques for crafting imagery, meter, and rhyme. Students will write and workshop their own poems.', 25, '2024-08-28 02:09:28', '2024-08-28 02:09:28'),
(45, 2, 'Introduction to Sociology', 'This course provides an overview of sociological concepts and theories, including the study of social institutions, culture, and social change.', 40, '2024-08-28 02:09:28', '2024-08-28 02:09:28'),
(46, 1, 'Advanced Calculus', 'This course covers advanced topics in calculus, including multivariable calculus, differential equations, and vector calculus. Students will solve complex mathematical problems.', 0, '2024-08-28 02:09:28', '2024-08-29 03:09:00');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `status` enum('enrolled','waiting','canceled') NOT NULL DEFAULT 'enrolled',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`id`, `user_id`, `course_id`, `status`, `created_at`, `updated_at`) VALUES
(29, 8, 24, 'canceled', '2024-08-29 18:54:15', '2024-08-29 19:12:01'),
(30, 8, 44, 'enrolled', '2024-08-29 18:54:25', '2024-08-29 19:11:12'),
(31, 8, 46, 'canceled', '2024-08-29 18:54:28', '2024-08-29 19:12:05'),
(32, 8, 26, 'enrolled', '2024-08-29 18:54:33', '2024-08-29 19:11:15');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `name`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 'Fall', '2024-08-26', '2024-12-15', '2024-08-28 02:09:10', '2024-08-28 02:09:10'),
(2, 'Spring', '2025-01-15', '2025-05-05', '2024-08-28 02:09:10', '2024-08-28 02:09:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip_code` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `ssn` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `address`, `city`, `state`, `zip_code`, `phone`, `ssn`) VALUES
(5, 'newstudent', '$2y$10$8Xwfw6S1aKFDAAZ76EENbuSt4jTXX5fKFpdbePIPy6lH8omKYc8bi', 'Corey', 'Hanson', 'newstudent@aol.com', '123 main st', 'La Vista', 'NE', '68128', '4029999999', '999999999'),
(8, 'student2', '$2y$10$Lmg28VQPwxaH5gYBJLIHF..noQ45wXqrm6w0q7GhLAH6DdhrvKfTe', 'John', 'Smith', 'student2@email.com', '123 state st', 'Fakeville', 'TX', '58674', '9991234567', '123456789');

-- --------------------------------------------------------

--
-- Table structure for table `waiting_lists`
--

CREATE TABLE `waiting_lists` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `semester_id` (`semester_id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `waiting_lists`
--
ALTER TABLE `waiting_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `waiting_lists`
--
ALTER TABLE `waiting_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`);

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `waiting_lists`
--
ALTER TABLE `waiting_lists`
  ADD CONSTRAINT `waiting_lists_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `waiting_lists_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
