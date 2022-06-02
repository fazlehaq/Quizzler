-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Jun 01, 2022 at 03:32 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quizzlerrelational`
--

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `sr_no` bigint(12) NOT NULL,
  `quiz_id` bigint(20) NOT NULL,
  `question` varchar(600) NOT NULL,
  `option1` varchar(150) NOT NULL,
  `option2` varchar(150) NOT NULL,
  `option3` varchar(150) NOT NULL,
  `option4` varchar(150) NOT NULL,
  `answer` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`sr_no`, `quiz_id`, `question`, `option1`, `option2`, `option3`, `option4`, `answer`) VALUES
(1, 1, 'PHP stands for -', 'Hypertext Preprocessor', 'Pretext Hypertext Preprocessor', 'Personal Home Processor', 'None of the above', 'Hypertext Preprocessor'),
(2, 1, 'Who is known as the father of PHP?', 'List Barely, , , ', 'Rasmus Lerdrof', 'Drek Kolkevi', 'None of the above', 'Rasmus Lerdrof'),
(3, 1, 'Variable name in PHP starts with -', '! (Exclamation)  ', '$ (Dollar)', '& (Ampersand)', '# (Hash)', '$ (Dollar)'),
(4, 1, 'Which of the following is the default file extension of PHP?', '.php', '.hphp', '.html', '.xml', '.php'),
(5, 1, 'Which of the following is not a variable scope in PHP?', 'Static', 'Global', 'Local', 'Extern', 'Extern'),
(6, 1, 'Which of the following is correct to add a comment in php?', '& …… &', ' // ……, /', '* …… */', 'Both (2) and (3)', 'Both (2) and (3)'),
(7, 1, 'Which of the following is used to display the output in PHP?', 'echo', 'write', 'print', 'Both (1) and (3)', 'Both (1) and (3)'),
(8, 1, 'Which of the following is used for concatenation in PHP?', '+ (plus)', '* (Asterisk)', '. (dot)', 'append()', '. (dot)'),
(9, 1, 'Which of the following is the correct way to create a function in PHP?', 'Create myFunction()', ' New_function myFunction()', 'function myFunction()', 'None of the above', 'None of the above'),
(10, 1, 'Which of the following function is used to unset a variable in PHP?', 'delete()', 'unset()', 'unlink()', 'None of the above', 'unset()'),
(11, 2, 'What is C++ ?', 'Procedural Oriented Language', 'functional Language', 'Object Oriented Language', 'All of the above', 'All of the above'),
(12, 2, 'Where does the execution of C++ program begins?', 'main()', '#include<iostream>', 'public static void main()', 'none of the above', 'main()'),
(13, 2, 'Which function is used to print in C++?', 'printf()', 'echo()', 'cout', 'Both (1) & (3)', 'Both (1) & (3)'),
(14, 2, 'In cout<<\"\"; what is it called \'<<\' ?', 'Extraction Operator', 'Contraction Operator', 'Output Operator', 'Display Operator', 'Extraction Operator'),
(15, 2, 'What do you mean by recurrsion?', 'Function keep calling itself', 'function calls another function', ' Higher Order Function', 'None of the Above', 'Function keep calling itself'),
(16, 2, 'Which of the following is the correct extension of C++ file?', '.hgh', '.c', '.h', '.cpp', '.cpp'),
(17, 2, 'C++ uses which approach?', 'Right-Left', 'Top-Down', 'Left-Right', 'Bottom-Up', 'Bottom-Up'),
(18, 2, 'Which of the following data type is not supported in C++ but not in C?', 'int', 'float', 'double', 'bool', 'bool'),
(19, 2, 'Identify correct syntax for declaring arrays in C++.', 'array arr[10]', 'array[10]', 'int arr[10]', 'int arr', 'int arr[10]'),
(20, 2, 'Which of the following is the address operator?', '*', '&', '[]', '&&', '&'),
(21, 2, 'What is correct way of pre-Increment the variable in C++?', 'n++', 'n+', '++n', '+n+', '++n'),
(22, 2, 'Which loop is preferred when we know the number of iterations?', 'for loop', 'while loop', 'do while', 'foreach', 'for loop'),
(23, 2, 'Identify the scope resolution operator?', ':', '?', '::', '^', ':'),
(24, 2, 'When can inline function be expanded?', 'Run Time', 'Compile Time', 'Never gets compiled', 'None of the above', 'Run Time'),
(25, 2, 'What is the size of int datatype in C++?', '1 byte', '2 byte ', '4 byte', 'Compiler Dependent', 'compiler Dependent');

-- --------------------------------------------------------

--
-- Table structure for table `quizlist`
--

CREATE TABLE `quizlist` (
  `quiz_id` bigint(20) NOT NULL,
  `quiz_name` varchar(50) NOT NULL,
  `total_questions` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quizlist`
--

INSERT INTO `quizlist` (`quiz_id`, `quiz_name`, `total_questions`, `time`, `status`) VALUES
(1, 'php', 10, 5, 1),
(2, 'c++', 15, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ranks`
--

CREATE TABLE `ranks` (
  `sr_no` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `quiz_id` bigint(20) NOT NULL,
  `score` int(11) NOT NULL,
  `Date and Time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ranks`
--

INSERT INTO `ranks` (`sr_no`, `user_id`, `quiz_id`, `score`, `Date and Time`) VALUES
(1, 1, 2, 13, '2022-06-01 13:19:24'),
(2, 1, 2, 1, '2022-06-01 13:25:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `Email`, `Password`) VALUES
(1, 'Md Fazle Haque', 'fazlehaqs360@gmail.com', '$2y$10$G0a.jCCwJMPkAUaJI.jZ5.DxmV5tFFir76hpGN.hTXVFe2pl0vDba'),
(2, 'solu', 'solu@email', '$2y$10$UZ8o/VF/9rSvcmYtskyLVeiS7TqibQE1lCz2K7nfmyoP9qCM5wL3O'),
(3, 'molu', 'molu@email', '$2y$10$I6GqftX/7i4wijyqnXOq9.iVnw4KFAZr7e9clXP/zzOKklhLS6ySK'),
(5, 'nabeel@2323', 'nabeel@email', '$2y$10$5bb.99amkh92qz9aiRjhPubtqdZMdVDCFfy2PpVngAdUm1hJTuX/6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `quizlist`
--
ALTER TABLE `quizlist`
  ADD PRIMARY KEY (`quiz_id`),
  ADD UNIQUE KEY `quiz_name` (`quiz_name`);

--
-- Indexes for table `ranks`
--
ALTER TABLE `ranks`
  ADD PRIMARY KEY (`sr_no`),
  ADD UNIQUE KEY `sr_no` (`sr_no`),
  ADD KEY `q_id` (`quiz_id`),
  ADD KEY `u_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `sr_no` bigint(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `quizlist`
--
ALTER TABLE `quizlist`
  MODIFY `quiz_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ranks`
--
ALTER TABLE `ranks`
  MODIFY `sr_no` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `quiz_id` FOREIGN KEY (`quiz_id`) REFERENCES `quizlist` (`quiz_id`);

--
-- Constraints for table `ranks`
--
ALTER TABLE `ranks`
  ADD CONSTRAINT `q_id` FOREIGN KEY (`quiz_id`) REFERENCES `quizlist` (`quiz_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `u_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
