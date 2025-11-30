-- ======================================
-- CLEAN DROP (dependents -> parents)
-- ======================================
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS activity_log;
DROP TABLE IF EXISTS feedback;
DROP TABLE IF EXISTS quiz;
DROP TABLE IF EXISTS video_lecture;
DROP TABLE IF EXISTS lecture_note;
DROP TABLE IF EXISTS topic;
DROP TABLE IF EXISTS admin_course;
DROP TABLE IF EXISTS course;
DROP TABLE IF EXISTS batch;
DROP TABLE IF EXISTS visa_status;
DROP TABLE IF EXISTS document;
DROP TABLE IF EXISTS visa_application;
DROP TABLE IF EXISTS student;
DROP TABLE IF EXISTS teacher;
DROP TABLE IF EXISTS admin;
DROP TABLE IF EXISTS visa_support_officer;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS enrollment;

SET FOREIGN_KEY_CHECKS = 1;

-- ======================================
-- USERS TABLE (Base table for all roles)
-- ======================================
CREATE TABLE users (
  user_id      VARCHAR(50) PRIMARY KEY,
  user_name    VARCHAR(100) NOT NULL,
  user_email   VARCHAR(100) UNIQUE,
  user_ph_no   VARCHAR(20),
  password     VARCHAR(255),
  role        ENUM('Admin','Teacher','Student','VisaSupportOfficer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ======================================
-- CORE ROLE TABLES
-- ======================================
CREATE TABLE admin (
  admin_id     VARCHAR(50) PRIMARY KEY,
  FOREIGN KEY (admin_id) REFERENCES users(user_id)
    ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE teacher (
  teacher_id    VARCHAR(50) PRIMARY KEY,
  course_id     VARCHAR(50),
  FOREIGN KEY (teacher_id) REFERENCES users(user_id)
    ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (course_id) REFERENCES course(course_id)
    ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE student (
  student_id    VARCHAR(50) PRIMARY KEY,
  batch_id      VARCHAR(50),
  FOREIGN KEY (student_id) REFERENCES users(user_id)
    ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE visa_support_officer (
  officer_id    VARCHAR(50) PRIMARY KEY,
  FOREIGN KEY (officer_id) REFERENCES users(user_id)
    ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ======================================
-- BATCH & COURSE SYSTEM
-- ======================================
CREATE TABLE batch (
  batch_id    VARCHAR(50) PRIMARY KEY,
  batch_no    VARCHAR(50),
  start_date  DATE,
  end_date    DATE,
  course_id   VARCHAR(50)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE course (
  course_id   VARCHAR(50) PRIMARY KEY,
  course_name VARCHAR(100) NOT NULL,
  course_fees DECIMAL(10,2)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Add foreign key for batch to course
ALTER TABLE batch
  ADD FOREIGN KEY (course_id) REFERENCES course(course_id)
    ON UPDATE CASCADE ON DELETE SET NULL;

-- Add foreign key for student to batch
ALTER TABLE student
  ADD FOREIGN KEY (batch_id) REFERENCES batch(batch_id)
    ON UPDATE CASCADE ON DELETE SET NULL;

-- ======================================
-- TOPIC & LEARNING MATERIALS
-- ======================================
CREATE TABLE topic (
    topic_id   VARCHAR(50) PRIMARY KEY,
    topic_name VARCHAR(100) NOT NULL,
    course_id VARCHAR(50),
    FOREIGN KEY (course_id) REFERENCES course(course_id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE lecture_note (
  lecture_note_id   VARCHAR(50) PRIMARY KEY,
  lecture_note_name VARCHAR(100),
  upload_date       DATE,
  class_id          VARCHAR(50),
  FOREIGN KEY (class_id) REFERENCES topic(topic_id)
    ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE video_lecture (
  vid             VARCHAR(50) PRIMARY KEY,
  v_name          VARCHAR(100),
  v_date          DATE,
  class_id        VARCHAR(50),
  FOREIGN KEY (class_id) REFERENCES course(course_id)
    ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE quiz (
  quiz_id     VARCHAR(50) PRIMARY KEY,
  quiz_name   VARCHAR(100),
  upload_date DATE,
  class_id    VARCHAR(50),
  FOREIGN KEY (class_id) REFERENCES topic(topic_id)
    ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ======================================
-- VISA APPLICATION SYSTEM
-- ======================================
CREATE TABLE visa_application (
  visa_application_id   VARCHAR(50) PRIMARY KEY,
  visa_application_type VARCHAR(100),
  passport_number       VARCHAR(50),
  visa_start_date       DATE,
  visa_end_date         DATE,
  officer_id            VARCHAR(50),
  student_id            VARCHAR(50),
  visa_status            VARCHAR(50),
  FOREIGN KEY (student_id) REFERENCES student(student_id)
    ON UPDATE CASCADE ON DELETE SET NULL,
  FOREIGN KEY (officer_id) REFERENCES visa_support_officer(officer_id)
    ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE document (
  document_id         VARCHAR(50) PRIMARY KEY,
  document_type       VARCHAR(100),
  received_date       DATE,
  visa_application_id VARCHAR(50),
  FOREIGN KEY (visa_application_id) REFERENCES visa_application(visa_application_id)
    ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE visa_status (
  status_id           VARCHAR(50) PRIMARY KEY,
  status              VARCHAR(50) NOT NULL,
  status_date         DATE,
  visa_application_id VARCHAR(50),
  FOREIGN KEY (visa_application_id) REFERENCES visa_application(visa_application_id)
    ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ======================================
-- MANY-TO-MANY RELATIONSHIP: Admin-Course
-- ======================================
CREATE TABLE admin_course (
  admin_class_id VARCHAR(50) PRIMARY KEY,
  admin_id       VARCHAR(50) NOT NULL,
  action_name    VARCHAR(100),
  course_id     VARCHAR(50),
  FOREIGN KEY (course_id) REFERENCES course(course_id)
    ON UPDATE CASCADE ON DELETE SET NULL,
  FOREIGN KEY (admin_id) REFERENCES admin(admin_id)
    ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ======================================
-- FEEDBACK & ACTIVITY LOG
-- ======================================
CREATE TABLE feedback (
  feedback_id VARCHAR(50) PRIMARY KEY,
  student_id  VARCHAR(50),
  class_id    VARCHAR(50),
  rating      INT,
  comment     TEXT,
  date        DATE,
  FOREIGN KEY (student_id) REFERENCES student(student_id)
    ON UPDATE CASCADE ON DELETE SET NULL,
  FOREIGN KEY (class_id) REFERENCES course(course_id)
    ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE activity_log (
  log_id       VARCHAR(50) PRIMARY KEY,
  user_id      VARCHAR(50),
  action_type  VARCHAR(50),
  action_date  DATE,
  description  TEXT,
  FOREIGN KEY (user_id) REFERENCES users(user_id)
    ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE enrollment (
  enrollment_id   INT AUTO_INCREMENT PRIMARY KEY,
  student_name    VARCHAR(100) NOT NULL,
  student_email   VARCHAR(150) NOT NULL,
  student_ph_no   VARCHAR(20) NOT NULL,
  batch_id        VARCHAR(50) NOT NULL,

  FOREIGN KEY (batch_id) REFERENCES batch(batch_id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
