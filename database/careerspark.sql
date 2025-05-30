-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2025 at 03:28 PM
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
  `course_provider` varchar(255) NOT NULL,
  `duration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `category`, `course_link`, `is_premium`, `course_image`, `created_at`, `updated_at`, `course_provider`, `duration`) VALUES
(11, 'Python Programming', 'Programming', 'https://www.coursera.org/specializations/python-3-programming', 0, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRYbsJFulTRg3kb36fs2oHH0rDX5C0uJ6HBDQ&s', '2024-11-27 07:55:26', '2024-12-25 08:57:31', 'Coursera', 5),
(12, 'Full Stack web development', 'Web development', 'https://www.coursera.org/professional-certificates/ibm-full-stack-cloud-developer', 1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSiEjBilP-PBEbL7NAsVh5jU2PEYPgaGhh8-g&s', '2024-11-27 08:57:18', '2024-12-25 08:58:20', 'Coursera', 12),
(13, 'Java Full Stack', 'Web development', 'https://www.udemy.com/course/full-stack-java-developer-java/?utm_source=adwords&utm_medium=udemyads&utm_campaign=Search_DSA_GammaCatchall_NonP_la.EN_cc.India&campaigntype=Search&portfolio=India&language=EN&product=Course&test=&audience=DSA&topic=&priority', 0, 'https://www.achieversit.com/management/uploads/course_image/Java-Full-Stack_(1).png', '2024-11-27 09:02:29', '2024-12-25 08:58:41', 'Udemy', 12),
(14, 'Coding for Everyone: C and C++', 'Programming', 'https://www.coursera.org/specializations/coding-for-everyone', 1, 'https://media.geeksforgeeks.org/wp-content/uploads/20230629144356/Best-CPP-Courses-with-Certificates.png', '2024-11-28 18:36:53', '2024-12-25 08:58:58', 'Coursera', 6),
(15, 'React - The Complete Guide 2024', 'Web Development', 'https://www.udemy.com/course/react-the-complete-guide-incl-redux/?couponCode=BFCPSALE24', 1, 'https://courses.tutorialswebsite.com/assets/front/img/category/reactjs-banner.jpeg', '2024-11-28 19:45:17', '2024-12-12 06:23:54', 'Udemy', 4),
(16, 'Cloud Computing on AWS for Beginners', 'Cloud Computing', 'https://www.udemy.com/course/introduction-to-cloud-computing-on-amazon-aws-for-beginners/?couponCode=BFCPSALE24', 1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQfX2uP2oWlJn9ePl4Gyoy47pkn3Kn-3YYw4A&s', '2024-11-28 20:14:15', '2024-12-12 06:24:04', 'Udemy', 5),
(17, 'Complete C# Course – Beginner to Expert', 'Programming', 'https://www.udemy.com/course/complete-c-sharp-programming-course-beginner-to-expert/?utm_source=adwords&utm_medium=udemyads&utm_campaign=Search_DSA_Beta_Prof_la.EN_cc.India&campaigntype=Search&portfolio=India&language=EN&product=Course&test=&audience=DSA&', 1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSD8Dan4uLIUP-r30a5F3MceIF8rI3-NxofsQ&s', '2024-12-02 10:09:12', '2024-12-12 06:24:15', 'Udemy', 4),
(18, 'Problem Solving', 'Problem-Solving', 'https://www.coursera.org/learn/problemsolving', 0, 'https://pico-consulting.com/wp-content/uploads/2017/05/shutterstock_425335618-Problem-Solving-banner.png', '2024-12-05 12:28:27', '2024-12-12 06:24:36', 'Coursera', 2),
(19, 'Software Design and Architecture', 'Software Development', 'https://www.coursera.org/specializations/software-design-architecture', 0, 'https://cdn.educba.com/academy/wp-content/uploads/2020/03/Software-Design.jpg', '2024-12-05 12:40:35', '2024-12-28 06:57:12', 'Coursera', 3),
(21, 'SQL Tutorial', 'Web development', 'https://www.w3schools.com/sql/', 0, 'https://www.vagdevitechnologies.com/wp-content/uploads/2022/11/Learn-SQL-Online-Courses.png', '2024-12-08 12:49:17', '2024-12-08 12:53:00', 'W3 Schools', 4),
(22, 'API Development', 'Web Development', 'https://www.coursera.org/learn/codio-api-development', 0, 'https://d3njjcbhbojbot.cloudfront.net/api/utilities/v1/imageproxy/https://s3.amazonaws.com/coursera-course-photos/dd/a9057ecc6e4f09a4a5d8d2ed8fd927/iconapi.png?auto=format%2Ccompress%2C%20enhance&dpr=2&w=265&h=216&q=50&fit=crop', '2024-12-10 16:26:21', '2024-12-10 16:26:21', 'Coursera', 3),
(23, 'JSON - Introduction', 'Web Development', 'https://www.w3schools.com/js/js_json_intro.asp', 0, 'https://i.ytimg.com/vi/6I3qMe-jXDs/hqdefault.jpg', '2024-12-10 16:28:55', '2024-12-10 16:45:33', 'W3 Schools', 2),
(24, 'Integration Developer Certification', 'Software Development', 'https://academy.workato.com/integration-developer-certification', 1, 'https://cc.sj-cdn.net/instructor/9vaaj1fob32o-workato-training-certification/courses/1ns1yedn6gv6p/promo-image.1689106210.png', '2024-12-10 16:32:53', '2024-12-10 16:32:53', 'Workato', 3),
(25, 'Databases and SQL for Data Science with Python', 'Database Management', 'https://www.coursera.org/learn/sql-data-science', 0, 'https://www.europe.study/images/subjects/python/sql-data-science-with-python.jpg', '2024-12-24 17:29:55', '2024-12-30 13:20:48', 'Coursera', 1),
(26, 'FPGA Embedded Design', 'Hardware Engineering', 'https://www.udemy.com/course/fpga-embedded-design-verilog/?couponCode=IND21PM', 1, 'https://image.slidesharecdn.com/course-180606133831/85/Short-course-on-FPGA-programming-1-320.jpg', '2024-12-24 17:43:19', '2024-12-25 14:32:13', 'Udemy', 5),
(27, 'Networking Protocols (CCENT/CCNA and CompTIA Network+ prep)', 'Cyber Security', 'https://www.udemy.com/course/networking-protocols-ccent-ccna-comptianetworkplus-prepcourse/?utm_source=adwords&utm_medium=udemyads&utm_campaign=Search_DSA_GammaCatchall_NonP_la.EN_cc.India&campaigntype=Search&portfolio=India&language=EN&product=Course&tes', 1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQNa93zaCE_T8LCU3G9frARd3uDt3lsBlRTiw&s', '2024-12-24 17:49:09', '2024-12-25 14:32:31', 'Udemy', 3),
(28, 'Cisco CCNA 200-301: The Complete Guide to Getting Certified', 'Cyber Security', 'https://www.coursera.org/specializations/packt-cisco-ccna-200-301-the-complete-guide-to-getting-certified', 1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSVVXGCkqphLbk7MAUthw5OD9tyz1Jd_5R1GOs-2os&s=0', '2024-12-24 17:53:35', '2024-12-25 14:32:46', 'Coursera', 6),
(29, 'Ethical Hacking', 'Cyber Security', 'https://onlinecourses.nptel.ac.in/noc22_cs13/preview', 0, 'https://vinsys.com/static/media/uploads/2022/02/Best-Ethical-Hacking-Certification-Courses-in-2022.jpg', '2024-12-24 17:57:12', '2024-12-25 14:32:58', 'NPTEL', 12),
(30, 'Java', 'Software Development', 'https://www.coursera.org/learn/java-introduction', 0, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQdCl4zZrcB7kwwZWw7pPXlT2QoFj43IzPcXA&s', '2024-12-24 18:34:13', '2024-12-25 14:33:26', 'Coursera', 2),
(31, 'Docker for Beginners', 'Software Development', 'https://www.coursera.org/learn/docker-for-the-absolute-beginner', 0, 'https://d3njjcbhbojbot.cloudfront.net/api/utilities/v1/imageproxy/https://s3.amazonaws.com/coursera-course-photos/be/f2467688764f5b9482f701b5608eb5/Docker-Training-Course-For-Absolute-Beginners.png?auto=format%2Ccompress%2C%20enhance&dpr=1&w=265&h=216&fit', '2024-12-24 18:37:09', '2024-12-25 14:34:00', 'Coursera', 3),
(32, 'Hardware Design Course', 'Hardware Designing', 'https://www.udemy.com/course/mixed_signal_course_esteempcb/?srsltid=AfmBOopEnivaCeL3HT-HG67_a5raCJs-9fyrUpHTEEttFO5QKnx7M42a&couponCode=IND21PM', 1, 'https://cdn.mindmajix.com/courses/hardware-design-and-development-training.png', '2024-12-24 18:41:38', '2024-12-25 14:35:31', 'Udemy', 2),
(33, 'Circuits and PCB Design', 'Hardware Designing', 'https://onlinecourses.nptel.ac.in/noc24_ee127/preview', 0, 'https://5.imimg.com/data5/SELLER/Default/2022/7/QG/MK/AI/8956518/pcb-circuit-design-course.jpg', '2024-12-24 18:45:51', '2024-12-25 14:35:48', 'NPTEL', 12),
(34, 'Python', 'Software Development', 'https://www.coursera.org/specializations/python?utm_medium=sem&utm_source=gg&utm_campaign=b2c_india_python_umich_ftcof_specializations_cx_dr_bau_gg_sem_hyb_in_all_m_hyb_24-04_x&campaignid=21151281836&adgroupid=164206015567&device=c&keyword=python%20course', 1, 'https://www.etudemy.com/wp-content/uploads/2022/01/Computer-Courses-in-Perinthalmanna-python-Copy.jpg', '2024-12-24 18:51:38', '2024-12-25 14:36:11', 'Coursera', 8),
(35, 'Software Manual Testing', 'Software Testing', 'https://www.udemy.com/course/software-manual-testing-course/?utm_source=adwords&utm_medium=udemyads&utm_campaign=Search_DSA_GammaCatchall_NonP_la.EN_cc.India&campaigntype=Search&portfolio=India&language=EN&product=Course&test=&audience=DSA&topic=&priority', 1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSQH_oe0q4Nkl1qnArtKrcS0DEa1Svwnl46Rw&s', '2024-12-24 19:58:47', '2024-12-25 14:34:36', 'Udemy', 2),
(36, 'Selenium', 'Software Testing', 'https://www.udemy.com/course/learn-selenium-automation-in-easy-python-language/?couponCode=IND21PM', 1, 'https://www.slaconsultantsindia.com/wp_files/wp-content/uploads/2018/05/Join-a-Respectable-Selenium-Training-Institute-to-Become-a-Professional-Software-Tester-880x618.jpg', '2024-12-24 20:02:29', '2024-12-25 14:36:31', 'Udemy', 1),
(37, 'Learn Jira with real-world examples', 'Software Testing', 'https://www.udemy.com/course/the-complete-guide-to-jira-with-real-world-examples/?couponCode=IND21PM', 1, 'https://www.sipexe.com/assets/courses/Jira_testing.jpg', '2024-12-24 20:04:39', '2024-12-25 14:36:48', 'Udemy', 1),
(38, 'Cypress', 'Software Testing', 'https://www.udemy.com/course/cypress-tutorial/?couponCode=IND21PM', 1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThBp_W0D6XLRZwO-R9jkf_MtOkM9H7hlT2UQ&s', '2024-12-24 20:06:32', '2024-12-25 14:37:04', 'Udemy', 2),
(39, 'Adobe Photoshop', 'Graphics Designing', 'https://www.udemy.com/course/adobe-photoshop-course/?couponCode=IND21PM', 1, 'https://img-c.udemycdn.com/course/480x270/5346430_f677.jpg', '2024-12-24 20:10:20', '2024-12-25 14:37:23', 'Udemy', 4),
(40, 'Illustrator MasterClass', 'Graphics Designing', 'https://www.udemy.com/course/illustrator-cc-masterclass/?couponCode=IND21PM', 1, 'https://img-c.udemycdn.com/course/750x422/5182936_0106_2.jpg', '2024-12-24 20:12:16', '2024-12-25 14:37:36', 'Udemy', 3),
(41, 'Learn 3D Modelling', 'Graphics Designing', 'https://www.udemy.com/course/blendertutorial/?couponCode=IND21PM', 1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQOl-hgXTXFFNko-qu0sPR7VP0Wge-hQJqhWg&s', '2024-12-24 20:16:22', '2024-12-25 14:37:55', 'Udemy', 4),
(42, 'Troubleshooting and Debugging Techniques', 'Helpdesk Engineering', 'https://www.coursera.org/learn/troubleshooting-debugging-techniques', 0, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTz7KDigiY-v3MmA6T6gbr-dK8ZfyEmauZmgg&s', '2024-12-24 20:19:51', '2024-12-25 14:38:21', 'Coursera', 1),
(43, 'Introduction to Customer Service', 'Helpdesk Engineering', 'https://www.coursera.org/learn/introduction-to-customer-service', 0, 'https://www.hubspot.com/hs-fs/hubfs/CS%20Training.jpg?width=595&height=400&name=CS%20Training.jpg', '2024-12-24 20:22:27', '2024-12-25 14:38:34', 'Coursera', 2),
(44, 'Introduction to MongoDB', 'Database Management', 'https://www.coursera.org/learn/introduction-to-mongodb', 0, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSOgUAeSr_szHDWRt-wFPuyB34pbxzJcon3Pg&s', '2024-12-25 06:49:11', '2024-12-25 14:38:50', 'Coursera', 3),
(45, 'Introduction to Git and GitHub', 'Software Development', 'https://www.coursera.org/learn/introduction-git-github', 0, 'https://www.filepicker.io/api/file/tsmP4fdkSmKaiez6t2jl', '2024-12-25 06:52:48', '2024-12-25 14:39:21', 'Coursera', 3),
(46, 'APIs', 'API Integration', 'https://www.coursera.org/learn/apis', 0, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRE9Qm8SFaazzUISjUjgHT_cYVcD0YCDAgFGA&s', '2024-12-25 06:55:17', '2024-12-25 14:39:36', 'Coursera', 3),
(47, 'Developing APIs with Google Cloud\'s Apigee API Platform Specialization', 'API Integration', 'https://www.coursera.org/specializations/apigee-api-gcp', 0, 'https://www.xenonstack.com/hubfs/xenonstack-api-development-best-practices.png', '2024-12-25 06:57:23', '2024-12-25 14:39:53', 'Coursera', 4),
(48, 'RESTful APIs Using Node.js and MongoDB', 'API Integration', 'https://www.coursera.org/learn/building-restful-apis-using-nodejs-and-express', 0, 'https://courses.tutorialswebsite.com/assets/front/img/category/nodejs-rest-api-courses11.jpeg', '2024-12-25 07:00:03', '2024-12-25 14:40:02', 'Coursera', 3),
(49, 'OAuth 2.0 in Spring Boot Applications', 'API Integration', 'https://www.udemy.com/course/oauth2-in-spring-boot-applications/?couponCode=LEARNNOWPLANS', 1, 'https://img-c.udemycdn.com/course/750x422/3219295_581d_3.jpg', '2024-12-25 07:30:00', '2024-12-25 14:40:15', 'Udemy', 2),
(50, 'Network Security', 'Cyber Security', 'https://www.coursera.org/learn/network-security', 0, 'https://d3f1iyfxxz8i1e.cloudfront.net/courses/course_image/73e7b3f18ea9.jpeg', '2024-12-25 07:32:48', '2024-12-25 14:40:29', 'Coursera', 3),
(51, 'Penetration Testing, Threat Hunting, and Cryptography', 'Cyber Security', 'https://www.coursera.org/learn/ibm-penetration-testing-threat-hunting-cryptography', 0, 'https://images.www.talentlms.com/library/wp-content/uploads/penetration-testing-online-training-course-thumb.jpg', '2024-12-25 07:35:47', '2024-12-25 14:40:39', 'Coursera', 2),
(52, 'Introduction to CRM with HubSpot', 'Helpdesk Engineering', 'https://www.coursera.org/projects/introduction-to-crm-with-hubspot', 0, 'https://dtmvamahs40ux.cloudfront.net/gl-academy/course/course-1032-CRM.jpg', '2024-12-25 07:38:14', '2024-12-25 14:40:50', 'Coursera', 1),
(53, 'Supervised Machine Learning: Regression and Classification', 'Software Development', 'https://www.coursera.org/learn/machine-learning', 0, 'https://www.fsm.ac.in/blog/wp-content/uploads/2022/08/ml-e1610553826718.jpg', '2024-12-25 08:51:53', '2024-12-25 14:41:09', 'Coursera', 6),
(54, 'After Effects CC Masters: VFX, Motion Graphics, Animation+', 'Graphics Designing', 'https://www.udemy.com/course/after-effects-cc/?utm_source=adwords&utm_medium=udemyads&utm_campaign=Search_Keyword_Beta_Prof_la.EN_cc.India&campaigntype=Search&portfolio=India&language=EN&product=Course&test=&audience=Keyword&topic=Digital_Compositing&prio', 0, 'https://www.classcentral.com/report/wp-content/uploads/2022/10/Adobe-After-Effects-BCG-Banner.png', '2024-12-25 08:54:23', '2024-12-25 14:41:34', 'Udemy', 5),
(55, 'Leadership Skills', 'Project Management', 'https://www.coursera.org/learn/leadershipskills?utm_medium=sem&utm_source=gg&utm_campaign=b2c_india_leadershipskills_iima_ftcof_learn_arte_may-23_dr_sem_rsa_gads_lg-all&campaignid=20041645334&adgroupid=168762168624&device=c&keyword=leadership%20qualities%', 0, 'https://www.efrontlearning.com/blog/wp-content/uploads/2021/01/eFront_20210125_1200x628.png', '2024-12-25 09:01:59', '2024-12-25 14:41:54', 'Coursera', 6),
(57, 'Agile Project Management: Agile, Scrum, Kanban & XP', 'Project Management', 'https://www.udemy.com/course/agile-project-management-genman/?couponCode=IND21PM', 1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTARGWOay_5yJK2PiuVR9_ZeScV2UDlWfyI2w&s', '2024-12-25 09:04:50', '2024-12-25 14:42:04', 'Udemy', 3),
(58, 'The Ultimate Project Management PMP Prep Course', 'Project Management', 'https://www.udemy.com/course/ultimate-project-management-pmp-35-pdus/?utm_source=adwords&utm_medium=udemyads&utm_campaign=Search_Keyword_Beta_Prof_la.EN_cc.India&campaigntype=Search&portfolio=India&language=EN&product=Course&test=&audience=Keyword&topic=P', 1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQyZsId2GmxxPbReit-OJqIJsITbzxHL3xUCA&s', '2024-12-25 09:07:01', '2024-12-25 14:42:14', 'Udemy', 3),
(59, 'PL/SQL Bootcamp', 'Database Management', 'https://www.udemy.com/course/plsql-beginner-to-advanced-become-a-perfect-plsql-developer/?couponCode=LEARNNOWPLANS', 1, 'https://img-c.udemycdn.com/course/480x270/1312466_8faf_11.jpg', '2024-12-25 16:38:35', '2024-12-25 16:38:35', 'Udemy', 5),
(60, 'TensorFlow for Deep Learning with Python', 'AIML', 'https://www.udemy.com/course/complete-guide-to-tensorflow-for-deep-learning-with-python/?couponCode=LEARNNOWPLANS', 1, 'https://img-c.udemycdn.com/course/480x270/1326292_4dcf.jpg', '2024-12-25 16:42:22', '2024-12-25 16:42:22', 'Udemy', 3),
(61, 'Certified NLP Practitioner', 'AIML', 'https://www.udemy.com/course/nlp-practitioner-neuro-linguistic-programming-certification-abnlp/?utm_source=adwords&utm_medium=udemyads&utm_campaign=Search_Keyword_Beta_Prof_la.EN_cc.India&campaigntype=Search&portfolio=India&language=EN&product=Course&test', 1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQGP8_boeFtawcTfJE4T1uZ_GVL3M2c8EGpMg&s', '2024-12-25 16:43:55', '2024-12-25 16:43:55', 'Udemy', 3),
(62, 'Business Analysis: Developing Requirements', 'Business Analytics', 'https://www.udemy.com/course/developing-requirements/?utm_source=adwords&utm_medium=udemyads&utm_campaign=Search_DSA_Beta_Prof_la.EN_cc.India&campaigntype=Search&portfolio=India&language=EN&product=Course&test=&audience=DSA&topic=&priority=Beta&utm_conten', 1, 'https://cdn.mindmajix.com/courses/business-analyst-training.png', '2024-12-25 16:46:12', '2024-12-30 13:16:40', 'Udemy', 1),
(63, 'Communication Skills', 'Business Analytics', 'https://www.udemy.com/course/the-complete-communication-skills-master-class-for-life/?couponCode=IND21PM', 1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSJHWlOJWHAD_ch9g4jsXJCc8MKJK3preAzGg&s', '2024-12-25 16:48:11', '2024-12-25 16:48:11', 'Udemy', 4),
(64, 'Tableau Business Intelligence Analyst Professional Certificate', 'Business Analytics', 'https://www.coursera.org/professional-certificates/tableau-business-intelligence-analyst', 0, 'https://aictech.co.in/assets/front/img/courses/647f1ec7aed9e.png', '2024-12-25 16:50:12', '2024-12-25 16:50:12', 'Coursera', 8),
(65, 'Cryptography I', 'Cyber Security', 'https://www.coursera.org/courses?query=cryptography', 0, 'https://img-c.udemycdn.com/course/480x270/6206543_704f.jpg', '2024-12-25 16:54:29', '2024-12-25 16:54:29', 'Coursera', 3),
(66, 'Cyber Incident Response Specialization', 'Cyber Security', 'https://www.coursera.org/specializations/cyber-incident-response', 0, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQg-LDLLI2uwJmFsgZN9K_cKnemHZn9lbsMzQ&s', '2024-12-25 16:55:53', '2024-12-25 16:55:53', 'Coursera', 1),
(67, 'Introduction to Technical Writing', 'Technical Writing', 'https://www.coursera.org/learn/technical-writing-introduction', 0, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT7JeFbOBy9dq638jitbFyJ0DNFAxlI0nkj9g&s', '2024-12-25 16:59:16', '2024-12-25 16:59:16', 'Coursera', 3),
(68, 'Learn Markdown', 'Technical Writing', 'https://www.coursera.org/learn/learn-markdown', 0, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSYOjJDSbefZWthZUwPRRY-UfxDF7R1kN9gAQ&s', '2024-12-25 17:03:47', '2024-12-25 17:03:47', 'Coursera', 1),
(69, 'API Documentation', 'Technical Writing', 'https://www.udemy.com/course/the-art-of-api-documentation/?utm_source=adwords&utm_medium=udemyads&utm_campaign=Search_DSA_Beta_Prof_la.EN_cc.India&campaigntype=Search&portfolio=India&language=EN&product=Course&test=&audience=DSA&topic=&priority=Beta&utm_c', 1, 'https://images.shiksha.com/mediadata/images/articles/1712649223phpqvuW40.jpeg', '2024-12-25 17:06:50', '2024-12-25 17:06:50', 'Udemy', 1),
(70, 'Active Directory & Group Policy Lab', 'Helpdesk Engineering', 'https://www.udemy.com/course/active-directory-group-policy-2012/?utm_source=adwords&utm_medium=udemyads&utm_campaign=Search_Keyword_Beta_Prof_la.EN_cc.India&campaigntype=Search&portfolio=India&language=EN&product=Course&test=&audience=Keyword&topic=Active', 1, 'https://academy.hackthebox.com/storage/modules/74/logo.png', '2024-12-25 17:08:29', '2024-12-25 17:08:29', 'Udemy', 3),
(71, 'Google BigQuery & PostgreSQL', 'Data Analysis', 'https://www.udemy.com/course/google-bigquery-and-postgresql-sql-for-data-analysis/?couponCode=IND21PM', 1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRGgRn3Es_9EokT2lGs9dyyqBQltgzH5I991w&s', '2024-12-25 17:10:59', '2024-12-30 13:19:30', 'Udemy', 4),
(72, 'The Data Analyst Course', 'Data Analysis', 'https://www.udemy.com/course/the-data-analyst-course-complete-data-analyst-bootcamp/?utm_source=adwords&utm_medium=udemyads&utm_campaign=Search_Keyword_Beta_Prof_la.EN_cc.India&campaigntype=Search&portfolio=India&language=EN&product=Course&test=&audience=', 1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLRsxOsuM0gRtl4jFeKfo3VSozT1X3dt4POg&s', '2024-12-25 17:13:19', '2024-12-25 17:13:19', 'Udemy', 5);

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
(1, 'Frontend Developer', 'HTML, CSS, JavaScript, React, UI/UX Design, Responsive Design', 'Builds and maintains the user interface of websites and web apps, ensuring a seamless user experience.', '2025-04-18 10:51:48'),
(2, 'Backend Developer', 'Node.js, Python, Java, Databases, REST APIs, Authentication, Security', 'Develops server-side logic, database interactions, and APIs that power web and mobile applications.', '2025-04-18 10:51:48'),
(3, 'Full Stack Developer', 'Frontend & Backend Development, Databases, DevOps, APIs, JavaScript, Python', 'Handles both frontend and backend development to create fully functional web applications.', '2025-04-18 10:51:48'),
(4, 'Mobile App Developer', 'Android, iOS, Flutter, React Native, UI/UX, APIs, Mobile Security', 'Designs and develops mobile applications for Android and iOS platforms.', '2025-04-18 10:51:48'),
(5, 'AI/ML Engineer', 'Machine Learning, Deep Learning, Python, Data Science, TensorFlow, Scikit-Learn', 'Builds intelligent systems that can learn from data and make predictions or decisions.', '2025-04-18 10:51:48'),
(6, 'Cybersecurity Analyst', 'Network Security, Ethical Hacking, Risk Assessment, Firewalls, Cryptography', 'Protects systems and networks from cyber threats and vulnerabilities.', '2025-04-18 10:51:48'),
(7, 'Blockchain Developer', 'Blockchain Fundamentals, Solidity, Ethereum, Smart Contracts, Web3.js', 'Develops decentralized applications and smart contracts on blockchain platforms.', '2025-04-18 10:51:48'),
(8, 'Cloud Architect', 'Cloud Platforms, AWS, Azure, GCP, Docker, Kubernetes, DevOps, CI/CD', 'Designs scalable and secure cloud infrastructure solutions for organizations.', '2025-04-18 10:51:48'),
(9, 'AR/VR Developer', 'Unity, Unreal Engine, 3D Modeling, C#, XR Development, Game Engines', 'Creates augmented and virtual reality experiences using 3D engines and immersive tech.', '2025-04-18 10:51:48'),
(10, 'Computer Vision Engineer', 'OpenCV, Image Processing, Deep Learning, Python, TensorFlow, AI', 'Builds systems that can interpret and understand visual information from the world.', '2025-04-18 10:51:48'),
(11, 'NLP Engineer', 'Natural Language Processing, Transformers, Text Mining, BERT, Python, AI', 'Develops applications that understand, interpret, and generate human language using AI.', '2025-04-18 10:51:48');

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
(1, 'Frontend Developer', 'Frontend Developers are responsible for implementing visual elements that users see and interact with in a web application. They work closely with designers to ensure that the user interface is both functional and aesthetically pleasing.', '1. Proficiency in HTML, CSS, and JavaScript\r\n2. Experience with frontend frameworks like React, Angular, or Vue.js\r\n3. Understanding of responsive and adaptive design principles\r\n4. Knowledge of version control systems like Git\r\n5. Familiarity with browser testing and debugging\r\n6. Good problem-solving and communication skills', '1. Bachelor\'s degree in Computer Science or related field\r\n2. Courses or certifications in web development\r\n3. Continuous learning to keep up with evolving technologies', '1. Develop new user-facing features\r\n2. Ensure the technical feasibility of UI/UX designs\r\n3. Optimize applications for maximum speed and scalability\r\n4. Collaborate with other team members and stakeholders\r\n5. Maintain and improve website', 'In India, the average salary for a Frontend Developer ranges from ₹4,00,000 to ₹10,00,000 per annum, depending on experience and location.', '1. Infosys\r\n2. Tata Consultancy Services (TCS)\r\n3. Wipro\r\n4. Accenture\r\n5. Cognizant\r\n6. IBM\r\n7. Capgemini\r\n8. Tech Mahindra'),
(2, 'Backend Developer', 'Backend Developers focus on server-side web application logic and integration. They write the web services and APIs used by frontend developers and mobile application developers.', '1. Proficiency in server-side languages like Java, Python, Ruby, PHP, or .Net\r\n\r\n2. Experience with database management systems like MySQL, PostgreSQL, or MongoDB\r\n\r\n3. Knowledge of RESTful API design and development\r\n\r\n4. Understanding of security and data protection\r\n\r\n5. Familiarity with version control tools like Git', '1. Bachelor\'s degree in Computer Science or related field\r\n\r\n2. Certifications in backend development technologies\r\n\r\n3. Hands-on experience through projects or internships', '1. Build and maintain web applications\r\n\r\n2. Develop and manage databases\r\n\r\n3. Integrate user-facing elements with server-side logic\r\n\r\n4. Ensure data security and compliance\r\n\r\n5. Optimize applications for speed and scalability', 'In India, Backend Developers earn between ₹5,00,000 and ₹12,00,000 per annum, based on experience and skill set.', '1. Infosys\r\n\r\n2. Tata Consultancy Services (TCS)\r\n\r\n3. Wipro\r\n\r\n4. Accenture\r\n\r\n5. Cognizant\r\n\r\n6. IBM\r\n\r\n7. Capgemini\r\n\r\n8. Tech Mahindra'),
(3, 'Full Stack Developer', 'Full Stack Developers are proficient in both frontend and backend development. They handle all aspects of web development, from designing user interfaces to managing databases and server-side logic.', 'Proficiency in HTML, CSS, JavaScript, and frontend frameworks\r\n\r\n1. Experience with backend languages like Node.js, Python, or Java\r\n\r\n2. Knowledge of database systems like MySQL, MongoDB\r\n\r\n3. Understanding of RESTful APIs and web services\r\n\r\n4. Familiarity with version control systems like Git\r\n\r\n5. Strong problem-solving and communication skills', '1. Bachelor\'s degree in Computer Science or related field\r\n\r\n2. Certifications in full stack development\r\n\r\n3. Practical experience through projects or internships', '1. Design and develop frontend and backend components\r\n\r\n2. Integrate APIs and third-party services\r\n\r\n3. Ensure responsiveness and cross-platform compatibility\r\n\r\n4. Collaborate with designers and other developers\r\n\r\n5. Maintain and upgrade existing applications', 'In India, Full Stack Developers earn between ₹6,00,000 and ₹12,00,000 per annum, depending on experience and location .', '1. Tata Consultancy Services (TCS)\r\n\r\n2. Infosys\r\n\r\n3. Wipro\r\n\r\n4. Accenture\r\n\r\n5. Cognizant\r\n\r\n6. IBM\r\n\r\n7. Capgemini\r\n\r\n8. Tech Mahindra'),
(4, 'Mobile App Developer', 'Mobile App Developers specialize in creating applications for mobile devices. They work on various platforms like Android and iOS, ensuring that apps are functional, user-friendly, and optimized for performance.', '1. Proficiency in programming languages like Java, Kotlin (Android), Swift (iOS)\r\n\r\n2. Experience with mobile development frameworks like React Native or Flutter\r\n\r\n3. Understanding of mobile UI/UX design principles\r\n\r\n4. Knowledge of APIs and third-party integrations\r\n\r\n5. Familiarity with app deployment processes on Google Play Store and Apple App Store', '1. Bachelor\'s degree in Computer Science or related field\r\n\r\n2. Certifications in mobile app development\r\n\r\n3. Hands-on experience through projects or internships', '1. Develop and maintain mobile applications\r\n\r\n2. Collaborate with cross-functional teams to define app features\r\n\r\n3. Ensure app performance and responsiveness\r\n\r\n4. Fix bugs and improve application performance\r\n\r\n5. Continuously discover and implement new technologies', 'In India, Mobile App Developers earn between ₹4,00,000 and ₹10,00,000 per annum, based on experience and expertise.', '1. Infosys\r\n\r\n2. Tata Consultancy Services (TCS)\r\n\r\n3. Wipro\r\n\r\n4. Accenture\r\n\r\n5. Cognizant\r\n\r\n6. IBM\r\n\r\n7. Capgemini\r\n\r\n8. Tech Mahindra'),
(5, 'AI/ML Engineer', 'AI/ML Engineers develop artificial intelligence and machine learning models to automate processes, analyze data, and enhance decision-making. They work on algorithms, data modeling, and integrating AI solutions into applications.\r\n\r\n', '1. Proficiency in programming languages like Python, R\r\n\r\n2. Knowledge of machine learning frameworks like TensorFlow, PyTorch\r\n\r\n3. Experience with data preprocessing and analysis\r\n\r\n4. Understanding of algorithms and statistical models\r\n\r\n5. Familiarity with cloud platforms like AWS, Azure', '1. Bachelor\'s or Master\'s degree in Computer Science, Data Science, or related field\r\n\r\n2. Certifications in AI/ML\r\n\r\n3. Research experience or projects in AI/ML', '1. Design and develop machine learning models\r\n\r\n2. Analyze large datasets to extract insights\r\n\r\n3. Collaborate with data scientists and engineers\r\n\r\n4. Deploy AI models into production environments\r\n\r\n5. Monitor and improve model performance', 'In India, AI/ML Engineers earn between ₹6,00,000 and ₹20,00,000 per annum, depending on experience and skill set.', '1. Infosys\r\n\r\n2. Tata Consultancy Services (TCS)\r\n\r\n3. Wipro\r\n\r\n4. Accenture\r\n\r\n5. Cognizant 6'),
(6, 'Cybersecurity Analyst', 'Cybersecurity Analysts protect an organization’s computer systems and networks from cyber threats. They monitor, detect, and respond to security breaches, implementing measures to strengthen systems and prevent future attacks.', '1. Knowledge of firewalls, VPNs, IDS/IPS, and endpoint security\r\n\r\n2. Familiarity with cybersecurity frameworks and standards\r\n\r\n3. Understanding of ethical hacking and penetration testing\r\n\r\n4. Knowledge of security incident handling and forensic analysis\r\n\r\n5. Good problem-solving, analytical, and communication skills', '1. Bachelor’s degree in Cybersecurity, Computer Science, or IT\r\n\r\n2. Industry certifications such as CEH, CompTIA Security+, or CISSP\r\n\r\n3. Hands-on training in tools like Wireshark, Nmap, Metasploit', '1. Monitor network traffic for suspicious activity\r\n\r\n2. Investigate and respond to security incidents\r\n\r\n3. Conduct vulnerability assessments and penetration testing\r\n\r\n4. Develop security policies and protocols\r\n\r\n5. Train staff on cybersecurity best practices', 'Cybersecurity Analysts in India earn between ₹5,00,000 and ₹12,00,000 per year, with potential growth in specialized roles.', '1. Deloitte\r\n\r\n2. IBM\r\n\r\n3. Infosys\r\n\r\n4. EY (Ernst & Young)\r\n\r\n5. Accenture\r\n\r\n6. Wipro\r\n\r\n7. HCL Technologies\r\n\r\n8. TCS'),
(7, 'Blockchain Developer', 'Blockchain Developers design and build decentralized applications (DApps) and blockchain-based systems. They work with distributed ledger technologies to develop smart contracts and ensure secure data handling.', '1. Understanding of Blockchain technology and architecture\r\n\r\n2. Programming in Solidity, JavaScript, or Python\r\n\r\n3. Knowledge of Ethereum, Hyperledger, or similar platforms\r\n\r\n4. Familiarity with cryptography and consensus mechanisms\r\n\r\n5. Experience with smart contracts and DApps', '1. Bachelor’s degree in Computer Science, IT, or related field\r\n\r\n2. Certification in Blockchain development (e.g., Blockchain Council, IBM)\r\n\r\n3. Experience in fintech or decentralized systems', '1. Develop and deploy smart contracts\r\n\r\n2. Design secure blockchain protocols\r\n\r\n3. Create backend architecture for DApps\r\n\r\n4. Monitor blockchain performance and scalability\r\n\r\n5. Collaborate with cross-functional teams', 'Blockchain Developers earn between ₹6,00,000 and ₹15,00,000 per year in India, with higher salaries in fintech or international firms.', '1. Infosys\r\n\r\n2. TCS\r\n\r\n3. Wipro\r\n\r\n4. IBM\r\n\r\n5. Tech Mahindra\r\n\r\n6. Accenture\r\n\r\n7. ConsenSys\r\n\r\n8. Polygon'),
(8, 'Cloud Architect', 'Cloud Architects are responsible for designing, implementing, and maintaining cloud computing systems. They oversee cloud strategy, manage cloud infrastructure, and ensure security and scalability.', '1. Knowledge of cloud platforms (AWS, Azure, Google Cloud)\r\n\r\n2. Proficiency in infrastructure-as-code tools (Terraform, CloudFormation)\r\n\r\n3. Experience in virtualization, networking, and security\r\n\r\n4. DevOps skills and CI/CD pipeline understanding\r\n\r\n5. Strong architecture and system design capabilities', '1. Bachelor\'s in Computer Science, Engineering, or IT\r\n\r\n2. Cloud certifications (e.g., AWS Certified Solutions Architect, Azure Architect)\r\n\r\n3. Prior experience in systems or network administration', '1. Design cloud solutions architecture\r\n\r\n2. Implement and manage cloud services\r\n\r\n3. Optimize performance and cost\r\n\r\n4. Ensure cloud security and compliance\r\n\r\n5. Migrate on-premise systems to the cloud', 'In India, Cloud Architects earn between ₹10,00,000 and ₹25,00,000 per year based on experience.', '1. Amazon Web Services\r\n\r\n2. Microsoft\r\n\r\n3. Google Cloud\r\n\r\n4. Infosys\r\n\r\n5. Wipro\r\n\r\n6. IBM\r\n\r\n7. Accenture\r\n\r\n8. TCS\r\n\r\n'),
(9, 'AR/VR Developer', 'AR/VR Developers create immersive augmented and virtual reality experiences using 3D modeling, animation, and interaction design. They work in industries like gaming, education, training, and simulation.', '1. Knowledge of Unity or Unreal Engine\r\n\r\n2. Proficiency in C#, C++, or JavaScript\r\n\r\n3. Understanding of 3D modeling, animation, and physics\r\n\r\n4. Experience with ARKit, ARCore, or Oculus SDK\r\n\r\n5. Creativity and problem-solving skills', '1. Bachelor’s degree in Game Design, Computer Science, or Multimedia\r\n\r\n2. Certification in AR/VR development\r\n\r\n3. Experience in XR projects and game engines', '1. Develop immersive applications for AR and VR platforms\r\n\r\n2. Collaborate with designers and 3D artists\r\n\r\n3. Integrate real-time 3D graphics\r\n\r\n4. Test and debug applications\r\n\r\n5. Optimize performance for different devices', 'AR/VR Developers in India typically earn between ₹5,00,000 and ₹15,00,000 annually, depending on domain and complexity.', '1. Tata Elxsi\r\n\r\n2. Infosys\r\n\r\n3. Accenture\r\n\r\n4. Tech Mahindra\r\n\r\n5. HCLTech\r\n\r\n6. Samsung Research\r\n\r\n7. Magic Leap\r\n\r\n8. Zoho'),
(10, 'Computer Vision Engineer', 'Computer Vision Engineers create systems that interpret visual data using artificial intelligence. They work on applications like facial recognition, object detection, and image segmentation.', '1. Proficiency in Python, OpenCV, and TensorFlow\r\n\r\n2. Experience with image processing and feature extraction\r\n\r\n3. Knowledge of CNNs and deep learning techniques\r\n\r\n4. Understanding of camera calibration and 3D geometry\r\n\r\n5. Mathematical and statistical background', '1. Master’s or Bachelor’s degree in Computer Vision, AI, or Computer Science\r\n\r\n2. Certification in AI/Deep Learning\r\n\r\n3. Research or project experience with visual datasets', '1. Build and train deep learning models for vision tasks\r\n\r\n2. Collect and preprocess image/video data\r\n\r\n3. Evaluate and fine-tune model performance\r\n\r\n4. Integrate vision systems into applications\r\n\r\n5. Conduct research and stay updated with recent advancements', 'Computer Vision Engineers earn between ₹8,00,000 and ₹20,00,000 annually in India.', '1. NVIDIA\r\n\r\n2. Intel\r\n\r\n3. Qualcomm\r\n\r\n4. Bosch\r\n\r\n5. Wipro AI\r\n\r\n6. Tata Elxsi\r\n\r\n7. Accenture\r\n\r\n8. Zoho'),
(11, 'NLP Engineer', 'NLP (Natural Language Processing) Engineers build systems that understand and process human language. They work on tasks such as speech recognition, machine translation, sentiment analysis, and chatbots.', '1. Proficiency in Python, NLTK, spaCy, and Hugging Face\r\n\r\n2. Knowledge of NLP techniques like tokenization, stemming, parsing\r\n\r\n3. Familiarity with transformers and BERT models\r\n\r\n4. Experience with deep learning frameworks like TensorFlow or PyTorch\r\n\r\n5. Understanding of linguistics and statistical modeling', '1. Bachelor’s/Master’s in Data Science, AI, or Computational Linguistics\r\n\r\n2. Certifications in NLP, ML\r\n\r\n3. Project or research experience in NLP applications', '1. Develop NLP pipelines and models\r\n\r\n2. Preprocess large text corpora\r\n\r\n3. Implement sentiment analysis, summarization, or translation\r\n\r\n4. Evaluate models using relevant metrics\r\n\r\n5. Work with cross-functional teams on integrating NLP into products', 'NLP Engineers in India earn between ₹7,00,000 and ₹18,00,000 per annum, depending on specialization.', '1. Google Research\r\n\r\n2. Microsoft\r\n\r\n3. Amazon\r\n\r\n4. Infosys\r\n\r\n5. TCS\r\n\r\n6. IBM\r\n\r\n7. Adobe\r\n\r\n8. Fractal Analytics\r\n\r\n'),
(12, 'Software Tester', 'Software Testers are responsible for the quality of software development and deployment. They are involved in performing automated and manual tests to ensure the software created by developers is fit for purpose. Some of the duties include analysis of software, and systems, mitigate risk and prevent software issues.\r\n\r\nA software tester is responsible for designing test scenarios for software usability, running these tests, and preparing reports on the effectiveness and defects to the production team. A software tester is also known as a software test engineer or a quality assurance (QA) tester.', 'To be successful as a software tester, one should have a working knowledge of software and test design, the capability to run through tests, and the ability to analyze the results. Ultimately, the software tester should be result-driven, have good communication skills, and up-to-date knowledge of software programming and software test design.\r\n\r\n1. Up-to-date knowledge of software test design and testing methodologies.\r\n2. Working knowledge of test techniques and compatibility with various software programs.\r\n3. Working knowledge of programming.\r\n4. Excellent communication and critical thinking skills.\r\n5. Good organizational skills and detail-oriented mindset.\r\n6. A passion for working with technology.', 'Academic background of a software tester should be in Computer Science. A BTech/ B.E., MCA, BCA, BSc- Computers, will land a job quickly.If person does not hold any of these degrees, then they must complete a software testing certification like ISTQB and CSTE which help you learn Software Development/ Test Life Cycle and other testing methodologies.', '1. Reviewing software requirements and preparing test scenarios.\r\n2. Executing tests on software usability.\r\n3. Analyzing test results on database impacts, errors or bugs, and usability.\r\n4. Preparing reports on all aspects related to the software testing carried out and reporting to the design team.\r\n5. Interacting with clients to understand product requirements.\r\n6. Participating in design reviews and providing input on requirements, product design, and potential problems.\r\n7. Execute all levels of testing (System, Integration, and Regression).\r\n8. Provide timely solutions.', 'Compensation of a software tester varies from company to company. Average Software testing career package in India is Rs 247,315 - Rs 449,111.', '1. LTI - Larsen & Toubro Infotech\r\n2. Wipro\r\n3. Spiceworks\r\n4. Tata Consultancy Services\r\n5. Intel Technology India Pvt Ltd\r\n6. AT & T communications Services India'),
(13, 'Business Analyst', 'Business analyst help guide businesses in improving processes, products, services and software through data analysis. These agile workers straddle the line between IT and the business to help bridge the gap and improve efficiency.\r\n\r\nBAs are responsible for creating new models that support business decisions by working closely with financial reporting and IT teams to establish initiatives and strategies to improve importing and to optimize costs. You’ll need a “strong understanding of regulatory and reporting requirements as well as plenty of experience in forecasting, budgeting and financial analysis combined with understanding of key performance indicators,” according to Robert Half Technology.\r\n\r\nThe role of a business analyst is constantly evolving and changing — especially as companies rely more on data to advise business operations. Every company has different issues that a business analyst can address, whether it’s dealing with outdated legacy systems, changing technologies, broken processes, poor client or customer satisfaction or siloed large organizations.', 'The business analyst position requires both hard skills and soft skills. Business analysts need to know how to pull, analyze and report data trends, and be able to share that information with others and apply it on the business side. Not all business analysts need a background in IT as long as they have a general understanding of how systems, products and tools work. Alternatively, some business analysts have a strong IT background and less experience in business, and are interested in shifting away from IT to this hybrid role.\r\n\r\n1. Able to exercise independent judgment and take action on it\r\n2. Excellent analytical, mathematical, and creative problem-solving skills\r\n3. Excellent listening, interpersonal, written, and oral communication skills\r\n4. Logical and efficient, with keen attention to detail\r\n5. Highly self-motivated and directed\r\n6. Ability to effectively prioritize and execute tasks while under pressure\r\n7. Strong customer service orientation\r\n8. Experience working in a team-oriented, collaborative environment', '1. College diploma or university degree in the field of business administration, finance, or information systems, computer science or a related field\r\n2. Proven experience with business and technical requirements analysis, elicitation, modeling, verification, and methodology development\r\n3. Excellent listening, interpersonal, written, and oral communication skills\r\n4. Demonstrated project management skills and project management software skills, including planning, organizing, and managing resources\r\n5. Working knowledge of Windows office systems\r\n6. Excellent understanding of the organization’s goals and objectives', '1. Elicits, analyzes, specifies, and validates the business needs of stakeholders, be they customers or end users. Collaborates with project sponsors to determine project scope and vision.\r\n2. Clearly identifies project stakeholders and establish customer classes, as well as their characteristics.\r\n3. Works with stakeholders and project team to prioritize collected requirements.\r\n4. Researches, reviews, and analyzes the effectiveness and efficiency of existing requirements-gathering processes and develop strategies for enhancing or further leveraging these processes.\r\n5. Develops and utilizes standard templates to accurately and concisely write requirements specifications.\r\n6. Analyzes and verifies requirements for completeness, consistency, comprehensibility, feasibility, and conformity to standards.\r\n7. Creates process models, specifications, diagrams, and charts to provide direction to developers and/or the project team.\r\n8. Manages and tracks the status of requirements throughout the project lifecycle; enforce and redefine as necessary.', 'The average salary for an IT business analyst is $67,762 per year, according to data from PayScale. The highest paid BAs are in San Francisco, where the average salary is 28 percent higher than the national average. New York is second, with reported salar', '1. Deloitte\r\n2. Tata Consultancy Services\r\n3. American Express\r\n4. Flipkart\r\n5. Dell Technologies\r\n6. Barclays'),
(14, 'Customer Service Executive', 'Customer Service Executive manages a team of representatives who will offer excellent customer service and after-sales support. Customer Service Execute creates policies and procedures and oversee the customer service provided by the team. The Customer Service Executive will be responsible for the selection of staff in the hiring process and ensure that a standardized level of service is maintained for all customers.\r\n\r\nA Customer Service Executive, display\'s excellent interpersonal and communication skills as well as a professional appearance. An outstanding Customer Service Executive should possess a proven track record of successful customer service and management skills.\r\n', '1. Excellent interpersonal and written and oral communication skills. \r\n2. Knowledge of CRM systems. \r\n3. Computer skills. \r\n4. The ability to run diagnostic tests and determine the causes of errors or problems. \r\n5. Keeping track of common issues and maintaining accurate reports are important abilities for these professionals.', 'Bachelor degree in business administration or any relevant field is required. MBA or any other master degree in management will help the candidates apply for a higher-level position.', '1. Managing a team of representatives offering customer support.\r\n2. Resolving customer complaints brought to your attention.\r\n3. Creating policies and procedures.\r\n4. Planning the training and standardization of service delivery.\r\n5. Conducting quality assurance surveys with customers and providing feedback to the staff.\r\n6. Possessing excellent product knowledge to enhance customer support.\r\n7. Maintaining a pleasant working environment for your team.\r\n', 'The average salary for a Customer Care Executive is Rs.209,450. For a fresher, the salary will be starting from Rs.180,000. Upon experience Customer Service Executive salary will range from Rs.220,000 - Rs.270,000 depending on the company.', '1. Amazon \r\n2. Dell Technologies \r\n3. HSBC \r\n4. Reliance Jio \r\n5. Tata communications \r\n6. Axis Bank \r\n7. Tech Mahindra Business Services Limited \r\n8. LG Electronics'),
(15, 'Data Scientist', 'A data scientist is someone who makes value out of data. Such a person proactively fetches information from various sources and analyzes it for better understanding about how the business performs, and to build AI tools that automate certain processes within the company.\r\n\r\nData scientist duties typically include creating various machine learning-based tools or processes within the company, such as recommendation engines or automated lead scoring systems. People within this role should also be able to perform statistical analysis.', 'A strong background in math, science, and computer science is a must for aspiring hardware engineers. They also, however, should be adept communicators capable of conveying instructions in verbal and written forms. Other critical skills include\r\n\r\n1. excellent analytical and problem-solving skills\r\n2. experience in database interrogation and analysis tools, such as Hadoop, SQL and SAS\r\n3. exceptional communication and presentation skills in order to explain your work to people who don\'t understand the mechanics behind data analysis\r\n4. planning, time management and organisational skills\r\n5. the ability to deliver under pressure and to tight deadlines\r\n6. teamworking skills and a collaborative approach to sharing ideas and finding solutions.', '1. BSc/BA in Computer Science, Engineering or relevant field; graduate degree in Data Science or other quantitative field is preferred.\r\n2. You\'ll be expected to know some programming languages such as R, Python, SQL, C or Java and have strong database design and coding skills.\r\n3. A postgraduate qualification, such as a Masters or PhD, can be useful and many data scientists have one. It is especially helpful if you\'re considering a change of career or are interested in learning analysis skills.\r\n4. You\'ll typically need a mathematical, engineering, computer science or scientific-related degree to get a place on a course, although subjects such as business, economics, psychology or health may also be relevant if you have mathematical aptitude and basic programming experience.\r\n5. Understanding of machine-learning and operations research\r\n6. Strong math skills (e.g. statistics, algebra)', '1. Identify valuable data sources and automate collection processes\r\n2. Undertake preprocessing of structured and unstructured data\r\n3. Analyze large amounts of information to discover trends and patterns\r\n4. Build predictive models and machine-learning algorithms\r\n5. Combine models through ensemble modeling\r\n6. Present information using data visualization techniques\r\n7. Propose solutions and strategies to business challenges\r\n8. Collaborate with engineering and product development teams', 'An entry-level Data Scientist with less than 1 year experience can expect to earn an average total compensation (includes tips, bonus, and overtime pay) of ₹536,700 based on 539 salaries. An early career Data Scientist with 1-4 years of experience earns a', '1. Pinterest\r\n2. Microsoft\r\n3. Accenture\r\n4. Intel\r\n5. Oracle\r\n6. Uber\r\n'),
(16, 'Helpdesk Engineer', 'Helpdesk Engineer are the go-to people for providing technical assistance and support related to computer systems, hardware, and software. They are responsible for answering queries and addressing system and user issues in a timely and professional manner. Helpdesk Engineer works with the IT team, and will often interact with system and computer users across the company. The helpdesk team will train users on basic system and computer functions. Understanding and proactively maintaining daily system performance, having the ability to troubleshoot customer problems, and innate follow-up and follow-through skills are all essential aspects of the help desk support’s day-to-day role.\r\n\r\nAn excellent Helpdesk Engineer must have good technical knowledge and be able to communicate effectively to understand the problem and explain its solution. They must also be customer-oriented and patient to deal with difficult customers. The goal is to create value for clients that will help preserve the company’s reputation and business.', '1. Proven experience as a help desk technician or other customer support role.\r\n1. Tech savvy with working knowledge of office automation products, databases and remote control.\r\n2. Good understanding of computer systems, mobile devices and other tech products.\r\n3. Ability to diagnose and resolve basic technical issues.\r\n4. Proficiency in English.\r\n5. Excellent communication skills.\r\n6. Customer-oriented and cool-tempered.\r\n7. General awareness of computer systems, PC repair, and network management\r\n8. Understanding and appreciation for information security within systems and user devices.', 'A college degree is required for entry-level helpdesk positions, a degree in computer information science, or help desk administration. It can also be useful to get a specialized or niche certificate in PC repair, network administration, or help desk support.', '1. Monitor and respond quickly to incoming requests relate to IT issues.\r\n2. Serve as the first point of contact for customers seeking technical assistance over the phone or email.\r\n3. Perform remote troubleshooting through diagnostic techniques and pertinent questions.\r\n4. Determine the best solution based on the issue and details provided by customers.\r\n5. Provide accurate information on IT products or services.\r\n6. Follow-up and update customer status and information.\r\n7. Pass on any feedback or suggestions by customers to the appropriate internal team.\r\n8. Identify and suggest possible improvements on procedures.\r\n', 'Helpdesk Engineer salary in India ranges between ₹ 1.4 Lakhs to ₹ 4.7 Lakhs with an average annual salary of ₹ 2.4 Lakhs.', '1. Wipro\r\n2. NTT Data\r\n3. Dell\r\n4. Reliance Jio Infocomm Ltd.\r\n5. IBM\r\n6. Google\r\n7. Cisco System'),
(17, 'Graphic Designer', 'The Graphic Designer job includes the entire process of defining requirements, visualizing and creating graphics including illustrations, logos, layouts and photos. Graphic Designer will be the one to shape the visual aspects of websites, books, magazines, product packaging, exhibitions and more.\r\n\r\nGraphic Designer should capture the attention of those who see them and communicate the right message. For this, one need to have a creative flair and a strong ability to translate requirements into design. The goal is to inspire and attract the target audience.\r\n\r\nGraphic designers use their artistic abilities to communicate ideas, inform consumers, and solve problems. From the layout of a website to large images seen on billboards, graphic designers create visual concepts by hand or by computer to help others interpret the world around them through color, texture, images, and symbols. Graphic designers can be found in many industries and may be responsible for all aspects of a company\'s design process, or they might specialize in a particular field such as advertising, digital design, illustration, or branding. Some work independently as freelancers, while others are part of a design studio, a creative agency, or a corporate company.', '1. Proven graphic designing experience.\r\n2. A strong portfolio of illustrations or other graphics.\r\n3. Familiarity with design software and technologies (such as InDesign, Illustrator, Dreamweaver, Photoshop).\r\n4. A keen eye for aesthetics and details.\r\n5. Excellent communication skills.\r\n6. Ability to work methodically and meet deadlines.', 'While entry is open to non-graduates, preference is given to those with relevant degrees. A degree in graphic design is advantageous or Degree in Design, Fine Arts or related field is a plus. Also one should have good knowledge of design software, such as Quark Xpress, InDesign or Illustrator, plus photo-editing software such as PhotoShop.', '1. Study design briefs and determine requirements.\r\n2. Schedule projects and define budget constraints.\r\n3. Conceptualize visuals based on requirements.\r\n4. Prepare rough drafts and present ideas.\r\n5. Develop illustrations, logos and other designs using software or by hand.\r\n6. Use the appropriate colors and layouts for each graphic.\r\n7. Work with copywriters and creative director to produce final design.\r\n8. Test graphics across various media.\r\n9. Ensure final graphics and layouts are visually appealing and on-brand.', 'The average salary for a Graphic Designer in India is Rs. 305123 per annum.', '1. Buttercup advertising studio\r\n2. Sigzen Technologies\r\n3. Mind digital\r\n4. Webisdom\r\n5. Zero designs\r\n6. Netgains\r\n7. Detecvision\r\n8. WiseLife\r\n'),
(18, 'Penetration Tester', 'Penetration testers, also known as “ethical hackers,” are highly skilled security specialists that spend their days attempting to breach computer and network security systems. These testers work in the information technology (IT) field to ensure that those without authorization cannot access an organization’s data. They do this by trying to hack into networks to identify potential vulnerabilities in the system.\r\n\r\nPenetration testers help businesses and organizations identify and resolve security vulnerabilities and weaknesses affecting their digital assets and computer networks. Some hold in-house positions with permanent employers, functioning as part of internal cybersecurity or information technology (IT) teams. Others work for specialized firms that provide penetration-testing services to end clients.', '1. Coding skill required to infiltrate any system.\r\n2. Comprehensive knowledge of computer security, including forensics, systems analysis and more.\r\n3. Insight into how hackers exploit the human element to gain unauthorized access to secure systems.\r\n4. Clear understanding of how computer security breaches can disrupt business, including the financial and managerial implications.\r\n5. Exceptional problem-solving skills.\r\n6. Communications skills to document and share your findings.', 'Bachelor’s or Master’s degree in computer science, IT, cybersecurity, or a related specialization. Knowledge of SQL, C++, JavaScript, Ruby and Python', 'Penetration Tester job will likely also involve planning and executing tests, documenting your methodologies, creating detailed reports about your findings and perhaps also being involved in designing fixes and improving security protocols.\r\n\r\n1. Perform penetration tests on computer systems, networks and applications.\r\n2. Create new testing methods to identify vulnerabilities.\r\n3. Perform physical security assessments of systems, servers and other network devices to identify areas that require physical protection.\r\n4. Pinpoint methods and entry points that attackers may use to exploit vulnerabilities or weaknesses.\r\n5. Search for weaknesses in common software, web applications and proprietary systems.\r\n6. Research, evaluate, document and discuss findings with IT teams and management.\r\n7. Review and provide feedback for information security fixes.\r\n8. Establish improvements for existing security services, including hardware, software, policies and procedures.\r\n9. Identify areas where improvement is needed in security education and awareness for users.', 'The average salary for a Penetration Tester in India is Rs. 603062 per annum.', '1. Bank of America\r\n2. JP Morgan Chase\r\n3. Amazon\r\n4. IBM\r\n5. Dell\r\n6. Sony\r\n7. Ebay\r\n8. Deloitte');

-- --------------------------------------------------------

--
-- Table structure for table `recommendations`
--

CREATE TABLE `recommendations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `career_suggested` varchar(100) NOT NULL,
  `prediction_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recommendations`
--

INSERT INTO `recommendations` (`id`, `user_id`, `career_suggested`, `prediction_date`) VALUES
(1, 16, 'Full Stack Developer', '2025-04-23 13:24:46'),
(2, 25, 'Graphics Designer', '2025-04-14 12:29:07');

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
(5, 16, 'A motivated engineering student passionate about technology and innovation and a passionate artist.', '../uploads/profile_pictures/defaultpfp.jpeg', 'Kundapura Taluk, Udupi Distraict, Karnataka', 'St. Joseph Engineering College, Mangaluru', 'Bachelor of Engineering in Computer Science', 'https://github.com/AkahayKumarS', 'https://www.linkedin.com/in/akshaya-kumar-s/', 'C, Java, Python, PHP, SQL, Graphic Design, HTML, CSS, Javascript, React, Node.js', 'Drawing, Painting and Clay Modeling', '2025-04-23 13:15:10'),
(8, 25, 'I am a nursing student passionate about Art and Dance.', NULL, 'Kundapura Taluk, Udupi Distraict, Karnataka', 'Nursing college, Udupi', 'GNM Nursing', '', '', 'Graphic Design, Photoshop, 3D Modeling', 'Drawing and Painting', '2025-04-14 07:47:36');

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
(16, 'Akshay Kumar S', 'akshay@gmail.com', '$2y$10$MZcxALFPuMUEVGWZ0dXMIevh.8loduLuYGvlA7w4zdMbWG/i0jXg6', '2024-11-26 17:23:55', 'student'),
(18, 'Ajith Kumar', 'ajith@gmail.com', '$2y$10$fZVLeMsM5ePWuFq78.t8Dufq9lfCOzfG8XpV6gutH7z3Bwj6WL6FS', '2024-11-27 11:48:36', 'student'),
(24, 'Rohith', 'rohith@gmail.com', '$2y$10$glH7c3WPn73de0Wk2O2WDuW78aJPu.30WQIhx9lJgqrW6mW9WZ6dm', '2024-12-25 06:36:32', 'student'),
(25, 'Aishwarya', 'aishu@gmail.com', '$2y$10$I8qrzg3SKvUA7kdUoviT3eHMFnUVKtTZ6mTQLFOCxrgD8Tg9grM.e', '2025-04-14 07:44:46', 'student');

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
-- Indexes for table `recommendations`
--
ALTER TABLE `recommendations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `job_roles`
--
ALTER TABLE `job_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `knowledge_network`
--
ALTER TABLE `knowledge_network`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1213;

--
-- AUTO_INCREMENT for table `recommendations`
--
ALTER TABLE `recommendations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_profiles`
--
ALTER TABLE `student_profiles`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recommendations`
--
ALTER TABLE `recommendations`
  ADD CONSTRAINT `recommendations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `student_profiles`
--
ALTER TABLE `student_profiles`
  ADD CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
