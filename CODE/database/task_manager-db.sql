-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2024 at 04:57 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `task_admin`
--

CREATE TABLE `task_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task_admin`
--

INSERT INTO `task_admin` (`id`, `username`, `pass`, `role`) VALUES
(2, 'admin', 'admin', 0),
(3, 'supervisor ', 'supervisor ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `task_employees`
--

CREATE TABLE `task_employees` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `emp_username` varchar(255) DEFAULT NULL,
  `emp_pass` varchar(255) DEFAULT NULL,
  `token` varchar(500) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `join_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task_employees`
--

INSERT INTO `task_employees` (`id`, `name`, `emp_username`, `emp_pass`, `token`, `email`, `phone`, `address`, `designation`, `photo`, `join_date`) VALUES
(47, 'Harry', 'harry', '$2y$10$ha2YWR0RsCBis1vMP0GhfOTNyvLterfmju9608KnR.4V9zoeNLY3W', 'f78d0cc204a2bfc158bfff7e06f06129', 'harry@task.com', '+44 1234567890', 'Marsh Gate, South Yorkshire, United Kingdom', 'Web Developer', '../assets/employeeimgs/1432399887-FileName-exeter-ai.png', '2024-04-20'),
(48, 'Arthur', 'arthur', '$2y$10$nugEkcai.GTMNi83SkDqXuiq.wIGowEhIeDHH20krz1tlu7zN4UJa', NULL, 'arthur@gmail.com', ' +44 1234567890', ' Marsh Gate, South Yorkshire, United Kingdom', 'Web Designer', '../assets/employeeimgs/927767227-FileName-profilepicture-2-portrait-head.jpg', '2024-04-22'),
(49, 'John', 'john', '$2y$10$gfqeI4VYQSzmCqK3mSt.iew6ntCgAuYFFtNTE5hkvfOmhJog./XjO', NULL, 'john@gmail.com', '+440000000000', 'XYZ', 'SEO Expert', '../assets/employeeimgs/1343663816-FileName-ai-generated-male-business-manager-leading-team-ai-generated-photo.jpg', '2024-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `task_notes`
--

CREATE TABLE `task_notes` (
  `id` int(11) NOT NULL,
  `task_id` int(30) DEFAULT NULL,
  `user_id` int(50) DEFAULT NULL,
  `notes` varchar(255) NOT NULL,
  `submit_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task_notes`
--

INSERT INTO `task_notes` (`id`, `task_id`, `user_id`, `notes`, `submit_date`) VALUES
(18, 56, 56, 'Profile Coding Completed. Working On Styling.', '2024-04-22 18:21:02'),
(19, 56, 56, 'Styling Completed', '2024-04-22 18:21:13');

-- --------------------------------------------------------

--
-- Table structure for table `task_projects`
--

CREATE TABLE `task_projects` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(1000) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task_projects`
--

INSERT INTO `task_projects` (`id`, `name`, `url`, `country`, `date`) VALUES
(29, 'Real Estate Agency', 'www.domian.com', 'United Kingdom', '2024-04-22'),
(30, 'Shopify Store', 'www.domain.com', 'United Kingdom', '2024-04-22'),
(32, 'Digital Marketing Agency', 'www.domain.com', 'United Kingdom', '2024-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `task_tasks`
--

CREATE TABLE `task_tasks` (
  `id` int(11) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `task_description` longtext DEFAULT NULL,
  `project_id` int(16) DEFAULT NULL,
  `employee_id` int(16) DEFAULT NULL,
  `priority_level` varchar(50) DEFAULT NULL,
  `assign_date` date NOT NULL DEFAULT current_timestamp(),
  `submit_date` date NOT NULL,
  `task_status` int(16) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task_tasks`
--

INSERT INTO `task_tasks` (`id`, `task_name`, `task_description`, `project_id`, `employee_id`, `priority_level`, `assign_date`, `submit_date`, `task_status`) VALUES
(56, 'Interactive Product Showcase', '<p>Develop a responsive web application to showcase our latest product line. The application should allow users to browse through different products, view detailed descriptions, and interact with 360-degree product images. Implement features like filtering by category, sorting by price, and a cart system for adding products. Ensure smooth transitions and an intuitive user interface to enhance the shopping experience. This project will involve front-end development using HTML, CSS, JavaScript, and possibly integration with a backend API for product data.</p>', 29, 47, 'Priority', '2024-04-22', '2024-04-30', 2),
(57, 'Create a Shoofly Store', '<p>Explore our range of products designed to minimize environmental impact while maximizing style and functionality. Whether you\'re looking to refresh your wardrobe with eco-friendly fashion or seeking eco-conscious gifts for loved ones, EcoFinds Boutique has something for everyone.</p>', 30, 47, 'Normal', '2024-04-22', '2024-04-29', 1),
(58, 'Enhanced User Profile Management System', '<p>Description:<br>Develop a robust user profile management system for our platform to enhance user engagement and personalization. The system should allow users to create detailed profiles, update information, upload profile pictures, and manage preferences.</p><p>Key features to implement:</p><p>User Registration and Authentication: Enable users to register securely and authenticate via email or social media accounts.<br>Profile Creation and Editing: Provide users with the ability to create detailed profiles including personal information, interests, and contact details. Allow easy editing of profile information.<br>Profile Picture Upload: Allow users to upload and manage profile pictures, with support for image cropping and resizing.<br>Privacy and Security Settings: Implement privacy settings to control the visibility of profile information to other users.<br>Preferences Management: Enable users to set preferences such as email notifications, language preferences, and communication settings.<br>User Dashboard: Create a dashboard for users to view and manage their profiles and settings in one centralized location.<br>Technologies to use:</p><p>Backend: Node.js with Express framework<br>Database: MongoDB for storing user profiles and preferences<br>Frontend: React.js for a responsive and intuitive user interface<br>Authentication: Implement JWT (JSON Web Tokens) for secure authentication and session management<br>This project aims to enhance user experience by providing a comprehensive and user-friendly profile management system. The system should be scalable and maintainable to accommodate future updates and feature enhancements.</p>', 29, 47, 'High Priority', '2024-04-22', '2024-04-26', 2),
(60, 'Enhanced User Profile Management System', '<p>Develop a robust user profile management system for our platform to enhance user engagement and personalization. The system should allow users to create detailed profiles, update information, upload profile pictures, and manage preferences.<br>Key features to implement:<br>User Registration and Authentication: Enable users to register securely and authenticate via email or social media accounts.<br>Profile Creation and Editing: Provide users with the ability to create detailed profiles including personal information, interests, and contact details. Allow easy editing of profile information.<br>Profile Picture Upload: Allow users to upload and manage profile pictures, with support for image cropping and resizing.<br>Privacy and Security Settings: Implement privacy settings to control the visibility of profile information to other users.<br>Preferences Management: Enable users to set preferences such as email notifications, language preferences, and communication settings.<br>User Dashboard: Create a dashboard for users to view and manage their profiles and settings in one centralized location.<br>Technologies to use:<br>Backend: Node.js with Express framework<br>Database: MongoDB for storing user profiles and preferences<br>Frontend: React.js for a responsive and intuitive user interface<br>Authentication: Implement JWT (JSON Web Tokens) for secure authentication and session management<br>This project aims to enhance user experience by providing a comprehensive and user-friendly profile management system. The system should be scalable and maintainable to accommodate future updates and feature enhancements.<br>&nbsp;</p>', 32, 49, 'High Priority', '2024-04-22', '2024-04-24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `task_user`
--

CREATE TABLE `task_user` (
  `id` int(11) NOT NULL,
  `userid` int(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task_user`
--

INSERT INTO `task_user` (`id`, `userid`, `email`, `pass`) VALUES
(1, NULL, 'abd', 'abd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `task_admin`
--
ALTER TABLE `task_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_employees`
--
ALTER TABLE `task_employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emp_username` (`emp_username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `task_notes`
--
ALTER TABLE `task_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_projects`
--
ALTER TABLE `task_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_tasks`
--
ALTER TABLE `task_tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_user`
--
ALTER TABLE `task_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `task_admin`
--
ALTER TABLE `task_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `task_employees`
--
ALTER TABLE `task_employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `task_notes`
--
ALTER TABLE `task_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `task_projects`
--
ALTER TABLE `task_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `task_tasks`
--
ALTER TABLE `task_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `task_user`
--
ALTER TABLE `task_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
