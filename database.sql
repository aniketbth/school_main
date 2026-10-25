CREATE DATABASE IF NOT EXISTS school_main CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE school_main;

CREATE TABLE roles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(80) NOT NULL,
  slug VARCHAR(80) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  role_id INT NOT NULL,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  phone VARCHAR(30) DEFAULT NULL,
  photo VARCHAR(255) DEFAULT NULL,
  status ENUM('active','inactive','locked') DEFAULT 'active',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY idx_role_id (role_id),
  CONSTRAINT FOREIGN KEY (role_id) REFERENCES roles(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE school_settings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  key_name VARCHAR(100) NOT NULL UNIQUE,
  key_value TEXT,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE academic_sessions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  session_name VARCHAR(50) NOT NULL,
  is_current TINYINT(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE classes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  class_name VARCHAR(80) NOT NULL,
  section_name VARCHAR(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE subjects (
  id INT AUTO_INCREMENT PRIMARY KEY,
  subject_name VARCHAR(120) NOT NULL,
  code VARCHAR(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  admission_no VARCHAR(50) UNIQUE,
  student_name VARCHAR(120) NOT NULL,
  father_name VARCHAR(120) DEFAULT NULL,
  mother_name VARCHAR(120) DEFAULT NULL,
  dob DATE DEFAULT NULL,
  gender ENUM('Male','Female','Other') DEFAULT 'Male',
  class_id INT DEFAULT NULL,
  section_name VARCHAR(40) DEFAULT NULL,
  session_id INT DEFAULT NULL,
  phone VARCHAR(30) DEFAULT NULL,
  email VARCHAR(150) DEFAULT NULL,
  address TEXT,
  status ENUM('active','pending','promoted','transferred','inactive') DEFAULT 'active',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT FOREIGN KEY (user_id) REFERENCES users(id),
  KEY idx_class_id (class_id),
  KEY idx_session_id (session_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE parents (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  parent_name VARCHAR(120) NOT NULL,
  relation VARCHAR(40) DEFAULT NULL,
  phone VARCHAR(30) DEFAULT NULL,
  email VARCHAR(150) DEFAULT NULL,
  address TEXT,
  CONSTRAINT FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE student_parent (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_id INT NOT NULL,
  parent_id INT NOT NULL,
  UNIQUE KEY uq_student_parent (student_id, parent_id),
  CONSTRAINT FOREIGN KEY (student_id) REFERENCES students(id),
  CONSTRAINT FOREIGN KEY (parent_id) REFERENCES parents(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE teachers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  teacher_name VARCHAR(120) NOT NULL,
  employee_code VARCHAR(50) NOT NULL UNIQUE,
  designation VARCHAR(100) DEFAULT NULL,
  qualification VARCHAR(150) DEFAULT NULL,
  phone VARCHAR(30) DEFAULT NULL,
  email VARCHAR(150) DEFAULT NULL,
  joining_date DATE DEFAULT NULL,
  CONSTRAINT FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE staff (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  staff_name VARCHAR(120) NOT NULL,
  employee_code VARCHAR(50) NOT NULL UNIQUE,
  role_name VARCHAR(100) DEFAULT NULL,
  department VARCHAR(100) DEFAULT NULL,
  phone VARCHAR(30) DEFAULT NULL,
  email VARCHAR(150) DEFAULT NULL,
  CONSTRAINT FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE fees (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_id INT NOT NULL,
  fee_month VARCHAR(20) NOT NULL,
  amount DECIMAL(10,2) NOT NULL,
  due_date DATE DEFAULT NULL,
  status ENUM('pending','paid','partial') DEFAULT 'pending',
  CONSTRAINT FOREIGN KEY (student_id) REFERENCES students(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE notices (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200) NOT NULL,
  content TEXT NOT NULL,
  notice_type VARCHAR(50) DEFAULT 'notice',
  published_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  is_active TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE events (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200) NOT NULL,
  description TEXT,
  event_date DATE DEFAULT NULL,
  venue VARCHAR(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE enquiries (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(150) DEFAULT NULL,
  phone VARCHAR(30) DEFAULT NULL,
  subject VARCHAR(200) DEFAULT NULL,
  message TEXT NOT NULL,
  status ENUM('new','contacted','closed') DEFAULT 'new',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE admissions_applications (
  id INT AUTO_INCREMENT PRIMARY KEY,
  applicant_name VARCHAR(120) NOT NULL,
  email VARCHAR(150) DEFAULT NULL,
  phone VARCHAR(30) DEFAULT NULL,
  class_applied VARCHAR(60) DEFAULT NULL,
  status ENUM('submitted','approved','rejected','waitlist') DEFAULT 'submitted',
  application_no VARCHAR(50) UNIQUE,
  document_path VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE library_books (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200) NOT NULL,
  author VARCHAR(200) DEFAULT NULL,
  category VARCHAR(100) DEFAULT NULL,
  quantity INT DEFAULT 1,
  available_quantity INT DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  sender_id INT NOT NULL,
  receiver_id INT NOT NULL,
  subject VARCHAR(200) DEFAULT NULL,
  message TEXT NOT NULL,
  attachment_path VARCHAR(255) DEFAULT NULL,
  sent_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT FOREIGN KEY (sender_id) REFERENCES users(id),
  CONSTRAINT FOREIGN KEY (receiver_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE activity_logs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT DEFAULT NULL,
  action VARCHAR(150) NOT NULL,
  details TEXT,
  ip_address VARCHAR(45) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO roles (name, slug) VALUES
('Super Admin','super_admin'),
('Admin','admin'),
('Principal','principal'),
('Teacher','teacher'),
('Student','student'),
('Parent','parent'),
('Accountant','accountant'),
('Librarian','librarian'),
('Receptionist','receptionist');

INSERT INTO school_settings (key_name, key_value) VALUES
('school_name','Bettiah Excellence School'),
('school_address','Bettiah, West Champaran, Bihar'),
('school_phone','+91 98765 43210'),
('school_email','info@bettiahschool.edu'),
('maintenance_mode','0'),
('theme','light');

INSERT INTO users (role_id, name, email, password, phone, status) VALUES
(1, 'Super Admin', 'admin@school.com', '$2y$10$LQxP2lKpUQxNiSFhW8cKwulY4L9wJq2V3E8jLxH8TKWlB2R6e5Qei', '9000000001', 'active'),
(3, 'Principal Name', 'principal@school.com', '$2y$10$LQxP2lKpUQxNiSFhW8cKwulY4L9wJq2V3E8jLxH8TKWlB2R6e5Qei', '9000000002', 'active'),
(4, 'Teacher One', 'teacher@school.com', '$2y$10$LQxP2lKpUQxNiSFhW8cKwulY4L9wJq2V3E8jLxH8TKWlB2R6e5Qei', '9000000003', 'active'),
(5, 'Student One', 'student@school.com', '$2y$10$LQxP2lKpUQxNiSFhW8cKwulY4L9wJq2V3E8jLxH8TKWlB2R6e5Qei', '9000000004', 'active'),
(6, 'Parent One', 'parent@school.com', '$2y$10$LQxP2lKpUQxNiSFhW8cKwulY4L9wJq2V3E8jLxH8TKWlB2R6e5Qei', '9000000005', 'active'),
(7, 'Accountant One', 'accountant@school.com', '$2y$10$LQxP2lKpUQxNiSFhW8cKwulY4L9wJq2V3E8jLxH8TKWlB2R6e5Qei', '9000000006', 'active'),
(8, 'Librarian One', 'librarian@school.com', '$2y$10$LQxP2lKpUQxNiSFhW8cKwulY4L9wJq2V3E8jLxH8TKWlB2R6e5Qei', '9000000007', 'active'),
(9, 'Receptionist One', 'reception@school.com', '$2y$10$LQxP2lKpUQxNiSFhW8cKwulY4L9wJq2V3E8jLxH8TKWlB2R6e5Qei', '9000000008', 'active');

INSERT INTO academic_sessions (session_name, is_current) VALUES ('2024-25', 1), ('2025-26', 0);
INSERT INTO classes (class_name, section_name) VALUES ('Class 6', 'A'), ('Class 9', 'A'), ('Class 12', 'Science');
INSERT INTO subjects (subject_name, code) VALUES ('Mathematics', 'MATH'), ('Science', 'SCI'), ('English', 'ENG');

INSERT INTO students (user_id, admission_no, student_name, father_name, mother_name, dob, gender, class_id, section_name, session_id, phone, email, address, status)
VALUES (4, 'ADM-001', 'Student One', 'Father One', 'Mother One', '2012-05-12', 'Male', 1, 'A', 1, '9876500001', 'student@school.com', 'Bettiah, Bihar', 'active');

INSERT INTO teachers (user_id, teacher_name, employee_code, designation, qualification, phone, email)
VALUES (3, 'Teacher One', 'EMP-101', 'Senior Teacher', 'M.Sc. Mathematics', '9876500002', 'teacher@school.com');

INSERT INTO staff (user_id, staff_name, employee_code, role_name, department, phone, email)
VALUES (6, 'Accountant One', 'ACC-101', 'Accountant', 'Accounts', '9876500003', 'accountant@school.com');

INSERT INTO notices (title, content, notice_type, is_active) VALUES
('Admissions Open', 'Admissions are open for the 2025-26 academic session. Please contact the office.', 'notice', 1),
('PTM Notice', 'Parent-teacher meeting will be held on Saturday at 10:00 AM.', 'announcement', 1);

INSERT INTO events (title, description, event_date, venue) VALUES
('Science Exhibition', 'Annual science exhibition for students.', '2025-03-05', 'School Hall'),
('Annual Sports Day', 'Intra-school sports event.', '2025-02-15', 'School Ground');

INSERT INTO enquiries (name, email, phone, subject, message, status) VALUES
('Demo Parent', 'parent@example.com', '9999999999', 'Admission', 'Kindly share fee structure.', 'new');

INSERT INTO admissions_applications (applicant_name, email, phone, class_applied, status, application_no)
VALUES ('Demo Applicant', 'demo@example.com', '9898989898', 'Class 6', 'submitted', 'APP-2025-001');

INSERT INTO library_books (title, author, category, quantity, available_quantity) VALUES
('Science for Everyone', 'R. Sharma', 'Science', 12, 11),
('English Grammar Habits', 'A. Singh', 'English', 8, 8);
