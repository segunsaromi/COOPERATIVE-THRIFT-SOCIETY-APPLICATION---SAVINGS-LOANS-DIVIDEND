-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2019 at 06:10 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cooperative`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_tbl`
--

CREATE TABLE `bank_tbl` (
  `SN` int(255) NOT NULL,
  `cust_id` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `acc_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_tbl`
--

INSERT INTO `bank_tbl` (`SN`, `cust_id`, `bank_name`, `acc_no`) VALUES
(1, 'YCT/ACA/COP/15105', 'ZENITH BANK', '0099776655'),
(2, 'YCT/ACA/COP/08015', 'GTBANK', '7766554433');

-- --------------------------------------------------------

--
-- Table structure for table `coop_admin`
--

CREATE TABLE `coop_admin` (
  `SN` int(255) NOT NULL,
  `cust_id` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coop_admin`
--

INSERT INTO `coop_admin` (`SN`, `cust_id`, `level`) VALUES
(2, 'YCT/ACA/COP/08015', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `customer_tbl`
--

CREATE TABLE `customer_tbl` (
  `SN` int(100) NOT NULL,
  `cust_id` varchar(255) NOT NULL,
  `cust_fname` varchar(255) NOT NULL,
  `cust_oname` varchar(255) NOT NULL,
  `cust_lname` varchar(255) NOT NULL,
  `cust_maritalstatus` varchar(255) NOT NULL,
  `cust_gender` varchar(255) NOT NULL,
  `cust_email` varchar(255) NOT NULL,
  `cust_phno` varchar(255) NOT NULL,
  `cust_date` varchar(255) NOT NULL,
  `cust_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_tbl`
--

INSERT INTO `customer_tbl` (`SN`, `cust_id`, `cust_fname`, `cust_oname`, `cust_lname`, `cust_maritalstatus`, `cust_gender`, `cust_email`, `cust_phno`, `cust_date`, `cust_status`) VALUES
(14, 'YCT/ACA/COP/15105', 'OLUWASEGUN', 'ABDUL', 'SAROMI', 'Married', 'Male', 'segun_saromi@yahoo.com', '07058342971', '2019-01-17', ''),
(15, 'YCT/ACA/COP/08015', 'ADEOYE', 'OLUFEMI', 'LAWAL', 'Married', 'Male', 'lawaly@yahoo.com', '08022399063', '2019-01-18', '');

-- --------------------------------------------------------

--
-- Table structure for table `dividend_tbl`
--

CREATE TABLE `dividend_tbl` (
  `SN` int(255) NOT NULL,
  `div_id` varchar(255) NOT NULL,
  `div_class` varchar(255) NOT NULL,
  `cust_id` varchar(255) NOT NULL,
  `dividend` varchar(255) NOT NULL,
  `last_calc` varchar(255) NOT NULL,
  `div_date` varchar(255) NOT NULL,
  `activate` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expenditure_tbl`
--

CREATE TABLE `expenditure_tbl` (
  `SN` int(255) NOT NULL,
  `exp_id` varchar(255) NOT NULL,
  `exp_des` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `exp_date` varchar(255) NOT NULL,
  `div_idloan` varchar(255) NOT NULL,
  `div_idsave` varchar(255) NOT NULL,
  `dividendloans` int(255) NOT NULL,
  `dividendsavings` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `guarantor`
--

CREATE TABLE `guarantor` (
  `SN` int(255) NOT NULL,
  `gname` varchar(255) NOT NULL,
  `approve` int(255) NOT NULL,
  `decline` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `income_tbl`
--

CREATE TABLE `income_tbl` (
  `SN` int(255) NOT NULL,
  `inc_id` varchar(255) NOT NULL,
  `inc_des` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `inc_date` varchar(255) NOT NULL,
  `div_idloan` varchar(255) NOT NULL,
  `div_idsave` varchar(255) NOT NULL,
  `dividendloans` int(255) NOT NULL,
  `dividendsavings` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loanpayment_tbl`
--

CREATE TABLE `loanpayment_tbl` (
  `SN` int(255) NOT NULL,
  `cust_id` varchar(255) NOT NULL,
  `loan_id` varchar(255) NOT NULL,
  `period` varchar(255) NOT NULL,
  `principal` varchar(255) NOT NULL,
  `interest` varchar(255) NOT NULL,
  `savings` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `status` int(16) NOT NULL,
  `dividend` int(255) NOT NULL,
  `div_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loanrequest_tbl`
--

CREATE TABLE `loanrequest_tbl` (
  `SN` int(255) NOT NULL,
  `cust_id` varchar(255) NOT NULL,
  `loan_id` varchar(255) NOT NULL,
  `loan_amount` varchar(255) NOT NULL,
  `loan_duration` varchar(255) NOT NULL,
  `loan_guarantor1` varchar(255) NOT NULL,
  `loan_guarantor2` varchar(255) NOT NULL,
  `loan_guarantor3` varchar(255) NOT NULL,
  `lg1_status` int(255) NOT NULL DEFAULT '0',
  `lg2_status` int(255) NOT NULL DEFAULT '0',
  `lg3_status` varchar(255) NOT NULL DEFAULT '0',
  `loan_status` int(255) NOT NULL,
  `loan_date` varchar(255) NOT NULL,
  `report` int(255) NOT NULL,
  `msg` int(255) NOT NULL,
  `print_date` date NOT NULL,
  `loan_complete` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loan_tbl`
--

CREATE TABLE `loan_tbl` (
  `SN` int(255) NOT NULL,
  `cust_id` varchar(255) NOT NULL,
  `loan_id` varchar(255) NOT NULL,
  `loan_payment` varchar(255) NOT NULL,
  `payment_date` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `loan_count` int(255) NOT NULL,
  `loan_countnext` int(255) NOT NULL,
  `dividend` int(255) NOT NULL,
  `div_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_tbl`
--

CREATE TABLE `payment_tbl` (
  `SN` int(255) NOT NULL,
  `cust_id` varchar(255) NOT NULL,
  `Status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_tbl`
--

INSERT INTO `payment_tbl` (`SN`, `cust_id`, `Status`) VALUES
(18, 'YCT/ACA/COP/15105', 1),
(19, 'YCT/ACA/COP/08015', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personalinfo_tbl`
--

CREATE TABLE `personalinfo_tbl` (
  `SN` int(255) NOT NULL,
  `cust_id` varchar(255) NOT NULL,
  `cust_fname` varchar(255) NOT NULL,
  `cust_oname` varchar(255) NOT NULL,
  `cust_lname` varchar(255) NOT NULL,
  `cust_maritalstatus` varchar(255) NOT NULL,
  `cust_gender` varchar(255) NOT NULL,
  `cust_email` varchar(255) NOT NULL,
  `cust_phno` varchar(255) NOT NULL,
  `cust_date` varchar(255) NOT NULL,
  `cust_staffstatus` varchar(255) NOT NULL,
  `cust_healthstatus` varchar(255) NOT NULL,
  `cust_nok` varchar(255) NOT NULL,
  `cust_noknum` varchar(255) NOT NULL,
  `cust_nokrelationship` varchar(255) NOT NULL,
  `cust_staffid` varchar(255) NOT NULL,
  `cust_school` varchar(255) NOT NULL,
  `cust_department` varchar(255) NOT NULL,
  `Passport` varchar(255) NOT NULL,
  `cust_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personalinfo_tbl`
--

INSERT INTO `personalinfo_tbl` (`SN`, `cust_id`, `cust_fname`, `cust_oname`, `cust_lname`, `cust_maritalstatus`, `cust_gender`, `cust_email`, `cust_phno`, `cust_date`, `cust_staffstatus`, `cust_healthstatus`, `cust_nok`, `cust_noknum`, `cust_nokrelationship`, `cust_staffid`, `cust_school`, `cust_department`, `Passport`, `cust_status`) VALUES
(13, 'YCT/ACA/COP/15105', 'OLUWASEGUN', 'ABDUL', 'SAROMI', 'Married', 'Male', 'segun_saromi@yahoo.com', '07058342971', '2019-01-17', 'Non Teaching', 'Non Medical Needs', 'MRS SAROMI', '08022399063', 'Spouse', 'AD/R/S.2759', 'Technology', 'COMPUTER SCIENCE', 'uploads/163621passport.jpg', '1'),
(14, 'YCT/ACA/COP/08015', 'ADEOYE', 'OLUFEMI', 'LAWAL', 'Married', 'Male', 'lawaly@yahoo.com', '08022399063', '2019-01-18', 'Non Teaching', 'Non Medical Needs', 'MRS LAWAL', '08022399063', 'Spouse', '3456', 'Technology', 'COMPUTER SCIENCE', 'uploads/666372p2.jpg', '1');

-- --------------------------------------------------------

--
-- Table structure for table `savingamount_tbl`
--

CREATE TABLE `savingamount_tbl` (
  `SN` int(255) NOT NULL,
  `cust_id` varchar(255) NOT NULL,
  `savings_id` varchar(255) NOT NULL,
  `cust_savings` varchar(255) NOT NULL,
  `savings_date` varchar(255) NOT NULL,
  `savings_status` varchar(255) NOT NULL,
  `report` int(255) NOT NULL,
  `msg` int(255) NOT NULL,
  `deduction_month` varchar(255) NOT NULL,
  `print_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `savingamount_tbl`
--

INSERT INTO `savingamount_tbl` (`SN`, `cust_id`, `savings_id`, `cust_savings`, `savings_date`, `savings_status`, `report`, `msg`, `deduction_month`, `print_date`) VALUES
(3, 'YCT/ACA/COP/15105', 'SID98984', '3000', '2019-01-21', '0', 0, 0, '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `savings_tbl`
--

CREATE TABLE `savings_tbl` (
  `SN` int(255) NOT NULL,
  `cust_id` varchar(255) NOT NULL,
  `savings_id` varchar(255) NOT NULL,
  `cust_savings` varchar(255) NOT NULL,
  `savings_date` varchar(255) NOT NULL,
  `savings_status` varchar(255) NOT NULL,
  `dividend` int(255) NOT NULL,
  `div_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `userEmail` varchar(60) NOT NULL,
  `userPass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `userEmail`, `userPass`) VALUES
(20, 'YCT/ACA/COP/15105', '07058342971', '5c80565db6f29da0b01aa12522c37b32f121cbe47a861ef7f006cb22922dffa1'),
(21, 'YCT/ACA/COP/08015', '08022399063', '5c80565db6f29da0b01aa12522c37b32f121cbe47a861ef7f006cb22922dffa1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_tbl`
--
ALTER TABLE `bank_tbl`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `coop_admin`
--
ALTER TABLE `coop_admin`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `customer_tbl`
--
ALTER TABLE `customer_tbl`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `dividend_tbl`
--
ALTER TABLE `dividend_tbl`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `expenditure_tbl`
--
ALTER TABLE `expenditure_tbl`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `guarantor`
--
ALTER TABLE `guarantor`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `income_tbl`
--
ALTER TABLE `income_tbl`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `loanpayment_tbl`
--
ALTER TABLE `loanpayment_tbl`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `loanrequest_tbl`
--
ALTER TABLE `loanrequest_tbl`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `loan_tbl`
--
ALTER TABLE `loan_tbl`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `payment_tbl`
--
ALTER TABLE `payment_tbl`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `personalinfo_tbl`
--
ALTER TABLE `personalinfo_tbl`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `savingamount_tbl`
--
ALTER TABLE `savingamount_tbl`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `savings_tbl`
--
ALTER TABLE `savings_tbl`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_tbl`
--
ALTER TABLE `bank_tbl`
  MODIFY `SN` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coop_admin`
--
ALTER TABLE `coop_admin`
  MODIFY `SN` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_tbl`
--
ALTER TABLE `customer_tbl`
  MODIFY `SN` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `dividend_tbl`
--
ALTER TABLE `dividend_tbl`
  MODIFY `SN` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenditure_tbl`
--
ALTER TABLE `expenditure_tbl`
  MODIFY `SN` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guarantor`
--
ALTER TABLE `guarantor`
  MODIFY `SN` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `income_tbl`
--
ALTER TABLE `income_tbl`
  MODIFY `SN` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loanpayment_tbl`
--
ALTER TABLE `loanpayment_tbl`
  MODIFY `SN` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loanrequest_tbl`
--
ALTER TABLE `loanrequest_tbl`
  MODIFY `SN` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_tbl`
--
ALTER TABLE `loan_tbl`
  MODIFY `SN` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_tbl`
--
ALTER TABLE `payment_tbl`
  MODIFY `SN` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `personalinfo_tbl`
--
ALTER TABLE `personalinfo_tbl`
  MODIFY `SN` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `savingamount_tbl`
--
ALTER TABLE `savingamount_tbl`
  MODIFY `SN` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `savings_tbl`
--
ALTER TABLE `savings_tbl`
  MODIFY `SN` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
