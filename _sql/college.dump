CREATE TABLE `module` (
  `modulecode` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `level` int(11) NOT NULL
);

CREATE TABLE `student` (
  `studentid` varchar(8) NOT NULL,
  `password` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `house` varchar(30) NOT NULL,
  `town` varchar(30) NOT NULL,
  `county` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `postcode` varchar(10) NOT NULL
);

CREATE TABLE `studentmodules` (
  `studentid` varchar(8) NOT NULL,
  `modulecode` varchar(10) NOT NULL
);

INSERT INTO `studentmodules` (`studentid`, `modulecode`) VALUES
('20000000', 'CO107'),
('20000000', 'IN251');

INSERT INTO `module` (`modulecode`, `name`, `level`) VALUES
('CO106', 'Programming Development', 1),
('CO107', 'Programming Principles', 1),
('IN251', 'Internet Systems Development', 2);

INSERT INTO `student` (`studentid`, `password`, `dob`, `firstname`, `lastname`, `house`, `town`, `county`, `country`, `postcode`) VALUES
('20000000', '$2y$10$.LJBOl64nZWEVVE/v5mgNuzR01zx1zoyXuGJUa/zp2U.MQxkps3LS', '1974-11-10', 'Jon', 'Smith', '23 Victoria Road', 'High Wycombe', 'Bucks', 'UK', 'HP11 1RT');


ALTER TABLE `module`
 ADD PRIMARY KEY (`modulecode`);

ALTER TABLE `student`
 ADD PRIMARY KEY (`studentid`);

ALTER TABLE `studentmodules`
 ADD PRIMARY KEY (`studentid`,`modulecode`);
