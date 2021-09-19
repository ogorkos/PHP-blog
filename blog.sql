-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2021 at 04:38 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Front'),
(2, 'Backend'),
(3, 'Full Stack');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_content`, `comment_status`, `comment_date`) VALUES
(18, 3, 'kostya', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\r\n\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 'not approved', '2021-09-08 02:19:09'),
(19, 3, 'kostya', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.', 'approved', '2021-09-08 02:19:14'),
(20, 2, 'kostya', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', 'approved', '2021-09-08 02:49:59'),
(22, 19, 'admin', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. ', 'approved', '2021-09-11 03:34:42'),
(23, 16, 'admin', 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 'approved', '2021-09-11 03:38:49'),
(24, 21, 'test', 'good', 'approved', '2021-09-16 10:35:01'),
(25, 21, 'test', 'yes', 'approved', '2021-09-16 11:15:25'),
(26, 16, 'test', 'nice', 'approved', '2021-09-17 10:49:30');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` datetime NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comments_count` int(11) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comments_count`, `post_status`) VALUES
(16, 1, 'What is JavaScript?', 'kostya', '2021-09-09 19:59:31', 'js.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam luctus vehicula blandit. Duis congue nisi id libero sodales malesuada a vel purus. Nullam odio ex, dictum ut ultricies eu, tristique sed libero. Morbi bibendum nisi malesuada tellus pulvinar, tincidunt convallis metus mollis. Cras pretium fringilla nunc, a facilisis eros fermentum nec. Maecenas consequat, elit et accumsan ultricies, ligula lorem dignissim purus, quis tempus velit felis vel ipsum. Pellentesque maximus vel massa et dictum. Etiam vitae auctor ex. Nunc ut pellentesque eros, nec placerat magna. Cras vestibulum varius massa, in vehicula justo porta ut. Integer et massa tempus, posuere mauris ac, aliquam eros. Aliquam in odio laoreet, bibendum justo at, bibendum mauris. Sed egestas mollis libero, a facilisis augue dapibus vel. Nam cursus orci nec tincidunt ullamcorper. Morbi at nisi ac augue fermentum elementum non eget magna.\r\n\r\nSuspendisse vehicula eleifend erat sit amet blandit. Nulla mattis lectus non sapien finibus, ut eleifend ipsum porttitor. Vestibulum vulputate lacus ut augue blandit consequat. Maecenas hendrerit est enim, vel bibendum magna cursus vitae. Maecenas mollis dictum risus, at pulvinar felis tempor a. Mauris consequat placerat felis, at rutrum metus ultricies sed. Aliquam fermentum sapien massa. Fusce porttitor suscipit massa ac varius. Maecenas velit justo, scelerisque sit amet auctor varius, aliquet non ligula. Mauris convallis justo a ligula dignissim, ac eleifend ex lacinia. Pellentesque eget ornare urna. Aenean vestibulum pulvinar metus, sed semper metus porttitor non. Sed bibendum magna vitae augue vulputate ullamcorper eget aliquam lacus. Curabitur nec nunc a ipsum ullamcorper blandit id sed tellus.\r\n\r\nVivamus tristique dignissim elementum. Integer eu semper ipsum. Morbi ante ante, porta nec mauris sed, pulvinar egestas magna. Nam rutrum rhoncus suscipit. Quisque porta interdum tincidunt. Sed porttitor, eros at tincidunt vulputate, metus turpis mollis urna, in tempor lacus sapien ut ante. Sed orci erat, tempor eget leo in, accumsan dictum ante.\r\n\r\nSuspendisse cursus massa a vehicula condimentum. Sed ut leo a risus semper tempor in ut ex. Suspendisse ullamcorper, libero at fringilla lobortis, arcu enim euismod enim, sed sollicitudin diam turpis a nunc. Phasellus vitae mi at enim suscipit viverra. Phasellus pretium velit diam, quis tincidunt ex feugiat non. Quisque mollis turpis sed neque viverra malesuada. Morbi nec tempus ipsum. Vestibulum sit amet gravida urna. Quisque lacus ligula, venenatis bibendum fringilla ac, imperdiet non risus. Sed tincidunt, arcu eu mollis pretium, massa arcu vulputate urna, vitae bibendum orci lorem sed mi. Duis posuere finibus viverra. Vestibulum porttitor erat at efficitur finibus. Praesent vestibulum semper magna. Nulla ut pulvinar ante. Suspendisse potenti. Etiam ornare vitae arcu ullamcorper tempus.\r\n\r\nMaecenas nibh nunc, mollis a nunc non, eleifend rutrum mauris. Nunc eleifend augue eget massa blandit aliquam. Nam ut turpis vel elit fringilla lobortis ac volutpat eros. Quisque tincidunt, diam facilisis imperdiet cursus, urna velit mollis augue, at dictum odio elit nec ante. Pellentesque laoreet ornare dui ac mollis. Suspendisse sapien leo, dignissim eleifend maximus eget, tempor congue felis. In eget dignissim diam.\r\n\r\nDonec facilisis ipsum non vulputate facilisis. Nunc vel lobortis mauris. Nam vehicula nisl sit amet arcu congue, sit amet suscipit tellus consequat. Morbi imperdiet scelerisque neque et consequat. Sed vehicula dapibus interdum. Suspendisse mattis imperdiet enim, nec commodo ligula porta ac. Fusce in felis pellentesque purus suscipit accumsan sit amet in purus. Suspendisse vestibulum blandit risus sit amet molestie. Donec sit amet ex ut libero ornare fringilla. Nulla nec tellus congue, faucibus justo sit amet, feugiat ipsum. Mauris id tortor diam. Aenean eu varius turpis, ut elementum eros. Duis suscipit massa quis dolor lobortis convallis. Ut nec mauris sit amet justo tempor rutrum. Suspendisse urna velit, finibus eget interdum dignissim, cursus nec eros.\r\n\r\nPraesent justo mi, condimentum in mattis id, egestas a nisi. Proin eleifend fermentum condimentum. Praesent feugiat finibus dolor, sed vestibulum justo porta sed. Nam vestibulum orci purus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Fusce porta massa aliquet nulla consequat, a porta est posuere. Duis nec blandit massa. Nullam dapibus pretium lacus ut aliquam. Vivamus tincidunt elit ac augue dignissim posuere. Nullam finibus vestibulum nisl sit amet elementum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla tempus lacus at sapien hendrerit, vitae faucibus nibh gravida.                        ', 'js', 0, 'published'),
(19, 2, 'New', 'Admin', '2021-09-09 21:31:34', 'php.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam luctus vehicula blandit. Duis congue nisi id libero sodales malesuada a vel purus. Nullam odio ex, dictum ut ultricies eu, tristique sed libero. Morbi bibendum nisi malesuada tellus pulvinar, tincidunt convallis metus mollis. Cras pretium fringilla nunc, a facilisis eros fermentum nec. Maecenas consequat, elit et accumsan ultricies, ligula lorem dignissim purus, quis tempus velit felis vel ipsum. Pellentesque maximus vel massa et dictum. Etiam vitae auctor ex. Nunc ut pellentesque eros, nec placerat magna. Cras vestibulum varius massa, in vehicula justo porta ut. Integer et massa tempus, posuere mauris ac, aliquam eros. Aliquam in odio laoreet, bibendum justo at, bibendum mauris. Sed egestas mollis libero, a facilisis augue dapibus vel. Nam cursus orci nec tincidunt ullamcorper. Morbi at nisi ac augue fermentum elementum non eget magna.\r\n\r\nSuspendisse vehicula eleifend erat sit amet blandit. Nulla mattis lectus non sapien finibus, ut eleifend ipsum porttitor. Vestibulum vulputate lacus ut augue blandit consequat. Maecenas hendrerit est enim, vel bibendum magna cursus vitae. Maecenas mollis dictum risus, at pulvinar felis tempor a. Mauris consequat placerat felis, at rutrum metus ultricies sed. Aliquam fermentum sapien massa. Fusce porttitor suscipit massa ac varius. Maecenas velit justo, scelerisque sit amet auctor varius, aliquet non ligula. Mauris convallis justo a ligula dignissim, ac eleifend ex lacinia. Pellentesque eget ornare urna. Aenean vestibulum pulvinar metus, sed semper metus porttitor non. Sed bibendum magna vitae augue vulputate ullamcorper eget aliquam lacus. Curabitur nec nunc a ipsum ullamcorper blandit id sed tellus.\r\n\r\nVivamus tristique dignissim elementum. Integer eu semper ipsum. Morbi ante ante, porta nec mauris sed, pulvinar egestas magna. Nam rutrum rhoncus suscipit. Quisque porta interdum tincidunt. Sed porttitor, eros at tincidunt vulputate, metus turpis mollis urna, in tempor lacus sapien ut ante. Sed orci erat, tempor eget leo in, accumsan dictum ante.\r\n\r\nSuspendisse cursus massa a vehicula condimentum. Sed ut leo a risus semper tempor in ut ex. Suspendisse ullamcorper, libero at fringilla lobortis, arcu enim euismod enim, sed sollicitudin diam turpis a nunc. Phasellus vitae mi at enim suscipit viverra. Phasellus pretium velit diam, quis tincidunt ex feugiat non. Quisque mollis turpis sed neque viverra malesuada. Morbi nec tempus ipsum. Vestibulum sit amet gravida urna. Quisque lacus ligula, venenatis bibendum fringilla ac, imperdiet non risus. Sed tincidunt, arcu eu mollis pretium, massa arcu vulputate urna, vitae bibendum orci lorem sed mi. Duis posuere finibus viverra. Vestibulum porttitor erat at efficitur finibus. Praesent vestibulum semper magna. Nulla ut pulvinar ante. Suspendisse potenti. Etiam ornare vitae arcu ullamcorper tempus.\r\n\r\nMaecenas nibh nunc, mollis a nunc non, eleifend rutrum mauris. Nunc eleifend augue eget massa blandit aliquam. Nam ut turpis vel elit fringilla lobortis ac volutpat eros. Quisque tincidunt, diam facilisis imperdiet cursus, urna velit mollis augue, at dictum odio elit nec ante. Pellentesque laoreet ornare dui ac mollis. Suspendisse sapien leo, dignissim eleifend maximus eget, tempor congue felis. In eget dignissim diam.\r\n\r\nDonec facilisis ipsum non vulputate facilisis. Nunc vel lobortis mauris. Nam vehicula nisl sit amet arcu congue, sit amet suscipit tellus consequat. Morbi imperdiet scelerisque neque et consequat. Sed vehicula dapibus interdum. Suspendisse mattis imperdiet enim, nec commodo ligula porta ac. Fusce in felis pellentesque purus suscipit accumsan sit amet in purus. Suspendisse vestibulum blandit risus sit amet molestie. Donec sit amet ex ut libero ornare fringilla. Nulla nec tellus congue, faucibus justo sit amet, feugiat ipsum. Mauris id tortor diam. Aenean eu varius turpis, ut elementum eros. Duis suscipit massa quis dolor lobortis convallis. Ut nec mauris sit amet justo tempor rutrum. Suspendisse urna velit, finibus eget interdum dignissim, cursus nec eros.\r\n\r\nPraesent justo mi, condimentum in mattis id, egestas a nisi. Proin eleifend fermentum condimentum. Praesent feugiat finibus dolor, sed vestibulum justo porta sed. Nam vestibulum orci purus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Fusce porta massa aliquet nulla consequat, a porta est posuere. Duis nec blandit massa. Nullam dapibus pretium lacus ut aliquam. Vivamus tincidunt elit ac augue dignissim posuere. Nullam finibus vestibulum nisl sit amet elementum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla tempus lacus at sapien hendrerit, vitae faucibus nibh gravida.', 'php', 0, 'project'),
(21, 3, 'Python', 'test', '2021-09-16 23:32:45', 'python.png', 'Python is an easy to learn, powerful programming language. It has efficient high-level data structures and a simple but effective approach to object-oriented programming. Python’s elegant syntax and dynamic typing, together with its interpreted nature, make it an ideal language for scripting and rapid application development in many areas on most platforms.\r\nThe Python interpreter and the extensive standard library are freely available in source or binary form for all major platforms from the Python Web site, https://www.python.org/, and may be freely distributed. The same site also contains distributions of and pointers to many free third party Python modules, programs and tools, and additional documentation.                                                ', 'Python', 0, 'published'),
(22, 1, 'C++', 'kostya', '2021-09-17 23:21:20', 'C++.png', 'C++ is a cross-platform language that can be used to create high-performance applications.\r\nC++ was developed by Bjarne Stroustrup, as an extension to the C language.\r\nC++ gives programmers a high level of control over system resources and memory.\r\nThe language was updated 3 major times in 2011, 2014, and 2017 to C++11, C++14, and C++17.\r\n\r\n            ', 'C++', 0, 'published');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `salt`, `token`) VALUES
(2, 'kostya', '$2y$12$2AoGb6tBZmNP9YkZLfU51O7v70lAbWhBaLDBDVixhsXl/PXl4Mqn.', 'Kostya', 'Ogorodnijchuk', 'okaagm@gmail.com', 'vasya.jpg', 'subscriber', '', ''),
(3, 'admin', '$2y$12$YM29sI6SakZa6GtOhp9AF.HCvtEu6g.jNQ2ffAZyjHfvKPQrhn1Rq', 'AdminF', 'AdminL', 'admin@gmail.com', 'admin.png', 'admin', '', ''),
(4, 'test', '$2y$12$fmiQ8AFzD0Hd8Ew7ThOLcunKuSHr7rwQleZ6gaKGMKxv4nviQn5oi', 'First', 'Last', 'test@gmail.com', '', 'subscriber', '', ''),
(7, 'test2', '$2y$12$CKfR9tQsI1p4J2RA1nJYjerZztMOY.sthS.Qh2QXnQ0yEXx4SxOvC', '', '', 'test2@gmail.com', 'logo.png', 'subscriber', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
