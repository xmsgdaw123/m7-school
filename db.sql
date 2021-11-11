SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE users (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  surname VARCHAR(50) NOT NULL,
  email VARCHAR(255) NOT NULL,
  isTeacher BOOLEAN NOT NULL,
  hashedPassword VARCHAR(100) NOT NULL,

  CONSTRAINT pkUserId PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE modules (
  id INT(11) NOT NULL AUTO_INCREMENT,
  code VARCHAR(50) NOT NULL,
  name VARCHAR(50) NOT NULL,
  description VARCHAR(255) NOT NULL,

  CONSTRAINT pkModuleId PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE moduleUsers (
  id INT(11) NOT NULL AUTO_INCREMENT,
  moduleId INT(11) NOT NULL,
  userId INT(11) NOT NULL,

  CONSTRAINT pkModuleUsersId PRIMARY KEY (id),
  CONSTRAINT fkModuleUsersModuleId FOREIGN KEY (moduleId)
    REFERENCES modules (id),
  CONSTRAINT fkModuleUsersUserId FOREIGN KEY (userId)
    REFERENCES users (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE tasks (
  id INT(11) NOT NULL AUTO_INCREMENT,
  moduleId INT(11) NOT NULL,
  name VARCHAR(50) NOT NULL,
  description VARCHAR(255) NOT NULL,

  CONSTRAINT pkTasksId PRIMARY KEY (id),
  CONSTRAINT fkTasksModuleId FOREIGN KEY (moduleId)
    REFERENCES modules (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE taskItems (
  id INT(11) NOT NULL AUTO_INCREMENT,
  taskId INT(11) NOT NULL,
  userId INT(11) NOT NULL,
  submitted BOOLEAN NOT NULL,
  submittedAt VARCHAR(50) NOT NULL,
  note DECIMAL(2),
  content VARCHAR(255) NOT NULL,

  CONSTRAINT pkTaskItemsId PRIMARY KEY (id),
  CONSTRAINT fkTaskItemsTaskId FOREIGN KEY (taskId)
    REFERENCES tasks (id),
  CONSTRAINT fkTaskItemsUserId FOREIGN KEY (userId)
    REFERENCES users (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;