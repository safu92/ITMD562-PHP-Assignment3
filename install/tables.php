<?php
defined("true-access") or die("No script kiddies please!");
echo '<h1> Installing Database... </h1>';

include("../configuration.php");
//connecting to database
function install_database($dbhost,$dbuser,$dbpass,$database)
{
	$dbc = mysqli_connect($dbhost,$dbuser,$dbpass,$database);
	$error = "";
	
	if ($dbc)
	{
	//executing all database commands
		mysqli_set_charset($dbc,"utf8");
		mysqli_query($dbc,"CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(10) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
");
		mysqli_query($dbc,"INSERT INTO `admin` (`username`, `password`) VALUES('admin', 'cfa8026d7a6303c14f23e55f39ed6273bf5352e7');");
		mysqli_query($dbc,"CREATE TABLE IF NOT EXISTS `courses` (
  `id` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(5000) NOT NULL,
  `credithours` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
");

mysqli_query($dbc,"INSERT INTO `courses` (`id`, `name`, `description`, `credithours`) VALUES
('CHEM542', 'Polymer Characterization and Analysis', 'Overview of various characterization and analysis techniques in polymer science and technology such as thermal analysis, mechanical property measurements, chromatographic separations, techniques for the determination of molecular weights and chemical analysis of polymer additive in polymer research, product development, quality control and degradation studies. A general discussion on industrial problem solvgin using multiple characterization techniques. 3-0-3', 3),
('CHEM635', 'Heterocyclic chemistry', 'Of the vast array of structures which organic compounds adopt, many contain ring systems as a component. When the ring is made up of carbon and at least one other element, the compound is classified as a heterocycle. The aims of this course are to identify the effects that the presence of such ring systems have on the chemistry of a molecule; to show how the rings can be made, and to describe some of the uses of the compounds in organic synthesis, in medicine and in other contexts. The chemistry of aromatic five-, six- and seven-membered ring compounds with one or more nitrogen, oxygen and/or sulfur atoms will be emphasized. Prerequisite: CHEM 531. 3-0-3', 3),
('CS422', 'Data Mining', 'This course will provide an introductory look at concepts and techniques in the field of data mining. After covering the introduction and terminologies to Data Mining, the techniques used to explore the large quantities of data for the discovery of meaningful rules and knowledge such as market basket analysis, nearest neighbor, decision trees, and clustering are covered. The students learn the material by implementing different techniques throughout the semester. Prerequisites: CS 331, CS 401, or CS 403. 3-0-3 (C) (T)', 3),
('CS511', ' Topics in Computer Graphics', 'Covers advanced topics in computer graphics. The exact course contents may change based on recent advances in the area and the instructor teaching it. Possible topics include: Geometric modeling, Subdivision surfaces, Procedural modeling, Warping and morphing, Model reconstruction, Image based rendering, Lighting and appearance,Texturing, Natural phenomena, Nonphotorealistic rendering Particle systems, Character animation, Physically based modeling and animation. Prerequisite: CS 411. 3-0-3', 3),
('CS548', 'Broadband Networks', 'The course studies the architectures, interfaces, protocols, technologies, products and services for broadband (high-speed) multimedia networks. The key principles of the protocols and technologies used for representative network elements and types of broadband network are studied. Specifically, cable modems, Digital Subscriber Lines, Power Lines, wireless 802.16 (WiMax), and broadband cellular Internet are covered for broadband access; for broadband Local Area Networks (LANs), Gigabit Ethernet, Virtual LANs and wireless LANs (802.11 WiFi and Bluetooth) are discussed; for broadband Wide Area Networks (WANs) the topics covered include optical networks (SONET/SDH,DWDM, optical network nodes, optical network nodes, optical switching technologies), frame-relay, ATM, wire-speed routers, IP switching, and MPLS. Also, quality of service issues in broadband networks and a view of the convergence of technologies in broadband networks are covered. Prerequisite: CS 455. 3-0-3', 3),
('MATH347', 'Probability and Statistics for Electrical and Computer Engineers', 'This course focuses on the introductory treatment of probability theory including: axioms of probability, discrete an continuous random variables, random vectors, marginal, joint, conditional and cumulative probability distributions, moment generating functions, expectations, and correlations. Also covered are sums of random variables, central limit theorem, sample means, and parameter estimation. Furthermore, random processes and random signals are covered. Examples and applications are drawn from problems of importance to electrical and computer engineers. (3-0-3) Prerequisites: MATH 251.', 3),
('MATH522', 'Mathematical Modeling', 'This course provides a systematic approach to modeling and analysis of physical processes. For specific applications, relevant differential equations are derived from basic principles, for example from conservation laws and constitutive equations. Dimensional analysis and scaling are introduced to prepare a model for analysis. Analytic solution techniques, such as integral transforms and similarity variable techniques, or approximate methods, such as asymptotic and perturbation methods, are presented and applied to the models. A broad range of applications from areas such as physics, engineering, biology, and chemistry are studied. (3-0-3) (C) Credit may not be granted for both MATH 486 and MATH 522. Prerequisites: MATH 461', 3),
('MATH582', 'Mathematical Finance', 'This course is a continuation of Math 485/548. It introduces the student tomodern continuous time mathematical finance. The major objective of the course is to present main mathematical methodologies and models underlying the area of financial engineering, and, in particular, those that provide a formal analytical basis for valuation and hedging of financial securities. (3-0-3) Prerequisites: MATH 485/548; MATH 481/542, or consent of the instructor.', 3),
('PHY420', 'Bio NanoTechnology', 'In this multidisciplinary course, we will examine the basic science behind nanotechnology and how it has infused itself into areas of nanofabrication, biomaterials, and molecular medicine. This course will cover materials considered basic building blocks of nanodevices such as organic molecules, carbon nanotubes, and quantum dots. Top-down and bottom-up assembly processes such as thin film patterrning through advanced lithography methods, self-assembly of molecular structures, and biological systems will be discussed. Students will also learn how bionanotechnology applies to modern medicine, including diagnostics and imaging and nanoscale, as well as targeted, nanotherapy and finally nanosurgery. 3-0-3', 3),
('PHYS240', 'Computational Science', 'This course provides an overview of introductory general physics in a computer laboratory setting. Euler-Newton method for solving differential equations, the trapezoidal rule for numerical quadrature and simple applications of random number generators. Computational projects include the study of periodic and chaotic motion, the motion of falling bodies and projectiles with air resistance, conservation of energy in mechanical and electrical systems, satellite motion, using random numbers to simulate radioactivity, the Monte Carlo method, and classical physical models for the hydrogen molecule and the helium atom. 2-3-3 (C)', 3);");

mysqli_query($dbc,"CREATE TABLE IF NOT EXISTS `enrollment` (
  `username` varchar(20) NOT NULL,
  `courseid` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
");

mysqli_query($dbc,"CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `enabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
");

mysqli_query($dbc,"INSERT INTO `modules` (`id`, `name`, `enabled`) VALUES
(1, 'course', 1),
(2, 'user', 1);
");

mysqli_query($dbc,"CREATE TABLE IF NOT EXISTS `settings` (
  `sitename` varchar(50) NOT NULL,
  `subtitle` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
");

mysqli_query($dbc,"INSERT INTO `settings` (`sitename`, `subtitle`) VALUES
('Safdar Institute of Technology', 'Shape your future');
");

mysqli_query($dbc,"CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
");


mysqli_query($dbc,"INSERT INTO `user` (`id`, `username`, `password`, `firstname`, `lastname`, `email`) VALUES
(1, 'user', '33831ae07f4d0976508748cd6b5441ce38da3235', 'Safdar', 'Matcheswala', 'smatches@hawk.iit.edu'),
(2, 'john', '6cf8fb666fe74226467678624ff6adae877dd615', 'John', 'Ceina', 'john123@mysite.com'),
(3, 'tom', '2c24679b6bb3ecb690690a491833d1f009993105', 'Tom', 'Kang', 'tomkang@site.com'),
(4, 'brad', '568a2364f4cdf947bb7ad27ce2e06c1f5d325cc3', 'Brad', 'Pitt', 'brad@email.com'),
(5, 'jason', 'd5a3431a7f5d02547d809d703a5afd36073d2251', 'Jason', 'Lambert', 'jlambert4@hawk.iit.edu');");

//after installation complete
		    echo '<h1>Installation Complete!</h1>';
			echo '<h1>Before proceeding, please delete folder named "install" from your website for security purposes.</h1>';
			echo '<h1>Go to admin page and edit your settings : <a href="../admin/index.php">Admin</a></h1>';
			echo '<h1>Username : admin</h1>';
			echo '<h1>Password : admin</h1>';

		}
	else
	{
		$error = mysqli_connect_error();
	}
	
	return array($dbc,$error);
}

install_database(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
?>