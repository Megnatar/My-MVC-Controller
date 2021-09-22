CREATE DATABASE `my_mvc`;

USE `my_mvc`;

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'Joz', 'j.n@NIX.ORG', '$2y$10$H6AV8oZkeRSb3ORJyF9CkeuZRdzoUdiwVUWqatf07GFOqTaBA1qKO');

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
 
