-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2021 at 05:52 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kckalai_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_abstract`
--

CREATE TABLE `tbl_abstract` (
  `id` int(11) NOT NULL,
  `abstract_title` text DEFAULT NULL,
  `abstract_stdname` text DEFAULT NULL,
  `abstract_file` varchar(255) DEFAULT NULL,
  `abstract_owner` varchar(255) DEFAULT NULL,
  `super_owner` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_academic_qualification`
--

CREATE TABLE `tbl_academic_qualification` (
  `id` int(11) NOT NULL,
  `academic_title` varchar(255) DEFAULT NULL,
  `academic_award_uni` varchar(255) DEFAULT NULL,
  `academic_date` varchar(255) DEFAULT NULL,
  `super_owner` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_academic_qualification`
--

INSERT INTO `tbl_academic_qualification` (`id`, `academic_title`, `academic_award_uni`, `academic_date`, `super_owner`) VALUES
(1, 'PhD in Engineering (E&E)', 'Universiti Kebangsaan Malaysia', 'October 2009', 'kckalai'),
(2, 'MIT(CompSc)', 'Universiti Kebangsaan Malaysia', 'September 2001', 'kckalai'),
(3, 'Bachelor of Engineering with Honours (Electrical and Electronic Engineering)', 'Universiti Sains Malaysia', 'August 1995', 'kckalai');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_activity`
--

CREATE TABLE `tbl_activity` (
  `id` int(11) NOT NULL,
  `activity_date` date DEFAULT NULL,
  `activity_time` time DEFAULT NULL,
  `activity_location` varchar(255) DEFAULT NULL,
  `activity_title` varchar(255) DEFAULT NULL,
  `activity_involvement` int(11) DEFAULT NULL,
  `activity_owner` varchar(255) DEFAULT NULL,
  `super_owner` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `admin_id` varchar(50) DEFAULT NULL,
  `admin_name` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `tagline` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `faculty` varchar(255) DEFAULT NULL,
  `university` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `postcode` int(11) DEFAULT NULL,
  `education_level` varchar(255) DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `specializations` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `credits` int(11) DEFAULT NULL,
  `plan` varchar(11) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `front_pic` varchar(255) DEFAULT NULL,
  `admin_password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `admin_id`, `admin_name`, `role`, `tagline`, `department`, `faculty`, `university`, `city`, `postcode`, `education_level`, `tel`, `fax`, `country`, `specializations`, `email`, `facebook`, `instagram`, `linkedin`, `twitter`, `location`, `credits`, `plan`, `profile_pic`, `front_pic`, `admin_password`) VALUES
(1, 'kckalai', 'Dr. Kalaivani Chellappan', 'Academic Lecturer', 'Knowledge is an endless ladder', 'Department of Electrical, Electronics & Systems Engineering', 'Faculty of Engineering & Built Environment', 'Universiti Kebangsaan Malaysia (UKM)', 'Bangi', 43600, 'PhD', '+603-8911 8374', '+603-8911 8359', 'Malaysia', 'Cardiovascular Engineering, Data Modeling & Analytics, IoT in Healthcare', 'kckalai@ukm.edu.my', NULL, NULL, NULL, NULL, NULL, 1, 'Super User', '1323424971.jpg', 'drkalai_front.jpg', 'd8acbef1271a1894c40225fc763845ae'),
(3, 'super_admin', 'Super Admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_adminlogin`
--

CREATE TABLE `tbl_adminlogin` (
  `id` int(11) NOT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_adminlogin`
--

INSERT INTO `tbl_adminlogin` (`id`, `user_id`, `name`, `email`, `password`) VALUES
(1, 'A55337', 'System Admin', NULL, '$2y$10$8EvOiK.XbFiC9J3njFF/zOn.xVBG.hNbwDHZ39PDuWsvVrfLZtoTS');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_appointment`
--

CREATE TABLE `tbl_admin_appointment` (
  `id` int(11) NOT NULL,
  `admin_position` varchar(255) DEFAULT NULL,
  `admin_startdate` varchar(255) DEFAULT NULL,
  `admin_enddate` varchar(255) DEFAULT NULL,
  `super_owner` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bookchapters`
--

CREATE TABLE `tbl_bookchapters` (
  `id` int(11) NOT NULL,
  `authors` text DEFAULT NULL,
  `chapter_title` text DEFAULT NULL,
  `book_year` int(11) DEFAULT NULL,
  `book_editor` text DEFAULT NULL,
  `book_title` text DEFAULT NULL,
  `book_edition` varchar(255) DEFAULT NULL,
  `chapter_pagenum` varchar(255) DEFAULT NULL,
  `publisher_location` varchar(255) DEFAULT NULL,
  `publisher_name` varchar(255) DEFAULT NULL,
  `chapter_file` varchar(255) DEFAULT NULL,
  `chapter_owner` varchar(255) DEFAULT NULL,
  `super_owner` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_books`
--

CREATE TABLE `tbl_books` (
  `id` int(11) NOT NULL,
  `authors` text DEFAULT NULL,
  `book_title` text DEFAULT NULL,
  `book_year` int(11) DEFAULT NULL,
  `book_notes` varchar(255) DEFAULT NULL,
  `publisher_location` varchar(255) DEFAULT NULL,
  `publisher_name` varchar(255) DEFAULT NULL,
  `book_file` varchar(255) DEFAULT NULL,
  `book_owner` varchar(255) DEFAULT NULL,
  `super_owner` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_books`
--

INSERT INTO `tbl_books` (`id`, `authors`, `book_title`, `book_year`, `book_notes`, `publisher_location`, `publisher_name`, `book_file`, `book_owner`, `super_owner`) VALUES
(1, 'Kalaivani Chellappan, Mas Ayu Othman, Muhammad Syafiq Abdul Razak, Nurul Asyikin Razali, Tiviyah Mogan & Maharam Mamat', 'Junior STEM Discovery: Eksplorasi Tenaga Hijau', 2018, 'Cetakan Pertama, Hak Cipta Â© 2018 UKM PKAS', 'Petaling Jaya', 'SK Innovation Sdn. Bhd.', NULL, 'kckalai', 'kckalai'),
(2, 'Kalaivani Chellappan, Mas Ayu Othman, Muhammad Syafiq Abdul Razak, Nurul Asyikin Razali, Mohd Syakir Fathillah, Nor Shahirah Shaik Amir & Maharam Mamat', 'Junior STEM Discovery: Teknologi Tenaga Hijau', 2019, 'Cetakan Pertama, Hak Cipta Â© 2019 UKM PKAS', 'Petaling Jaya', 'SK Innovation Sdn. Bhd', NULL, 'kckalai', 'kckalai'),
(3, 'Kalaivani Chellappan, Muhammad Syafiq Abdul Razak, Nurul Asyikin Razali, Nor Faizah Juarni, Mas Ayu Othman & Aida Abdul Rasyid', 'MySTEM Exploration: Junior Electrical Circuit Lighting Design', 2019, 'First Published February 2019,Copyright Â© 2019 SK Innovation Sdn. Bhd', 'Petaling Jaya', 'SK Innovation Sdn. Bhd', NULL, 'kckalai', 'kckalai');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cards`
--

CREATE TABLE `tbl_cards` (
  `id` int(11) NOT NULL,
  `admin_id` varchar(50) DEFAULT NULL,
  `card_num` varchar(50) DEFAULT NULL,
  `cvv` int(11) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_career_history`
--

CREATE TABLE `tbl_career_history` (
  `id` int(11) NOT NULL,
  `career_title` varchar(255) DEFAULT NULL,
  `career_organization` varchar(255) DEFAULT NULL,
  `career_startdate` varchar(255) DEFAULT NULL,
  `career_enddate` varchar(255) DEFAULT NULL,
  `super_owner` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_career_history`
--

INSERT INTO `tbl_career_history` (`id`, `career_title`, `career_organization`, `career_startdate`, `career_enddate`, `super_owner`) VALUES
(1, 'Engineer', 'Esso Production Mâ€™sia Inc.', 'May 1995', 'January 1997', 'kckalai'),
(2, 'Centre Coordinator to Deputy Head of School', 'Stamford College â€“ School of Computing', 'February 1997', 'December 2001', 'kckalai'),
(3, 'Head', 'Taylorâ€™s College â€“ School of Computing', 'January 2002', 'June 2004', 'kckalai'),
(4, 'Senior Lecturer to Assistant Professor(Deputy Dean SA&Q)', 'Universiti Tun Abdul Razak (Unirazak)', 'July 2004', 'August 2011', 'kckalai'),
(5, 'Research Fellow/Senior Lecturer', 'Universiti Kebangsaan Malaysia', 'September 2011', 'Present', 'kckalai');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_checkin`
--

CREATE TABLE `tbl_checkin` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_checkin`
--

INSERT INTO `tbl_checkin` (`id`, `user_id`, `date`, `time`) VALUES
(1, 'A9999998', '2017-07-05', '12:45:35'),
(2, 'A9999998', '2017-07-05', '03:06:50'),
(3, 'A159397', '2017-07-07', '04:05:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_checkout`
--

CREATE TABLE `tbl_checkout` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_checkout`
--

INSERT INTO `tbl_checkout` (`id`, `user_id`, `date`, `time`) VALUES
(1, 'A9999998', '2017-07-05', '03:03:29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_community`
--

CREATE TABLE `tbl_community` (
  `id` int(11) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `category_niche` varchar(255) DEFAULT NULL,
  `community_target` varchar(255) DEFAULT NULL,
  `community_location` varchar(255) DEFAULT NULL,
  `program_date` date DEFAULT NULL,
  `program_title` varchar(255) DEFAULT NULL,
  `program_members` text DEFAULT NULL,
  `program_funding` varchar(255) DEFAULT NULL,
  `program_work_partner` varchar(255) DEFAULT NULL,
  `super_owner` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_community_category`
--

CREATE TABLE `tbl_community_category` (
  `id` int(11) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `super_owner` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_countries`
--

CREATE TABLE `tbl_countries` (
  `id` int(11) NOT NULL,
  `country` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_countries`
--

INSERT INTO `tbl_countries` (`id`, `country`) VALUES
(1, 'Afghanistan'),
(2, 'Albania'),
(3, 'Algeria'),
(4, 'Andorra'),
(5, 'Angola'),
(6, 'Antigua and Barbuda'),
(7, 'Argentina'),
(8, 'Armenia'),
(9, 'Australia'),
(10, 'Austria'),
(11, 'Azerbaijan'),
(12, 'Bahamas, The'),
(13, 'Bahrain'),
(14, 'Bangladesh'),
(15, 'Barbados'),
(16, 'Belarus'),
(17, 'Belgium'),
(18, 'Belize'),
(19, 'Benin'),
(20, 'Bhutan'),
(21, 'Bolivia'),
(22, 'Bosnia and Herzegovina'),
(23, 'Botswana'),
(24, 'Brazil'),
(25, 'Brunei'),
(26, 'Bulgaria'),
(27, 'Burkina Faso'),
(28, 'Burma'),
(29, 'Burundi'),
(30, 'Cambodia'),
(31, 'Cameroon'),
(32, 'Canada'),
(33, 'Cape Verde'),
(34, 'Central Africa'),
(35, 'Chad'),
(36, 'Chile'),
(37, 'China'),
(38, 'Colombia'),
(39, 'Comoros'),
(40, 'Congo, Democratic Republic of the'),
(41, 'Costa Rica'),
(42, 'Cote dIvoire'),
(43, 'Crete'),
(44, 'Croatia'),
(45, 'Cuba'),
(46, 'Cyprus'),
(47, 'Czech Republic'),
(48, 'Denmark'),
(49, 'Djibouti'),
(50, 'Dominican Republic'),
(51, 'East Timor'),
(52, 'Ecuador'),
(53, 'Egypt'),
(54, 'El Salvador'),
(55, 'Equatorial Guinea'),
(56, 'Eritrea'),
(57, 'Estonia'),
(58, 'Ethiopia'),
(59, 'Fiji'),
(60, 'Finland'),
(61, 'France'),
(62, 'Gabon'),
(63, 'Gambia, The'),
(64, 'Georgia'),
(65, 'Germany'),
(66, 'Ghana'),
(67, 'Greece'),
(68, 'Grenada'),
(69, 'Guadeloupe'),
(70, 'Guatemala'),
(71, 'Guinea'),
(72, 'Guinea-Bissau'),
(73, 'Guyana'),
(74, 'Haiti'),
(75, 'Holy See'),
(76, 'Honduras'),
(77, 'Hong Kong'),
(78, 'Hungary'),
(79, 'Iceland'),
(80, 'India'),
(81, 'Indonesia'),
(82, 'Iran'),
(83, 'Iraq'),
(84, 'Ireland'),
(85, 'Israel'),
(86, 'Italy'),
(87, 'Ivory Coast'),
(88, 'Jamaica'),
(89, 'Japan'),
(90, 'Jordan'),
(91, 'Kazakhstan'),
(92, 'Kenya'),
(93, 'Kiribati'),
(94, 'Korea, North'),
(95, 'Korea, South'),
(96, 'Kosovo'),
(97, 'Kuwait'),
(98, 'Kyrgyzstan'),
(99, 'Laos'),
(100, 'Latvia'),
(101, 'Lebanon'),
(102, 'Lesotho'),
(103, 'Liberia'),
(104, 'Libya'),
(105, 'Liechtenstein'),
(106, 'Lithuania'),
(107, 'Macau'),
(108, 'Macedonia'),
(109, 'Madagascar'),
(110, 'Malawi'),
(111, 'Malaysia'),
(112, 'Maldives'),
(113, 'Mali'),
(114, 'Malta'),
(115, 'Marshall Islands'),
(116, 'Mauritania'),
(117, 'Mauritius'),
(118, 'Mexico'),
(119, 'Micronesia'),
(120, 'Moldova'),
(121, 'Monaco'),
(122, 'Mongolia'),
(123, 'Montenegro'),
(124, 'Morocco'),
(125, 'Mozambique'),
(126, 'Namibia'),
(127, 'Nauru'),
(128, 'Nepal'),
(129, 'Netherlands'),
(130, 'New Zealand'),
(131, 'Nicaragua'),
(132, 'Niger'),
(133, 'Nigeria'),
(134, 'North Korea'),
(135, 'Norway'),
(136, 'Oman'),
(137, 'Pakistan'),
(138, 'Palau'),
(139, 'Panama'),
(140, 'Papua New Guinea'),
(141, 'Paraguay'),
(142, 'Peru'),
(143, 'Philippines'),
(144, 'Poland'),
(145, 'Portugal'),
(146, 'Qatar'),
(147, 'Romania'),
(148, 'Russia'),
(149, 'Rwanda'),
(150, 'Saint Lucia'),
(151, 'Saint Vincent and the Grenadines'),
(152, 'Samoa'),
(153, 'San Marino'),
(154, 'Sao Tome and Principe'),
(155, 'Saudi Arabia'),
(156, 'Scotland'),
(157, 'Senegal'),
(158, 'Serbia'),
(159, 'Seychelles'),
(160, 'Sierra Leone'),
(161, 'Singapore'),
(162, 'Slovakia'),
(163, 'Slovenia'),
(164, 'Solomon Islands'),
(165, 'Somalia'),
(166, 'South Africa'),
(167, 'South Korea'),
(168, 'Spain'),
(169, 'Sri Lanka'),
(170, 'Sudan'),
(171, 'Suriname'),
(172, 'Swaziland'),
(173, 'Sweden'),
(174, 'Switzerland'),
(175, 'Syria'),
(176, 'Taiwan'),
(177, 'Tajikistan'),
(178, 'Tanzania'),
(179, 'Thailand'),
(180, 'Tibet'),
(181, 'Timor-Leste'),
(182, 'Togo'),
(183, 'Tonga'),
(184, 'Trinidad and Tobago'),
(185, 'Tunisia'),
(186, 'Turkey'),
(187, 'Turkmenistan'),
(188, 'Tuvalu'),
(189, 'Uganda'),
(190, 'Ukraine'),
(191, 'United Arab Emirates'),
(192, 'United Kingdom'),
(193, 'United States'),
(194, 'Uruguay'),
(195, 'Uzbekistan'),
(196, 'Vanuatu'),
(197, 'Venezuela'),
(198, 'Vietnam'),
(199, 'Yemen'),
(200, 'Zambia'),
(201, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grant`
--

CREATE TABLE `tbl_grant` (
  `id` int(11) NOT NULL,
  `grant_title` text DEFAULT NULL,
  `category_code` int(11) DEFAULT NULL,
  `grant_code` varchar(255) DEFAULT NULL,
  `grant_funder` varchar(255) DEFAULT NULL,
  `grant_amount` int(11) DEFAULT NULL,
  `grant_duration` varchar(255) DEFAULT NULL,
  `grant_status` int(11) DEFAULT NULL,
  `super_owner` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_grant`
--

INSERT INTO `tbl_grant` (`id`, `grant_title`, `category_code`, `grant_code`, `grant_funder`, `grant_amount`, `grant_duration`, `grant_status`, `super_owner`) VALUES
(1, 'Design And Development Of Pilot National Space Weather Data Network Management Systems', 0, 'SA1213001', 'Agensi Angkasa Negara Special Grant', 299900, '2013 - 2015', 1, 'kckalai'),
(2, 'Noninvasive Single Point Vascular Risk Assessor for Multiple Cardiovascular Risk Factors Screening', 0, 'ERGS/1/2012/TK02/UKM/03/2', 'Exploratory Research Grant Scheme (ERGS)', NULL, '2012 - 2015', 1, 'kckalai'),
(3, 'Green Innovation In Teaching and Learning Enhancement Through Open Source', 0, 'Industri-2013-002', 'Research University Grant (Industry Grant)', NULL, '2013 - 2014', 1, 'kckalai'),
(4, 'Collaborated Women Entrepreneurship Through Innovation and Technology Towards Family and Nation Sosio-Economic Building', 0, 'Komuniti-2013-015', 'Research University Grant (Community Grant)', NULL, '2013 - 2015', 1, 'kckalai'),
(5, 'Establish Left Ventricular Hypertrophy (LVH) Screening through Photoplethysmogram based Empricial Model', 0, 'GGPM-2012-095', 'Research University Grant (Young Researchers Encouragement Grant)', NULL, '2012 - 2014', 1, 'kckalai'),
(6, 'Estimation of Aterial Ageing Hemodynamics through Lumped Parameter Modeling', 0, 'GUP-2012-026', 'Research University Grant (Research Grant)', NULL, '2011 - 2013', 1, 'kckalai'),
(7, 'Elucidating The Role of Central Sensory Systems in Congnitive Impairment', 1, 'LRGS/BU/2012/UKM-UKM/K/02', 'Long Term Research Grant - Ministry of Education Malaysia', NULL, '2012 - 2016', 0, 'kckalai'),
(8, 'Unravelling The Transitional Events of Normal to Pathological Aging Leading To Cognitive Decline', 1, 'LRGS/BU/2012/UKM-UKM/K/04', 'Long Term Research Grant - Ministry of Education Malaysia', NULL, '2012 - 2016', 0, 'kckalai'),
(9, 'Investigation of New Ontological Medical Decision Support System for Emergency Medical Services', 1, 'ERGS/1/2013/TK02/UKM/02/2', 'Exploratory Research Grant - Ministry of Education Malaysia', NULL, '2013 - 2015', 1, 'kckalai'),
(10, 'Advanced Probabilistic Respiratory Motion Tracking Using Distance Cameras For External Beam Radiotheraphy', 1, 'ERGS/1/2013/TK02/UKM/03/2', 'Exploratory Research Grant - Ministry of Education Malaysia', NULL, '2013 - 2016', 0, 'kckalai'),
(11, 'Human Emotion Recognition System for Automotive Drivers using Psychophysiological', 1, '01-01-02-SF1061 ScienceFund MOSTI', 'E-Science - Ministry of Science, Technology and Innovation Malaysia', NULL, '2014 - 2016', 0, 'kckalai'),
(12, 'Muda Probalistic Computer Aided Medical Diagnosis Of Lung Cancer Using Pet/Ct Imaging', 1, 'GGPM-2013-066', 'Young Researcher Encouragement Grant - Research University Grant', NULL, '2013 - 2015', 1, 'kckalai'),
(13, 'Mobile Health Application for Remote Post-Chemotheraphy Patient Monitoring', 1, 'INDUSTRI-2012-032', 'Industry Grant - Research University Grant', NULL, '2012 - 2014', 1, 'kckalai'),
(14, 'Space Science Virtual Task Training Knowledge Portal Development', 1, 'INDUSTRI-2013-001', 'Industry Grant - Research University Grant', NULL, '2013 - 2014', 1, 'kckalai'),
(15, 'Electronic Rapid Prototyping Techniques for Technopreneurs in the Field of Healthcare Technology Innovation', 1, 'INDUSTRI-2013-006', 'Industry Grant - Research University Grant', NULL, '2013 - 2015', 1, 'kckalai'),
(16, 'NIVAR: A Screening Tools For Vascular Risk Assessment And Management', 1, 'PRGS/1/11/TK/UKM/01/1', 'Prototype Development Research Grant Scheme (PRGS)- Ministry of Education Malaysia', NULL, '2011 - 2013', 1, 'kckalai'),
(17, 'Indigenous Community Skills & Competency Trans-theoretical Modeling for Social Business', 1, 'FRGS/2/2013/SS07/UKM/02/1', 'Fundamental Research Grant Scheme (FRGS) - Ministry of Education Malaysia', NULL, '2013 - 2015', 1, 'kckalai'),
(18, '<a href=\"https://sites.google.com/site/ppukmbiomedical/\">Sustainable Green Health Practice Culture Among Working Adults</a>', 1, 'PHUM-2013-009', 'Knowledge Technology Transfer (KTP) - Ministry of Education Malaysia', NULL, '2013 - 2015', 1, 'kckalai'),
(19, 'ANGKASA Research Knowledge Organization Innovation: Design and Framework', 1, 'PTS-2012-134', 'Strategic Action Research Grant - Research University Grant', NULL, '2012 - 2013', 1, 'kckalai'),
(20, 'A Contactless Sensing System For Extramural Monitoring of Muscle Activity', 2, 'AP-2013-001', NULL, NULL, '2013 - 2015', 1, 'kckalai'),
(21, 'Design and Fabrication of Optical Interconnect System Using CMOS Process Technology', 2, 'DPP-2013-061', NULL, NULL, '2013 - 2014', 1, 'kckalai'),
(22, 'Bio-Mechanical and Physiological Investigation of Brain Memory Function Enhancement of Primary School Children Through Optimized Rope Skipping Activity', 2, 'DPP-2013-089', NULL, NULL, '2013 - 2014', 1, 'kckalai'),
(23, 'Effective Methodologies for Innovative Health Care Devices Development and Commercialization', 2, 'DPP-2013-095', NULL, NULL, '2013 - 2014', 1, 'kckalai'),
(24, 'Photoplethysmograph Analysis and Vitamin D Deficiency in Coronary Artery', 2, 'FF-197-2012', NULL, NULL, '2012 - 2013', 1, 'kckalai'),
(25, 'Noninvasive Technique For Endothelial Dysfunction Assessment Using A Radial PPG-CAP Modeling In Healthy And Non-Healthy Subjects', 2, 'FF-2013-409', NULL, NULL, '2013 - 2015', 1, 'kckalai'),
(26, '<i>Dana Fundamental PPUKM Petanda Fungsi Salur Darah Di Kalangan Wanita Muda Yang Mempengaruhi Faktor Risiko Penyakit Kardiovaskular</i>', 2, 'FF-2014-011', NULL, NULL, '2013 - 2015', 1, 'kckalai'),
(27, 'Novel risk predictors of cardiovascular disease among young adults with cardiovascular risk', 2, 'UKM-GUP-2011-300', NULL, NULL, '2012 - 2013', 1, 'kckalai'),
(28, 'Prototype of Digital Malay Auditory-Cognitive Wellness Trainer', 0, 'PRGS/2/2019/ICT01/UKM/02/2', 'Skim Geran Penyelidikan Pembangunan Prototaip (PRGS)', 78000, '1 Dis 2019 â€“ 31 Nov 2021', 0, 'kckalai'),
(29, 'What to Hack in School: STEM Design Thinking', 0, 'KK-2019-019', 'Program STEM dan Minda,  RMK 11', 30000, '1 Nov 2019 â€“ 31 Oct 2021', 0, 'kckalai'),
(30, 'Monitoring of Blood Oxygenation for Diabetic Foot Ulceration Detection by Using Diffuse Reflectance Spectroscopy', 0, 'KK-2019-018', 'ASEAN India S&T Development Fund (AISTDF)', 9988, '1 Jul 2019 â€“ 30 Jun 2021', 0, 'kckalai'),
(31, 'Internet of Things Activated Quay Crane Storm Protection System (StormX)', 0, 'KK-2019-013', 'Newport Technologies Sdn. Bhd', 108000, '1 Jul 2019 â€“ 30 Jun 2022', 0, 'kckalai'),
(32, 'Pemerkasaan Program dan Pengkomersilan Produk ILJTM', 0, 'KK-2019-008', 'JTM, KSM', 470000, '25 Apr 2019 â€“ 24 Apr 2022', 0, 'kckalai'),
(33, 'Navigasi Pemulihan Strok dalam Komuniti Membantu Mangsa Strok dan Keluarga dalam Penjagaaan Jangka Panjang ', 0, 'KK-2017-012', 'University Community Transformation Centre (UCTC) Fund', 42000, '1 Nov 2017 â€“ 30 Apr 2018', 1, 'kckalai'),
(34, 'Launching Innovation in Classroom: Establishing STEMA-IoT Data Collection Infrastructure in Secondary Schools', 0, 'KK-2017-014', ' Program STEM & Minda Fund', 30000, '1 Sept 2017 â€“ 31 Aug 2019', 1, 'kckalai'),
(35, 'Multi-scale Computational Model of Three-Dimensional Hemodynamics of Upper Limb Arterial System for Atrial Fibrillation Modeling', 0, 'FRGS/1/2016/TK04/UKM/02/1', 'Fundamental Research Grant Scheme (FRGS)Fund', 60500, 'Aug 2016 â€“ 31 July 2019', 1, 'kckalai'),
(36, 'm-Health Monitoring Through SMS Gateway in Malaysian Rural Community', 0, 'PHI-2015-001', 'Knowledge Technology Transfer Programme (KTP) Fund', 109880, '1 Mac 2016 â€“ 31 Mei 2018', 1, 'kckalai'),
(37, 'Green Health Monitoring Among Working Adults Using ICT', 0, 'KK-2014-011', 'Multimedia Development Corporation (MDeC) Sdn. Bhd. Fund', 15000, '1 Mac 2016 â€“ 31 Mei 2018', 0, 'kckalai'),
(38, 'Collaborative Formal And Non- Formal Education Re-Engineering In Regenerating Youth Development In Marginalised Community Towards Employability', 0, 'LRGS/2013/UMK-UKM/SS/04', 'Long Research Grant Scheme (LRGS) Fund', 935900, '1 Jan 2014- 31 Dec 2016', 1, 'kckalai'),
(39, 'Modelling Arteries in Human Cardiovascular System and Estimating Vessel Properties Using Lumped Method', 0, 'null', 'Without Funding', 0, 'Julai 2010- Julai 2012', 1, 'kckalai'),
(40, 'Development of Self-Monitoring Ontology for Diabetes Management', 0, 'UNIRAZAK003', 'UNIRAZAK', 12000, 'Julai 2009- June 2011', 1, 'kckalai'),
(41, 'Fuzzy Based Vascular Characterization Using Photoplethysmogram', 0, ' UNIRAZAK001', 'UNIRAZAK', 8000, '4/2009-3/2010', 1, 'kckalai'),
(42, 'Pembangunan dan Pengesahan Algoritma Yang Menggabungkan Indeks Kecergasan Fotopletismografi Jari dan Kadar Denyutan Jantung Untuk Penilaian Faktor Risiko Penyakit Kardiovaskular', 1, 'FF-2018-259', 'PPUKM Fundamental PPUKM', 13150, '1 Sept 2017 â€“31 Aug 2019', 1, 'kckalai'),
(43, 'Development of Energy Resources Learning Kit Monitoring for Interdisciplinary STEM Exploration', 1, 'GUP-2017-084', 'Research University Grant', 70000, '16 Okt 2017 â€“ 15 Okt 2019', 0, 'kckalai'),
(44, 'Heart rate based adaptive calibration of finger plethysmography measurements to arterial blood volume change for vascular health monitor', 1, 'GUP-2017-096', 'Research University Grant', 41250, '16 Okt 2017 â€“ 15 Okt 2019', 0, 'kckalai'),
(45, 'Automated Medical Services via IoT, Mobile Application and Big Data Integration', 1, 'AP-2017-007/2', 'Projek Arus Perdana', 101000, '1 Sept 2017 â€“31 Aug 2019', 0, 'kckalai'),
(46, 'STEM Mentoring Program', 1, 'GG-2017-016', 'Program STEM & Minda Fund', 225000, '1 Sept 2017 â€“30 Sept 2019', 0, 'kckalai'),
(47, 'Feature Extraction of Seizure from EEG Signal for Epilepsy Detection and Monitoring Purpose', 1, 'KK-2018-006', 'Without Funding', 0, '14 Apr 2016 â€“14 Apr 2018', 1, 'kckalai'),
(48, 'A Study on Tympanic Membrane Displacement Using Finite Element Analysis For Hearing Loss Application', 0, 'DPP-2015-120', 'Research Group Development Fund ', 9000, '15 Jun 2015 â€“30 Sept 2016', 1, 'kckalai'),
(49, 'The Identification of New CT Scan Markers to Diagnosed Cerebral Amyloid Angiopathy in Primary Intracerebral Hemorrhage', 1, 'GGPM-2015-033', 'Young Researcher Motivation Grant ', 30000, '1 Jun 2015 â€“30 Nov 2017', 1, 'kckalai'),
(50, 'Volumetric Quantification Of Infarction Core And Penumbra For Stroke Patients Using Multimodal CT Imaging', 1, 'FF-2014-378', 'Without Funding', 0, '2 Nov 2014 â€“1  Nov 2017', 1, 'kckalai'),
(51, 'Pengalaman dan Pengendalian Kajian Penyelidikan oleh Penyelidik UKM di Angkasa', 1, 'TD-2014-014', 'Top Down Research Fund (TD)', 150000, '1 Nov 2014 â€“31 Oct 2016', 1, 'kckalai'),
(52, 'Development of Upper Limb Musculotendon Dynamic Model For Personalized Stroke Rehabilitation.', 1, 'AP-2014-014', 'Projek Arus Perdana', 190000, '1 Aug 2014 â€“31 July 2017', 1, 'kckalai'),
(53, 'Trending the Characteristics of Photopletysmograph (PPG) Signals among Individuals of High Risk of Cardiovascular disease (CVD) against hs-CRP as an endothelial dysfunction (ED) biomarker', 1, 'GGPM-2014-052', 'Young Researcher Motivation Grant ', 50000, '1 Aug 2014 â€“31 Jan 2017', 1, 'kckalai'),
(54, 'Monitoring Of Blood Oxygenation For Diabetic Foot Ulceration Detection By Using Diffuse Reflectance Spectroscopy', 0, 'null', 'India-ASEAN Cooperation', 7745, 'na', 0, 'kckalai'),
(55, 'IoT Activated Quay Crane Storm Protection System', 0, 'GUP-2017-026', 'Research University Fund', 70000, '16 Okt 2017 â€“ 15 Okt 2019', 0, 'kckalai'),
(56, 'Computer Aided Segmentation of the Liver for Risk Assessment of Resection due to Cancer', 1, 'GUP-2014-066', 'Research University Grant', 50000, '1 Aug 2014 â€“31 July 2016', 1, 'kckalai'),
(57, 'Assessment of UKM Learning Outcomes', 1, 'PTS-2014-001', 'Projek Tindakan/Stategik', 150000, '1 Aug 2014 â€“31 July 2015', 1, 'kckalai'),
(58, 'Probabilistic Computer Aided Diagnostic System for Stroke Patients Using Multimodal Imaging', 1, '01-01-02-SF1111', 'ScienceFund MOSTI', 137500, '1 July 2014 â€“31 Dec 2016', 1, 'kckalai'),
(59, 'Enhancing PET/CT imaging of Lung Cancer with Dynamic Image Reconstruction and Probabilistic Motion Correction.', 1, 'FRGS/1/2014/TK03/UKM/03/2', 'Fundamental Research Grant Scheme (FRGS)', 127112, '1 July 2014 â€“30 Jun 2017', 1, 'kckalai'),
(60, 'Hardware Implementation of 32- Bit Speed Divert Digital requency Synthesizer', 1, 'DPP-2014-062', 'Research Development Team Fund', 20000, '1 July 2014 â€“31 Mac 2015', 1, 'kckalai'),
(61, 'Development of Wearable EMG Device for Post Stroke Rehabilitation.', 1, 'DPP-2014-122', 'Research Development Team Fund', 30000, '1 Apr 2014 â€“31 Mac 2015', 1, 'kckalai'),
(62, 'The Effects Of Self- Monitoring Based Pedometer Exercise On Cardiovascular Markers And Vascular Indices Among Young Men With Cardiovascular Risks.', 1, 'FF-2014-139', 'Without Funding', 0, '13 Mac 2014 â€“12 Mac 2017', 1, 'kckalai'),
(63, 'Space Research Knowledge Repository', 1, 'LL-2013-002', 'Multimedia Development Corporation (MDeC) Sdn. Bhd. Fund', 15000, '5 Aug 2013 â€“17 July 2014', 1, 'kckalai'),
(64, 'Prospective Study On The Use Of Palmytiol Hexapeptide For Keloid Scar', 1, 'FF-146-2013', 'PPUKM Fundamental Fund', 20000, '1 Apr 2013 â€“31 Oct 2015', 1, 'kckalai'),
(65, 'Mengukuhkan Dan Meningkatkan Kenampakan (Visibility) Institut Sains Angkasa', 1, 'DPP-2013-127', 'Research Development Team Fund', 45000, '1 Jan 2013 â€“31 Mac 2014', 1, 'kckalai'),
(66, 'Development of Novel Si(x)Gel(1-x) Tuneable Quantum Dot Lateral P- I-N Photodiode (QDLP) for Near-infrared Detection Applications', 1, 'INDUSTRI-2012-017', 'Research Incentive Fund-Industry ', 20000, '25 Jun 2012 â€“24 Jun 2014', 1, 'kckalai'),
(67, 'Exploration of FPGA Approach of A Smart Home Controller Using Agent Modelling And Task Distribution.', 1, 'UKM-GUP-2011-350', 'University Research Grant', 30000, '8 Aug 2011 â€“7 Aug 2012', 1, 'kckalai'),
(68, 'Intelligent Triage System For Emergency Medical Services Using Ontology Driven Design And Clinical Support System', 1, 'UKM-GUP-2011-352', 'University Research Grant', 30000, '8 Aug 2011 â€“7 Aug 2012', 1, 'kckalai');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_interest`
--

CREATE TABLE `tbl_interest` (
  `id` int(11) NOT NULL,
  `interest_category` int(11) DEFAULT NULL,
  `interest_title` varchar(255) NOT NULL,
  `interest_notes` text DEFAULT NULL,
  `interest_file` varchar(255) DEFAULT NULL,
  `super_owner` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_journals`
--

CREATE TABLE `tbl_journals` (
  `id` int(11) NOT NULL,
  `authors` text DEFAULT NULL,
  `journal_year` int(11) DEFAULT NULL,
  `journal_title` text DEFAULT NULL,
  `journal_name` text DEFAULT NULL,
  `journal_volume` varchar(255) DEFAULT NULL,
  `journal_pagenum` varchar(255) DEFAULT NULL,
  `journal_file` varchar(255) DEFAULT NULL,
  `journal_owner` varchar(255) DEFAULT NULL,
  `super_owner` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_journals`
--

INSERT INTO `tbl_journals` (`id`, `authors`, `journal_year`, `journal_title`, `journal_name`, `journal_volume`, `journal_pagenum`, `journal_file`, `journal_owner`, `super_owner`) VALUES
(1, 'Aminuddin, A., Chellappan, K., Maskon, O., Zakaria, Z., Karim, A.A., Ngah, W.Z., & Nordin, N.A.', 2014, 'Augmentation index is a better marker for cardiovascular risk in young Malaysian males', 'Saudi Medical Journal', '35', 'No 2', NULL, 'kckalai', 'kckalai'),
(2, 'Chowdhury, R., Reaz, M., Ali, M.A., Bakar, A.A., Chellappan, K., & Chang, T.G. ', 2013, 'Surface Electromyography Signal Processing and Classification Techniques', 'Sensors (Basel,Switzerland)', '13(9)', '12431-12466', NULL, 'kckalai', 'kckalai'),
(3, 'K Chellappan & Al Mabrok Saleh Ahmed', 2013, 'Pervasive Collaborative Network Approach to Type II Diabetes Management', 'Asian Transactions on Basic and Applied Sciences (ATBAS ISSN: 2221-4291)', '(3)2', '53 - 58', NULL, 'kckalai', 'kckalai'),
(4, 'Bhuyan, M.S., Majlis, B.Y., Othman, M., Ali, S., Kalaivani, C., & Islam, S.', 2013, 'Bluff body fluid interactions modelling for micro energy harvesting application', 'Journal of Physics: Conference Series', '431(1)', '', NULL, 'kckalai', 'kckalai'),
(5, 'Bhuyan, M.S., Majlis, B.Y., Othman, M., Ali, S., Kalaivani, C., & Islam, S. ', 2013, 'Development of a Fluid Actuated Piezoelectric Micro Energy Harvester: Finite Element Modeling Simulation and Analysis', 'Asian Journal of Scientific Research. Online', '6', '691-702.', NULL, 'kckalai', 'kckalai'),
(6, 'Zahedi, E., Chellappan, K., Ali, M., & Singh, H.', 2007, 'Analysis of the Effect of Ageing on Rising Edge Characteristics of the Photoplethysmogram using a Modified Windkessel Model', 'International Journal of Cardiovascular Engineering, Springer', '7(4)', '172 - 181', NULL, 'kckalai', 'kckalai'),
(7, 'Arka, I.H., & Chellappan, K. ', 2014, 'Collaborative compressed i-cloud medical image storage with decompress viewer', 'Procedia Computer Science', '42', '114-121', NULL, 'kckalai', 'kckalai'),
(8, 'K Mohd Radzi, A, Rambely, A, Chellapan', 2014, 'Rope skipping as a measure to fight obesity', 'Obesity Review', '55(Issue Supplement S2)', '200', NULL, 'kckalai', 'kckalai'),
(9, 'Al-Qazzaz, N.K., Ali, S.H., Ahmad, S.A., Chellappan, K., Islam, M.T., & Escudero, J.', 2014, 'Role of EEG as Biomarker in the Early Detection and Classification of Dementia', 'The Scientific World Journal', '', '', NULL, 'kckalai', 'kckalai'),
(10, 'Zahedi, E., Sohani, V., Ali, M.A., Chellappan, K., & Beng, G.K.', 2015, 'Experimental feasibility study of estimation of the normalized central blood pressure waveform from radial photoplethysmogram', 'Journal of healthcare engineering', '6(1)', '121-144', NULL, 'kckalai', 'kckalai'),
(11, 'Chellappan, K., Mustafa, A., Mohammed, M.J., & Thajeel, A.M. ', 2015, 'Layered Defense Approach: Towards Total Network Security', 'International Journal of Computer Science and Business Informatics', '15(1)', '', NULL, 'kckalai', 'kckalai'),
(12, 'K Chellappan, R Sahathevan', 2015, 'Accelerated aging and noninvasive cardiovascular risk monitoring: O61', 'Cerebrovascular Diseases', '40', '25-27', NULL, 'kckalai', 'kckalai'),
(13, 'A Aminuddin, Z Zaiton, K Chellappan, U Azizah, S Norizam, Nor MMN Anita', 2016, 'The Assessment of Finger Photoplethysmography Fitness Index (PPGF) among Young Men with Cardiovascular Disease Risk Factors: A Cross Sectional Study ', ' Medicine and Health - Kuala Lumpur', '11(2)', '218-231', NULL, 'kckalai', 'kckalai'),
(14, 'Armum, P., & Chellappan, K. ', 2016, 'Social and emotional self-efficacy of adolescents: measured and analysed interdependencies within and across academic achievement level', 'International Journal of Adolescence and Youth', '21(3)', '279-288', NULL, 'kckalai', 'kckalai'),
(15, 'Hussain, A., Chell, K., & Mukari, S.Z.', 2016, 'Single channel speech enhancement using ideal binary mask technique based on computational auditory scene analysis', 'Journal of Theoretical & Applied Information Technology', '91(1)', '12-22', NULL, 'kckalai', 'kckalai'),
(16, 'K Chellappan, S Nur Hidayah Malek, R Jaafar, A Aminuddin', 2017, 'Photoplethysmography signal in paroxysmal and persistence atrial fibrillation patients', 'Journal of Engineering and Applied Sciences', '12(8)', '1946-1951', NULL, 'kckalai', 'kckalai'),
(17, 'MS Fathillah, Rosmina Jaafar, Kalaivani Chellappan, Rabani Remli, WAW Zainal', 2017, 'Complexity analysis on EEG signal via Lempel-Ziv and approximate entropy: Effect of multiresolution analysis', 'International Medical Device and Technology Conference', '', '6-7', NULL, 'kckalai', 'kckalai'),
(18, 'Mohammed, S.A., Norhazlina, H., Jit, S.M., Kalaivani, C., Wayan, S., Fredolin, T.T., Maszidah, M., Mardina, A., & Tariqul, I.', 2017, 'Utilization of Wind Steadiness Index for Identification of Malaysian Northeast Monsoon Onset and Withdrawal from 2011 to 2015', 'Advanced Science Letters', '23(2)', '1440-1443', NULL, 'kckalai', 'kckalai'),
(19, 'Syafiqah, M.N., Kalaivani, C., & Wayan, S.', 2017, 'Diurnal and Seasonal Variation of total Electron Content at Langkawi and Unimas Stations', 'Advanced Science Letters', '23(2)', '1393-1397', NULL, 'kckalai', 'kckalai'),
(20, 'Sattar, R.R., Chell, K., Omar, N., Megat, M.N., & Aminuddin, A', 2017, 'Finger photoplethysmograph as a monitoring device for lipid profile in men with cardiovascular risk', 'Journal of Theoretical and Applied Information Technology', '95(6)', '', NULL, 'kckalai', 'kckalai'),
(21, 'Ammar AK Timimi, MA Mohd Ali, Kalaivani Chellappan', 2017, 'A Novel AMARS Technique for Baseline Wander Removal Applied to Photoplethysmogram', 'IEEE transactions on biomedical circuits and systems', '11(3)', '627-326', NULL, 'kckalai', 'kckalai'),
(22, 'Rohaida Mat Akir, Kalaivani Chellappan, Mardina Abdullah', 2017, 'Total Electron Content Forecasting using Artificial Neural Network', 'Pertanika Journal of Science and Technology', '25(S6)', '19-28', NULL, 'kckalai', 'kckalai'),
(23, 'SK Tan, P Armum, AI Chokkalingam, TS Mohd Meerah, L Halim, K Osman, K Chellappan', 2017, 'Communication: Uses and Influence of Employment among Youths: The Role of Formal Education', 'Pertanika Journal of Social Sciences & Humanities', '25', '', NULL, 'kckalai', 'kckalai'),
(24, 'Hussain, A., Chell, K., & Mukari, S.Z. ', 2018, 'Development of Malay language based spatial audio simulator of auditory training software ', 'Journal of Engineering and Applied Sciences', '13(11)', '4038-4045', NULL, 'kckalai', 'kckalai'),
(25, 'Sabaruddin, M.F., Nor, M., Mubarak, M., Rashid, N., Chan, G.F., Youichi, S., & Ibrahim, N', 2018, 'Biodecolourisation of acid red 27 Dye by Citrobacter freundii A1 and Enterococcus casseliflavus C1 bacterial consortium', ' Malaysian Journal of Fundamental and Applied Sciences', '14(2)', '202-207', NULL, 'kckalai', 'kckalai'),
(26, 'Fathillah, M.S., Chellappan, K., Remli, R., Jaafar, R., & Zaidi, W.', 2018, 'T100. Computerized Recognition of Epileptic Discharge (CREED) algorithm and its clinical application ', 'Clinical Neurophysiology', '129', 'e41', NULL, 'kckalai', 'kckalai'),
(27, 'Tan, S.K., & Chellappan, K.', 2018, 'Assessing the Validity and Reliability of the Self-Efficacy Questionaire for children (SEQ-C) Among Malaysian Adolescents: Rasch model Analysis', 'Measurement and Evaluation in Counseling and Development', '51', '179-192', NULL, 'kckalai', 'kckalai'),
(28, 'Fathillah, M.S., Jaafar, R., Chellappan, K., Remli, R., & Zainal, W.', 2018, 'Multiresolution analysis on nonlinear complexity measurement of EEG signal for epileptic discharge monitoring', 'Malaysian Journal of Fundamental and Applied Sciences', '14(2)', '219-225', NULL, 'kckalai', 'kckalai'),
(29, 'Fathillah, M.S., Chell, K., Jaafar, R., Remli, R., & Zaidi, W. ', 2018, 'Time-frequency analysis in ictal and interictal seizure epilepsy patients using electroencephalogram', 'Journal of Theoretical & Applied Information Technology', '96(11)', '3433-3443', NULL, 'kckalai', 'kckalai'),
(30, 'Hussain, A., Chellapan, K., & Mukari, S.Z.', 2018, 'Evaluation of Two-channel Source Separation using Exploratory Projection Pursuit Technique', 'Malaysian Journal of Health Sciences /Jurnal Sains Kesihatan Malaysia', '16', '211', NULL, 'kckalai', 'kckalai'),
(31, 'Muhajir, M., Aminuddin, A., Ugusman, A., Salamt, N., Asmawi, Z., Zulkefli, A. F., Azmi, M. F., Chellappan, K. & Anita, N.M', 2018, 'Evaluation of finger photoplethysmography fitness index on young women with cardiovascular disease risk factors', 'Sains Malaysiana', '47(10)', '2481-2489', NULL, 'kckalai', 'kckalai'),
(32, 'Aminuddin, A., Tan, I., Butlin, M., Avolio, A. P., Kiat, H., Barin, E., Anita, N.M. & Chellappan, K. ', 2018, 'Effect of increasing heart rate on finger photoplethysmography fitness index (PPGF) in subjects with implanted cardiac pacemakers', 'PloS one', '13(11)', '', NULL, 'kckalai', 'kckalai'),
(33, 'Mukari, S. Z. M. S., Yusof, Y., Ishak, W. S., Maamor, N., Chellapan, K., & Dzulkifli, M. A. ', 2018, 'Relative contributions of auditory and cognitive functions on speech recognition in quiet and in noise among older adults', 'Brazilian journal of otorhinolaryngology', '', '', NULL, 'kckalai', 'kckalai'),
(34, 'Chellappan, K., Ab Malek, S. N. H., Jaafar, R., & Aminuddin, A.', 2016, 'Self-monitoring technique for stroke prevention among atrial fibrillation patients', 'International Journal Of Stroke', '11(3)', '248', NULL, 'kckalai', 'kckalai'),
(35, 'Chellappan, K., Nordin, K. M., & Sahathevan, R', 2016, 'Personalised post stroke finger grip rehabilitation monitoring framework & prototype', ' International Journal Of Stroke', '11(3)', '261', NULL, 'kckalai', 'kckalai'),
(36, 'Chellappan, K., Shaik Amir, N. S., Mukari, S. A., Law, Z. K., & Sahathevan, R', 2016, 'Identifying imaging parameters that distinguish cerebral amyloid angiopathy hemorrhage (CAAH) from intracerebral hemorrhage (ICH)', 'International Journal Of Stroke', '11(3)', '271', NULL, 'kckalai', 'kckalai'),
(37, 'Chellappan, K., Uroshi, R., Maskon, O., & Sahathevan, R.', 2016, 'Non-invasive finger photoplethysmogram in detection of left ventricular hypertrophy among stroke patients. International Journal Of Stroke', 'International Journal Of Stroke', '11(3)', '221-222', NULL, 'kckalai', 'kckalai'),
(38, 'Zahedi, E., Sohani, V., Ali, M. A., Chellappan, K., & Beng, G. K', 2015, 'Experimental feasibility study of estimation of the normalized central blood pressure waveform from radial photoplethysmogram', 'Journal of healthcare engineering', '6(1)', '121-144', NULL, 'kckalai', 'kckalai'),
(39, 'K., Chellappan, R,Sahathevan., SA Mukari, AA Abd Rahni, AS Muda, ZK Law, FA Hamzah, I Hossian Akra', 2014, 'Volumetric quantification of infarct core and penumbra for stroke patients using multimodal CT imaging', 'International Journal of Stroke', '', '132', NULL, 'kckalai', 'kckalai'),
(40, 'Chellappan, K.', 2014, 'Nonoinvasive vascular risk prediction using photoplethysmogram', 'Journal of Neuroepidemiology ', '', '71-113', NULL, 'kckalai', 'kckalai'),
(41, 'Aminuddin, A., Luqman Hakim, A.Z., Chan, S.Y., Nur Elyatulnadia, S., Hamizatul Akma, H., Nur Shahira Afifa, R., Ugusman, A., & Chellappan, K', 2018, 'The Changes of Aortic Stiffness During Normal Menstrual Cycle, Medicine & Health.Med & Health', 'SCOPUS', '13(1)', '117-129', NULL, 'kckalai', 'kckalai'),
(42, 'Chellappan, K., Shaik Amir, N., Law, Z., Mukari, S., & Sahathevan, R', 2018, 'CT brain image clustering for differentiation of intracerebral haemorrhage: A novel algorithm', 'SCOPUS', '', '', NULL, 'kckalai', 'kckalai'),
(43, 'Akir, R. M., Abdullah, M., Chellappan, K., & Bahari, S. A', 2018, 'Ionospheric TEC Response to the Partial Solar Eclipse Over the Malaysian Region', 'Space Science and Communication for Sustainability', '', '87-95', NULL, 'kckalai', 'kckalai'),
(44, 'Akir, R. M., Abdullah, M., Chellappan, K., Hasbi, A. M., & Bahari, S. A', 2017, 'Comparative study of TEC for GISTM stations in the Peninsular Malaysia region for the period of January 2011 to December 2012', 'Advanced Science Letters', '23(2)', '1304-1309', NULL, 'kckalai', 'kckalai'),
(45, 'Shariff, A. R. M., Harun, N., Singh, M. S. J., Chellappan, K., Suparta, W., Tangang, F. T., Muhammad, M., Abdullah.M & Islam, M. T', 2017, 'Utilization of wind steadiness index for identification of Malaysian northeast monsoon onset and withdrawal from 2011 to 2015', 'Advanced Science Letters (SCOPUS)', '23(2)', '1440-1443', NULL, 'kckalai', 'kckalai'),
(46, 'Shariff, A. R. M., Singh, M. S. J., Chellappan, K., Suparta, W., Tangang, F. T., Salimun, E., Muhammad, M., Abdullah.M & Islam, M. T', 2015, 'A preliminary study of cold surges and precipitation during the northeast monsoon season over Malaysia', 'Advanced Science Letters (SCOPUS)', '21(2)', '185-188', NULL, 'kckalai', 'kckalai'),
(47, 'Bani, N.H., Maamor, N., Ishak, W.S., Mukari, S.Z., & Chellapan, K', 2019, 'Development of Malay sentence materials in speech-in-noise training for adults', 'International Journal on Disability and Human Development', '', '', NULL, 'kckalai', 'kckalai'),
(48, 'Aminuddin, A. Muhajir M., Chellappan, K. Salamt, N., Ugusman, A', 2017, 'The Association between Finger Photoplethysmograph Fitness Index and other Cardiovascular Risk Marker among the Young Women', 'The Medical Journal of Malaysia', '', '', NULL, 'kckalai', 'kckalai'),
(49, 'Omara, N., Aminuddin, A., Zakaria, Z., Sattar, R.R., Chellappan, K., Ali, M., Salamt, N., & Nordin, N.A.', 2016, 'Improvement of cardiorespiratory fitness in young men with cardiovascular risks participating in pedometer based workplace programme', 'Journal of Clinical Research and Bioethics', '7', '1-6', NULL, 'kckalai', 'kckalai'),
(50, 'Puspalathaa Armum, Agnes Indra Chokkalingam, Tan Shiu Kuan, Kalaivani Chellappan', 2016, 'Instrument development and validation in assessing employability traits among youth in Malaysian context', 'Journal of Education and Social Science', '', '73-81', NULL, 'kckalai', 'kckalai'),
(51, 'Agnes Indra Chokkalingam, Puspalathaa Armum, Tan Shiu Kuan, Kalaivani Chellappan', 2016, 'An exploration of the level of academic self-efficacy (ASE) among Malaysian adolescents based on socioeconomic, different academic settings and gender', 'Journal of Education and Social Sciences', '', '86-94', NULL, 'kckalai', 'kckalai'),
(52, 'Amir, N.S., Kang, L.Z., Mukari, S., Sahathevan, R., & Chellappan, K.', 2020, 'CT brain image advancement for ICH diagnosis', ' Healthcare Technology Letters', '7', '1-6', NULL, 'kckalai', 'kckalai'),
(53, 'Lazim, M.R., Aminuddin, A., Chellappan, K., Ugusman, A., Hamid, A.A., Ahmad, W.M., & Mohamad, M.S. ', 2020, ' Is Heart Rate a Confounding Factor for Photoplethysmography Markers? A Systematic Review', ' International Journal of Environmental Research and Public Health', '17', '', NULL, 'kckalai', 'kckalai'),
(54, 'Adnan, N., Kamal, N., & Chellappan, K', 2019, 'An IoT Based Smart Lighting System Based on Human Activity', 'IEEE 14th Malaysia International Conference on Communication (MICC)', '', '65-68', NULL, 'kckalai', 'kckalai'),
(55, 'Aminuddin, A., Yong, C.K., Salamt, N., Ugusman, A., & Chellappan, K. ', 2019, 'Impact of Smoking on Lipid Profile Among Urban Malaysian Men', 'International Journal of Cardiology', '297', '29-30', NULL, 'kckalai', 'kckalai'),
(56, 'Silva, H., Shaik, S., Chellappan, K., & Karunaweera, N. D', 2019, 'Use of image processing for a mhealth based approach to screen cutaneous leishmaniasis lesions in remote areas. ', 'American Journal of Tropical Medicine and Hygiene ', '101', '569', NULL, 'kckalai', 'kckalai');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_knowledge`
--

CREATE TABLE `tbl_knowledge` (
  `id` int(11) NOT NULL,
  `knowledge_theme` varchar(255) DEFAULT NULL,
  `knowledge_title` varchar(255) DEFAULT NULL,
  `knowledge_notes` text DEFAULT NULL,
  `knowledge_date` date DEFAULT NULL,
  `super_owner` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_popular_article`
--

CREATE TABLE `tbl_popular_article` (
  `id` int(11) NOT NULL,
  `article_platform` int(11) DEFAULT NULL,
  `article_title` varchar(255) DEFAULT NULL,
  `article_author` varchar(255) DEFAULT NULL,
  `article_file` varchar(255) DEFAULT NULL,
  `article_owner` varchar(255) DEFAULT NULL,
  `super_owner` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_proceedings`
--

CREATE TABLE `tbl_proceedings` (
  `id` int(11) NOT NULL,
  `authors` text DEFAULT NULL,
  `proceeding_year` varchar(255) DEFAULT NULL,
  `proceeding_title` text DEFAULT NULL,
  `conference_name` text DEFAULT NULL,
  `conference_location` varchar(255) DEFAULT NULL,
  `proceeding_volume` varchar(255) DEFAULT NULL,
  `proceeding_pagenum` varchar(255) DEFAULT NULL,
  `conference_date` varchar(255) DEFAULT NULL,
  `proceeding_file` varchar(255) DEFAULT NULL,
  `proceeding_owner` varchar(255) DEFAULT NULL,
  `super_owner` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_proceedings`
--

INSERT INTO `tbl_proceedings` (`id`, `authors`, `proceeding_year`, `proceeding_title`, `conference_name`, `conference_location`, `proceeding_volume`, `proceeding_pagenum`, `conference_date`, `proceeding_file`, `proceeding_owner`, `super_owner`) VALUES
(1, 'Mohd Radzi, A, Rambely & A, Chellapan, K', '2014', 'Rope skipping as a measure to fight obesity', 'Abstracts of the 12th International Congress on Obesity', 'Kuala Lumpur, Malaysia', 'Obesity Review, Volume 15, Issue Supplement S2', '200', '17-20 March 2014', NULL, 'kckalai', 'kckalai'),
(2, 'Amilia Aminuddin, Norizam Salamt, Azmir Ahmad, Aini Farzana Zulkefli, Zaiton Zakaria, Oteh Maskon, Kalaivani Chellappan & Nor Anita Megat Mohd Nordin', '2014', 'The impact of risk factors on novel biomarkers of coronary artery disease among young males', 'MSH 2014 - 11th Annual Scientific Meeting', '', '', '', '', NULL, 'kckalai', 'kckalai'),
(3, 'Kalaivani Chellappan & Sabirin Abdullah', '2013', 'ANGKASA research knowledge organization system : a needs analysis study', 'Proceeding of the 2013 IEEE International Conference on Space Science and Communication (IconSpace)', '', '', '137-140', '', NULL, 'kckalai', 'kckalai'),
(4, 'A. S. N Mokhtar, M. B. I. Reaz, K. Chellappan & M. A. Mohd Ali', '2013', 'Scaling free CORDIC algorithm implementation of sine and cosine function', 'Proceedings of the World Congress on Engineering 2013 (WCE 2013)', '', '', '', '', NULL, 'kckalai', 'kckalai'),
(5, 'Sembagam K, Nor Anita Megat Mohd Nordin, Zaiton Zakaria & K Chellappan', '2013', 'Non-invasive Cardiovascular Disease Screening: High and Low Risk Clustering with Photoplethysmogram Analysis', '27th Scientific Meeting of Malaysian Society of Pharmacology & Physiology', '', '', '', '', NULL, 'kckalai', 'kckalai'),
(6, 'Vahid Sohani, Edmond Zahedi, Kalaivani Chellappan & Mohd Alauddin Mohd Ali', '2012', 'A review of commercially available non-invasive vascular screening technologies for clinical applications', '2012 IEEE-EMBS Conference on Biomedical Engineering and Sciences, IECBES 2012', '', '2012', '568 - 573', '', NULL, 'kckalai', 'kckalai'),
(7, 'K. Chellappan, Noor K. Mohsin, Sawal Hamid Bin Md Ali & Md. Shabiul Islam', '2012', 'Post-stroke brain memory assessment framework', '2012 IEEE-EMBS Conference on Biomedical Engineering and Sciences, IECBES 2012', '', '2012', '189 - 194', '', NULL, 'kckalai', 'kckalai'),
(8, 'Amilia Aminuddin, Norizam Salamt, Azmir Ahmad, Firdaus Azmi, Zaiton Zakaria, Oteh Maskon, Kalaivani Chellappan & Nor Anita Megat Mohd Nordin', '2012', 'Carotid intima media thickness among young males with cardiovascular risk factors', '2012 IEEE-EMBS Conference on Biomedical Engineering and Sciences, IECBES 2012', '', '2012', '449 - 453.2', '', NULL, 'kckalai', 'kckalai'),
(9, 'Amilia Aminuddin, Norizam Salamt, Azmir Ahmad, Musmarlina Omar, Zaiton Zakaria, Wan Zurinah Wan Ngah, Oteh Maskon, Kalaivani Chellapan & Nor Anita Megat Mohd Nordin', '2012', 'Novel cardiovascular biomarkers among young males with risk factors', '46th Malaysia-Singapore Congress of Medicine', '', '', '', '', NULL, 'kckalai', 'kckalai'),
(10, 'Kalaivani Chellappan, Mohd. Alauddin Mohd. Ali & Nor Anita Megat Mohd Nordin', '2012', 'Vascular age sustainability in ageing Health Management', '1st World Congress on Healthy Ageing', '', '', '', '', NULL, 'kckalai', 'kckalai'),
(11, 'Nor Anita MMN, Kalaivani C, Amilia A, Ahmad Faiz AF, Zaiton Z & Wan Zurinah WN', '2011', 'Young men with abdominal obesity have increased indices of arterial stiffness', 'MASO 2011 - Scientific Conference on Obesity', '', '', '', '', NULL, 'kckalai', 'kckalai'),
(12, 'Yousef K. Qawqzeh, M. B. I. Reaz, O. Maskon, Kalaivani Chellappan & M. A. M. Ali', '2011', 'Photoplethysmogram reflection index and aging', 'Proc. SPIE 8285, 82852R (2011); doi:10.1117/12.913587', '', '', '', '', NULL, 'kckalai', 'kckalai'),
(13, 'Kalaivani Chellappan & Almabrok Saleh Ahmed', '2011', 'Self-Managed Internet Based Individualized Risk Assessor for Malaysian Diabetes Population', 'Third International Conference on Computational Intelligence, Modelling & Simulation', '', '2011', '293 - 297', '', NULL, 'kckalai', 'kckalai'),
(14, 'Y. K. Qawqzeh h, M. B. I. Reaz, O. Maskon, Kalaivani Chellappan, M. T. Islam & M. A. M. Ali', '2011', 'The investigation of the effect of aging through photoplethysmogram signal analysis of erectile dysfunction subjects', '10th WSEAS International Conference on Telecommunications and Informatics (Tele-Info `11) -Recent Researches in Telecommunications, Informatics, Electronics and Signal Processing', '', '', '', '', NULL, 'kckalai', 'kckalai'),
(15, 'Kalaivani Chellappan & Sundaraja Perumal', '2011', 'Service Oriented Architecture & Real-Time Agent Activated Maintenance Framework For Port Equipment Management', 'The 2nd International Conference on Industrial Engineering and Operations Management (IEOM 2011)', 'Grand Season Hotel, KL', '', '', '22-24 January 2011', NULL, 'kckalai', 'kckalai'),
(16, 'Y. K. Qawqzeh, M B. I. Reaz, O. Maskon, Kalaivani Chellappan & M. A. M. Ali', '2010', 'Photoplethysmogram Reflection Index and Aging', 'International Conference on Signal and Information Processing (ICSIP 2010)', 'Changsha, China', '', '741- 745', '14-15 December 2010', NULL, 'kckalai', 'kckalai'),
(17, 'Kalaivani Chellappan', '2010', 'Photoplethysmogram Signal Variability and Repeatability Assessment', '2010 IEEE EMBS Conference on Biomedical Engineering & Sciences', 'Kuala Lumpur, Malaysia', '', '', '30th Nov - 2nd Dec 2010', NULL, 'kckalai', 'kckalai'),
(18, 'Abubakar Agil Emhmed & Kalaivani Chellappan', '2010', 'GIS-based Mobile Tourism Architecture Prototype for Libya (A Case Study)', 'International Symposium on Information Technology (ITSIM 2010)', '', '', '', '', NULL, 'kckalai', 'kckalai'),
(19, 'Kalaivani Chellappan, Edmond Zahedi & Mohd Alauddin Mohd Ali', '2008', 'An Age Index for Vascular System Based on Photoplethysmogram Pulse Contour Analysis', 'IFMBE Proceedings, 4th Kuala Lumpur International Conference on Biomedical Engineering', 'Kuala Lumpur, Malaysia', 'Vol: 21', '125 - 128', '', NULL, 'kckalai', 'kckalai'),
(20, 'Kalaivani Chellappan, Edmond Zahedi & Mohd Alauddin Mohd Ali', '2007', 'Effects of Physical Exercise on the Photoplethysmogram Waveform', 'IEEE 5th Student Conference on Research and Development (SCOReD 2007)', '', '', '', '', NULL, 'kckalai', 'kckalai'),
(21, 'Kalaivani Chellappan, Edmond Zahedi & Mohd Alauddin Mohd Ali', '2006', 'Age-related Upper Limb Vascular System Windkessel Model using Photoplethysmography', 'IFMBE Proceedings, 3rd Kuala Lumpur International Conference on Biomedical Engineering', 'Kuala Lumpur, Malaysia', 'Vol: 15', '563 - 566', '', NULL, 'kckalai', 'kckalai'),
(22, 'Kalaivani Chellappan, Edmond Zahedi & Mohd Alauddin Mohd Ali', '2006', 'Windkessel Model of the Arterial Vascular System using Photoplethysmography', 'Proceedings of Graduate Research Seminar UKM (SPS2006)', '', '', '183 - 186', '', NULL, 'kckalai', 'kckalai'),
(23, 'Ayob, M., Chellappan, K. & Ali , N.M.', '2001', 'Intelligent tutoring tool for digital logic design course (ITDiL)', 'Proceedings of IEEE Region 10 International Conference on Electrical and Electronic Technology, TENCON', '', 'Vol: 2', '899 - 902', '', NULL, 'kckalai', 'kckalai'),
(24, 'Kalaivani Chellappan', '2001', 'Intelligent Tutoring System for Digital Logic Design Learning', 'SCOReD 2001', '', '', '071', '', NULL, 'kckalai', 'kckalai'),
(25, 'Abdullah Mohd Zin, Masri Ayob, Kalaivani Chellappan, Suhaila Zainuddin & Rosilah Hassan', '2000', 'A Computer Aided Learning Software for Digital Logic Design', 'Proceeding of International Forum cum Conference on Information Technology and Communication at the Dawn of the New Millennium', '', '', '629 - 637', '', NULL, 'kckalai', 'kckalai'),
(26, 'Masri Ayob, Kalaivani Chellappan, Abdullah Mohd Zin and Rosilah Hassan', '2000', 'Sigma Solution Digital Designer and Simulator', 'ICAST2000 Proceeding of the 2nd International Conference on Advances and Strategic Technologies', '', '', '1709 - 1714', '', NULL, 'kckalai', 'kckalai'),
(27, 'Rohaida Mat Akir, Mardina Abdullah, Kalaivani Chellappan, Siti Aminah Bahari', '2018', 'Ionospheric TEC Response to the Partial Solar Eclipse Over the Malaysian Region', 'Space Science and Communication for Sustainability', '', '', '87-95', '', NULL, 'kckalai', 'kckalai'),
(28, 'Mohd Syakir Fathillah, Rosmina Jaafar, Kalaivani Chellappan, Rabani Remli, Wan Asyraf Wan Zainal', '2017', 'Interictal epileptic discharge EEG detection based on wavelet and multiresolution analysis', 'System Engineering and Technology (ICSET), 2017 7th IEEE International Conference on', '', '', '140-144', '', NULL, 'kckalai', 'kckalai'),
(29, 'Abrar Hussain, Kalaivani Chellappan, Siti Zamratol Mai-Sarah Mukari', '2017', 'Evaluation of source separation using projection pursuit algorithm for computer-based auditory training system', 'System Engineering and Technology (ICSET), 2017 7th IEEE International Conference on', '', '', '145-150', '', NULL, 'kckalai', 'kckalai'),
(30, 'Abrar Hussain, Kalaivani Chellappan, M Siti Zamratol', '2016', 'Speech enhancement using degenerate unmixing estimation technique and adaptive noise cancellation technique as a post signal processing', 'Biomedical Engineering and Sciences (IECBES), 2016 IEEE EMBS Conference on', '', '', '280-285', '', NULL, 'kckalai', 'kckalai'),
(31, 'Kalaivani Chellappan, Law Zhe Kang, Shahizon Mukari, Ramesh Sahathevan', '2016', 'MR image enhancement for ICH classification', 'Biomedical Engineering and Sciences (IECBES), 2016 IEEE EMBS Conference on', '', '', '160-165', '', NULL, 'kckalai', 'kckalai'),
(32, 'Mohd Syakir Fathillah, Rosmina Jaafar, Kalaivani Chellappan, Rabani Remli', '2016', 'A study on EEG signals during eye-closed and eye-open using discrete wavelet transform', 'Biomedical Engineering and Sciences (IECBES), 2016 IEEE EMBS Conference on', '', '', '674-678', '', NULL, 'kckalai', 'kckalai'),
(33, 'Kalaivani Chellappan', '2016', 'A preliminary dengue fever prediction model based on vital signs and blood profile', 'Biomedical Engineering and Sciences (IECBES), 2016 IEEE EMBS Conference on', '', '', '652-656', '', NULL, 'kckalai', 'kckalai'),
(34, 'K Chellappan, SNH Ab Malek, R Jaafar, A Aminuddin', '2016', 'SELF-MONITORING TECHNIQUE FOR STROKE PREVENTION AMONG ATRIAL FIBRILLATION PATIENTS', 'INTERNATIONAL JOURNAL OF STROKE', '', '11(SUPP 3)', '248-248', '', NULL, 'kckalai', 'kckalai'),
(35, 'K Chellappan, R Uroshi, O Maskon, R Sahathevan', '2016', 'NON-INVASIVE FINGER PHOTOPLETHYSMOGRAM IN DETECTION OF LEFT VENTRICULAR HYPERTROPHY AMONG STROKE PATIENTS', 'INTERNATIONAL JOURNAL OF STROKE', '', '11(SUPP 3)', '221-222', '', NULL, 'kckalai', 'kckalai'),
(36, 'K Chellappan, KM Nordin, R Sahathevan', '2016', 'PERSONALISED POST STROKE FINGER GRIP REHABILITATION MONITORING FRAMEWORK & PROTOTYPE', 'INTERNATIONAL JOURNAL OF STROKE', '', '11(SUPP 3)', '261-261', '', NULL, 'kckalai', 'kckalai'),
(37, 'K Chellappan, NS Amir, SA Mukari, ZK Law, R Sahathevan', '2016', 'IDENTIFYING IMAGING PARAMETERS THAT DISTINGUISH CEREBRAL AMYLOID ANGIOPATHY HEMORRHAGE (CAAH) FROM INTRACEREBRAL HEMORRHAGE', 'INTERNATIONAL JOURNAL OF STROKE', '', '11(SUPP 3)', '271-271', '', NULL, 'kckalai', 'kckalai'),
(38, 'Ashrani Aizzuddin Abd Rahni, Israna Hossain Arka, Kalaivani Chellappan, Shahizon Azura Mukari, Zhe Kang Law, Ramesh Sahathevan', '2016', 'Comparison of stroke infarction between CT perfusion and diffusion weighted imaging: preliminary results', 'Medical Imaging 2016: Biomedical Applications in Molecular, Structural, and Functional Imaging', '', '9788', '978824', '', NULL, 'kckalai', 'kckalai'),
(39, 'S Nur Hidayah Malek, Kalaivani Chellappan, Rosmina Jaafar', '2015', 'Short review of electrocardiogram (ECG) technique versus optical techniques for monitoring vascular health', 'International Conference for Innovation in Biomedical Engineering and Life Sciences', '', '', '222-225', '', NULL, 'kckalai', 'kckalai'),
(40, 'Ahmad Ridzuan Mohammed Shariff, Mandeep Singh Jit Singh, Kalaivani Chellappan, Wayan Suparta, Fredolin T Tangang, Ester Salimun, Maszidah Muhammad, Mardina Abdullah, Mohammad Tariqul Islam', '2015', 'Initial observations of cold surge frequency over Southeast Asia in relation to ENSO-induced anomalies', 'Space Science and Communication (IconSpace), 2015 International Conference on', '', '', '453-458', '', NULL, 'kckalai', 'kckalai'),
(41, 'Rohaida Mat Akir, Mardina Abdulla, Kalaivani Chellappan, Alina Marie Hasbi', '2015', 'Preliminary vertical TEC prediction using neural network: Input data selection and preparation', 'Space Science and Communication (IconSpace), 2015 International Conference on', '', '', '283-287', '', NULL, 'kckalai', 'kckalai'),
(42, 'Selvakumar Atikan, Kalaivani Chellappan', '2015', 'UKM GNSS data management framework using client site data processing techniques ', 'Space Science and Communication (IconSpace), 2015 International Conference on', '', '', '489-492', '', NULL, 'kckalai', 'kckalai'),
(43, 'Nurul Syafiqah Mohamad, Kalaivani Chellappan', '2015', 'The relationship between total electron content (TEC), tides phenomena and the position of moon and sun during the full moon and new moon in Selangor ', 'Space Science and Communication (IconSpace), 2015 International Conference on', '', '', '277-282', '', NULL, 'kckalai', 'kckalai'),
(44, 'Israna Hossain Arka, Kalaivani Chellappan, Shahizon Azura Mukari, Zhe Kang Law, Ramesh Sahathevan, Ashrani Aizzuddin Abd Rahni', '2015', 'Simultaneous tilt correction and registration of CT angiography and dynamic ct brain images', 'BioSignal Analysis, Processing and Systems (ICBAPS), 2015 International Conference on', '', '', '88-92', '', NULL, 'kckalai', 'kckalai'),
(45, 'Israna H Arka, Kalaivani Chellappan, Shahizon A Mukari, Zhe K Law, Ramesh Sahathevan, Ashrani A Abd Rahni', '2014', 'Automatic volumetric registration off NCCT and CTA brain images using intensity based image registration', 'Biomedical Engineering and Sciences (IECBES), 2014 IEEE Conference on', '', '', '821-826', '', NULL, 'kckalai', 'kckalai'),
(46, 'Raifana Rosa Mohamad Sattar, Kalaivani Chellappan, Amilia Aminuddin, Norsuhana Omar, Zaiton Zakaria, Mohd Alauddin Mohd Ali, Nor Anita Megat Mohd Nordin', '2014', 'Correlation between lipid profile and finger photoplethysmogram morphological properties among young men with cardiovascular risk: A preliminary result', 'Biomedical Engineering and Sciences (IECBES), 2014 IEEE Conference on', '', '', '602-606', '', NULL, 'kckalai', 'kckalai'),
(47, 'A Hussain, K Chellappan, Siti Zamratol', '2014', 'Evaluation of multichannel speech signal separation with beamforming techniques', 'Biomedical Engineering and Sciences (IECBES), 2014 IEEE Conference on', '', '', '766-771', '', NULL, 'kckalai', 'kckalai'),
(48, 'Khairul Muslim Nordin, Kalaivani Chellappan, Ramesh Sahathevan', '2014', 'Upper limb rehabilitation in post stroke patients: Clinical observation', 'Biomedical Engineering and Sciences (IECBES), 2014 IEEE Conference on', '', '', '700-704', '', NULL, 'kckalai', 'kckalai'),
(49, 'Norhayati Mohd Zainee, Kalaivani Chellappan', '2014', 'Emergency clinic multi-sensor continuous monitoring prototype using e-health platform', 'Biomedical Engineering and Sciences (IECBES), 2014 IEEE Conference on', '', '', '32.37', '', NULL, 'kckalai', 'kckalai'),
(50, 'Vahid Sohani, Edmond Zahedi, MA Mohd Ali, Gan Kok Beng, Kalaivani Chellappan', '2014', 'A Dynamic Model Between Central Aortic Pressure and Radial Photooplethysmogram: Experimental Proof o Concept ', 'Intelligent and Advanced Systems (ICIAS), 2014 5th International Conference', '', '', '1-4', '', NULL, 'kckalai', 'kckalai'),
(51, 'E Zahedi, KB Gan, K Chellappan, MAM Ali, Mohd Marzuki Mustafa', '2014', 'A synergistic program between engineering and business schools towards medical technology commercialization', 'Region 10 Symposium, 2014 IEEE', '', '', '456-461', '', NULL, 'kckalai', 'kckalai'),
(52, 'Rohaida Mat Akir, Mardina Abdullah, Kalaivani Chellappan & Siti Aminah Bahari', '2018', 'Comparison of the neural network and the IRI model for forecasting TEC over UKM Station', 'Proceedings of IPI Research Colloquium 2017', 'Trolak, Perak', '', '', '1-3 OCT', NULL, 'kckalai', 'kckalai'),
(53, 'Agnes Indra Chokkalingam; Puspalathaa Armum; Tan Shiu Kuan & Kalaivani Chellappan', '2016', 'Academic self-efficacy (ASE) grading among Malaysian adolescents', 'Proceeding- Kuala Lumpur International Communication, Education, Language and Social Sciences 5 (KLiCELS 5), ', '', '', '212-213', '', NULL, 'kckalai', 'kckalai'),
(54, 'Puspalathaa Armum, Agnes Indra Chokkalingam, Tan Shiu Kuan & Kalaivani Chellappan', '2016', 'Instrument validity: principles of instrument development and validation in assessing employability traits among youth', 'Proceeding- Kuala Lumpur International Communication, Education, Language and Social Sciences 5 (KLiCELS 5)', '', '', '163-174', '', NULL, 'kckalai', 'kckalai'),
(55, 'S. Nur Hidayah Malek, K. Chellappan & R. Jaafar', '2016', 'Short review of Electrocardiogram (ECG) technique versus optical techniques for monitoring vascular health', '. International Conference for Innovation in Biomedical Engineering and Life Sciences (ICIBEL2015)', 'Putrajaya', '', '', '6-8 DEC', NULL, 'kckalai', 'kckalai'),
(56, 'Rahni, A. A. A., Arka, I. H., Chellappan, K., Mukari, S. A., Law, Z. K., & Sahathevan, R. ', '2016', 'Comparison of stroke infarction between CT perfusion and diffusion weighted imaging: preliminary results', 'Medical Imaging 2016: Biomedical Applications in Molecular, Structural, and Functional Imaging, 9788', '', '', '978-824', '', NULL, 'kckalai', 'kckalai'),
(57, 'A. N. M. Radzi, A. S. Rambely & K. Chellappan', '2014', 'A protocol of rope skipping exercise for primary school children: A pilot test', 'AIP Conference Proceedings - 3rd International Conference on Mathematical Sciences 1602 (1)', '', '', '330-334', '', NULL, 'kckalai', 'kckalai'),
(58, 'Tan Shiu Kuan, Puspalathaa Armum, Agnes Indra Chokkalingam, Kamisah Osman & Kalaivani Chellappan', '2014', 'Perception of barriers in labour market attachment among marginalised youth in Malaysia', 'Proceedings of the International Conference on Language, Literature, Culture and Education (ICLLCE 2014)', '', '', '87-95', '', NULL, 'kckalai', 'kckalai'),
(59, 'Arka, I. H., & Chellappan, K', '2014', 'Collaborative compressed I-cloud medical image storage with decompress viewer', 'Procedia Computer Science, 42, International Conference on Robot PRIDE 2013-2014 - Medical and Rehabilitation Robotics and Instrumentation, (ConfPRIDE 2013-2014)', '', '', '114-121', '', NULL, 'kckalai', 'kckalai'),
(60, 'A. S. N Mokhtar, M. B. I. Reaz, K. Chellappan & M. A. Mohd Ali', '2013', 'Scaling free CORDIC algorithm implementation of sine and cosine function', '. Proceedings of the World Congress on Engineering 2013 (WCE 2013)', '', '', '2-4', '', NULL, 'kckalai', 'kckalai'),
(61, 'Abdullah Mohd Zin, Masri Ayob, Kalaivani Chellappan, Suhaila Zainuddin & Rosilah Hassan', '2000', 'A Computer Aided Learning Software for Digital Logic Design', 'Proceeding of International Forum cum Conference on Information Technology and Communication at the Dawn of the New Millennium', '', '', '629-637', '', NULL, 'kckalai', 'kckalai'),
(62, 'Masri Ayob, Kalaivani Chellappan, Abdullah Mohd Zin & Rosilah Hassan', '2000', 'Sigma Solution Digital Designer and Simulator', '. ICAST2000 Proceeding of the 2nd International Conference on Advances and Strategic Technologies', '', '', '1709-1714', '', NULL, 'kckalai', 'kckalai'),
(63, 'Radzi, A., Chellappan, K., & Rambely, A.S. ', '2019', 'Consistent rope skipping in short term memory enhancement: A practical intervention', 'AIP Conference Proceedings 2111 (1)', '', '', '', '', NULL, 'kckalai', 'kckalai'),
(64, 'Md Rizman Md Lazim, Amilia Aminuddin, Kalaivani Chellappan, Azizah Ugusman, Norizam Salamt, Oteh Maskon, Wan Amir Nizam Wan Ahmad, Mohd Faizal Shawal Mohamad & Ahmad Khairuddin Mohamed Yusof. ', '2018', 'Development and Validation of Heart Rate-Incorporated Photoplethysmography Fitness Index Algorithm for Cardiovascular Disease Risk Assessment', 'EEE-EMBS Conference on Biomedical Engineering and Sciences', 'Kuching, Sarawak', '', '', '3-6 Dec', NULL, 'kckalai', 'kckalai'),
(65, 'Kalaivani Chellappan', '2018', 'Cloud-base home environment health monitoring framework', 'APAMI 2018 - 10th Biennial Conference of the Asia Pacific Association for Medical Informatics', 'Colombo, Sri-Lanka', '', '', '8-12 October', NULL, 'kckalai', 'kckalai'),
(66, 'Md Rizman Md Lazin @ Md Lazim, Amilia Aminuddin, Kalaivani Chellappan, Azizah Ugusman, Oteh Maskon, Wan Amir Nizam Wan Ahmad, Mohd Shawal Faizal Mohamad & Ahmad Khairudin Mohamed Yusof', '2018', 'The influence of heart rate towards photoplethysmography parameters for cardiovascular disease risk assessment: A review', '32nd Scientific Meeting of Malaysian Society of Pharmacology & Physiology', 'Hotel Bangi Putrajaya', '', '', '8-9 Aug', NULL, 'kckalai', 'kckalai'),
(67, 'Ashrani Aizzuddin Abd Rahni, Gunawathi Gunasekaran, Israna Hossain Arka, Kalaivani Chellappan, Shahizon Azura Mukari, Ramesh Sahathevan', '2018', 'Reducing Execution Time in CT Angiography and Dynamic CT Brain Image Registration through Code Optimisation', '2nd International Conference on BioSignal Analysis, Processing and Systems (ICBAPS)', 'Kuching Sarawak', '', '37-40', '26-27 July', NULL, 'kckalai', 'kckalai'),
(68, 'Kalaivani Chellappan & Anis Nurnabila Mohd Radzi', '2018', 'Pembelajaran futuristik: STEM & Memori', 'Rampai Penyelidik Siri 6', 'Dewan Tun Abdullah Salleh, UKM Bangi', '', '', '17 July', NULL, 'kckalai', 'kckalai'),
(69, 'Kalaivani Chellappan', '2018', 'Integrated STEM: Informal Education and Community Collaboration an Engineering Intervention', 'Rampai Penyelidik Siri 6', 'Dewan Tun Abdullah Salleh, UKM Bangi', '', '', '17 July', NULL, 'kckalai', 'kckalai'),
(70, 'Lilia H., Kalaivani C., Ruhizan M.Yasin, Kamisah O., Zanaton H.Iksan, Azmin Sham R., W.Juliana W.Ahmad, Effandi Z., Hafizah H., Mardina A, Rizafizah O., M.Izwan Mahmud,Roslinda R.,Abu Yazid A.Bakar, T.Mastura T.Soh, M.Sattar Rasul,S abirin A, S.Mistima', '2018', 'Futuristic multidiscipline stem mentoring program', 'Rampai Penyelidik Siri 6', 'Dewan Tun Abdullah Salleh, UKM Bangi', '', '', '17 July', NULL, 'kckalai', 'kckalai'),
(71, 'Kalaivani Chellappan, Mas Ayu Othman, Muhammad Syafiq Abdul Razak, Mohd Syakir Fathillah & Nor Shahirah Shaik Amir', '2018', 'STEMA IoT exploration carnival', 'The 17th International Expo on Inventions and Innovation', 'World Trade Centre (PWTC), Kuala Lumpur', '', '', '22-24 Feb', NULL, 'kckalai', 'kckalai'),
(72, 'Norizam Salamt, Amilia Aminuddin, Azizah Ugusman, Aini Farzana Zulkefli, Zanariyah Asmawi & Kalaivani Chellappan', '2018', 'The Association between Finger Photoplethysmograph Fitness Index (PPGF) and obesity measures', 'NHAM- CRM Research Track 2018', 'Le Meridien Kuala Lumpur', '', '', '14 April', NULL, 'kckalai', 'kckalai'),
(73, 'Musilawati Muhajir, Amilia Aminuddin, Kalaivani Chellappan, Azizah Ugusman, Norizam Salamt, Zanariyah Asmawi & Aini Farzana Zulkefli', '2018', 'Finger photoplethysmography fitness index assessment for screening young women with cardiovascular disease risk factors', 'NHAM-CRM Research Track 2018', '. Le Meridien Kuala Lumpur', '', '', '14 April', NULL, 'kckalai', 'kckalai'),
(74, 'Kalaivani Chellappan', '2018', 'Integrated STEM: Informal Education and Community Collaboration an Engineering Intervention', 'Rampai Penyelidik Siri 6', 'Dewan Tun Abdullah Salleh, UKM Bangi', '', '', '17 July', NULL, 'kckalai', 'kckalai'),
(75, 'Mohd Syakir Fathillah, Rosmina Jaafar, Kalaivani Chellappan, Rabani Remli & Wan Asyraf Wan Zainal', '2017', 'Interictal epileptic discharge EEG detection based on wavelet and multiresolution analysis', 'IEEE International Conference on System Engineering and Technology (ICSET)', 'Shah Alam, Selangor', '', '', '2-3 October', NULL, 'kckalai', 'kckalai'),
(76, 'Mohd Syakir Fathillah, Rosmina Jaafar, Kalaivani Chellappan, Rabani Remli & Wan Asyraf Wan Zaidi', '2017', 'Complexity analysis on eeg signal via lempel-ziv and approximate entropy: effect of multiresolution analysis', 'International Medical Device and Technology Conference 2017 (iMEDiTEC 2017)', 'Johor Bahru', '', '', '6-7 Sept', NULL, 'kckalai', 'kckalai'),
(77, 'Aminuddin A, Muhajir M, Kalaivani C, Salamt N. & Ugusman A', '2017', 'The association between finger photoplethysmograph fitness index and other cardiovascular risk marker among the young women', 'The International i-Sihat 2017 Symposium Kuala Lumpur', 'Premier Hotel, Kuala Lumpur', '', '', '1-2 Aug', NULL, 'kckalai', 'kckalai'),
(78, 'Roszilah Hamid, Norhana Arshad, Mohd Shahbudin Mastar@Masdar, Kalaivani Chellappan et al', '2017', 'Meremajakan Pengajaran, Mengispirasikan Pembelajaran', 'Prosiding PeKA 2016 K-Novasi P & P UKM (Pendidikan Kejuruteraan dan Alam Bina)', 'Fakulti Kejuruteraan dan Alam Bina, UKM', '', '', '', NULL, 'kckalai', 'kckalai');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pro_member`
--

CREATE TABLE `tbl_pro_member` (
  `id` int(11) NOT NULL,
  `membership_body` varchar(255) DEFAULT NULL,
  `membership_status` varchar(255) DEFAULT NULL,
  `membership_startdate` varchar(255) DEFAULT NULL,
  `membership_enddate` varchar(255) DEFAULT NULL,
  `super_owner` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pro_member`
--

INSERT INTO `tbl_pro_member` (`id`, `membership_body`, `membership_status`, `membership_startdate`, `membership_enddate`, `super_owner`) VALUES
(1, 'Board of Engineers Malaysia', 'Member', '2000', 'Present', 'kckalai');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_research_facilities`
--

CREATE TABLE `tbl_research_facilities` (
  `id` int(11) NOT NULL,
  `facility_name` varchar(255) DEFAULT NULL,
  `facility_services` varchar(255) DEFAULT NULL,
  `facility_equipment` varchar(255) DEFAULT NULL,
  `facility_file1` varchar(255) DEFAULT NULL,
  `facility_file2` varchar(255) DEFAULT NULL,
  `super_owner` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_research_ip`
--

CREATE TABLE `tbl_research_ip` (
  `id` int(11) NOT NULL,
  `research_ip_id` varchar(11) DEFAULT NULL,
  `research_ip_title` varchar(255) DEFAULT NULL,
  `research_ip_members` text DEFAULT NULL,
  `research_ip_year` int(11) DEFAULT NULL,
  `research_ip_level` int(11) DEFAULT NULL,
  `research_ip_country` varchar(255) DEFAULT NULL,
  `super_owner` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_research_outcome`
--

CREATE TABLE `tbl_research_outcome` (
  `id` int(11) NOT NULL,
  `research_title` text DEFAULT NULL,
  `research_link` text DEFAULT NULL,
  `research_ip` varchar(255) DEFAULT NULL,
  `research_owner` varchar(255) DEFAULT NULL,
  `super_owner` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_scholarly_activities`
--

CREATE TABLE `tbl_scholarly_activities` (
  `id` int(11) NOT NULL,
  `scholarly_type` varchar(255) DEFAULT NULL,
  `scholarly_event` varchar(255) DEFAULT NULL,
  `scholarly_location` varchar(255) DEFAULT NULL,
  `scholarly_date` varchar(255) DEFAULT NULL,
  `super_owner` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_scholarly_types`
--

CREATE TABLE `tbl_scholarly_types` (
  `id` int(11) NOT NULL,
  `scholarly_type_title` varchar(255) DEFAULT NULL,
  `super_owner` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_scholarly_types`
--

INSERT INTO `tbl_scholarly_types` (`id`, `scholarly_type_title`, `super_owner`) VALUES
(1, 'Research', 'kckalai');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_students`
--

CREATE TABLE `tbl_students` (
  `id` int(11) NOT NULL,
  `std_reg_num` varchar(25) DEFAULT NULL,
  `std_name` text DEFAULT NULL,
  `std_picture` varchar(255) DEFAULT NULL,
  `std_type` int(11) DEFAULT NULL,
  `std_phonenum` varchar(255) DEFAULT NULL,
  `std_email` varchar(255) DEFAULT NULL,
  `std_research_title` text DEFAULT NULL,
  `std_start_year` int(11) DEFAULT NULL,
  `std_end_year` int(11) DEFAULT NULL,
  `std_status` int(11) DEFAULT NULL,
  `std_sv_status` int(11) DEFAULT NULL,
  `std_faculty` varchar(25) DEFAULT NULL,
  `std_funding_status` varchar(255) DEFAULT NULL,
  `std_activity` text DEFAULT NULL,
  `std_research_outcome` varchar(255) DEFAULT NULL,
  `std_password` varchar(255) DEFAULT NULL,
  `std_firstlogin` int(11) DEFAULT NULL,
  `super_owner` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_students`
--

INSERT INTO `tbl_students` (`id`, `std_reg_num`, `std_name`, `std_picture`, `std_type`, `std_phonenum`, `std_email`, `std_research_title`, `std_start_year`, `std_end_year`, `std_status`, `std_sv_status`, `std_faculty`, `std_funding_status`, `std_activity`, `std_research_outcome`, `std_password`, `std_firstlogin`, `super_owner`) VALUES
(1, 'P75369', 'SITI NUR HIDAYAH BINTI AB. MALEK', 'no_image.jpg', 2, '+6017-2491793/+6011-10371793', 'sitinurhidayahmalek@gmail.com', 'Automated Atrial Fibrillation Detection and Monitoring', 2013, 0, 0, 0, 'FKAB', 'LRGS/BU/2012/UKM-UKM/K/02', 'Lorem ipsum', 'fdgdfgfdgaaa', 'd8acbef1271a1894c40225fc763845ae', 0, 'kckalai'),
(2, 'P65723', 'ROHAIDA BINTI MAT AKIR', 'no_image.jpg', 2, 'null', 'null', 'Forecasting Model for Ionosperic GPS Total Electron Content Over Malaysia Region', 2012, 2018, 1, 1, 'FKAB', 'GUP-2017-026', 'Not Specified', 'Not Specified', '0cc94cba6c3e9a21e81a72cfaf384ddc', 1, 'kckalai'),
(3, 'P65909', 'ANIS NURNABILA BINTI MOHD RADZI ', 'no_image.jpg', 2, 'null', 'null', 'Biomechanical and Physiological Investigation of Brain Memory Function Enhancement of Primary School Children Through Optimized Rope Skipping Activity', 2013, 0, 0, 1, 'FST', 'GUP-2017-026', 'Not Specified', 'Not Specified', '9ed18f4ae94cf80e056992b1266ce6dd', 1, 'kckalai'),
(4, 'P49911', 'AMMAR YOUNIS KADHIM TIMIMI', 'no_image.jpg', 2, '0123456789', 'ammar@younis.com', 'Dengue Simulation using Peripheral Blood Volume Change Waveform', 2009, 0, 0, 0, 'FKAB', 'GUP-2017-026', 'Not Specified', 'Not Specified', '46d15dbb34fe77354e1240581d14f4fd', 1, 'kckalai'),
(5, 'P64474', 'DR. AMILIA BINTI AMINUDDIN', 'no_image.jpg', 2, 'null', 'null', 'Markers of Central and Peripheral Vascular Functions Among Young Men with Coronary Artery Disease Risk Factors', 2012, 2015, 1, 1, 'PPUKM', 'GUP-2017-026', 'Not Specified', 'Not Specified', '31c11bb70fe2baf83ffcb8e9ff4c06df', 1, 'kckalai'),
(6, 'P68160', 'NORHAYATI BINTI MOHD ZAINEE ', 'no_image.jpg', 2, 'null', 'null', 'FPGA Based Synchronized Multi-Physiosignal Acquisition Prototype Design', 2012, 2018, 1, 0, 'FKAB', 'GUP-2017-026', 'Not Specified', 'Not Specified', 'ae9b73f9c3150be4f1b5e90581002077', 1, 'kckalai'),
(7, 'P68814', 'YUSMEERA BINTI YUSOF', 'no_image.jpg', 2, 'null', 'null', 'Pembangunan Bahan dan Efikasi Sistem Latihan Auditori-Kognitif dalam Kalangan Warga Tua dengan Tahap Kognitif Normal dan Masalah Neuro-Kognitif', 2013, 2019, 1, 1, 'FSK', 'GUP-2017-026', 'Not Specified', 'Not Specified', '1c85bf15a27ef53032d0686021f7db3e', 1, 'kckalai'),
(8, 'P68825', 'NURUL HUDA BINTI BANI', 'no_image.jpg', 2, 'null', 'null', 'Developing Auditory-Cognitive Training Software for Adult', 2013, 0, 1, 0, 'FSK', 'GUP-2017-026', 'Not Specified', 'Not Specified', '324c7e5faded4183952d0a28e2c1e408', 1, 'kckalai'),
(9, 'P70137', 'NORSUHANA BINTI OMAR', 'no_image.jpg', 2, 'null', 'null', 'Kesan Program Senaman Berasaskan Pedometer terhadap Parameter Kardiovaskular dan Kesan Program Senaman berasaskan Pedometer terhadap Parameter Kardiovaskular dan Indeks Kesihatan Vaskular di Kalangan Lelaki Muda dengan Faktor Risiko Kardiovaskular', 2013, 2016, 1, 1, 'PPUKM', 'GUP-2017-026', 'Not Specified', 'Not Specified', '868e00f0331872a3ca9691d89d89cece', 1, 'kckalai'),
(10, 'P75397', 'PUSPALATHAA A/P ARMUM', 'no_image.jpg', 2, 'null', 'null', 'Psychology Impact Measurement in Employability Among TVET', 2014, 0, 0, 1, 'FPend', 'GUP-2017-026', 'Not Specified', 'Not Specified', 'a1165890812af1d745a633a1f9c7d7f9', 1, 'kckalai'),
(11, 'P90267', 'MD RIZMAN BIN MD LAZIN @ MD LAZIM', 'no_image.jpg', 2, '0123456789', 'mdrizman@lazim.com', 'Pacemaker Patients Finger Photoplethysmography Fitness index (PPGF) Validation for Heart rate Variability (HRV)', 2016, 0, 0, 1, 'PPUKM', 'GUP-2017-026', 'Not Specified', 'Not Specified', '93a941b35c5fc2f8bb4aedb13d095a32', 1, 'kckalai'),
(12, 'P69982', 'ABRAR HUSSAIN', 'no_image.jpg', 1, '+6-01139931890', 'abrarhussainfahim@gmail.com', 'Algoritma Penambahbaikan Pertututuran dalam Bahasa Melayu berasaskan Sistem Latihan Auditori', 2013, 2018, 1, 0, 'FKAB', 'LRGS/BU/2012/UKM-UKM/K/02', 'Not Specified', 'Not Specified', '215ac2d2697d07fe69612661e13fc256', 1, 'kckalai'),
(13, 'P83586', 'NOR SHAHIRAH BINTI SHAIK AMIR', 'no_image.jpg', 1, '019-3958620', ' shahirahshaik25@gmail.com', 'The Identification of New CT Scan Markers to Diagnose Cerebral Amyloid Angiopathy in Primary Intracerebral Hemorrhage', 2015, 2019, 1, 0, 'FKAB', 'LRGS/BU/2012/UKM-UKM/K/02', 'Not Specified', 'Not Specified', 'af496ed284d833dc9216cd2094eea2e2', 1, 'kckalai'),
(14, 'P84057', 'MOHD SYAKIR FATHILLAH', 'no_image.jpg', 1, '013-3370775', 'syakirfathillah92@gmail.com', 'Development of Hybrid Epileptic Discharge Detection Algorithm for Electroencephalography (EEG)', 2015, 2019, 1, 1, 'FKAB', 'GUP-2017-026', 'Not Specified', 'Not Specified', '01bfb99bdd78a842f551926c0e262c2b', 1, 'kckalai'),
(15, 'P74528', 'KHAIRUL MUSLIM BIN NORDIN', 'no_image.jpg', 1, '012-9215921', 'kmuslim.nordin@mara.gov.my', 'Model Pengurusan Rehabilitasi Kendiri Cengkaman Jari bagi Pesakit Pasca Strok di Rumah', 2013, 2018, 1, 0, 'FKAB', 'LRGS/BU/2012/UKM-UKM/K/02', 'Not Specified', 'Not Specified', '1ceb9a711368141a80926de70fc59808', 1, 'kckalai'),
(16, 'P75152', 'RAIFANA ROSA BINTI MOHAMAD SATTAR', 'no_image.jpg', 1, 'null', 'null', 'Analisis Morfologi Fotopletismogram dalam Kalangan Lelaki Muda dengan Risiko Kardiovaskular, Profil Lipid: Pendekatan Intervensi', 2013, 2018, 1, 0, 'FKAB', 'LRGS/BU/2012/UKM-UKM/K/02', 'Not Specified', 'Not Specified', 'ec34ef2e4290c95180936cda7c1f2845', 1, 'kckalai'),
(17, 'P62577', 'SEMBAGAM A/P KRISHNAN', 'no_image.jpg', 1, 'null', 'null', 'Penyaringan Penyakit Arteri Koronari Secara Bukan Invasif: Pengkelasan Kepada Berisiko Tinggi Dan Rendah Dengan Fotoplestismograf Jari', 2011, 2016, 1, 1, 'FKAB', 'GUP-2017-026', 'Not Specified', 'Not Specified', 'e021cfd0bdd04c7b70a13ecc3498e6c2', 1, 'kckalai'),
(18, 'P77772', 'NURUL SYAFIQAH BINTI MOHAMAD', 'no_image.jpg', 1, 'null', 'null', 'GPS In Weather Monitoring', 2014, 0, 0, 0, 'FKAB', 'LRGS/BU/2012/UKM-UKM/K/02', 'Not Specified', 'Not Specified', '4f8a489697f9d6dea0b997275eab4abd', 1, 'kckalai'),
(19, 'UGT20001', 'SUVAASHINI A/P GOTHANDAPANI', 'no_image.jpg', 0, 'null', 'null', 'null', 2020, 0, 0, 0, 'FKAB', 'LRGS/BU/2012/UKM-UKM/K/02', 'Not Specified', 'Not Specified', 'f19f9031712473aa04b0853c511cf02a', 1, 'kckalai'),
(20, 'INT18005', 'NURUL ATIKAH BINTI MAT ZAHAD', 'no_image.jpg', 0, 'null', 'null', 'null', 2018, 0, 1, 0, 'FKAB', 'LRGS/BU/2012/UKM-UKM/K/02', 'Not Specified', 'Not Specified', '3612a8f142248879d37cfcc85443942a', 1, 'kckalai'),
(21, 'UGT17002', 'ATIF SYAMIMI BIN OTHMAN ', 'no_image.jpg', 0, 'null', 'null', 'null', 2017, 0, 1, 0, 'FKAB', 'LRGS/BU/2012/UKM-UKM/K/02', 'Not Specified', 'Not Specified', '72904579e4f24ac98d70b4dca4a6ac28', 1, 'kckalai'),
(22, 'A152973', 'NAVANES A/L MARIMUTHU', 'no_image.jpg', 0, 'null', 'null', 'Home Environment Healthcare Management. Communication & Computer Engineering Programme', 2019, 0, 1, 0, 'FKAB', 'GUP-2017-026', 'Not Specified', 'Not Specified', '437aa81f41edbb6db6629698b6479f51', 1, 'kckalai'),
(23, 'A156479', 'Nurul Adlin Syazwani binti Muzikir', 'no_image.jpg', 0, 'null', 'null', 'Non-Invasive Pre and Post Exercise Muscle Fatigue Assessment Kit.  Communication & Computer Engineering Programme', 2019, 0, 1, 0, 'FKAB', 'GUP-2017-026', 'Not Specified', 'Not Specified', 'e3ed90d97edad148261234000041c845', 1, 'kckalai'),
(24, 'A156512', 'Aina Syaza binti Ady Hervan', 'no_image.jpg', 0, '0123456789', 'ainsyaza@gmail.com', 'Single Lead Portable ECG for Cardiac Care. Electrical & Electronics Programme', 2019, 0, 1, 0, 'FKAB', 'KK-2014-011', 'Not Specified', 'Not Specified', '33b65deb39609e128c213d8a4f9018f9', 1, 'kckalai'),
(25, ' A149445', 'Siti Nurain binti Ibrahim', 'no_image.jpg', 0, 'null', 'null', 'Smart Home Environment Health Manager, Electrical & Electronics Programme', 2018, 0, 1, 0, 'FKAB', 'GUP-2017-026', 'Not Specified', 'Not Specified', 'd5de93aabbb5d42c4932aa36339326a7', 1, 'kckalai'),
(26, 'A150994', 'Nurul Azlina binti Suerman', 'no_image.jpg', 0, 'null', 'null', 'Radial Pulse rate Monitoring System  Communication & Computer Engineering Programme', 2018, 0, 1, 0, 'FKAB', 'GUP-2017-026', 'Not Specified', 'Not Specified', 'a00b133a464b99b66762ac3a37862bc9', 1, 'kckalai'),
(27, 'A150871', 'Muhammad Hazim bin Jemiran', 'no_image.jpg', 0, 'null', 'null', 'Smartphone Camera Intergration for Finger Heart Rate Detection, Communication & Computer Engineering Programme', 2018, 0, 1, 0, 'FKAB', 'GUP-2017-026', 'Not Specified', 'Not Specified', '4ea8f3d13a7966ad905a4d117c44d685', 1, 'kckalai'),
(28, 'A144319', 'Atif Syamimi bin Othman', 'no_image.jpg', 0, 'null', 'null', 'Mobile Application for Stroke Risk Calculation System, Electrical & Electronics Programme', 2018, 0, 1, 0, 'FKAB', 'GUP-2017-026', 'Not Specified', 'Not Specified', 'de092ca3c2e81691b1b83ff6ccb4f230', 1, 'kckalai'),
(29, 'A161882', 'Amira Wahida binti Osman', 'no_image.jpg', 0, 'null', 'null', 'Diabetic Monitoring Using Mobile Apps. Software Engineering program (Information System Development)', 2018, 0, 1, 0, 'FKAB', 'GUP-2017-026', 'Not Specified', 'Not Specified', 'c5a2529406028cc87debac7fdbff0222', 1, 'kckalai'),
(30, 'A144271', 'Norfazreena binti Ishak', 'no_image.jpg', 0, 'null', 'null', 'Temperature Detectors at Investigations of the Location of the Adult Body for Heat Stroke Management,  Communication & Computer Engineering Programme', 2017, 0, 1, 0, 'FKAB', 'GUP-2017-026', 'Not Specified', 'Not Specified', '0c16e8d971e984cd9405d8fcfa803a42', 1, 'kckalai'),
(31, 'A151522', 'Lee Lin', 'no_image.jpg', 0, 'null', 'null', 'Video Streaming in Ambulans for Patience Management. Computer Science Programme', 2017, 0, 1, 0, 'FTSM', 'GUP-2017-026', 'Not Specified', 'Not Specified', '6db6ebb9803d23353c18f8b3d31e445a', 1, 'kckalai'),
(32, 'A150652', 'Pang Xin Yi', 'no_image.jpg', 0, 'null', 'null', 'Tremor Monitoring using Mobile Application, Computer Science Programme', 2017, 0, 1, 0, 'FTSM', 'GUP-2017-026', 'Not Specified', 'Not Specified', '5232510a66259d33cd63633833c1151e', 1, 'kckalai'),
(33, 'A141977', 'Eu Xiu Hong', 'no_image.jpg', 0, 'null', 'null', 'Headphone SNR Measurement for Adaptive Speech in Noise Auditory Training Headset Selection, Electrical & Electronics Programme', 2016, 0, 1, 0, 'FKAB', 'GUP-2017-026', 'Not Specified', 'Not Specified', 'fc098ee7244872035938879adff6f5f4', 1, 'kckalai'),
(34, 'A142006', 'Yeoh Yun Huai', 'no_image.jpg', 0, 'null', 'null', 'Headphone Based 3-D Spatialization and Localization Simulator for Spatial Auditory Training Application,Electrical & Electronics Programme', 2016, 0, 1, 0, 'FKAB', 'GUP-2017-026', 'Not Specified', 'Not Specified', '950cd7ff924c5706e6e39b05cd3ea13e', 1, 'kckalai'),
(35, 'A136443', 'Teh Choon Ying', 'no_image.jpg', 0, 'null', 'null', 'Design of a Memory Test Based Mobile Memory Analyzer, Electrical & Electronics Programme', 2015, 0, 1, 0, 'FKAB', 'GUP-2017-026', 'Not Specified', 'Not Specified', '607000c90bf224a8045c91245da6a884', 1, 'kckalai'),
(36, 'A137920', 'Nur Adila binti Payarin', 'no_image.jpg', 0, 'null', 'null', 'Design and Development EMG Kit for Muscle Fatigue Assessment during Skipping Exercise. Electrical & Electronics Programme', 2015, 0, 1, 0, 'FKAB', 'GUP-2017-026', 'Not Specified', 'Not Specified', '29a745f6485ede8dba6e623cd80f7a97', 1, 'kckalai'),
(37, 'P91155', 'Ahmad Safaa Salman', 'no_image.jpg', 1, 'null', 'null', 'Vehicle Accident Detection and Tracking using GSM and GPS', 2019, 0, 1, 0, 'FKAB', 'GUP-2017-026', 'Not Specified', 'Not Specified', '7518e6341e2309b82956bb650d5f2e3e', 1, 'kckalai'),
(38, 'P91179', 'Saif Jamal Mahdi', 'no_image.jpg', 1, 'null', 'null', 'Brain Image Enhancement Techniques with Deep Learning Analysis', 2019, 0, 1, 0, 'FKAB', 'GUP-2017-026', 'Not Specified', 'Not Specified', 'a83eec68d8f14f2f6389b5c59ed0eb0f', 1, 'kckalai'),
(39, 'P86805', 'Ali Abdillahi Abdirahman', 'no_image.jpg', 1, 'null', 'null', 'IoT Based Urban Garden Monitoring System', 2018, 0, 1, 0, 'FKAB', 'GUP-2017-026', 'Not Specified', 'Not Specified', '34ef327250de92adbc2e4c68c3784d5b', 1, 'kckalai'),
(40, 'P86792', 'Mustafa M. W.Alhasan', 'no_image.jpg', 1, 'null', 'null', 'Objective Quality Assessment of Color Tone-Mapped Images', 2018, 0, 1, 0, 'FKAB', 'GUP-2017-026', 'Not Specified', 'Not Specified', '9eb83708ef99787004353bd31a3a3395', 1, 'kckalai'),
(41, 'P86641', 'Ahmed Adil Yousif', 'no_image.jpg', 1, 'null', 'null', 'Smart Baby Monitoring System', 2018, 0, 1, 0, 'FKAB', 'GUP-2017-026', 'Not Specified', 'Not Specified', '30ba50c43281211fef9fa08202098294', 1, 'kckalai'),
(42, 'P76719', 'Bdoor Alaa Mahmood', 'no_image.jpg', 1, 'null', 'null', 'Personal Document Security Tool for Cloud Application', 2016, 0, 1, 0, 'FKAB', 'GUP-2017-026', 'Not Specified', 'Not Specified', 'ea08f298c168d0e82cee70b61649fec2', 1, 'kckalai'),
(43, 'P76711', 'Habshah Binti Abu Bakar', 'no_image.jpg', 1, 'null', 'null', 'Video Compression Learning Tools for Combined Learning', 2015, 0, 1, 0, 'FKAB', 'GUP-2017-026', 'Not Specified', 'Not Specified', '9666547a429b2bd2d708f9a3cd8de616', 1, 'kckalai'),
(44, 'P76732', 'Nurul Illiani Yaacob', 'no_image.jpg', 1, 'null', 'null', 'Image Compression And Decompression Assistive Learning Aid For Slow Learner', 2015, 0, 1, 0, 'FKAB', 'GUP-2017-026', 'Not Specified', 'Not Specified', '9d82331253d2d4f8d6d713556e4b8f0f', 1, 'kckalai');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teaching`
--

CREATE TABLE `tbl_teaching` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(255) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `course_code` varchar(255) DEFAULT NULL,
  `course_title` text DEFAULT NULL,
  `graduate_code` int(11) DEFAULT NULL,
  `super_owner` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_teaching`
--

INSERT INTO `tbl_teaching` (`id`, `academic_year`, `semester`, `course_code`, `course_title`, `graduate_code`, `super_owner`) VALUES
(1, '2016/2017', 1, 'KT6154', 'Cryptography and Network Security', 1, 'kckalai'),
(2, '2016/2017', 2, 'KL2163', 'Digital Electronics', 0, 'kckalai'),
(3, '2016/2017', 2, 'KT6154', 'Cryptography and Network Security', 1, 'kckalai'),
(4, '2018/2019', 2, 'KKKL2121', 'Digital Electronics Laboratory', 0, 'kckalai'),
(5, '2018/2019', 2, 'KKKL2163', 'Digital Electronics', 0, 'kckalai'),
(6, '2018/2019', 2, 'KKKT4173', 'Network Security', 1, 'kckalai'),
(7, '2018/2019', 2, 'KKKT6183', 'Cryptography & Computer Networks', 1, 'kckalai'),
(8, '2018/2019', 2, 'KKKT6253', 'Software Engineering', 1, 'kckalai'),
(9, '2018/2019', 1, 'KKKZ4013', 'Bioisyarat dan Sistem ', 0, 'kckalai'),
(10, '2018/2019', 1, 'KKKT6013', 'Multimedia Communication', 1, 'kckalai'),
(11, '2017/2018', 2, 'KKKL2163', 'Digital Electronics', 0, 'kckalai'),
(12, '2017/2018', 2, 'KKKT6183', 'Cryptography & Computer Networks', 1, 'kckalai'),
(13, '2017/2018', 2, 'KKKL2121', 'Digital Electronics Laboratory', 0, 'kckalai'),
(14, '2017/2018', 1, 'KKKT6013', 'Multimedia Communication', 1, 'kckalai'),
(15, '2017/2018', 1, 'KKKZ4014', 'Biosignal & System', 0, 'kckalai'),
(16, '2016/2017', 2, 'KKKL2163', 'Digital Electronics', 0, 'kckalai'),
(17, '2016/2017', 2, 'KKKT6183', 'Cryptography & Computer Networks', 1, 'kckalai'),
(18, '2016/2017', 1, 'KKKT6154', 'Cryptography & Computer Networks', 1, 'kckalai'),
(19, '2016/2017', 1, 'KKKZ4013', 'Biosignal & System', 0, 'kckalai'),
(20, '2015/2016', 2, 'KKKL2163', 'Digital Electronics', 0, 'kckalai'),
(21, '2015/2016', 2, 'KKKT6154', 'Cryptography & Computer Networks', 1, 'kckalai'),
(22, '2015/2016', 1, 'KKKT6154', 'Cryptography & Computer Networks', 1, 'kckalai'),
(23, '2015/2016', 1, 'KKKZ4014', 'Biosignal & System', 0, 'kckalai'),
(24, '2014/2015', 1, 'KKKL2164', 'Digital Electronics', 0, 'kckalai'),
(25, '2014/2015', 2, 'KKKT6154', 'Cryptography & Computer Networks', 1, 'kckalai'),
(26, '2014/2015', 2, 'KKKT6234', 'Multimedia Communication', 1, 'kckalai'),
(27, '2014/2015', 2, 'KKKT6254', 'Software Engineering', 1, 'kckalai'),
(28, '2014/2015', 1, 'HHHC9501', 'Critical Thinking, Problem Solving and Scientific Approach', 0, 'kckalai'),
(29, '2014/2015', 1, 'KKKT4074 ', 'Telecommunication Network', 1, 'kckalai'),
(30, '2014/2015', 1, 'KKKT6154', 'Cryptography & Computer Networks', 1, 'kckalai'),
(31, '2013/2014', 2, 'KKKT6234', 'Multimedia Communication', 1, 'kckalai'),
(32, '2013/2014', 2, 'KKKT6254', 'Software Engineering', 1, 'kckalai'),
(33, '2013/2014', 1, 'KKKT6154', 'Cryptography & Computer Networks', 1, 'kckalai'),
(34, '2012/2013', 2, 'KKKT4224', 'Software Engineering', 1, 'kckalai'),
(35, '2012/2013', 2, 'KKKT6154', 'Cryptography & Computer Networks', 1, 'kckalai'),
(36, '2012/2013', 2, 'KKKT6234 ', 'Multimedia Communication', 1, 'kckalai'),
(37, '2009 ( UNITAR)', 1, 'n/a', 'Research Methodology', 2, 'kckalai'),
(38, '2004 - 2011 ( UNITAR )', 2, 'n/a', 'Artificial Intelligence', 0, 'kckalai'),
(39, '2002 - 2004 ( TAYLORâ€™S COLLEGE )', 2, 'n/a', 'Computer Network & Security', 1, 'kckalai'),
(40, '2004 - 2011 ( UNITAR )', 1, 'n/a', 'Software Engineering', 1, 'kckalai'),
(41, '2004 - 2011 ( UNITAR )', 2, 'n/a', 'Computer Networks (WSN)', 1, 'kckalai'),
(42, '2004 - 2011 ( UNITAR )', 1, 'n/a', 'System Analysis & Design', 0, 'kckalai'),
(43, '2004 - 2011 ( UNITAR )', 1, 'n/a', 'System Analysis & Design', 0, 'kckalai'),
(44, '2004 - 2011 ( UNITAR )', 1, 'n/a', 'Algorithm & Data Structure', 0, 'kckalai'),
(45, '2004 - 2011 ( UNITAR )', 2, 'n/a', 'System Integration', 0, 'kckalai'),
(46, '2002 - 2004 ( TAYLORâ€™S COLLEGE )', 2, 'n/a', 'Digital Signal Processing', 0, 'kckalai'),
(47, '2002 - 2004 ( TAYLORâ€™S COLLEGE )', 1, 'n/a', 'C Programming ', 0, 'kckalai'),
(48, '2002 - 2004 ( TAYLORâ€™S COLLEGE )', 2, 'n/a', 'Computer Organization & Architecture', 0, 'kckalai'),
(49, '2002 - 2004 ( TAYLORâ€™S COLLEGE )', 2, 'n/a', 'Software Reengineering', 0, 'kckalai'),
(50, '2002 - 2004 ( TAYLORâ€™S COLLEGE )', 2, 'n/a', 'Database Management', 0, 'kckalai'),
(51, '1997-2001 (STAMFORD)', 1, 'n/a', 'Digital Logic Design ', 0, 'kckalai'),
(52, '1997-2001 (STAMFORD)', 2, 'n/a', 'Circuit Theory', 0, 'kckalai'),
(53, '1997-2001 (STAMFORD)', 1, 'n/a', 'Electronics Devices', 0, 'kckalai'),
(54, '1997-2001 (STAMFORD)', 1, 'n/a', 'Data Communication & Networks', 0, 'kckalai'),
(55, '1997-2001 (STAMFORD)', 2, 'n/a', 'Analysis of Algorithms', 0, 'kckalai');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_thesis`
--

CREATE TABLE `tbl_thesis` (
  `id` int(11) NOT NULL,
  `thesis_title` varchar(255) DEFAULT NULL,
  `thesis_stdname` varchar(255) DEFAULT NULL,
  `thesis_year` int(11) DEFAULT NULL,
  `thesis_file` varchar(255) DEFAULT NULL,
  `thesis_owner` varchar(255) DEFAULT NULL,
  `super_owner` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userlogin`
--

CREATE TABLE `tbl_userlogin` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `tel_no` varchar(11) DEFAULT NULL,
  `ic_num` varchar(255) DEFAULT NULL,
  `institution` varchar(255) DEFAULT NULL,
  `faculty` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_userlogin`
--

INSERT INTO `tbl_userlogin` (`id`, `user_id`, `name`, `email`, `tel_no`, `ic_num`, `institution`, `faculty`, `department`, `duration`, `start_date`, `end_date`, `password`, `role`, `status`, `picture`) VALUES
(1, 'A9999999', 'Test Person', 'test@email.com', '0123456789', '0123456789', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$PK7BwPOX6YVauJysUZXIY.Dxiq4ddN585ort3lSDTGYSvARmcrxYS', NULL, 'Not Active', NULL),
(2, 'A9999998', 'TEST PERSON 2', 'test2@gmail.com', '0125345345', '1234567890', 'UKM BANGI', 'FTSM', 'CAIT', '11 months', '2017-12-31', '2019-01-01', '$2y$10$iwakTicvbk4JE35kadKrAudvazDGx9BzrymdxfUoJHWIR3ctq9YHS', 'Parttime Worker', 'Active', 'hugh-laurie-portrait.jpg'),
(3, 'A159397', 'MUHAMAD AMIRULLAH BIN ABDUL SAMAT', 'kckalai.ra005.it@gmail.com', '+6013990911', '941214085543', 'UKM', 'FTSM', 'IT', '2 months', '2017-07-03', '2017-09-03', '$2y$10$MnyH.akKhlus2ssTQMemDOtb6LIKolSUj8C7xF1hCSvwjCMMCK6f6', 'Parttime Worker', 'Active', 'pakupakis_1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_value`
--

CREATE TABLE `tbl_value` (
  `id` int(11) NOT NULL,
  `value_title` varchar(255) DEFAULT NULL,
  `value_content` text DEFAULT NULL,
  `value_file` varchar(255) DEFAULT NULL,
  `value_date` datetime DEFAULT NULL,
  `super_owner` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_value`
--

INSERT INTO `tbl_value` (`id`, `value_title`, `value_content`, `value_file`, `value_date`, `super_owner`) VALUES
(1, 'Epistemic Value ', 'Epistemic value is a kind of value which attaches to cognitive successes such as true beliefs, justified beliefs, knowledge, and understanding. These kinds of cognitive success do of course often have practical value. True beliefs about local geography help us get to work on time; knowledge of mechanics allows us to build vehicles; understanding of general annual weather patterns helps us to plant our fields at the right time of year to ensure a good harvest. ', NULL, '2017-09-18 13:19:18', 'kckalai'),
(2, 'Virtue', 'Virtue explains behavior showing high moral value ', 'Virtue.jpg', '2017-09-18 14:41:44', 'kckalai');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_abstract`
--
ALTER TABLE `tbl_abstract`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_academic_qualification`
--
ALTER TABLE `tbl_academic_qualification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_activity`
--
ALTER TABLE `tbl_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_adminlogin`
--
ALTER TABLE `tbl_adminlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin_appointment`
--
ALTER TABLE `tbl_admin_appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_bookchapters`
--
ALTER TABLE `tbl_bookchapters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_books`
--
ALTER TABLE `tbl_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cards`
--
ALTER TABLE `tbl_cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_career_history`
--
ALTER TABLE `tbl_career_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_checkin`
--
ALTER TABLE `tbl_checkin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_checkout`
--
ALTER TABLE `tbl_checkout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_community`
--
ALTER TABLE `tbl_community`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_community_category`
--
ALTER TABLE `tbl_community_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_countries`
--
ALTER TABLE `tbl_countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_grant`
--
ALTER TABLE `tbl_grant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_interest`
--
ALTER TABLE `tbl_interest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_journals`
--
ALTER TABLE `tbl_journals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_knowledge`
--
ALTER TABLE `tbl_knowledge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_popular_article`
--
ALTER TABLE `tbl_popular_article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_proceedings`
--
ALTER TABLE `tbl_proceedings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pro_member`
--
ALTER TABLE `tbl_pro_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_research_facilities`
--
ALTER TABLE `tbl_research_facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_research_ip`
--
ALTER TABLE `tbl_research_ip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_research_outcome`
--
ALTER TABLE `tbl_research_outcome`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_scholarly_activities`
--
ALTER TABLE `tbl_scholarly_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_scholarly_types`
--
ALTER TABLE `tbl_scholarly_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_students`
--
ALTER TABLE `tbl_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_teaching`
--
ALTER TABLE `tbl_teaching`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_thesis`
--
ALTER TABLE `tbl_thesis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_userlogin`
--
ALTER TABLE `tbl_userlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_value`
--
ALTER TABLE `tbl_value`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_abstract`
--
ALTER TABLE `tbl_abstract`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_academic_qualification`
--
ALTER TABLE `tbl_academic_qualification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_activity`
--
ALTER TABLE `tbl_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_adminlogin`
--
ALTER TABLE `tbl_adminlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_admin_appointment`
--
ALTER TABLE `tbl_admin_appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_bookchapters`
--
ALTER TABLE `tbl_bookchapters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_books`
--
ALTER TABLE `tbl_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_cards`
--
ALTER TABLE `tbl_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_career_history`
--
ALTER TABLE `tbl_career_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_checkin`
--
ALTER TABLE `tbl_checkin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_checkout`
--
ALTER TABLE `tbl_checkout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_community`
--
ALTER TABLE `tbl_community`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_community_category`
--
ALTER TABLE `tbl_community_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_countries`
--
ALTER TABLE `tbl_countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `tbl_grant`
--
ALTER TABLE `tbl_grant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `tbl_interest`
--
ALTER TABLE `tbl_interest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_journals`
--
ALTER TABLE `tbl_journals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `tbl_knowledge`
--
ALTER TABLE `tbl_knowledge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_popular_article`
--
ALTER TABLE `tbl_popular_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_proceedings`
--
ALTER TABLE `tbl_proceedings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `tbl_pro_member`
--
ALTER TABLE `tbl_pro_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_research_ip`
--
ALTER TABLE `tbl_research_ip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_research_outcome`
--
ALTER TABLE `tbl_research_outcome`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_scholarly_activities`
--
ALTER TABLE `tbl_scholarly_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_scholarly_types`
--
ALTER TABLE `tbl_scholarly_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_students`
--
ALTER TABLE `tbl_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_teaching`
--
ALTER TABLE `tbl_teaching`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tbl_thesis`
--
ALTER TABLE `tbl_thesis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_userlogin`
--
ALTER TABLE `tbl_userlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_value`
--
ALTER TABLE `tbl_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
