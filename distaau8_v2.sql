-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jul 24, 2016 at 01:45 PM
-- Server version: 5.5.45-37.4-log
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `distaau8_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `cus`
--

CREATE TABLE IF NOT EXISTS `cus` (
  `cu_id` int(11) NOT NULL AUTO_INCREMENT,
  `utility` varchar(255) NOT NULL,
  `abr_utility` varchar(11) NOT NULL,
  PRIMARY KEY (`cu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `cus`
--

INSERT INTO `cus` (`cu_id`, `utility`, `abr_utility`) VALUES
(1, 'Luapula WSC', 'LPWSC'),
(2, 'Chambeshi WSC', 'CHWSC'),
(3, 'Eastern WSC', 'EWSC'),
(4, 'Lukanga', 'LGWSC'),
(5, 'Mulonga WSC', 'MWSC'),
(6, 'Nkana WSC', 'NWSC'),
(7, 'Kafubu WSC', 'KWSC'),
(8, 'Lusaka WSC', 'LWSC'),
(9, 'Southern WSC', 'SWSC'),
(10, 'Western WSC', 'WWSC'),
(11, 'N-Western WSC', 'NWWSC');

-- --------------------------------------------------------

--
-- Table structure for table `directives`
--

CREATE TABLE IF NOT EXISTS `directives` (
  `dir_id` double DEFAULT NULL,
  `directive` mediumtext,
  `issue_date` datetime DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `in_id` double DEFAULT NULL,
  `utility_id` double DEFAULT NULL,
  `in_id1` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `directives`
--

INSERT INTO `directives` (`dir_id`, `directive`, `issue_date`, `due_date`, `status`, `comments`, `in_id`, `utility_id`, `in_id1`) VALUES
(1, 'Immediately show cause why punitive action should not be taken against you for not complying with the previous directive on enhancing procedures for new connections.', '2016-06-03 00:00:00', '2016-06-03 00:00:00', NULL, NULL, 1, 6, 1),
(2, 'Immediately investigate the poor performance in billing and submit a report on the cause and measures to be taken.', '2016-06-03 00:00:00', '2016-06-30 00:00:00', NULL, NULL, 1, 6, 1),
(3, 'Submit a plan on how you will improve water supply to CEC Village Kataga Street, Mindolo West 2nd to 6th  street, portions of Chamboli and Luangwa Townships and ensure that the over 400 customers who are not being billed start to be be billed including those in Magum Township.', '2016-06-03 00:00:00', '2016-06-30 00:00:00', NULL, NULL, 1, 6, 1),
(4, 'Immediately streamline procedures of connecting and capturing new connections to ensure that they are done within the stipulated timeframes and elimionate all possible loopholes for fraud.', '2016-06-03 00:00:00', '2016-06-03 00:00:00', NULL, NULL, 1, 6, 1),
(5, 'Speed up the process of adoption of ISO 17025. Ensure that the quality manual and other procedures are completed.', '2016-06-03 00:00:00', '2016-07-15 00:00:00', NULL, NULL, 1, 6, 1),
(6, 'Immediately discontinue the off-system receipting for new connections and ensure that payments for the same were tied to the customer account in the system.', '2016-06-03 00:00:00', '2016-06-03 00:00:00', NULL, NULL, 1, 6, 1),
(7, '		                                Ensure that you fully develop and implement a MMS.		                            ', '2016-06-03 00:00:00', '2016-07-13 00:00:00', NULL, '', 1, 6, 1),
(8, 'Submit a plan  of how you will ensure that the challenges of sewage floading in Kalulushi are eradicated.', '2016-06-03 00:00:00', '2016-06-30 00:00:00', NULL, NULL, 1, 6, 1),
(9, '		                                		                                		                                		                                		                                		                                		                                		                                		                                		                                		                                		                                Enhance the process of making and capturing new connections and also address the non-billing in Chabanyama and Twatasha of Chingola where poor supply was reported. Furthermore, investigate the over 1,184 suspended accounts in Chingola and provide a status report on the measures taken or to be taken by 30th July 2016. 		                            		                            		                            		                            		                            		                            		                            		                            		                            		                            		                            		                            ', '2016-06-21 00:00:00', '2016-07-30 00:00:00', NULL, '', 1, 5, 1),
(10, 'Provide a plan of how you intend to minimise casualization by 15th July 2016.  ', '2016-06-21 00:00:00', '2016-07-15 00:00:00', NULL, NULL, 1, 5, 1),
(11, 'Immediately restore supply to Kawama Township and propose measures for improving water supply to above mentioned inadequately serviced areas by 15th July 2016.  ', '2016-06-21 00:00:00', '2016-07-15 00:00:00', NULL, NULL, 1, 5, 1),
(12, 'Thoroughly investigate the stagnant billing particularly in Chililabombwe and submit a report by 15th July 2016 on the necessary corrective action to be undertaken.', '2016-06-21 00:00:00', '2016-07-15 00:00:00', NULL, NULL, 1, 5, 1),
(13, 'Urgently address the sewage surcharging challenges in PPZ Compound and provide a status report by 30th July 2016.', '2016-06-21 00:00:00', '2016-07-30 00:00:00', NULL, NULL, 1, 5, 1),
(14, 'Speedily address the numerous leakages across Chingola and submit a report to that effect by 15th July 2016.', '2016-06-21 00:00:00', '2016-07-15 00:00:00', NULL, NULL, 1, 5, 1),
(15, '		                                Ensure uniformity and enhancement of operational processes across all the Divisions such as MMS implementation, stores management, human resources management and handling of disconnections and provide a status report on the matters by 30th July 2016. 		                            ', '2016-06-21 00:00:00', '2016-07-30 00:00:00', NULL, '', 1, 5, 1),
(16, 'Investigate the seemingly stagnated billing and submit a report on the causes and measures to be taken to remedy the situation.', '2016-06-03 00:00:00', '2016-06-30 00:00:00', NULL, NULL, 1, 7, 1),
(17, 'Immediately address all the zero consumptions observed and re-assess the non-issuance of bills to some customers in Ndeke and Kariba Townships with the view of improving the company’s billing in line with tariff projections. ', '2016-06-03 00:00:00', '2016-06-30 00:00:00', NULL, NULL, 1, 7, 1),
(18, 'Immediately improve the new connections process to ensure that the stipulated timeframes in the SLGs are compiled with. Further, investigate and eliminate any fraudulent activities in the process.', '2016-06-03 00:00:00', '2016-06-30 00:00:00', NULL, NULL, 1, 7, 1),
(19, 'Immediately show cause why you should not be cited for misappropriation of the sanitation surcharge and meter charges. ', '2016-06-03 00:00:00', '2016-06-30 00:00:00', NULL, NULL, 1, 7, 1),
(20, 'Submit a report on how you will arrest the wrongful procurement of items by 30th June 2016.', '2016-06-03 00:00:00', '2016-06-30 00:00:00', NULL, NULL, 1, 7, 1),
(21, 'Immediately improve financial controls particularly on handling of new connection charges and accounting for daily collections by Chief Cashiers.', '2016-06-03 00:00:00', '2016-06-30 00:00:00', NULL, NULL, 1, 7, 1),
(22, 'Immediately engage staff or their representatives to reconcile the leave days’ discrepancies and embark on a companywide sensitisation of staff on the policy on leave days. ', '2016-06-03 00:00:00', '2016-06-30 00:00:00', NULL, NULL, 1, 7, 1),
(23, 'Provide a time-bound plan of how you intend to improve service hours in Mumbwa to the guaranteed level, failure to which NWASCO will reduce the tariff commensurate to the level of service.', '2016-02-11 00:00:00', '2016-04-18 00:00:00', NULL, NULL, 1, 4, 1),
(24, 'Institute measures/plans to ensure Chlorine residue in the affected districts and the pH at borehole reservoirs in Serenje are within the required limits. You are required to submit a report detailing the measures to be taken to NWASCO.', '2016-02-11 00:00:00', '2016-04-18 00:00:00', NULL, NULL, 1, 4, 1),
(25, 'Ensure that all new connections for paid-up customers are done within the guaranteed timeframe. You are requested to submit a list of all paid up customers and the dates they will be connected.', '2016-02-11 00:00:00', '2016-03-31 00:00:00', NULL, NULL, 1, 4, 1),
(26, 'Ensure that ring-fencing of the sanitation surcharge and meter charge is done correctly with the CU transferring all the due amounts to a dedicated account.', '2016-02-11 00:00:00', '2016-04-18 00:00:00', NULL, NULL, 1, 4, 1),
(27, 'Further you are directed to submit a report to NWASCO on the remedial measures you will take to address all other highlighted issues of in the letter of findings.', '2016-02-11 00:00:00', '2016-04-18 00:00:00', NULL, NULL, 1, 4, 1),
(28, 'Avail to NWASCO the necessary documentation concerning the motor vehicle leases including the payment plan.', '2016-02-28 00:00:00', '2016-02-26 00:00:00', NULL, NULL, 1, 9, 1),
(29, 'Address the pH challenges for the water supplied in Zimba. ', '2016-02-28 00:00:00', '2016-02-28 00:00:00', NULL, NULL, 1, 9, 1),
(30, 'Provide a timeframe within which the deficits in the Meter Charge and Sanitation Surcharge accounts will be remitted in the respective accounts. ', '2016-02-28 00:00:00', '2016-02-12 00:00:00', NULL, NULL, 1, 9, 1),
(31, 'Put in place the necessary measures to ensure that quantitative test methods for micro-bacteriological parameters are used in all your districts/ centres. ', '2016-02-28 00:00:00', '2016-03-31 00:00:00', NULL, NULL, 1, 9, 1),
(32, 'Avail to NWASCO a plan on how you are going to improve water supply hours in the townships identified above to meet the Service Level Guarantees ', '2016-02-28 00:00:00', '2016-02-26 00:00:00', NULL, NULL, 1, 9, 1),
(33, 'Ensure that expenditure on casual labour is discontinued immediately as it is not allowable. The CU is expected to draw from its casual labour line from the approved tariff expenditure to fund casual labour expenses.', '2016-06-20 00:00:00', '2016-06-20 00:00:00', NULL, NULL, 1, 9, 1),
(34, 'Institute measures to ensure that monthly sanitation surcharge collections are transferred consistently to dedicated account.', '2016-06-20 00:00:00', '2016-06-20 00:00:00', NULL, NULL, 1, 9, 1),
(35, 'Ensure that all the unbanked arrears amounting to K667,937.01 are paid back to the dedicated account  in fifteen equal installments starting from July 2016 as proposed by your Company. Please take note that failure to adhere to the proposed repayment plan may result in the suspension of sanitation surcharge and your company refunding all affected customers.', '2016-06-20 00:00:00', '2016-06-20 00:00:00', NULL, NULL, 1, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `directive_cats`
--

CREATE TABLE IF NOT EXISTS `directive_cats` (
  `dir_id` int(11) NOT NULL DEFAULT '0',
  `dircat_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`dir_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `directive_cats`
--

INSERT INTO `directive_cats` (`dir_id`, `dircat_name`) VALUES
(1, 'Annual Inspection Directives'),
(2, 'Spot Check Inspection Directives'),
(3, 'Others Directives');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `indicators`
--

CREATE TABLE IF NOT EXISTS `indicators` (
  `in_id` double DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `sname` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `indicators`
--

INSERT INTO `indicators` (`in_id`, `fname`, `sname`) VALUES
(1, 'Inspection Directives', 'Directives'),
(2, 'Tariff Conditions', 'Tariff Conditions'),
(3, 'Special Regulatory Supervision', 'SRS'),
(4, 'WSS Projects', 'Projects'),
(5, 'Regulation by Incentives', 'RBI'),
(6, 'Service Level Guarantees and Agreements ', 'SLAs/ SLGs');

-- --------------------------------------------------------

--
-- Table structure for table `licence_conditions`
--

CREATE TABLE IF NOT EXISTS `licence_conditions` (
  `l_id` int(11) NOT NULL AUTO_INCREMENT,
  `licence` varchar(255) NOT NULL,
  `issue_date` date NOT NULL,
  `due_date` date NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `utility_id` int(11) NOT NULL,
  `town_id` int(11) NOT NULL,
  PRIMARY KEY (`l_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `licence_conditions`
--

INSERT INTO `licence_conditions` (`l_id`, `licence`, `issue_date`, `due_date`, `status`, `utility_id`, `town_id`) VALUES
(1, 'The provisions concerning the transfer or amendments of the License, penalty for infringement of the provisions of the License, and its suspension or cancellation shall be enforced as specified in the Water Supply and Sanitation Act No. 28 of 1997.', '0000-00-00', '0000-00-00', NULL, 1, 1),
(2, 'License, penalty for infringement of the provisions of the License, and its suspension or cancellation shall be enforced as specified in the Water Supply and Sanitation Act No. 28 of 1997.', '0000-00-00', '0000-00-00', NULL, 2, 2),
(3, 'The provisions concerning the transfer or amendments of the License, penalty for infringement of the provisions of the License, and its suspension or cancellation shall be enforced as specified in the Water Supply and Sanitation Act No. 28 of 1997.', '0000-00-00', '0000-00-00', NULL, 3, 3),
(4, 'Amendments of the License, penalty for infringement of the provisions of the License, and its suspension or cancellation shall be enforced as specified in the Water Supply and Sanitation Act No. 28 of 1997.', '0000-00-00', '0000-00-00', NULL, 4, 4),
(5, 'The provisions concerning the transfer or amendments of the License, penalty for infringement of the provisions of the License, and its suspension or cancellation shall be enforced as specified in the Water Supply and Sanitation Act No. 28 of 1997.', '0000-00-00', '0000-00-00', NULL, 5, 5),
(6, 'Penalty for infringement of the provisions of the License, and its suspension or cancellation shall be enforced as specified in the Water Supply and Sanitation Act No. 28 of 1997.', '0000-00-00', '0000-00-00', NULL, 6, 6),
(7, 'The provisions concerning the transfer or amendments of the License, penalty for infringement of the provisions of the License, and its suspension or cancellation shall be enforced as specified in the Water Supply and Sanitation Act No. 28 of 1997.', '0000-00-00', '0000-00-00', NULL, 7, 7),
(8, 'The provisions concerning the transfer or amendments of the License, penalty for infringement of the provisions of the License, and its suspension or cancellation shall be enforced as specified in the Water Supply and Sanitation Act No. 28 of 1997.', '0000-00-00', '0000-00-00', NULL, 8, 8),
(9, 'Infringement of the provisions of the License, and its suspension or cancellation shall be enforced as specified in the Water Supply and Sanitation Act No. 28 of 1997.', '0000-00-00', '0000-00-00', NULL, 9, 9),
(10, 'The provisions concerning the transfer or amendments of the License, penalty for infringement of the provisions of the License, and its suspension or cancellation shall be enforced as specified in the Water Supply and Sanitation Act No. 28 of 1997.', '0000-00-00', '0000-00-00', NULL, 10, 10),
(11, 'The provisions concerning the transfer or amendments of the License, penalty for infringement of the provisions of the License, and its suspension or cancellation shall be enforced as specified in the Water Supply and Sanitation Act No. 28 of 1997.', '0000-00-00', '0000-00-00', NULL, 11, 11);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `proj_id` double DEFAULT NULL,
  `project` varchar(255) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `utility_id` double DEFAULT NULL,
  `in_id` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`proj_id`, `project`, `start_date`, `end_date`, `status`, `utility_id`, `in_id`) VALUES
(1, 'Sichili Water Supply project', '2011-12-01 00:00:00', NULL, NULL, 10, 4),
(2, 'Sesheke Water supply Improvement Project', '2012-05-01 00:00:00', NULL, NULL, 10, 4),
(3, 'Improvement of water supply for Site and Service in Kaoma ', '2013-05-01 00:00:00', '2015-02-01 00:00:00', NULL, 10, 4),
(4, 'Muoyo Water Supply Scheme.', '2013-03-01 00:00:00', '2015-01-17 00:00:00', NULL, 10, 4),
(5, 'Mandanga Water Supply Scheme ', '2012-04-13 00:00:00', '2012-10-22 00:00:00', NULL, 10, 4),
(6, 'Construction of 8 water kiosks in Mchini, Mchenga Gwai and Nabvutika compounds of Chipata district.', '2015-12-03 00:00:00', '2015-10-31 00:00:00', NULL, 3, 4),
(7, 'Great East Road T4- LOT 3 Mtenguleni, Chipata, Mwami boarder-Relocation of Water and Sewerage services.', '2015-01-04 00:00:00', '2015-07-31 00:00:00', NULL, 3, 4),
(8, 'Nyimba, chadiza, katete and chipata emergency works - Phase 2 and 3 ', '2013-12-01 00:00:00', '2015-12-01 00:00:00', NULL, 3, 4),
(9, 'Water and Sanitation Project in Livingstone  Raw Water Intake Equipping, Raising Main Line replacement, Reservoirs, Network replacement and metering', '2013-01-06 00:00:00', '2015-08-31 00:00:00', NULL, 9, 4),
(10, 'Choma upgrading of Production and Supply to match the Provincial Capital City status. Abstraction Plants-Dam , Treatment Plants, Network rehab, and Metering', '2014-01-05 00:00:00', '2015-05-31 00:00:00', NULL, 9, 4),
(11, 'Chandamali Water Supply Project', '2015-03-16 00:00:00', '2015-12-24 00:00:00', NULL, 9, 4),
(12, 'Libuyu Sanitation project phase II ', '2015-01-15 00:00:00', '2015-08-04 00:00:00', NULL, 9, 4),
(13, 'MUFUMBWE Water Supply Project', '2013-01-08 00:00:00', '2015-01-31 00:00:00', NULL, 11, 4),
(14, 'KASEMPA Water Supply Project', '2012-01-03 00:00:00', '2014-10-30 00:00:00', NULL, 11, 4),
(15, 'MUSHITALA  Phase 2', '2014-01-08 00:00:00', '2014-12-31 00:00:00', NULL, 11, 4),
(16, 'Installation 5,000m of water network and metering of 150 households in Mufulira', '2015-02-01 00:00:00', '2015-07-01 00:00:00', NULL, 6, 4),
(17, 'Survey works, designs and extension of 5,657m sewer network and construction of  274 manholes in Chingola', '2014-06-01 00:00:00', '2015-12-01 00:00:00', NULL, 6, 4),
(18, 'Installation of 38,400m of water network and metering of 600 properties in SNDP in Chingola', '2015-02-01 00:00:00', '2015-09-01 00:00:00', NULL, 6, 4),
(19, 'Rehabilitation of 11,370m of water network, metering of 4,308 households, bulk metering and rehabilitation of 550 toilets in Nchanga North in Chingola', '2013-07-01 00:00:00', '2016-07-01 00:00:00', NULL, 6, 4),
(20, 'Partitioning of panels at Kafue water treatment plant in Chingola', '2015-01-01 00:00:00', '2015-02-01 00:00:00', NULL, 6, 4),
(21, 'Install 2,846 water waters and replace 630 water meters in Chingola', '2014-11-01 00:00:00', '2015-03-01 00:00:00', NULL, 6, 4),
(22, 'Construction of 3 revenue booths in Chingola, 3 revenue booths in Mufulira and 2 revenue booths in Chililabombwe', '2014-12-01 00:00:00', '2015-01-01 00:00:00', NULL, 6, 4),
(23, 'Construction of a flood defense embarkment at River water pump station in Mufulira', '2015-03-01 00:00:00', '2015-06-01 00:00:00', NULL, 6, 4),
(24, 'Supply, install and commission GIS/GPS system at Musonko House in Chingola', '2015-02-01 00:00:00', '2015-06-01 00:00:00', NULL, 6, 4),
(25, 'a)      Kasumbalesa Water and Sanitation Augmentation Project', '2012-05-01 00:00:00', '2015-03-01 00:00:00', NULL, 6, 4),
(26, 'Improvement of water supply and sanitation services in the City of Ndola, Municipality of Luanshya and Masaiti District  The major scope of works includes: • Upgrading of the water treatment plants. • Extension of water supply to all unserviced • Rehabili', NULL, '2017-07-09 00:00:00', NULL, 7, 4),
(27, 'MUSHITALA  Phase 2', NULL, NULL, NULL, 4, 4),
(28, 'KASEMPA Water Supply Project', NULL, NULL, NULL, 4, 4),
(29, 'MUFUMBWE Water Supply Project', NULL, NULL, NULL, 4, 4),
(30, 'BADEA (Mansa)', '2014-05-01 00:00:00', '2015-12-01 00:00:00', NULL, 1, 4),
(31, 'BADEA (Kawambwa)', '2014-05-01 00:00:00', '2015-12-01 00:00:00', NULL, 1, 4),
(32, 'Avail NWASCO a report on corrective actions taken or that you will undertake on the following issues of non-compliance and concerns.', '2014-06-16 00:00:00', '2014-03-30 00:00:00', NULL, 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE IF NOT EXISTS `requests` (
  `r_id` double DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `user_id` double DEFAULT NULL,
  `item_id` double DEFAULT NULL,
  `in_id` double DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  UNIQUE KEY `r_id` (`r_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`r_id`, `reason`, `user_id`, `item_id`, `in_id`, `date`, `type`, `status`, `comment`) VALUES
(1, 'Editing Request', 1, 3, 2, '2014-01-11 00:00:00', 'edit', 'pending', 'Requesting to change the expiry date'),
(2, 'Archiving Request', 1, 7, 2, '2014-01-11 00:00:00', 'archive', 'accepted', 'Requesting to Archive Tariff Condition'),
(3, 'Archiving Request', 1, 4, 2, '2014-01-11 00:00:00', 'archive', 'accepted', 'Requesting to Archive Tariff Condition'),
(4, 'Editing Request', 1, 5, 2, '2014-01-11 00:00:00', 'edit', 'accepted', 'Requesting to change the expiry date'),
(5, 'Editing Request', 1, 8, 2, '2014-01-11 00:00:00', 'archive', 'pending', 'Requesting to Archive Tariff Condition'),
(6, 'Archiving Request', 1, 10, 2, '2014-01-11 00:00:00', 'edit', 'pending', 'Requesting to change the expiry date');

-- --------------------------------------------------------

--
-- Table structure for table `srs`
--

CREATE TABLE IF NOT EXISTS `srs` (
  `srs_id` int(11) NOT NULL DEFAULT '0',
  `indicator` varchar(255) DEFAULT NULL,
  `base` double DEFAULT NULL,
  `target` double DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `achieved` double DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `utility_id` int(11) NOT NULL,
  `in_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `srs`
--

INSERT INTO `srs` (`srs_id`, `indicator`, `base`, `target`, `due_date`, `achieved`, `status`, `comments`, `utility_id`, `in_id`) VALUES
(0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tariff_conditions`
--

CREATE TABLE IF NOT EXISTS `tariff_conditions` (
  `tariff_id` double DEFAULT NULL,
  `condition` varchar(255) DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `score` varchar(255) DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `utility_id` double DEFAULT NULL,
  `in_id` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tariff_conditions`
--

INSERT INTO `tariff_conditions` (`tariff_id`, `condition`, `weight`, `score`, `due_date`, `status`, `remarks`, `utility_id`, `in_id`) VALUES
(1, 'Ensure that actual costs do not exceed an adverse variance of 10% of the approved cost structure for 2014.', 10, NULL, NULL, NULL, NULL, 10, 2),
(2, 'Maintain an average collection efficiency of at least 85% throughout the tariff period', 20, NULL, NULL, NULL, NULL, 10, 2),
(3, 'Maintain a full  cost coverage rate of at least 90%  at 85% collection efficiency throughout the tariff period', 20, NULL, NULL, NULL, NULL, 10, 2),
(4, 'Reactivate 900 customer accounts by 31st August 2014', 5, NULL, '2014-08-31 00:00:00', NULL, NULL, 10, 2),
(5, 'Increase number of connections by at least 500 by 30th August 2014', 5, NULL, '2014-08-30 00:00:00', NULL, NULL, 10, 2),
(6, 'Improve metering to at least 85% by 31st August 2013', 10, NULL, '2014-08-31 00:00:00', NULL, NULL, 10, 2),
(7, 'Maintain water quality compliance above 95% throughout the tariff period.', 20, NULL, NULL, NULL, NULL, 10, 2),
(8, 'Remain current on NWASCO license fees throughout 2014 and propose a payment plan on how your licence fee arrears will be cleared within the tariff period.', 10, NULL, NULL, NULL, NULL, 10, 2),
(9, 'Ring fence the fixed meter charge throughout the tariff period', 10, NULL, NULL, NULL, NULL, 10, 2),
(10, 'Fully meet the  2014 Service level agreement', 15, NULL, NULL, NULL, NULL, 10, 2),
(11, 'Ensure that external auditing of Financial Statements is up to date.', 10, NULL, NULL, NULL, NULL, 10, 2),
(12, 'Ensure that no meter remains stuck for longer than 3 months', 5, NULL, NULL, NULL, NULL, 10, 2),
(13, 'Submit an energy consumption reduction strategy by 14th February 2014 2014 and report on implementation biannually within the tariff period.', 10, NULL, '2014-02-14 00:00:00', NULL, NULL, 10, 2),
(14, 'Ensure that actual costs do not exceed an adverse variance of 10% of the approved cost structure of  K22,548,540 for 2015', 15, NULL, NULL, NULL, NULL, 3, 2),
(15, 'Achieve an average collection efficiency of at least 85% by 31st August 2015', 20, NULL, '2015-08-31 00:00:00', NULL, NULL, 3, 2),
(16, 'Achieve O&M cost coverage rate of at least 68% at 85% collection efficiency by 31st August 2015', 20, NULL, '2015-08-31 00:00:00', NULL, NULL, 3, 2),
(17, 'Increase number of connections by  900 from the current 15,266  by 31st August 2015', 10, NULL, '2015-08-31 00:00:00', NULL, NULL, 3, 2),
(18, 'Maintain 100% metering throughout the tariff period', 10, NULL, NULL, NULL, NULL, 3, 2),
(19, 'Maintain water quality compliance above 95% throughout the tariff period', 20, NULL, NULL, NULL, NULL, 3, 2),
(20, 'Remain current on NWASCO license fees throughout 2015 and propose a payment plan on how 40% of your licence fee arrears (base K275,860) will be cleared within the tariff period i.e. January to August 2015. ', 10, NULL, '2015-08-01 00:00:00', NULL, NULL, 3, 2),
(21, 'Ring fence the fixed meter charge throughout the tariff period', 10, NULL, NULL, NULL, NULL, 3, 2),
(22, 'Fully adhere to the  2015 Service Level Guarantees', 15, NULL, NULL, NULL, NULL, 3, 2),
(23, 'Ensure that external auditing of Financial Statements is up to date', 10, NULL, NULL, NULL, NULL, 3, 2),
(24, 'Ensure that no meter remains stuck for longer than 3 months', 10, NULL, NULL, NULL, NULL, 3, 2),
(25, 'Submit a plan on how you intend to extend water supply service to the Mental Hospital in Chadiza and Airport  and Farmers training college in Mambwe by 28th February 2015', 5, NULL, '2015-02-28 00:00:00', NULL, NULL, 3, 2),
(26, 'Submit a plan on how you intend to improve sewerage services in Kapata in Chipata by 28th February 2015', 5, NULL, '2015-02-28 00:00:00', NULL, NULL, 3, 2),
(27, 'Submit an energy consumption reduction strategy by 31st January 2015 and report on implementation biannually within the tariff period', 10, NULL, '2015-01-31 00:00:00', NULL, NULL, 3, 2),
(28, 'Ring fence 20% of the sewerage billing throughout the tariff period', 15, NULL, NULL, NULL, NULL, 3, 2),
(29, 'Ensure that actual costs do not exceed an adverse variance of 10% of the approved cost structure (ZMW50, 750,739) for 2015.', 10, NULL, NULL, NULL, NULL, 9, 2),
(30, 'Maintain an average collection efficiency of at least 85% throughout the tariff period', 20, NULL, NULL, NULL, NULL, 9, 2),
(31, 'Achieve an O&M cost coverage rate of at least 116%  at 85% collection efficiency by August 2015', 20, NULL, '2015-08-01 00:00:00', NULL, NULL, 9, 2),
(32, 'Increase total customer base by at least 2,400 connections by 31st August 2015 from the current 40,965 total connections.', 10, NULL, '2015-08-31 00:00:00', NULL, NULL, 9, 2),
(33, 'Install 4,000 meters by 31st August 2015. ', 10, NULL, '2015-08-31 00:00:00', NULL, NULL, 9, 2),
(34, 'Maintain water quality compliance above 95% throughout the tariff period.', 20, NULL, NULL, NULL, NULL, 9, 2),
(35, 'Remain current on NWASCO license fees throughout 2015', 10, NULL, NULL, NULL, NULL, 9, 2),
(36, 'Ring fence the fixed meter charge throughout the tariff period', 10, NULL, NULL, NULL, NULL, 9, 2),
(37, 'Ring fence 20% of the sewerage billing throughout the tariff period', 10, NULL, NULL, NULL, NULL, 9, 2),
(38, 'Ensure that external auditing of Financial Statements is up to date.', 10, NULL, NULL, NULL, NULL, 9, 2),
(39, 'Ensure that no meter remains stuck for longer than 3 months', 5, NULL, NULL, NULL, NULL, 9, 2),
(40, 'Submit an energy consumption reduction strategy by 31st January 2014 and report on implementation biannually within the tariff period.', 10, NULL, '2014-01-31 00:00:00', NULL, NULL, 9, 2),
(41, 'Fully adhere to the 2015 Service Level Guarantees.', 20, NULL, NULL, NULL, NULL, 9, 2),
(42, 'Extend service to Chandamali and Manungu Compounds Choma and Monze respectively by ', 10, NULL, NULL, NULL, NULL, 9, 2),
(43, 'Ensure that actual costs do not exceed an adverse variance of 10% of the approved cost structure for 2014.', 10, NULL, NULL, NULL, NULL, 11, 2),
(44, 'Maintain an average collection efficiency of at least 90% throughout the tariff period', 20, NULL, NULL, NULL, NULL, 11, 2),
(45, 'Maintain an average O&M Cost coverage of at least 100% throughout the tariff period', 20, NULL, NULL, NULL, NULL, 11, 2),
(46, 'Submit an energy consumption reduction strategy by 31st January 2014 and report on implementation biannually within the tariff period.', 10, NULL, '2014-01-31 00:00:00', NULL, NULL, 11, 2),
(47, 'Submit a feasible program on how you plan to extend water supply to the following areas: Kawiku and Kaputu in Mwinilunga and Muselepete in Kasempa. Report on plan of implementation to NWASCO quarterly', 5, NULL, NULL, NULL, NULL, 11, 2),
(48, 'Increase number of water connections for Solwezi, Zambezi, Kabompo districts by a total of at least 1000 by end of  August 2014', 5, NULL, '2014-08-01 00:00:00', NULL, NULL, 11, 2),
(49, 'Ensure that external auditing of Financial Statements is up to date by end of August 2014.', 10, NULL, '2014-08-01 00:00:00', NULL, NULL, 11, 2),
(50, 'Ring fence the fixed meter charge throughout the tariff period', 10, NULL, NULL, NULL, NULL, 11, 2),
(51, 'Maintain water quality compliance  above 95%  throughout the tariff period', NULL, NULL, NULL, NULL, NULL, 11, 2),
(52, 'Ring fence 20% of sewerage billing throughout the tariff period', 10, NULL, NULL, NULL, NULL, 11, 2),
(53, 'Ensure no meter remains stuck for longer than 3 months.', 5, NULL, NULL, NULL, NULL, 11, 2),
(54, 'Maintain 100% metering ratio throughout the tariff period', 10, NULL, NULL, NULL, NULL, 11, 2),
(55, 'Maintain NRW at 30% maximum during the tariff period', 10, NULL, NULL, NULL, NULL, 11, 2),
(56, 'Reactivate all inactive sewer connections in Zambezi and extend to 100 new connections', 5, NULL, NULL, NULL, NULL, 11, 2),
(57, 'Remain current on NWASCO license fees throughout 2014', 10, NULL, NULL, NULL, NULL, 11, 2),
(58, 'Fully meet the Service level Agreement for 2014', 15, NULL, NULL, NULL, NULL, 11, 2),
(59, 'Retain the 2013 tariffs on the entire Kalulushi town; Wusakile, Chamboli, Ndeke and Makobo Townships of Kitwe and Chambishi Towns respectively, until supply to the mentioned areas is improved in line with the SLG and commitment letter signed on 2nd Octobe', 20, NULL, NULL, NULL, NULL, 6, 2),
(60, 'Maintain water quality compliance above 95% throughout the tariff period.', 20, NULL, NULL, NULL, NULL, 6, 2),
(61, 'Maintain an average collection efficiency of at least 85% throughout the tariff period.', 20, NULL, NULL, NULL, NULL, 6, 2),
(62, 'Maintain the O&M costs for the approved tariff within 10% adverse variance subject to reasonable justification.', 10, NULL, NULL, NULL, NULL, 6, 2),
(63, 'Increase domestic metered connection by 5000 by August 2014.', 5, NULL, '2014-08-01 00:00:00', NULL, NULL, 6, 2),
(64, 'Remain current on NWASCO license fees throughout 2014 and clear all accumulated licence arrears by 28th February 2014.', 10, NULL, '2014-02-28 00:00:00', NULL, NULL, 6, 2),
(65, 'Ensure that external auditing of Financial Statements is up to date by end of August 2014.', 10, NULL, '2014-08-01 00:00:00', NULL, NULL, 6, 2),
(66, 'Submit an energy consumption reduction strategy by 31st January 2014 and report on implementation biannually within the tariff period.', 10, NULL, '2014-01-31 00:00:00', NULL, NULL, 6, 2),
(67, 'Ring fence the fixed meter charge and sanitation surcharge through the tariff period.', 10, NULL, NULL, NULL, NULL, 6, 2),
(68, 'Ring fence 50% of the sewerage billing throughout the tariff period.', 10, NULL, NULL, NULL, NULL, 6, 2),
(69, 'Ensure no meter remains stuck for longer than 3 months.', 10, NULL, NULL, NULL, NULL, 6, 2),
(70, 'Fully meet the Service level Agreement for 2014.', 15, NULL, NULL, NULL, NULL, 6, 2),
(71, 'Ensure that actual costs do not exceed an adverse variance of 10% of the approved cost structure for 2015 (from base K60,300,981.00 as per tariff  approval)', 20, NULL, NULL, NULL, NULL, 7, 2),
(72, 'Attain an average collection efficiency of at least 85% from 67% by 31st July 2015 and maintain throughout the tariff period', 20, NULL, '2015-07-31 00:00:00', NULL, NULL, 7, 2),
(73, 'Install 5000 meters by 31st August 2015.  ', 15, NULL, '2015-08-31 00:00:00', NULL, NULL, 7, 2),
(74, 'Maintain water quality compliance above 95% throughout the tariff period.', 15, NULL, NULL, NULL, NULL, 7, 2),
(75, 'Remain current on NWASCO license fees throughout 2015.  ', 5, NULL, NULL, NULL, NULL, 7, 2),
(76, 'Ring-fence the fixed meter charge throughout the tariff period', 15, NULL, NULL, NULL, NULL, 7, 2),
(77, 'Ring-fence the sanitation surcharge throughout the tariff period', 10, NULL, NULL, NULL, NULL, 7, 2),
(78, 'Ring-fence 20% of the sewerage billing throughout the tariff period', 5, NULL, NULL, NULL, NULL, 7, 2),
(79, 'Adhere to the  2015 Service level guarantees', 20, NULL, NULL, NULL, NULL, 7, 2),
(80, 'Ensure that no meter remains stuck for longer than 3 months', 10, NULL, NULL, NULL, NULL, 7, 2),
(81, 'Submit an energy consumption reduction strategy by 15th May 2015 and report on implementation biannually within the tariff period.', 10, NULL, '2015-05-15 00:00:00', NULL, NULL, 7, 2),
(82, 'Increase total customer base by at least 2000 connections by 31st August 2015, base will be as in (2014 sector report)', 10, NULL, '2015-08-31 00:00:00', NULL, NULL, 7, 2),
(83, 'Ensure that actual costs do not exceed an adverse variance of 10% of the approved cost structure for 2015 ( from base K26.3million as per tariff approval)', 10, NULL, NULL, NULL, NULL, 4, 2),
(84, 'Attain  and maintain collection efficiency of at least 85% from 81% throughout the tariff period', 20, NULL, NULL, NULL, NULL, 4, 2),
(85, 'Attain O&M cost coverage rate of at least 108%  at 85% collection efficiency by 31st October and maintain throughout the tariff period', 20, NULL, '2015-10-31 00:00:00', NULL, NULL, 4, 2),
(86, 'Install 3,000 meters by 31st August 2015', 10, NULL, '2015-08-31 00:00:00', NULL, NULL, 4, 2),
(87, 'Maintain water quality compliance above 95% throughout the tariff period.', 20, NULL, NULL, NULL, NULL, 4, 2),
(88, 'Remain current on NWASCO license fees throughout 2015 and propose a payment plan on how licence fee arrears will be cleared within the tariff period.', 10, NULL, NULL, NULL, NULL, 4, 2),
(89, 'Ring fence the fixed meter charge throughout the tariff period', 10, NULL, NULL, NULL, NULL, 4, 2),
(90, 'Ring fence the sanitation charge throughout the tariff period', 10, NULL, NULL, NULL, NULL, 4, 2),
(91, 'Ring fence 20% of the sewerage billing throughout the tariff period', 10, NULL, NULL, NULL, NULL, 4, 2),
(92, 'Adhere to the  2015 Service level guarantees', 15, NULL, NULL, NULL, NULL, 4, 2),
(93, 'Ensure that no meter remains stuck for longer than 3 months', 5, NULL, NULL, NULL, NULL, 4, 2),
(94, 'Submit an energy consumption reduction strategy by 31st January 2015 and report on implementation biannually within the tariff period.', 10, NULL, '2015-01-31 00:00:00', NULL, NULL, 4, 2),
(95, 'Increase total customer base by at least 1000 connections by 31st August 2015, base will be as in (2014 sector report)', 10, NULL, '2015-08-31 00:00:00', NULL, NULL, 4, 2),
(96, 'Ensure that actual costs do not exceed an adverse variance of 10% of the approved cost structure of K10, 691,165 for 2015.', 20, NULL, NULL, NULL, NULL, 1, 2),
(97, 'Maintain average collection efficiency above 85% throughout 2015.', 20, NULL, NULL, NULL, NULL, 1, 2),
(98, 'Achieve an average O&M cost coverage by collection of 60% (from 56.8%) by August 2015.', 10, NULL, '2015-08-01 00:00:00', NULL, NULL, 1, 2),
(99, 'Increase number of connections by 700 (from 5,350) by 30th August 2015.', 15, NULL, '2015-08-30 00:00:00', NULL, NULL, 1, 2),
(100, 'Remain current on NWASCO license fees throughout the tariff period', 10, NULL, NULL, NULL, NULL, 1, 2),
(101, 'Ensure that external auditing of Financial Statements is up to date by 31st August 2015.', 10, NULL, '2015-08-31 00:00:00', NULL, NULL, 1, 2),
(102, 'Attend to reported leakages within 24 hours', 10, NULL, NULL, NULL, NULL, 1, 2),
(103, 'Maintain water quality compliance above 95% throughout the tariff period.', 20, NULL, NULL, NULL, NULL, 1, 2),
(104, 'Ensure that no meter remains stuck for longer than 3 months', 15, NULL, NULL, NULL, NULL, 1, 2),
(105, 'Improve average service hours for Kawambwa from 3 to 9 hours by 30th August 2015', 15, NULL, '2015-08-30 00:00:00', NULL, NULL, 1, 2),
(106, 'Maintain 100% metering throughout the tariff period', 10, NULL, NULL, NULL, NULL, 1, 2),
(107, 'Fully adhere to the 2015 Service Level Guarantees', 15, NULL, NULL, NULL, NULL, 1, 2),
(108, 'Improve service hours in Chabanyama, Lulamba and Twatasha in Chingola to the SLG by April 2014', 10, NULL, '2014-04-01 00:00:00', NULL, NULL, 5, 2),
(109, 'Maintain an average collection efficiency of at least 90% throughout the tariff period', 20, NULL, NULL, NULL, NULL, 5, 2),
(110, 'Maintain full cost coverage rate of at least 100% at current collection efficiency throughout the tariff period', 15, NULL, NULL, NULL, NULL, 5, 2),
(111, 'Ensure no meter remains stuck for longer than 3 months', 15, NULL, NULL, NULL, NULL, 5, 2),
(112, 'Increase number of water and sewer connections by 2,000 and 1,000 respectively by 31st August 2014', 5, NULL, NULL, NULL, NULL, 5, 2),
(113, 'Achieve 100% metering for bulk meters and 80% customer meters by 30th June 2014', 15, NULL, '2014-06-30 00:00:00', NULL, NULL, 5, 2),
(114, 'Submit an energy consumption reduction strategy by 31st January 2014 and report on implementation biannually within the tariff period', 10, NULL, '2014-01-31 00:00:00', NULL, NULL, 5, 2),
(115, 'Remain current on NWASCO license fees throughout the tariff period', 5, NULL, NULL, NULL, NULL, 5, 2),
(116, 'Improve water quality compliance  to 95%  by August  2014', 20, NULL, '2014-08-01 00:00:00', NULL, NULL, 5, 2),
(117, 'Ensure that external auditing of Financial Statements is up to date by end of August 2014', 10, NULL, '2014-08-01 00:00:00', NULL, NULL, 5, 2),
(118, 'Ring fence 50% of the sewerage billing throughout the tariff period', 10, NULL, NULL, NULL, NULL, 5, 2),
(119, 'Ring fence the fixed meter charge and the sanitation surcharge  throughout the tariff period', 10, NULL, NULL, NULL, NULL, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `towns`
--

CREATE TABLE IF NOT EXISTS `towns` (
  `town_id` int(11) NOT NULL AUTO_INCREMENT,
  `town` varchar(255) DEFAULT NULL,
  `utility_id` varchar(11) NOT NULL,
  PRIMARY KEY (`town_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=123 ;

--
-- Dumping data for table `towns`
--

INSERT INTO `towns` (`town_id`, `town`, `utility_id`) VALUES
(1, 'Kalabo', '10'),
(2, 'Kaoma', '10'),
(3, 'Limulungu', '10'),
(4, 'Luampa', '10'),
(5, 'Lukulu', '10'),
(6, 'Mitete', '10'),
(7, 'Mongu', '10'),
(8, 'Mulobezi', '10'),
(9, 'Mwandi', '10'),
(10, 'Nalolo', '10'),
(11, 'Nkeyama', '10'),
(12, 'Senanga', '10'),
(13, 'Sesheke', '10'),
(14, 'Shangombo', '10'),
(15, 'Sikongo', '10'),
(16, 'Sioma', '10'),
(17, 'Chiengi', '1'),
(18, 'Chipili', '1'),
(19, 'Chembe', '1'),
(20, 'Kawambwa', '1'),
(21, 'Lunga', '1'),
(22, 'Mansa', '1'),
(23, 'Milenge', '1'),
(24, 'Mwansabobwe', '1'),
(25, 'Mwense', '1'),
(26, 'Nchelenge', '1'),
(27, 'Samfya', '1'),
(28, 'Chinsali', '2'),
(29, 'Isoka', '2'),
(30, 'Mafinga', '2'),
(31, 'Mpika', '2'),
(32, 'Nakonde', '2'),
(33, 'Shiwa''Ngandu ', '2'),
(34, 'Chilubi', '2'),
(35, 'Kaputa', '2'),
(36, 'Kasama', '2'),
(37, 'Luwingu', '2'),
(38, 'Mbala', '2'),
(39, 'Mporokoso', '2'),
(40, 'Mpulungu', '2'),
(41, 'Mungwi', '2'),
(42, 'Nsama', '2'),
(43, 'Chadiza', '3'),
(44, 'Chama', '3'),
(45, 'Chipata', '3'),
(46, 'Katete', '3'),
(47, 'Lundazi', '3'),
(48, 'Mambwe', '3'),
(49, 'Nyimba', '3'),
(50, 'Petauke', '3'),
(51, 'Sinda', '3'),
(52, 'Vubwi', '3'),
(53, 'Chibombo', '4'),
(54, 'Chisamba', '4'),
(55, 'Chitambo', '4'),
(56, 'Itezhi-Tezhi', '4'),
(57, 'Kabwe', '4'),
(58, 'Kapiri', '4'),
(59, 'Mposhi', '4'),
(60, 'Luano', '4'),
(61, 'Mkushi', '4'),
(62, 'Mumbwa', '4'),
(63, 'Ngabwe', '4'),
(64, 'Serenje', '4'),
(65, 'Chinsali', '5'),
(66, 'Isoka', '5'),
(67, 'Mafinga', '5'),
(68, 'Mpika', '5'),
(69, 'Nakonde', '5'),
(70, 'Shiwa''Ngandu ', '5'),
(71, 'Chilubi', '5'),
(72, 'Kaputa', '5'),
(73, 'Kasama', '5'),
(74, 'Luwingu', '5'),
(75, 'Mbala', '5'),
(76, 'Mporokoso', '5'),
(77, 'Mpulungu', '5'),
(78, 'Mungwi', '5'),
(79, 'Nsama', '5'),
(80, 'Chililabombwe', '6'),
(81, 'Chingola', '6'),
(82, 'Mufulira', '6'),
(83, 'Luanshya', '7'),
(84, 'Kabwe', '6'),
(85, 'Livingstone', '9'),
(86, 'Kazungula', '9'),
(87, 'Namwala', '9'),
(88, 'Mbabala', '9'),
(89, 'Choma', '9'),
(90, 'Pemba', '9'),
(91, 'Batoka', '9'),
(92, 'Sinazongwe', '9'),
(93, 'Kalomo', '9'),
(94, 'Zimba', '9'),
(95, 'Sinazeze', '9'),
(96, 'Maamba', '9'),
(97, 'Siavonga', '9'),
(98, 'Mazabuka', '9'),
(99, 'Nega-Nega', '9'),
(100, 'monze', '9'),
(101, 'chisekesi', '9'),
(102, 'Gwembe', '9'),
(103, 'Munyumbwe', '9'),
(104, 'Chilanga', '8'),
(105, 'Chirundu', '8'),
(106, 'Chongwe', '8'),
(107, 'Kafue', '8'),
(108, 'Luangwa', '8'),
(109, 'Lusaka', '8'),
(110, 'Rufunsa', '8'),
(111, 'Shibuyunji', '8'),
(112, 'Chavuma', '11'),
(113, 'Ikelenge', '11'),
(114, 'Kabompo', '11'),
(115, 'Kasempa', '11'),
(116, 'Manyinga', '11'),
(117, 'Mufumbwe', '11'),
(118, 'Mwinilunga', '11'),
(119, 'Solwezi', '11'),
(120, 'Zambezi', '11'),
(121, 'Masaiti', '7'),
(122, 'Ndola', '7');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'trudy', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, 'pEzxKZ5IDdQyPf30AkuuM.', 1268889823, 1469105433, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(2, '::1', NULL, '$2y$08$M6bSNYQQz1mfzmhvMdXtk.jmU1FVCkKtzdu8y/tQmWPVQsGaBJ.QK', NULL, 'omax@g.com', NULL, NULL, NULL, NULL, 1466509164, 1466530813, 1, 'Omara', 'Daniel', 'Chambeshi WSC', '0773234654'),
(3, '::1', NULL, '$2y$08$ZLm69/nFiEDO521OMCwKjur1Gg51arW8tGUxE873QDzMhyjAfZmMe', NULL, 'nkutu@gmail.com', NULL, NULL, NULL, NULL, 1466520639, NULL, 1, 'Yusuf', 'Nkutu', 'Lusaka WSC', '0773234654');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `wwg`
--

CREATE TABLE IF NOT EXISTS `wwg` (
  `group_id` double DEFAULT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `consitution_date` varchar(255) DEFAULT NULL,
  ` expiry_date` varchar(255) DEFAULT NULL,
  `utility_id` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wwg`
--

INSERT INTO `wwg` (`group_id`, `group_name`, `consitution_date`, ` expiry_date`, `utility_id`) VALUES
(1, 'Mpika', NULL, NULL, 2),
(2, 'Kasama', NULL, NULL, 2),
(3, 'Mongu', NULL, NULL, 10),
(4, 'Chipata ', NULL, NULL, 3),
(5, 'Lusaka', NULL, NULL, 8),
(6, 'Livingstone', NULL, NULL, 9),
(7, 'Solwezi', NULL, NULL, 11),
(8, 'Kitwe', NULL, NULL, 6),
(9, 'Kalulushi', NULL, NULL, 6),
(10, 'Ndola', NULL, NULL, 7),
(11, 'Kabwe', NULL, NULL, 4),
(12, 'Kapiri Mposhi', NULL, NULL, 4);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
