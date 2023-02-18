-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2023 at 05:25 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `sl` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`sl`, `name`, `email`, `emp_id`, `password`) VALUES
(1, 'john doe', 'john@email.com', 9999, '25f9e794323b453885f5181f1b624d0b');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `sl` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `exam` varchar(255) NOT NULL,
  `marks` int(11) NOT NULL,
  `credit` int(11) NOT NULL,
  `supervisor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`sl`, `id`, `semester`, `exam`, `marks`, `credit`, `supervisor`) VALUES
(1, 191311084, 10, 'spring-2022', 4, 1, 'RIS'),
(2, 191311159, 10, 'spring-2022', 4, 1, 'RIS'),
(3, 191311075, 10, 'spring-2022', 4, 1, 'RIS'),
(4, 191311099, 10, 'spring-2022', 3, 1, 'RIS'),
(5, 191311015, 10, 'spring-2022', 3, 1, 'RIS'),
(6, 191311151, 10, 'spring-2022', 3, 1, 'RIS');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `sl` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `id` varchar(255) NOT NULL,
  `semester` int(11) NOT NULL,
  `section` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `supervisor` varchar(255) NOT NULL,
  `teamCode` varchar(255) DEFAULT NULL,
  `report_file` varchar(255) DEFAULT NULL,
  `credit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`sl`, `name`, `id`, `semester`, `section`, `title`, `supervisor`, `teamCode`, `report_file`, `credit`) VALUES
(245, 'Nafisa Shameem Raha', '191311059', 10, 'B', 'Feature Selection Technique for Prediction of Neuro-Degenerative Disorders in Data Mining', 'KIM', '2023_364724', NULL, 0),
(246, 'Anik Das', '191311003', 10, 'A', 'Feature Selection Technique for Prediction of Neuro-Degenerative Disorders in Data Mining', 'KIM', '2023_364724', NULL, 0),
(247, 'Humira Jinat Reya', '191311062', 10, 'B', 'Feature Selection Technique for Prediction of Neuro-Degenerative Disorders in Data Mining', 'KIM', '2023_364724', NULL, 0),
(248, 'Md. Anarul Islam', '191311084', 11, 'C', 'Open Source Client-Server Traffic Sniffer for Security Testing', 'RIS', '2023_791650', '191311084-191311159-191311075.pdf', 1),
(249, 'Md. Rakibul Hasan Lipu', '191311159', 11, 'C', 'Open Source Client-Server Traffic Sniffer for Security Testing', 'RIS', '2023_791650', '191311084-191311159-191311075.pdf', 1),
(250, 'Md. Mahamudul Hasan Roky', '191311075', 11, 'C', 'Open Source Client-Server Traffic Sniffer for Security Testing', 'RIS', '2023_791650', '191311084-191311159-191311075.pdf', 1),
(251, 'Mst.Sunjida Kabir', '191311154', 10, 'C', 'University Project/Thesis Information Registry', 'TKA', '2023_788143', NULL, 0),
(252, 'Nishat Tasnim', '191311113', 10, 'C', 'University Project/Thesis Information Registry', 'TKA', '2023_788143', NULL, 0),
(253, 'Sumaiya Sharmin Srity', '191311082', 10, 'C', 'University Project/Thesis Information Registry', 'TKA', '2023_788143', NULL, 0),
(254, 'Fardin Fuad', '191311017', 10, 'B', 'Student Lodging/Hostel Rent Finding System and Online Complaint Box', 'AKI', '2023_278163', NULL, 0),
(255, 'Ashis Sarkar', '173311012', 10, 'B', 'Student Lodging/Hostel Rent Finding System and Online Complaint Box', 'AKI', '2023_278163', NULL, 0),
(256, 'Mst.Nure Jannat Sarmin Lopa', '191311099', 11, 'B', 'Pet Care and Maintenance Website', 'RIS', '2023_457981', '191311099-191311015.pdf', 1),
(257, 'Rukaiya Yesmin', '191311015', 11, 'A', 'Pet Care and Maintenance Website', 'RIS', '2023_457981', '191311099-191311015.pdf', 1),
(258, 'Md.foysal Rahaman', '191311151', 11, 'A', 'Pet Care and Maintenance Website', 'RIS', '2023_457981', '191311151.pdf', 1),
(259, 'Md. Razwanul Hasan', '191311020', 10, 'B', 'Patient&#039;s Integrated Medical Information System', 'MRS', '2023_638017', NULL, 0),
(260, 'Mst. Shadia Sultana Shethy', '191311005', 10, 'A', 'Patient&#039;s Integrated Medical Information System', 'MRS', '2023_638017', NULL, 0),
(261, 'Md. Ashif Imtaiaz', '191311060', 10, 'B', 'Patient&#039;s Integrated Medical Information System', 'MRS', '2023_638017', NULL, 0),
(262, 'Abdullah Tamim', '191311031', 10, 'C', 'Prediction of Prices of European Football League Transfer Window using Machine Learning and Deep Learning Algorithms', 'AH', '2023_145842', NULL, 0),
(263, 'Md. Rashid Shahriar Chowdhury', '191311155', 10, 'C', 'Prediction of Prices of European Football League Transfer Window using Machine Learning and Deep Learning Algorithms', 'AH', '2023_145842', NULL, 0),
(264, 'Md. Wadud Jahan', '191311033', 10, 'C', 'Prediction of Prices of European Football League Transfer Window using Machine Learning and Deep Learning Algorithms', 'AH', '2023_145842', NULL, 0),
(265, 'Md. Imran Sarkar', '191311008', 10, 'C', 'Phone Locking and Unlocking via Shake Pattern', 'AKI', '2023_967980', NULL, 0),
(266, 'Mst. Surovi Akter Tumpa', '191311039', 10, 'C', 'Phone Locking and Unlocking via Shake Pattern', 'AKI', '2023_967980', NULL, 0),
(267, 'Mehnaz Tabassum', '191311167', 10, 'C', 'Phone Locking and Unlocking via Shake Pattern', 'AKI', '2023_967980', NULL, 0),
(268, 'Md. Mehedi Hasan', '191311019', 10, 'A', 'Prediction of Weather Forecast for Smart Agriculture Supported by Machine Learning', 'AMM', '2023_162814', NULL, 0),
(269, 'Md. Waly Ul Amin', '191311054', 10, 'A', 'Prediction of Weather Forecast for Smart Agriculture Supported by Machine Learning', 'AMM', '2023_162814', NULL, 0),
(270, 'Sharaf Nawar Sharika', '191311028', 10, 'A', 'Prediction of Weather Forecast for Smart Agriculture Supported by Machine Learning', 'AMM', '2023_162814', NULL, 0),
(271, 'Md.Alfaz Bin Rumon', '191311108', 10, 'B', 'Facial Emotion Detection using CNN', 'GS', '2023_638199', NULL, 0),
(272, 'Sumaya Rahman Silvia', '191311172', 10, 'B', 'Facial Emotion Detection using CNN', 'GS', '2023_638199', NULL, 0),
(273, 'Mst.sadiya Yesmin', '191311097', 10, 'B', 'Facial Emotion Detection using CNN', 'GS', '2023_638199', NULL, 0),
(274, 'Mst.Roxana Akter', '191311096', 10, 'B', 'Fish Requirement System using IoT', 'SHR', '2023_564230', NULL, 0),
(275, 'Rajibul Hasan Raj', '191311107', 10, 'B', 'Fish Requirement System using IoT', 'SHR', '2023_564230', NULL, 0),
(276, 'Abidul Haque', '191311156', 10, 'B', 'Fish Requirement System using IoT', 'SHR', '2023_564230', NULL, 0),
(277, 'Md Al Amin Islam', '191311132', 10, 'C', 'Mess/Tenant Management App', 'MRS', '2023_809938', NULL, 0),
(278, 'Md Sakibul Hasan', '191311145', 10, 'C', 'Mess/Tenant Management App', 'MRS', '2023_809938', NULL, 0),
(279, 'Most. Nafisa Yesmin', '191311004', 10, 'C', 'Mess/Tenant Management App', 'MRS', '2023_809938', NULL, 0),
(280, 'S. M. Ariful Islam', '191311122', 10, 'C', 'Detection of Five Stages of Diabetic Retinopathy', 'SAL', '2023_984968', NULL, 0),
(281, 'Md. Aliul Azim', '191311051', 10, 'C', 'Detection of Five Stages of Diabetic Retinopathy', 'SAL', '2023_984968', NULL, 0),
(282, 'Md.maksudul Islam Rabbi', '181311128', 10, 'C', 'Detection of Five Stages of Diabetic Retinopathy', 'SAL', '2023_984968', NULL, 0),
(283, 'Khondoker Tahsin Ahmed', '191311025', 10, 'C', 'Plant Identity Application', 'TKA', '2023_665031', NULL, 0),
(284, 'Md. Abir Hossain Setu', '191311012', 10, 'C', 'Plant Identity Application', 'TKA', '2023_665031', NULL, 0),
(285, 'Md. Ruhin Mahbub', '191311057', 10, 'B', 'Plant Identity Application', 'TKA', '2023_665031', NULL, 0),
(286, 'Mst. Jakiya Tasnova', '191311112', 10, 'B', 'Highlights of the year site', 'ITR', '2023_781901', NULL, 0),
(287, 'Abdullah Al Emon', '191311022', 10, 'A', 'Highlights of the year site', 'ITR', '2023_781901', NULL, 0),
(288, 'Mst. Aulima Liza', '191311114', 10, 'A', 'Highlights of the year site', 'ITR', '2023_781901', NULL, 0),
(289, 'Md. Nasimul Hoque Sohan', '191311048', 10, 'C', 'Travel Information and Guidelines', 'MTI', '2023_848288', NULL, 0),
(290, 'Md. Eman Ali', '191311026', 10, 'C', 'Travel Information and Guidelines', 'MTI', '2023_848288', NULL, 0),
(291, 'Mim Obaidur Rahman Nasim', '191311086', 10, 'C', 'Travel Information and Guidelines', 'MTI', '2023_848288', NULL, 0),
(292, 'Golam Ahnaf Zadid', '191311014', 10, 'A', 'Market Basket Analysis for Improving the Effectiveness of Marketing and Sales using Data Mining', 'AMM', '2023_366340', NULL, 0),
(293, 'Mst. Asha Khatun', '191311068', 10, 'B', 'Market Basket Analysis for Improving the Effectiveness of Marketing and Sales using Data Mining', 'AMM', '2023_366340', NULL, 0),
(294, 'Jerin Tasneem Bristy', '191311153', 10, 'A', 'Market Basket Analysis for Improving the Effectiveness of Marketing and Sales using Data Mining', 'AMM', '2023_366340', NULL, 0),
(295, 'Md. Mostafizur Rahman', '191311073', 10, 'B', 'NGO Finder and Information Web Application for Users', 'SR', '2023_281485', NULL, 0),
(296, 'Tasnia Azmi', '191311029', 10, 'A', 'NGO Finder and Information Web Application for Users', 'SR', '2023_281485', NULL, 0),
(297, 'Md. Jahid Hasan', '191311150', 10, 'A', 'NGO Finder and Information Web Application for Users', 'SR', '2023_281485', NULL, 0),
(298, 'Zarin Sharmin', '191311013', 10, 'A', 'Emotion Detection using Facial Expression', 'ST', '2023_333559', NULL, 0),
(299, 'Mostarin Sultana', '191311036', 10, 'B', 'Emotion Detection using Facial Expression', 'ST', '2023_333559', NULL, 0),
(300, 'Taufiqur Rahman', '191311010', 10, 'A', 'Emotion Detection using Facial Expression', 'ST', '2023_333559', NULL, 0),
(301, 'Mominul Islam', '191311072', 10, 'A', 'Mining Big Data for Climate-Smart Agriculture', 'MK', '2023_823776', NULL, 0),
(302, 'Md.asif Istiak', '191311011', 10, 'A', 'Mining Big Data for Climate-Smart Agriculture', 'MK', '2023_823776', NULL, 0),
(303, 'Sabbir Hossen', '191311074', 10, 'A', 'Mining Big Data for Climate-Smart Agriculture', 'MK', '2023_823776', NULL, 0),
(304, 'Most.Farjana Famim', '191311161', 10, 'B', 'Face Mask Detection', 'SMT', '2023_940724', NULL, 0),
(305, 'Md. Mahfizur  Rahman Polok', '191311160', 10, 'B', 'Face Mask Detection', 'SMT', '2023_940724', NULL, 0),
(306, 'Md. Samrat Sagor', '191311106', 10, 'B', 'Face Mask Detection', 'SMT', '2023_940724', NULL, 0),
(307, 'Jannatul mawa', '191311083', 10, 'B', 'Review Website', 'AAL', '2023_565682', NULL, 0),
(308, 'Sazia Arfrin Tamanna Nodi', '191311090', 10, 'A', 'Review Website', 'AAL', '2023_565682', NULL, 0),
(309, 'Jasmin Akter', '191311100', 10, 'A', 'Review Website', 'AAL', '2023_565682', NULL, 0),
(310, 'Md. Fatin Ilham', '191311102', 10, 'A', 'Gait Recognition from Incomplete to Complete Gait Cycle using Deep Learning', 'GS', '2023_601526', NULL, 0),
(311, 'Md. Mehedi Hasan', '191311081', 10, 'B', 'Gait Recognition from Incomplete to Complete Gait Cycle using Deep Learning', 'GS', '2023_601526', NULL, 0),
(312, 'Khalid Saifullah Sabbir', '191311009', 10, 'A', 'Gait Recognition from Incomplete to Complete Gait Cycle using Deep Learning', 'GS', '2023_601526', NULL, 0),
(313, 'Faria Mahjabin Tazree', '191311066', 10, 'B', 'Clustering based Pattern Analysis on COVID-19 using Data Mining Technique to Predict the Age Level for Death Cases in Bangladesh', 'AH', '2023_900242', NULL, 0),
(314, 'Sohana Momtaz', '191311002', 10, 'B', 'Clustering based Pattern Analysis on COVID-19 using Data Mining Technique to Predict the Age Level for Death Cases in Bangladesh', 'AH', '2023_900242', NULL, 0),
(315, 'Md. Minhazur Hossain', '191311116', 10, 'B', 'Clustering based Pattern Analysis on COVID-19 using Data Mining Technique to Predict the Age Level for Death Cases in Bangladesh', 'AH', '2023_900242', NULL, 0),
(316, 'Sayeka Islam Safa', '191311016', 10, 'A', 'Development of a Social Media Bullying Detection on Bangla Text', 'MK', '2023_240391', NULL, 0),
(317, 'Md. Shakir Ahmed', '191311162', 10, 'B', 'Development of a Social Media Bullying Detection on Bangla Text', 'MK', '2023_240391', NULL, 0),
(318, 'Md. Sohanur Rahman', '191311058', 10, 'A', 'Development of a Social Media Bullying Detection on Bangla Text', 'MK', '2023_240391', NULL, 0),
(319, 'Anik Kumar Mondal.', '191311130', 10, 'C', 'Performance Analysis of Facial and Iris Recognition using Super Resolution Algorithm', 'JF', '2023_837099', NULL, 0),
(320, 'Umme Rimjim Boyshaki', '191311024', 10, 'C', 'Performance Analysis of Facial and Iris Recognition using Super Resolution Algorithm', 'JF', '2023_837099', NULL, 0),
(321, 'Md. Shaiful Mursalin', '163311015', 10, 'C', 'Performance Analysis of Facial and Iris Recognition using Super Resolution Algorithm', 'JF', '2023_837099', NULL, 0),
(322, 'Hasnat arefin', '191311175', 10, 'C', 'Virtual Desktop Assistant', 'NN', '2023_283040', NULL, 0),
(323, 'Md.sojib Shake', '191311078', 10, 'C', 'Virtual Desktop Assistant', 'NN', '2023_283040', NULL, 0),
(324, 'Md.minhajul Islam', '191311077', 10, 'B', 'Virtual Desktop Assistant', 'NN', '2023_283040', NULL, 0),
(325, 'Md. Fajla Rabby', '191311166', 10, 'A', 'Path Finding Algorithms Visualization', 'AF', '2023_792301', NULL, 0),
(326, 'Taskin Hossain', '191311001', 10, 'A', 'Path Finding Algorithms Visualization', 'AF', '2023_792301', NULL, 0),
(327, 'Rabby Islam', '191311037', 10, 'A', 'Path Finding Algorithms Visualization', 'AF', '2023_792301', NULL, 0),
(328, 'Md.Imran Ali', '191311047', 10, 'B', 'Rice Leaf Diseases Image Classification using Convolutional Neural Network', 'JF', '2023_954019', NULL, 0),
(329, 'Md. Hossain Ahammod Khan Nayeem', '191311110', 10, 'B', 'Rice Leaf Diseases Image Classification using Convolutional Neural Network', 'JF', '2023_954019', NULL, 0),
(330, 'Md.ruhul Amin', '191311147', 10, 'B', 'Rice Leaf Diseases Image Classification using Convolutional Neural Network', 'JF', '2023_954019', NULL, 0),
(331, 'Md Ebrahim Ali', '191311088', 10, 'A', 'Design Concept for Interative OS Service', 'NN', '2023_955837', NULL, 0),
(332, 'Moriam Nessa', '191311101', 10, 'A', 'Design Concept for Interative OS Service', 'NN', '2023_955837', NULL, 0),
(333, 'Md. Munzurul Hasan Mridha', '191311079', 10, 'A', 'Design Concept for Interative OS Service', 'NN', '2023_955837', NULL, 0),
(334, 'Md. Wasy Ul Amin', '191311053', 10, 'A', 'Analysis of the Quality of Education and Addiction to Social Media of University Students in Online Education System', 'ST', '2023_999156', NULL, 0),
(335, 'Sanaullah Al Sakib', '191311065', 10, 'A', 'Analysis of the Quality of Education and Addiction to Social Media of University Students in Online Education System', 'ST', '2023_999156', NULL, 0),
(336, 'Md. A. Quader', '191311135', 10, 'A', 'Analysis of the Quality of Education and Addiction to Social Media of University Students in Online Education System', 'ST', '2023_999156', NULL, 0),
(337, 'Rifah Tasnia', '191311035', 10, 'A', 'Understanding Mobile Application and Social Media User Behavior using Data Science', 'AMM', '2023_124514', NULL, 0),
(338, 'Mehezabin Mubin', '191311044', 10, 'C', 'Understanding Mobile Application and Social Media User Behavior using Data Science', 'AMM', '2023_124514', NULL, 0),
(339, 'Rookaya Sultana', '191311055', 10, 'C', 'Understanding Mobile Application and Social Media User Behavior using Data Science', 'AMM', '2023_124514', NULL, 0),
(340, 'Md. Athsanul Islam', '181311150', 10, 'A', 'Thesis/Project Information Registry', 'MTI', '2023_908554', NULL, 0),
(341, 'Md. Tawhid Alahi Munna', '191311021', 10, 'A', 'Thesis/Project Information Registry', 'MTI', '2023_908554', NULL, 0),
(342, 'Ashik Sarker', '191311045', 10, 'B', 'Thesis/Project Information Registry', 'MTI', '2023_908554', NULL, 0),
(343, 'Md. Arik Shahriar', '191311144', 10, 'B', 'Stock/Inventory Management System', 'DH', '2023_269962', NULL, 0),
(344, 'Sri Dip Kumar Ghosh', '191311092', 10, 'B', 'Stock/Inventory Management System', 'DH', '2023_269962', NULL, 0),
(345, 'Md. Delowar Hossain', '191311177', 10, 'A', 'Stock/Inventory Management System', 'DH', '2023_269962', NULL, 0),
(346, 'Ramis Fariha Raka', '191311104', 10, 'C', 'Departmental Event Information System', 'RAK', '2023_872523', NULL, 0),
(347, 'Sumaiya Siddiqua', '191311124', 10, 'C', 'Departmental Event Information System', 'RAK', '2023_872523', NULL, 0),
(348, 'Umme Hafsha Muna', '191311118', 10, 'C', 'Departmental Event Information System', 'RAK', '2023_872523', NULL, 0),
(349, 'Md Shah Noor Rahman', '191311023', 10, 'A', 'Academic Application Approval System', 'DH', '2023_613897', NULL, 0),
(350, 'Asif Iqbal', '191311061', 10, 'A', 'Academic Application Approval System', 'DH', '2023_613897', NULL, 0),
(351, 'Nahdia Tabassum', '191311040', 10, 'B', 'Academic Application Approval System', 'DH', '2023_613897', NULL, 0),
(352, 'Asif Abdullah', '191311076', 10, 'B', 'Alumni Connect App for VU', 'SMT', '2023_552976', NULL, 0),
(353, 'Anika Ebnath', '191311030', 10, 'B', 'Alumni Connect App for VU', 'SMT', '2023_552976', NULL, 0),
(354, 'Md. Sakirul Islam Ankon', '191311117', 10, 'B', 'Alumni Connect App for VU', 'SMT', '2023_552976', NULL, 0),
(355, 'Tonmoy Ghosh', '191311137', 10, 'B', 'T20 Cricket Match Result Prediction', 'AH', '2023_122751', NULL, 0),
(356, 'Sajib Pramanik', '191311098', 10, 'B', 'T20 Cricket Match Result Prediction', 'AH', '2023_122751', NULL, 0),
(357, 'Md.Nafiur Rahman', '191311071', 10, 'C', 'T20 Cricket Match Result Prediction', 'AH', '2023_122751', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `supervisor`
--

CREATE TABLE `supervisor` (
  `sl` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `emp_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supervisor`
--

INSERT INTO `supervisor` (`sl`, `name`, `sName`, `email`, `emp_id`, `password`) VALUES
(1, 'Md. Khademul Islam Molla, PhD', 'KIM', 'kim@email.com', '1111', 'e10adc3949ba59abbe56e057f20f883e'),
(2, 'Rafi Ibn Sultan', 'RIS', 'ris@email.com', '1112', 'e10adc3949ba59abbe56e057f20f883e'),
(3, 'Tokey Ahmmed', 'TKA', 'tka@email.com', '1113', 'e10adc3949ba59abbe56e057f20f883e'),
(4, 'Md. Toufikul Islam', 'MTI', 'mti@email.com', '1114', 'e10adc3949ba59abbe56e057f20f883e'),
(5, 'Md. Nour Noby', 'NN', 'nn@email.com', '1115', 'e10adc3949ba59abbe56e057f20f883e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`sl`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`sl`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`sl`);

--
-- Indexes for table `supervisor`
--
ALTER TABLE `supervisor`
  ADD PRIMARY KEY (`sl`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `sl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `sl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `sl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=358;

--
-- AUTO_INCREMENT for table `supervisor`
--
ALTER TABLE `supervisor`
  MODIFY `sl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
