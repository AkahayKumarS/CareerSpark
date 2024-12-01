-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2024 at 10:32 AM
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
-- Database: `careerspark`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `course_link` varchar(255) NOT NULL,
  `is_premium` tinyint(1) NOT NULL DEFAULT 0,
  `course_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `course_provider` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `category`, `course_link`, `is_premium`, `course_image`, `created_at`, `updated_at`, `course_provider`) VALUES
(11, 'Python Programming', 'Programming', 'https://www.coursera.org/specializations/python-3-programming', 0, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRYbsJFulTRg3kb36fs2oHH0rDX5C0uJ6HBDQ&s', '2024-11-27 07:55:26', '2024-11-28 15:50:33', ''),
(12, 'Full Stack web development', 'Web development', 'https://www.coursera.org/professional-certificates/ibm-full-stack-cloud-developer', 1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSiEjBilP-PBEbL7NAsVh5jU2PEYPgaGhh8-g&s', '2024-11-27 08:57:18', '2024-11-28 17:26:13', ''),
(13, 'Java Full Stack', 'Web development', 'https://www.udemy.com/course/full-stack-java-developer-java/?utm_source=adwords&utm_medium=udemyads&utm_campaign=Search_DSA_GammaCatchall_NonP_la.EN_cc.India&campaigntype=Search&portfolio=India&language=EN&product=Course&test=&audience=DSA&topic=&priority', 0, 'https://www.achieversit.com/management/uploads/course_image/Java-Full-Stack_(1).png', '2024-11-27 09:02:29', '2024-11-27 13:03:52', ''),
(14, 'Coding for Everyone: C and C++', 'Programming', 'https://www.coursera.org/specializations/coding-for-everyone', 1, 'https://media.geeksforgeeks.org/wp-content/uploads/20230629144356/Best-CPP-Courses-with-Certificates.png', '2024-11-28 18:36:53', '2024-11-28 18:36:53', ''),
(15, 'React - The Complete Guide 2024', 'Web Development', 'https://www.udemy.com/course/react-the-complete-guide-incl-redux/?couponCode=BFCPSALE24', 1, 'https://courses.tutorialswebsite.com/assets/front/img/category/reactjs-banner.jpeg', '2024-11-28 19:45:17', '2024-11-28 19:54:47', 'Udemy'),
(16, 'Cloud Computing on AWS for Beginners', 'Cloud Computing', 'https://www.udemy.com/course/introduction-to-cloud-computing-on-amazon-aws-for-beginners/?couponCode=BFCPSALE24', 1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQfX2uP2oWlJn9ePl4Gyoy47pkn3Kn-3YYw4A&s', '2024-11-28 20:14:15', '2024-11-28 20:14:15', 'Udemy');

-- --------------------------------------------------------

--
-- Table structure for table `recommendations`
--

CREATE TABLE `recommendations` (
  `recommendation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `career_path` varchar(255) NOT NULL,
  `confidence_score` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `resource_id` int(11) NOT NULL,
  `recommendation_id` int(11) NOT NULL,
  `resource_name` varchar(255) NOT NULL,
  `resource_link` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_profiles`
--

CREATE TABLE `student_profiles` (
  `profile_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bio` text DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `college` varchar(255) DEFAULT NULL,
  `highest_qualification` varchar(100) DEFAULT NULL,
  `github_profile` varchar(255) DEFAULT NULL,
  `linkedin_profile` varchar(255) DEFAULT NULL,
  `technical_skills` text DEFAULT NULL,
  `hobbies` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_profiles`
--

INSERT INTO `student_profiles` (`profile_id`, `user_id`, `bio`, `profile_picture`, `address`, `college`, `highest_qualification`, `github_profile`, `linkedin_profile`, `technical_skills`, `hobbies`, `updated_at`) VALUES
(5, 16, 'A motivated engineering student passionate about technology and innovation and a passionate artist.', '../uploads/profile_pictures/Akshaya_Kumar_S-Photoroom.png', 'Kundapura Taluk, Udupi Distraict, Karnataka', 'St. Joseph Engineering College, Mangaluru', 'Bachelor of Engineering in Computer Science', 'https://github.com/AkahayKumarS', 'https://www.linkedin.com/in/akshaya-kumar-s/', 'C, Java, Python, HTML, CSS, JavaScript, PHP, SQL, ReactJS, NodeJS, Bootsrap, Tailwind CSS', 'Drawing, Painting and Clay Modeling', '2024-11-27 09:25:23'),
(6, 19, '', '../uploads/profile_pictures/WhatsApp_Image_2023-12-21_at_11.20.57_PM-removebg-preview.png', '', '', '', '', '', '', '', '2024-11-27 12:17:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_type` enum('admin','student') DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `user_type`) VALUES
(15, 'Admin', 'admin@careerspark.com', '$2y$10$aKsipkFuS/8l36pZq4p2GuQxPoxIJIQBIC2n9nBKcAUtGWAC8EPW.', '2024-11-26 17:21:12', 'admin'),
(16, 'Akshay Kumar S', 'akshay@gmail.com', '$2y$10$CDRO9XiU9OIvxj2mG3aukeW4.p.c9s128sUAVl9VNN2TYrTjJuqJS', '2024-11-26 17:23:55', 'student'),
(17, 'Shankar Shettigar', 'shankar@gmail.com', '$2y$10$BPh/T9Ra04PvX1u9LVRmteb1/TuZvAc.iqunwSN21sR1OnT55y1xa', '2024-11-27 11:34:17', 'student'),
(18, 'Ajith Kumar', 'ajith@gmail.com', '$2y$10$fZVLeMsM5ePWuFq78.t8Dufq9lfCOzfG8XpV6gutH7z3Bwj6WL6FS', '2024-11-27 11:48:36', 'student'),
(19, 'Aishwarya', 'aishwarya@gmail.com', '$2y$10$L2Skp0GntT2hBEXRHXXtFeS/e2u1p6YcYlr/44Pp3I.mhR87mXfou', '2024-11-27 12:16:15', 'student'),
(20, 'Amma', 'amma@gmail.com', '$2y$10$hl.HuFm0auXWST.2aRxa8ezxw4q733nyqet3L0GxYPMVHTwYQaDce', '2024-11-27 12:52:37', 'student'),
(21, 'Ajith Kumar', 'ajithkumar@gmail.com', '$2y$10$zFT/7i2NSc/iHasN2m7yPuQubjKO8tUMlwTlIKyDvEnmy3..QoGBe', '2024-11-27 12:59:12', 'student'),
(22, 'Ajith Kumar', 'akshaykumars@gmail.com', '$2y$10$pozGZ9183HeaKORkAKemSusbZ5Qcs11qvx93k8ND1W59FjZGMuJ76', '2024-11-27 13:34:42', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recommendations`
--
ALTER TABLE `recommendations`
  ADD PRIMARY KEY (`recommendation_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`resource_id`),
  ADD KEY `recommendation_id` (`recommendation_id`);

--
-- Indexes for table `student_profiles`
--
ALTER TABLE `student_profiles`
  ADD PRIMARY KEY (`profile_id`),
  ADD KEY `fk_user_profile` (`user_id`);

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
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `recommendations`
--
ALTER TABLE `recommendations`
  MODIFY `recommendation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `resource_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_profiles`
--
ALTER TABLE `student_profiles`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recommendations`
--
ALTER TABLE `recommendations`
  ADD CONSTRAINT `recommendations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `resources`
--
ALTER TABLE `resources`
  ADD CONSTRAINT `resources_ibfk_1` FOREIGN KEY (`recommendation_id`) REFERENCES `recommendations` (`recommendation_id`) ON DELETE CASCADE;

--
-- Constraints for table `student_profiles`
--
ALTER TABLE `student_profiles`
  ADD CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
