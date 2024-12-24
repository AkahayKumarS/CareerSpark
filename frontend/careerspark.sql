-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2024 at 04:35 AM
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
(16, 'Cloud Computing on AWS for Beginners', 'Cloud Computing', 'https://www.udemy.com/course/introduction-to-cloud-computing-on-amazon-aws-for-beginners/?couponCode=BFCPSALE24', 1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQfX2uP2oWlJn9ePl4Gyoy47pkn3Kn-3YYw4A&s', '2024-11-28 20:14:15', '2024-11-28 20:14:15', 'Udemy'),
(17, 'Complete C# Course – Beginner to Expert', 'Programming', 'https://www.udemy.com/course/complete-c-sharp-programming-course-beginner-to-expert/?utm_source=adwords&utm_medium=udemyads&utm_campaign=Search_DSA_Beta_Prof_la.EN_cc.India&campaigntype=Search&portfolio=India&language=EN&product=Course&test=&audience=DSA&', 1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSD8Dan4uLIUP-r30a5F3MceIF8rI3-NxofsQ&s', '2024-12-02 10:09:12', '2024-12-02 10:09:12', 'Udemy'),
(18, 'Problem Solving', 'Problem-Solving', 'https://www.coursera.org/learn/problemsolving', 0, 'https://pico-consulting.com/wp-content/uploads/2017/05/shutterstock_425335618-Problem-Solving-banner.png', '2024-12-05 12:28:27', '2024-12-05 12:33:34', 'Coursera'),
(19, 'Software Design and Architecture', 'Software Development', 'https://www.coursera.org/specializations/software-design-architecture', 1, 'https://cdn.educba.com/academy/wp-content/uploads/2020/03/Software-Design.jpg', '2024-12-05 12:40:35', '2024-12-05 12:40:35', 'Coursera');

-- --------------------------------------------------------

--
-- Table structure for table `job_roles`
--

CREATE TABLE `job_roles` (
  `id` int(11) NOT NULL,
  `job_role` varchar(255) NOT NULL,
  `required_skills` text NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_roles`
--

INSERT INTO `job_roles` (`id`, `job_role`, `required_skills`, `description`, `created_at`) VALUES
(1, 'Database Administrator', 'SQL, Database Management, Backup and Recovery, Data Modeling', 'Responsible for managing, securing, and ensuring the performance of databases.', '2024-12-04 11:10:55'),
(2, 'Hardware Engineer', 'Hardware Design, Troubleshooting, Computer Architecture, Circuit Design', 'Designs and tests hardware components like processors and memory.', '2024-12-04 11:10:55'),
(3, 'Application Support Engineer', 'Problem Solving, SQL, Software Debugging, Customer Support', 'Provides technical support for applications and resolves user issues.', '2024-12-04 11:10:55'),
(4, 'Cyber Security Specialist', 'Ethical Hacking, Network Security, Malware Analysis, Firewalls', 'Protects networks and systems from cyber threats and unauthorized access.', '2024-12-04 11:10:55'),
(5, 'Networking Engineer', 'Networking Protocols, Cisco Technologies, Troubleshooting, Firewall Management', 'Designs and maintains network infrastructure and ensures connectivity.', '2024-12-04 11:10:55'),
(6, 'Software Developer', 'Java, Python, Problem Solving, Software Design', 'Develops, tests, and maintains software applications.', '2024-12-04 11:10:55'),
(7, 'API Integration Specialist', 'API Development, REST API, Postman, JSON, Integration', 'Develops and integrates APIs for seamless communication between applications.', '2024-12-04 11:10:55'),
(8, 'Project Manager', 'Leadership, Planning, Agile Methodologies, Risk Management', 'Oversees project execution, manages teams, and ensures project success.', '2024-12-04 11:10:55'),
(9, 'Information Security Specialist', 'Network Security, Encryption, Vulnerability Assessment, Risk Management', 'Ensures data integrity and security within an organization.', '2024-12-04 11:10:55'),
(10, 'Technical Writer', 'Technical Writing, Research, Communication Skills, Editing', 'Creates user manuals, documentation, and guides for software and hardware.', '2024-12-04 11:10:55'),
(11, 'AI ML Specialist', 'Machine Learning, Python, TensorFlow, Deep Learning, Data Analysis', 'Builds and optimizes machine learning models and AI solutions.', '2024-12-04 11:10:55'),
(12, 'Software Tester', 'Manual Testing, Automation Testing, Selenium, Bug Reporting', 'Tests software to identify bugs and ensure quality assurance.', '2024-12-04 11:10:55'),
(13, 'Business Analyst', 'Requirement Analysis, Communication, Process Modeling, Documentation', 'Analyzes business needs and bridges gaps between stakeholders and technical teams.', '2024-12-04 11:10:55'),
(14, 'Customer Service Executive', 'Customer Support, Communication, CRM Tools, Problem Solving', 'Handles customer inquiries and ensures customer satisfaction.', '2024-12-04 11:10:55'),
(15, 'Data Scientist', 'Data Analysis, Python, R, Machine Learning, Big Data', 'Analyzes large data sets to extract insights and make data-driven decisions.', '2024-12-04 11:10:55'),
(16, 'Helpdesk Engineer', 'Troubleshooting, Customer Support, Technical Skills, Problem Solving', 'Provides IT support and resolves technical issues for end-users.', '2024-12-04 11:10:55'),
(17, 'Graphics Designer', 'Photoshop, Illustrator, Creativity, UX Design, Typography', 'Designs visual content for print and digital media.', '2024-12-04 11:10:55');

-- --------------------------------------------------------

--
-- Table structure for table `knowledge_network`
--

CREATE TABLE `knowledge_network` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `skills` text NOT NULL,
  `educational_requirements` text NOT NULL,
  `duties` text NOT NULL,
  `salary` varchar(255) NOT NULL,
  `companies` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `knowledge_network`
--

INSERT INTO `knowledge_network` (`id`, `title`, `description`, `skills`, `educational_requirements`, `duties`, `salary`, `companies`) VALUES
(8, 'Technical Writer', 'Technical Writers have the expertise to understand and communicate the technical aspects of a digital product to both highly technical and non-technical users. In a way, they act as a translator, providing users with the information that will resonate best with them based on their background.\r\n\r\nTechnical Writers are responsible for preparing instruction manuals and articles with the main goal to communicate complex, technical information more easily. They also develop, gather, and disseminate technical information among customers, designers, and manufacturers. Technical Writers are responsible for producing high-quality and understandable documentation with the goal to improve the success of products.\r\n', 'Based on our research, we identified the following core skills one must possess to get a job as a Technical Writer:\r\n \r\n1. Ability to translate highly technical information into easily understandable information for customers. \r\n2. Creative skills and usage of photographs, drawings, diagrams, animation, and charts that increase users\' understanding. \r\n3. Excellent written skills in English.\r\n4. Excellent communication and teamwork skills, including willingness and ability to consult with subject matter experts from engineering, support, and product management. \r\n5. Enjoys working as part of a team in a collaborative environment. \r\n6. Attention to detail with a creative eye.', 'A college degree is usually required for a position as a Technical Writer. In addition, knowledge of or experience with a technical subject, such as science or engineering, is beneficial. Employers generally prefer candidates who have a bachelor’s degree in English or another communications-related subject. Technical writing jobs may require candidates to have both a degree and knowledge of a technical field, such as engineering or computer science.', 'Technical writers create paper-based and digital operating instructions, how-to manuals, assembly instructions, and “frequently asked questions” pages to help technical support staff, consumers, and other users within a company or an industry.\r\n\r\n1. Write for a variety of audiences, from non-technical end users to programmers, system administrators, and integrators.\r\n2. Prepare, review, revise, and maintain technical documents, including software and systems engineering, system operations, testing, and user documentation.\r\n3. Gather and analyze technical and product information from various sources to document new or changing product functionality.\r\n4. Test both the product and its documentation for accuracy and consistency.\r\n5. Identify problem areas or structural deficiencies and proactively contribute to their improvement.\r\n6. Update existing documentation to reflect changes to functionality.\r\n', 'The national average salary for a Technical Writer is ₹5,99,007 in India.', '1. Oracle \r\n2. Wipro \r\n3. Cognizant \r\n4. Tata Consultancy Services \r\n5. Cisco \r\n6. Cyient \r\n7. Capgemini \r\n8. HCL Technologies'),
(9, 'Customer Service Executive', 'Customer Service Executive manages a team of representatives who will offer excellent customer service and after-sales support. Customer Service Execute creates policies and procedures and oversee the customer service provided by the team. The Customer Service Executive will be responsible for the selection of staff in the hiring process and ensure that a standardized level of service is maintained for all customers.\r\n\r\nA Customer Service Executive, display\'s excellent interpersonal and communication skills as well as a professional appearance. An outstanding Customer Service Executive should possess a proven track record of successful customer service and management skills.\r\n', '1. Excellent interpersonal and written and oral communication skills. \r\n2. Knowledge of CRM systems. \r\n3. Computer skills. \r\n4. The ability to run diagnostic tests and determine the causes of errors or problems. \r\n5. Keeping track of common issues and maintaining accurate reports are important abilities for these professionals.', 'Bachelor degree in business administration or any relevant field is required. MBA or any other master degree in management will help the candidates apply for a higher-level position.', '1. Managing a team of representatives offering customer support.\r\n2. Resolving customer complaints brought to your attention.\r\n3. Creating policies and procedures.\r\n4. Planning the training and standardization of service delivery.\r\n5. Conducting quality assurance surveys with customers and providing feedback to the staff.\r\n6. Possessing excellent product knowledge to enhance customer support.\r\n7. Maintaining a pleasant working environment for your team.\r\n', 'The average salary for a Customer Care Executive is Rs.209,450. For a fresher, the salary will be starting from Rs.180,000. Upon experience Customer Service Executive salary will range from Rs.220,000 - Rs.270,000 depending on the company.', '1. Amazon \r\n2. Dell Technologies \r\n3. HSBC \r\n4. Reliance Jio \r\n5. Tata communications \r\n6. Axis Bank \r\n7. Tech Mahindra Business Services Limited \r\n8. LG Electronics'),
(10, 'API Integration Specialist', 'The API Integration Specialist are the technical problem solver who will help the clients and partners integrate with their system. The ideal candidate should be comfortable with writing scripts, have a strong understanding of REST web-services, and be willing to specialize in the more technical nuts and bolts of our system and the Application Programming Interface (API). Beyond the technical skillset, someone who can communicate clearly both orally and in writing. The incumbent will be required to bridge the gap between business resources and the technology team and effectively communicate with internal and external clients.', '1. Proven track record in understanding an enterprise’s APIs and processes. \r\n2. Experience in using APIs and web services to integrate systems. \r\n3. Excellent verbal and written communication skills, strong troubleshooting, problem solving, and analytical ability required. \r\n4. Ability to understand and articulate technical concepts and derive solutions.\r\n5. Ability to deal with complex and challenging client issues. \r\n6. Capability to perform in a high pressure working environment.', 'Degree in Computer Science or Information Technology or Business Information Systems or 2 years working in a technical role with API.', '1. Field support calls and emails from developers and business users about account API integration and functionality.\r\n2. Assist customers, partners, vendors and others with all aspects of our API and its documentation.\r\n3. Assist non-technical users in potential outcomes that can be achieved using the API.\r\n4. Consult business professionals on ways to maximize our API by providing data to 3rd party integrations.\r\n5. Engage with product and development teams in software development discussions to create/improve our systems.\r\n6. Use the API to create test scenarios and scripts with expected outcomes for new integrations or expanded API use.\r\n7. Be able to identify problems, prioritize and arrive at possible solutions.\r\n8. Be the Subject Matter Expert for all things API, including integrations, documentation and use cases, etc.', 'The average salary for API Integration Specialist is Rs. 731,000 per annum', '1. Uber \r\n2. Barclays \r\n3. IBM \r\n4. Philips \r\n5. Larsenn and Tourbo Infotech Limited \r\n6. Oracle \r\n7. Bank of America'),
(12, 'AI/ML Specialists', 'An artificial intelligence (AI)/ Machine Learning (ML) specialist applies their skills in engineering and computer science to create machines and software programs that can think for themselves. Most often, they use AI principles to address persistent business pain points, augment the capability of technical and human resources, and execute a change management/transformation process. The key contribution of an AI specialist is using emerging technologies, such as machine learning (ML) and neuro-linguistic programming (NLP), to solve business problems in new and creative ways that provide greater insight, accuracy, and consistency.', '1. Programming skills needed \r\n2. Computer science fundamentals and programming \r\n3. Distributed computing \r\n4. Machine learning algorithms and libraries \r\n5. Software engineering and system design\r\n6. Strong knowledge of data', 'In order to get a job as an AI/ML Specialist a Bachleor or Master’s degree in computer science, mathematics or similar relevant field is a necessity.One have to master data structures (stacks, queues, multi-dimensional arrays, trees, graphs), algorithms (searching, sorting, optimization, dynamic programming), computability and complexity (P vs. NP, NP-complete problems, big-O notation, approximate algorithms), and computer architecture (memory, cache, bandwidth, deadlocks, distributed processing).One have to master coding languages, such as Python, C++, JavaScript, Java, C#, Julia, Shell, R, TypeScript.', 'A AI/ML Specialist produces a tailor-made solution for each problem. The only way to achieve optimal results is to carefully process the data and select the best algorithm for the given context.\r\n\r\n1. Understanding business objectives and developing models that help to achieve them, along with metrics to track their progress\r\n2. Understand company and client challenges and how integrating AI capabilities can help create solutions\r\n3. Develop machine learning applications according to requirements\r\n4. Select appropriate datasets and data representation methods\r\n5. Analyze and explain AI and machine learning (ML) solutions while setting and maintaining high ethical standards\r\n6. Designing machine learning systems and self-running artificial intelligence (AI) software to automate predictive models.', 'According to online sources, the entry-level Artificial Intelligence/ Machine Learning salary in India for almost 40% of professionals earn around Rs. 6,00,000, mid-level and senior-level artificial intelligence salary could earn more than Rs. 50,00,000 i', '1. Microsoft \r\n2. Google \r\n3. Nokia \r\n4. JP Morgan \r\n5. Cisco \r\n6. Amazon \r\n7. Apple \r\n8. IBM');

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
(5, 16, 'A motivated engineering student passionate about technology and innovation and a passionate artist.', '../uploads/profile_pictures/Akshaya_Kumar_S-Photoroom.png', 'Kundapura Taluk, Udupi Distraict, Karnataka', 'St. Joseph Engineering College, Mangaluru', 'Bachelor of Engineering in Computer Science', 'https://github.com/AkahayKumarS', 'https://www.linkedin.com/in/akshaya-kumar-s/', 'C, Java, Python, HTML, CSS, JavaScript, PHP, SQL, ReactJS, NodeJS, Bootsrap, Tailwind CSS, REST API, Postman', 'Drawing, Painting and Clay Modeling', '2024-12-05 12:41:16'),
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
(22, 'Ajith Kumar', 'akshaykumars@gmail.com', '$2y$10$pozGZ9183HeaKORkAKemSusbZ5Qcs11qvx93k8ND1W59FjZGMuJ76', '2024-11-27 13:34:42', 'student'),
(23, 'Abhi', 'abhi@gmail.com', '$2y$10$4nCQcq14Z2EAHdpwTBEwGuOrBVo/NFVRq5DkD6Y7aV03jOPHYw1MC', '2024-12-02 05:55:42', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_roles`
--
ALTER TABLE `job_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `knowledge_network`
--
ALTER TABLE `knowledge_network`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `job_roles`
--
ALTER TABLE `job_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `knowledge_network`
--
ALTER TABLE `knowledge_network`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `student_profiles`
--
ALTER TABLE `student_profiles`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student_profiles`
--
ALTER TABLE `student_profiles`
  ADD CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
