-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2024 at 03:21 AM
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
-- Database: `chronic_disease_indicator`
--

-- --------------------------------------------------------

--
-- Table structure for table `disease`
--

CREATE TABLE `disease` (
  `DisID` int(2) DEFAULT NULL,
  `Dname` varchar(24) DEFAULT NULL,
  `Dsymptoms` varchar(105) DEFAULT NULL,
  `Dfatrate` decimal(4,3) DEFAULT NULL,
  `Daffperyear` varchar(12) DEFAULT NULL,
  `Dtreatment` varchar(76) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `disease`
--

INSERT INTO `disease` (`DisID`, `Dname`, `Dsymptoms`, `Dfatrate`, `Daffperyear`, `Dtreatment`) VALUES
(1, 'Hypertension', 'High blood pressure, Headaches, Dizziness, Chest pains', 0.030, '1 Million', 'Diet, Exercise, Stree management, Medication, Monitor blood pressure'),
(2, 'Diabetes', 'High blood pressure, High blood sugar, Increased thirst, Frequent urination, Fatique', 0.025, '500 Thousand', 'Diet, Exercise, Blood surgar monitoring, Medication, Regular check-ups'),
(3, 'Asthma', 'Wheezing, Coughing, Respiratory infection,  Shortness of breath, Chest tightness', 0.010, '3 Million', 'Avoid triggers, inhaler, Medicine'),
(4, 'Arthritis', ' Joint pain, Joint stiffness, Reduced range of motion,  Joint inflimmation', 0.005, '2 Million', 'Medicine, Physical Therapy, Exercise'),
(5, 'Depression', ' Sadness, Hopelessness,  Loss of intrest,  Low mood', 0.020, '10 Million', 'Therapy, Medicine, Exercise, Support systems'),
(6, 'Obesity', 'Excessive body weight, High blood pressure, High blood sugar,  Shortness of breath', 0.025, '5 Million', 'Diet, Exercise, Therapy, Medicine'),
(7, 'Apnea', ' Excessive daytime sleepiness, Loud snoring', 0.015, '2 Million', 'Diet, Exercise, CPAP, Surgery'),
(8, 'Fibromyalgia', ' Widespread musculoskeletal pain, Fatigue,Tenderness, Headaches, Difficulty concetrating, Memory Problems', 0.005, '1.5 Million', ' Medicine, Physical Therapy, Stress management, Cognitive-behavioral Therapy'),
(9, 'Migraine', ' Severe Headaches, Nausea, Vomiting, Sensitive to sound, Sensitive to light', 0.002, '6 Million', 'Medicine, Advoiding triggers'),
(10, 'Irritable Bowel Syndrome', 'Abdominal pain, Bloating, Irregular bowel habits, Abdominal discomfort', 0.001, '4 Million', 'Diet Change, Medicine, Stree management, Probiotics');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `SpecID` int(2) DEFAULT NULL,
  `DisID` int(2) DEFAULT NULL,
  `Fname` varchar(11) DEFAULT NULL,
  `Lname` varchar(9) DEFAULT NULL,
  `Specialty` varchar(24) DEFAULT NULL,
  `Dlocation` varchar(17) DEFAULT NULL,
  `Dage` int(2) DEFAULT NULL,
  `YearsActive` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`SpecID`, `DisID`, `Fname`, `Lname`, `Specialty`, `Dlocation`, `Dage`, `YearsActive`) VALUES
(1, 2, 'Daivd', 'Johnson', 'Diabetes', 'Garland, Plano', 45, 20),
(2, 9, 'Sarah', 'Lee', 'Migraine', 'Rockwall', 40, 15),
(3, 6, 'Micheal', 'Nguyen', 'Obesity', 'Rockwall, Plano', 50, 25),
(4, 3, 'Emily', 'Patel', 'Asthma', 'Plano, Garland', 42, 18),
(5, 1, 'Christopher', 'Kim', 'Hypertension', 'Garland', 48, 22),
(6, 8, 'Jessica', 'Gupta', 'Fibromyalgia', 'Plano, Rockwall', 38, 12),
(7, 6, 'Daniel', 'Chang', 'Obesity', 'Rockwall, Garland', 55, 30),
(8, 4, 'Ashely', 'Patel', 'Arthritis', 'Garland', 42, 17),
(9, 5, 'Joshua', 'Rodriguez', 'Depression', 'Plano, Garland', 47, 21),
(10, 7, 'Samantha', 'Wong', 'Apnea', 'Plano', 41, 16),
(11, 3, 'Ryan', 'Martinez', 'Asthma', 'Garland', 52, 27),
(12, 10, 'Lauren', 'Singh', 'Irritable Bowel Syndrome', 'Plano, Rockwall', 39, 14),
(13, 1, 'Andrew', 'Kim', 'Hypertension', 'Garland', 44, 19),
(14, 8, 'Rachel', 'Nguyen', 'Fibromyalgia', 'Rockwall', 46, 24),
(15, 5, 'Brian', 'Lee', 'Depression', 'Plano', 49, 23),
(16, 4, 'Megan', 'Kumar', 'Arthritis', 'Garland', 37, 11),
(17, 9, 'Kyle', 'Patel', 'Migraine', 'Rockwall, Plano', 54, 29),
(18, 2, 'Lauren', 'Wong', 'Diabetes', 'Garland, Plano', 42, 16),
(19, 7, 'Jordan', 'Kim', 'Apnea', 'Rockwall, Garland', 48, 22),
(20, 1, 'Mathew', 'Garcia', 'Hypertension', 'Plano, Rockwall', 40, 14);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `DisID` varchar(7) DEFAULT NULL,
  `Fname` varchar(11) DEFAULT NULL,
  `Lname` varchar(9) DEFAULT NULL,
  `Usex` varchar(1) DEFAULT NULL,
  `Username` varchar(12) DEFAULT NULL,
  `Password` int(3) DEFAULT NULL,
  `PhoneNum` varchar(13) DEFAULT NULL,
  `Uage` int(2) DEFAULT NULL,
  `Uheight` decimal(5,2) DEFAULT NULL,
  `Uweight` int(3) DEFAULT NULL,
  `Ulocation` varchar(8) DEFAULT NULL,
  `Usymptom` varchar(143) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`DisID`, `Fname`, `Lname`, `Usex`, `Username`, `Password`, `PhoneNum`, `Uage`, `Uheight`, `Uweight`, `Ulocation`, `Usymptom`) VALUES
('9,6', 'Snert', 'Mcgurt', 'M', 'smcgurt01', 123, '507-223-4582', 27, 170.18, 152, 'Rockwall', 'Severe headache, High blood pressure'),
('2, 4', 'John', 'Smith', 'M', 'jsmith01', 123, '123-456-7890', 34, 177.80, 189, 'Plano', 'High blood pressure, High blood surgar, Joint pain and stiffness'),
('3, 5', 'Emily', 'Johnson', 'F', 'ejohnson01', 123, '234-567-8901', 39, 176.64, 156, 'Plano', 'Shortness of breath, Severe headache, Low mood,  Sadness, Hopelessness'),
('1, 6, 7', 'Micheal', 'Williams', 'M', 'mwilliams01', 123, '234-678-9012', 45, 182.88, 203, 'Rockwall', 'High Blood pressure, Dizziness, Chest pains, Obesity, Excessive daytime sleepiness, Loud snoring'),
('8, 10', 'Sarah', 'Brown', 'F', 'sbrown01', 123, '456-789-0123', 42, 165.10, 165, 'Rockwall', 'Widespread musculoskeletal pain, Fatigue, Sleep disturbances, Abdominal discomfort, Irregular bowel habits, Anxiety'),
('2, 5', 'David', 'Jones', 'M', 'djones01', 123, '345-923-2994', 28, 175.26, 172, 'Garland', 'High blood sugar, Persistent low mood, Low mood,  Sadness, Hopelessness, Chronic pain in back, Chronic pain in joints, Chronic pain in muscles'),
('3, 4', 'Amanda', 'Davis', 'F', 'adavis01', 123, '452-343-4823', 25, 162.56, 143, 'Plano', 'Wheezing, Coughing, Chest tightness, Shortness of breath, Allergic rhinitis, Itchy skin, Inflamed skin'),
('4, 6', 'James', 'Miller', 'M', 'jmiller01', 123, '682-992-0021', 54, 180.34, 191, 'Rockwall', 'Joint pain, Joint stiffness, Swelling, Tenderness, Reduced range of motion, High blood pressure, Excess body weight'),
('5, 9', 'Jennifer', 'Wilson', 'F', 'jwilson01', 123, '214-563-7823', 36, 170.18, 155, 'Garland', 'Severe headaches, Sensitive to light, Sensitive to sound, Low mood,  Sadness, Hopelessness, Loss of interest, Anxiety'),
('2, 7', 'Robert', 'Taylor', 'M', 'rtoylor01', 123, '901-429-5521', 44, 187.96, 213, 'Garland', 'High blood pressure, High blood surgar, Excessive daytime sleepiness, Loud snoring'),
('5, 8', 'Jessica', 'Anderson', 'F', 'janderson01', 123, '932-553-2195', 31, 172.72, 154, 'Plano', 'Widespread musculoskeletal pain, Fatigue, Chronic fatigue, Difficulty concentrating, Memory problems, Low mood,  Sadness, Hopelessness, Anxiety'),
('2, 4', 'Christopher', 'Martinez', 'M', 'cMartinez01', 123, '592-235-9322', 41, 180.34, 186, 'Rockwall', 'High blood pressure, High blood sugar, Chronic pain in back, Chronic pain in joints, Chronic pain in muscles'),
('3, 4, 5', 'Laura', 'Garcia', 'F', 'lgarcia01', 123, '312-592-3445', 48, 162.56, 149, 'Plano', 'Wheezing, Coughing, Chest tightness, Shortness of breath, Joint pain, Joint stiffness, Swelling, Tenderness, Low mood,  Sadness, Hopelessness'),
('6', 'Kevin', 'Rodriguez', 'M', 'krodriguez01', 123, '332-942-1124', 34, 152.40, 194, 'Garland', 'High blood sugar, Excessive body weight, Anxiety'),
('8', 'Stephanie', 'Hernandez', 'F', 'shernandez01', 123, '482-553-9245', 39, 165.10, 154, 'Garland', 'Widespread musculskeletal pain, Severe headaches, Fatigue, Sleep disturbances, Anxiety'),
('5, 7', 'Daniel', 'Lopez', 'M', 'dlopez01', 123, '452-345-6643', 45, 177.80, 212, 'Plano', 'High blood pressure, Low mood, Loss of intrest, Excessive daytime sleepiness, Loud snoring'),
('3', 'Rachel', 'Perez', 'F', 'rperez01', 123, '384-594-2236', 28, 160.02, 148, 'Rockwall', 'Wheezing, Coughing, Chest tightness, Shortness of breath, Allergic rhinitis, Itchy skin, Inflamed skin, Anxiety'),
('4, 8', 'Justin', 'Ramirez', 'M', 'jramirez01', 123, '972-410-8220', 44, 190.50, 198, 'Rockwall', 'Joint pain, Joint stiffness, Reduced range og motion, High blood sugar, Chronic pain in back, Chronic pain in joints, Chronic pain in muscles'),
('5, 9', 'Ashley', 'Torres', 'F', 'atorres01', 123, '812-592-5911', 35, 170.18, 156, 'Plano', 'Severe headaches, Sensitive to light, Sensitive to sound, Nausea, Vomiting, Low mood,  Sadness, Hopelessness, Anxiety'),
('2, 7', 'Matthew', 'Flores', 'M', 'mflores01', 123, '214-345-2216', 39, 187.96, 210, 'Garland', 'High blood pressure, Excessive body weight, Excessive daytime sleepiness, Loud snoring'),
('8', 'Megan', 'Scott', 'F', 'mscott01', 123, '481-0031-3481', 33, 172.72, 157, 'Plano', 'Widespread musuloskeletal pain, Chronic fatigue, Difficulty concentrating, Memory problems, Anxiety'),
(NULL, 'Koi', 'Sloi', NULL, 'ksloi01', 123, NULL, NULL, NULL, NULL, NULL, NULL),
('1,2,3,4', 'Rosie', 'Dawg', 'F', 'rdawg01', 123, '', 10000, 999.99, 3000, 'Rockwall', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
