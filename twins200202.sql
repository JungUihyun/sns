-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- 생성 시간: 20-02-07 19:57
-- 서버 버전: 10.1.43-MariaDB-0ubuntu0.18.04.1
-- PHP 버전: 7.2.24-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `twins200202`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `sns_addfriend`
--

CREATE TABLE `sns_addfriend` (
  `idx` int(11) NOT NULL,
  `qidx` int(11) NOT NULL,
  `ridx` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='친구추가 테이블 qidx-신청자  ridx-받은사람';

--
-- 테이블의 덤프 데이터 `sns_addfriend`
--

INSERT INTO `sns_addfriend` (`idx`, `qidx`, `ridx`, `date`) VALUES
(34, 6, 16, '2020-02-06 10:39:48'),
(36, 6, 8, '2020-02-07 12:29:35'),
(39, 6, 20, '2020-02-07 16:58:06');

-- --------------------------------------------------------

--
-- 테이블 구조 `sns_boards`
--

CREATE TABLE `sns_boards` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `writer` varchar(100) NOT NULL,
  `files` varchar(200) NOT NULL,
  `date` datetime NOT NULL,
  `liked` int(11) NOT NULL,
  `commented` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `sns_boards`
--

INSERT INTO `sns_boards` (`id`, `content`, `writer`, `files`, `date`, `liked`, `commented`) VALUES
(26, 'dsfsdfsdfsdf', '휘균', '', '2020-01-29 19:52:36', 0, 0),
(27, 'sdfsdfsfsfsd', '휘균', '', '2020-01-29 19:52:40', 0, 0),
(28, 'asdasdasdasdasdasdasdasd', 'asd', '', '2020-01-29 20:59:50', 0, 0),
(29, 'asdasdasdasdadafasadasdasdasd', 'asd', '', '2020-01-29 20:59:56', 0, 0),
(30, 'asdsfsdfsfsfsfd', 'asd', '', '2020-01-30 11:04:52', 0, 0),
(31, 'sdfsfsfdsf', 'asd', '', '2020-01-30 11:05:07', 0, 0),
(32, 'asdasdasdasdasd', 'asd', '', '2020-01-30 16:26:28', 1, 6),
(34, '쪽지 답장기능\r\n게시물 친구공개, 전체공개\r\n댓글 친구만, 전체 다', '휘균', '', '2020-02-07 11:03:24', 1, 2),
(36, 'ㄴㅇㄴㅁㅇㅇ\r\nㅇㄹㄴㄹㄴㄹㄹ소러\r\nㄴㅇㄹㄴㄹㅇㄴㅇㄹ\r\nㄴㅇㄹㄴㅇㄹ', '휘균', '', '2020-02-07 11:25:59', 0, 1);

-- --------------------------------------------------------

--
-- 테이블 구조 `sns_comments`
--

CREATE TABLE `sns_comments` (
  `idx` int(11) NOT NULL,
  `uidx` varchar(100) NOT NULL,
  `pidx` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `writer` varchar(100) NOT NULL,
  `wdate` datetime NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `sns_comments`
--

INSERT INTO `sns_comments` (`idx`, `uidx`, `pidx`, `content`, `writer`, `wdate`, `level`) VALUES
(11, '5', '32', 'asdadadad', '왕휘균', '2020-02-01 16:48:53', 0),
(12, '5', '32', 'sdsfsfsf', '왕휘균', '2020-02-01 16:55:09', 0),
(14, '7', '32', 'werwrwr', 'asd', '2020-02-01 17:00:22', 0),
(30, '14', '32', '안녕하세요', '테스트2', '2020-02-05 13:59:35', 0),
(33, '10', '34', '안녕', 'rty', '2020-02-05 21:50:09', 0),
(34, '6', '32', 'sdfsfsdf', '휘균', '2020-02-05 21:52:18', 0),
(35, '6', '32', 'sdfsdfsdf', '휘균', '2020-02-05 22:16:43', 0),
(36, '6', '34', '안녕하세요', '휘균', '2020-02-05 23:08:51', 0),
(37, '6', '36', '.on(\"dragleave\", dragOver).on(\"dragleave\", dragOver).on(\"dragleave\", dragOver).on(\"dragleave\", dragOver).on(\"dragleave\", dragOver).on(\"dragleave\", dragOver).on(\"dragleave\", dragOver).on(\"dragleave\", dragOver).on(\"dragleave\", dragOver).on(\"dragleave\", dragOver).on(\"dragleave\", dragOver).on(\"dragleave\", dragOver).on(\"dragleave\", dragOver).on(\"dragleave\", dragOver).on(\"dragleave\", dragOver).on(\"dragleave\", dragOver).on(\"dragleave\", dragOver).on(\"dragleave\", dragOver).on(\"dragleave\", dragOver).on(\"dragleave\", dragOver).on(\"dragleave\", dragOver).on(\"dragleave\", dragOver).on(\"dragleave\", dragOver).on(\"dragleave\", dragOver).on(\"dragleave\", dragOver)', '휘균', '2020-02-07 16:40:28', 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `sns_friends`
--

CREATE TABLE `sns_friends` (
  `idx` int(11) NOT NULL,
  `qidx` int(11) NOT NULL,
  `ridx` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `sns_friends`
--

INSERT INTO `sns_friends` (`idx`, `qidx`, `ridx`, `date`) VALUES
(15, 12, 11, '2020-02-04 11:05:54'),
(16, 11, 12, '2020-02-04 11:05:54'),
(17, 10, 12, '2020-02-04 11:06:46'),
(18, 12, 10, '2020-02-04 11:06:46'),
(21, 14, 13, '2020-02-04 12:06:11'),
(22, 13, 14, '2020-02-04 12:06:11'),
(29, 12, 6, '2020-02-07 18:19:30'),
(30, 6, 12, '2020-02-07 18:19:30');

-- --------------------------------------------------------

--
-- 테이블 구조 `sns_like`
--

CREATE TABLE `sns_like` (
  `idx` int(11) NOT NULL,
  `pidx` int(11) NOT NULL,
  `uidx` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `sns_like`
--

INSERT INTO `sns_like` (`idx`, `pidx`, `uidx`) VALUES
(37, 32, 14),
(39, 34, 6);

-- --------------------------------------------------------

--
-- 테이블 구조 `sns_msg`
--

CREATE TABLE `sns_msg` (
  `idx` int(11) NOT NULL,
  `qidx` int(11) NOT NULL,
  `ridx` int(11) NOT NULL,
  `content` text NOT NULL,
  `writer` varchar(200) NOT NULL,
  `receiver` varchar(200) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `sns_msg`
--

INSERT INTO `sns_msg` (`idx`, `qidx`, `ridx`, `content`, `writer`, `receiver`, `date`) VALUES
(2, 6, 13, 'ㅈㄷㄹㄴㄴㅇㅎㄴㅍㄴ', '휘균', '테스트3', '2020-02-06 15:32:52'),
(3, 7, 6, 'sdsdfsdfdfsdfsfsddfsdffdssdf', 'asd', '휘균', '2020-02-06 19:42:06'),
(4, 6, 13, '테스트3', '휘균', 'asd', '2020-02-06 19:56:12'),
(5, 6, 13, 'ㄷㄱㅈㅂㄷㅈㅂㅈㄷㄱ', '휘균', 'asd', '2020-02-07 10:57:00'),
(7, 12, 11, 'sdsdsdfsdfsfsdfdsfsdfsfsdfsfsdfffffffffffffffffffffffffffffffsfsdfsfsdfsfsdfffffffffffffffffffffffffffffffsfsdfsfsdfsfsdfffffffffffffffffffffffffffffffsfsdfsfsdfsfsdfffffffffffffffffffffffffffffff', 'cvb', '휘균', '2020-02-07 18:20:03');

-- --------------------------------------------------------

--
-- 테이블 구조 `sns_uploads`
--

CREATE TABLE `sns_uploads` (
  `idx` int(11) NOT NULL,
  `pidx` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `directory` varchar(200) NOT NULL,
  `type` int(11) NOT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 테이블 구조 `sns_users`
--

CREATE TABLE `sns_users` (
  `idx` int(11) NOT NULL,
  `id` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `sns_users`
--

INSERT INTO `sns_users` (`idx`, `id`, `password`, `name`) VALUES
(5, 'qwe@qwe', 'qwe', '왕휘균'),
(6, 'king@king', '1234', '휘균'),
(7, 'asd@asd', 'asd', 'asd'),
(8, 'admin@admin', '1234', '가나다'),
(9, 'uio@uio', 'uio', 'uio'),
(10, 'rty@rty', 'rty', 'rty'),
(11, 'iop@iop', 'iop', 'iop'),
(12, 'cvb@cvb', 'cvb', 'cvb'),
(13, 'test3@test3', 'test3', '테스트3'),
(14, 'test2@test2', 'test2', '테스트2'),
(15, 'test4@test4', 'test4', '테스트4'),
(16, 'test5@test5', 'test5', '테스트5'),
(17, 'test6@test6', 'test6', '테스트6'),
(19, 'test7@test7', 'test7', '테스트7'),
(20, 'test8@test8', 'test8', '테스트8');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `sns_addfriend`
--
ALTER TABLE `sns_addfriend`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `sns_boards`
--
ALTER TABLE `sns_boards`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `sns_comments`
--
ALTER TABLE `sns_comments`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `sns_friends`
--
ALTER TABLE `sns_friends`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `sns_like`
--
ALTER TABLE `sns_like`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `sns_msg`
--
ALTER TABLE `sns_msg`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `sns_uploads`
--
ALTER TABLE `sns_uploads`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `sns_users`
--
ALTER TABLE `sns_users`
  ADD PRIMARY KEY (`idx`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `sns_addfriend`
--
ALTER TABLE `sns_addfriend`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- 테이블의 AUTO_INCREMENT `sns_boards`
--
ALTER TABLE `sns_boards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- 테이블의 AUTO_INCREMENT `sns_comments`
--
ALTER TABLE `sns_comments`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- 테이블의 AUTO_INCREMENT `sns_friends`
--
ALTER TABLE `sns_friends`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- 테이블의 AUTO_INCREMENT `sns_like`
--
ALTER TABLE `sns_like`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- 테이블의 AUTO_INCREMENT `sns_msg`
--
ALTER TABLE `sns_msg`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 테이블의 AUTO_INCREMENT `sns_uploads`
--
ALTER TABLE `sns_uploads`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `sns_users`
--
ALTER TABLE `sns_users`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
