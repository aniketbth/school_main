CREATE DATABASE IF NOT EXISTS school_main CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE school_main;

CREATE TABLE IF NOT EXISTS roles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL UNIQUE,
  slug VARCHAR(60) NOT NULL UNIQUE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  role_id INT NOT NULL,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  phone VARCHAR(30) DEFAULT NULL,
  photo VARCHAR(255) DEFAULT NULL,
  status ENUM('active','inactive','locked') DEFAULT 'active',
  last_login DATETIME DEFAULT NULL,
  remember_token VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  deleted_at DATETIME DEFAULT NULL,
  INDEX idx_role_id (role_id),
  CONSTRAINT fk_users_role FOREIGN KEY (role_id) REFERENCES roles(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS school_settings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  key_name VARCHAR(100) NOT NULL UNIQUE,
  key_value TEXT,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS academic_sessions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  session_name VARCHAR(50) NOT NULL,
  is_current TINYINT(1) DEFAULT 0,
  status ENUM('active','archived') DEFAULT 'active',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS classes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  class_name VARCHAR(50) NOT NULL,
  section_name VARCHAR(20) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS subjects (
  id INT AUTO_INCREMENT PRIMARY KEY,
  subject_name VARCHAR(100) NOT NULL,
  code VARCHAR(30) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS class_subjects (
  id INT AUTO_INCREMENT PRIMARY KEY,
  class_id INT NOT NULL,
  subject_id INT NOT NULL,
  teacher_id INT DEFAULT NULL,
  UNIQUE KEY uq_class_subject (class_id, subject_id),
  KEY idx_class_id (class_id),
  KEY idx_subject_id (subject_id),
  CONSTRAINT fk_class_subject_class FOREIGN KEY (class_id) REFERENCES classes(id),
  CONSTRAINT fk_class_subject_subject FOREIGN KEY (subject_id) REFERENCES subjects(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  admission_no VARCHAR(50) NOT NULL UNIQUE,
  roll_no VARCHAR(20) DEFAULT NULL,
  student_name VARCHAR(120) NOT NULL,
  father_name VARCHAR(120) DEFAULT NULL,
  mother_name VARCHAR(120) DEFAULT NULL,
  dob DATE DEFAULT NULL,
  gender ENUM('Male','Female','Other') DEFAULT 'Male',
  class_id INT DEFAULT NULL,
  section_name VARCHAR(30) DEFAULT NULL,
  session_id INT DEFAULT NULL,
  phone VARCHAR(30) DEFAULT NULL,
  email VARCHAR(150) DEFAULT NULL,
  address TEXT,
  status ENUM('active','pending','promoted','transferred','inactive') DEFAULT 'active',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_student_user FOREIGN KEY (user_id) REFERENCES users(id),
  KEY idx_class_id (class_id),
  KEY idx_session_id (session_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS parents (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  parent_name VARCHAR(120) NOT NULL,
  relation VARCHAR(20) DEFAULT NULL,
  phone VARCHAR(30) DEFAULT NULL,
  email VARCHAR(150) DEFAULT NULL,
  address TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_parent_user FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS student_parent (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_id INT NOT NULL,
  parent_id INT NOT NULL,
  UNIQUE KEY uq_student_parent (student_id, parent_id),
  CONSTRAINT fk_student_parent_student FOREIGN KEY (student_id) REFERENCES students(id),
  CONSTRAINT fk_student_parent_parent FOREIGN KEY (parent_id) REFERENCES parents(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS teachers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  teacher_name VARCHAR(120) NOT NULL,
  employee_code VARCHAR(50) NOT NULL UNIQUE,
  designation VARCHAR(100) DEFAULT NULL,
  qualification VARCHAR(150) DEFAULT NULL,
  phone VARCHAR(30) DEFAULT NULL,
  email VARCHAR(150) DEFAULT NULL,
  joining_date DATE DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_teacher_user FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS staff (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  staff_name VARCHAR(120) NOT NULL,
  employee_code VARCHAR(50) NOT NULL UNIQUE,
  role_name VARCHAR(100) DEFAULT NULL,
  department VARCHAR(100) DEFAULT NULL,
  phone VARCHAR(30) DEFAULT NULL,
  email VARCHAR(150) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_staff_user FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS teacher_subject_class (
  id INT AUTO_INCREMENT PRIMARY KEY,
  teacher_id INT NOT NULL,
  subject_id INT NOT NULL,
  class_id INT NOT NULL,
  UNIQUE KEY uq_teacher_subject_class (teacher_id, subject_id, class_id),
  CONSTRAINT fk_tsc_teacher FOREIGN KEY (teacher_id) REFERENCES teachers(id),
  CONSTRAINT fk_tsc_subject FOREIGN KEY (subject_id) REFERENCES subjects(id),
  CONSTRAINT fk_tsc_class FOREIGN KEY (class_id) REFERENCES classes(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS attendance_students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_id INT NOT NULL,
  attendance_date DATE NOT NULL,
  status ENUM('present','absent','late','leave') DEFAULT 'present',
  remarks VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY uq_student_attendance (student_id, attendance_date),
  CONSTRAINT fk_attendance_student FOREIGN KEY (student_id) REFERENCES students(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS attendance_staff (
  id INT AUTO_INCREMENT PRIMARY KEY,
  staff_id INT NOT NULL,
  attendance_date DATE NOT NULL,
  status ENUM('present','absent','late','leave') DEFAULT 'present',
  remarks VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY uq_staff_attendance (staff_id, attendance_date),
  CONSTRAINT fk_attendance_staff FOREIGN KEY (staff_id) REFERENCES staff(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS examinations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  exam_name VARCHAR(100) NOT NULL,
  session_id INT DEFAULT NULL,
  start_date DATE DEFAULT NULL,
  end_date DATE DEFAULT NULL,
  status ENUM('draft','active','locked') DEFAULT 'draft'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS exam_schedule (
  id INT AUTO_INCREMENT PRIMARY KEY,
  exam_id INT NOT NULL,
  class_id INT NOT NULL,
  subject_id INT NOT NULL,
  exam_date DATE DEFAULT NULL,
  start_time TIME DEFAULT NULL,
  end_time TIME DEFAULT NULL,
  room_no VARCHAR(20) DEFAULT NULL,
  CONSTRAINT fk_exam_schedule_exam FOREIGN KEY (exam_id) REFERENCES examinations(id),
  CONSTRAINT fk_exam_schedule_class FOREIGN KEY (class_id) REFERENCES classes(id),
  CONSTRAINT fk_exam_schedule_subject FOREIGN KEY (subject_id) REFERENCES subjects(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS marks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_id INT NOT NULL,
  exam_id INT NOT NULL,
  subject_id INT NOT NULL,
  theory_marks DECIMAL(5,2) DEFAULT 0,
  practical_marks DECIMAL(5,2) DEFAULT 0,
  total_marks DECIMAL(5,2) DEFAULT 0,
  grade VARCHAR(10) DEFAULT NULL,
  remarks VARCHAR(255) DEFAULT NULL,
  UNIQUE KEY uq_marks (student_id, exam_id, subject_id),
  CONSTRAINT fk_marks_student FOREIGN KEY (student_id) REFERENCES students(id),
  CONSTRAINT fk_marks_exam FOREIGN KEY (exam_id) REFERENCES examinations(id),
  CONSTRAINT fk_marks_subject FOREIGN KEY (subject_id) REFERENCES subjects(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS fee_heads (
  id INT AUTO_INCREMENT PRIMARY KEY,
  head_name VARCHAR(100) NOT NULL,
  description TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS fee_structure (
  id INT AUTO_INCREMENT PRIMARY KEY,
  class_id INT NOT NULL,
  head_id INT NOT NULL,
  amount DECIMAL(10,2) NOT NULL,
  UNIQUE KEY uq_fee_structure (class_id, head_id),
  CONSTRAINT fk_fee_structure_class FOREIGN KEY (class_id) REFERENCES classes(id),
  CONSTRAINT fk_fee_structure_head FOREIGN KEY (head_id) REFERENCES fee_heads(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS fee_invoices (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_id INT NOT NULL,
  invoice_no VARCHAR(50) NOT NULL UNIQUE,
  total_amount DECIMAL(10,2) NOT NULL,
  due_amount DECIMAL(10,2) DEFAULT 0,
  status ENUM('paid','partially_paid','pending') DEFAULT 'pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_fee_invoice_student FOREIGN KEY (student_id) REFERENCES students(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS fee_payments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  invoice_id INT NOT NULL,
  student_id INT NOT NULL,
  amount DECIMAL(10,2) NOT NULL,
  payment_method ENUM('cash','upi','cheque','bank') DEFAULT 'cash',
  transaction_ref VARCHAR(100) DEFAULT NULL,
  payment_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_pay_invoice FOREIGN KEY (invoice_id) REFERENCES fee_invoices(id),
  CONSTRAINT fk_pay_student FOREIGN KEY (student_id) REFERENCES students(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS notices (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200) NOT NULL,
  content TEXT NOT NULL,
  notice_type ENUM('notice','circular','announcement') DEFAULT 'notice',
  published_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  created_by INT DEFAULT NULL,
  is_active TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS events (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200) NOT NULL,
  description TEXT,
  event_date DATE DEFAULT NULL,
  venue VARCHAR(200) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS holidays (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(150) NOT NULL,
  holiday_date DATE NOT NULL,
  description TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS library_books (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200) NOT NULL,
  author VARCHAR(200) DEFAULT NULL,
  category VARCHAR(100) DEFAULT NULL,
  isbn VARCHAR(100) DEFAULT NULL,
  quantity INT DEFAULT 1,
  available_quantity INT DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS library_issues (
  id INT AUTO_INCREMENT PRIMARY KEY,
  book_id INT NOT NULL,
  student_id INT NOT NULL,
  issue_date DATE NOT NULL,
  return_due_date DATE NOT NULL,
  return_date DATE DEFAULT NULL,
  fine_amount DECIMAL(8,2) DEFAULT 0,
  CONSTRAINT fk_issue_book FOREIGN KEY (book_id) REFERENCES library_books(id),
  CONSTRAINT fk_issue_student FOREIGN KEY (student_id) REFERENCES students(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS enquiries (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  email VARCHAR(150) DEFAULT NULL,
  phone VARCHAR(30) DEFAULT NULL,
  subject VARCHAR(200) DEFAULT NULL,
  message TEXT NOT NULL,
  status ENUM('new','contacted','closed') DEFAULT 'new',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS careers_applications (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  email VARCHAR(150) DEFAULT NULL,
  phone VARCHAR(30) DEFAULT NULL,
  position VARCHAR(100) DEFAULT NULL,
  resume_path VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS admissions_applications (
  id INT AUTO_INCREMENT PRIMARY KEY,
  applicant_name VARCHAR(120) NOT NULL,
  email VARCHAR(150) DEFAULT NULL,
  phone VARCHAR(30) DEFAULT NULL,
  class_applied VARCHAR(50) DEFAULT NULL,
  status ENUM('submitted','approved','rejected','waitlist') DEFAULT 'submitted',
  application_no VARCHAR(50) NOT NULL UNIQUE,
  document_path VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS pages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  slug VARCHAR(100) NOT NULL UNIQUE,
  title VARCHAR(255) NOT NULL,
  content LONGTEXT,
  meta_title VARCHAR(255) DEFAULT NULL,
  meta_description TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS sliders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(150) NOT NULL,
  subtitle VARCHAR(255) DEFAULT NULL,
  image_url VARCHAR(255) DEFAULT NULL,
  link_url VARCHAR(255) DEFAULT NULL,
  is_active TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS gallery_albums (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(150) NOT NULL,
  description TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS gallery_images (
  id INT AUTO_INCREMENT PRIMARY KEY,
  album_id INT NOT NULL,
  image_url VARCHAR(255) NOT NULL,
  caption VARCHAR(200) DEFAULT NULL,
  CONSTRAINT fk_gallery_image_album FOREIGN KEY (album_id) REFERENCES gallery_albums(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS testimonials (
  id INT AUTO_INCREMENT PRIMARY KEY,
  person_name VARCHAR(100) NOT NULL,
  role VARCHAR(100) DEFAULT NULL,
  message TEXT NOT NULL,
  is_active TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS faqs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  question VARCHAR(255) NOT NULL,
  answer TEXT NOT NULL,
  is_active TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  sender_id INT NOT NULL,
  receiver_id INT NOT NULL,
  subject VARCHAR(255) DEFAULT NULL,
  message TEXT NOT NULL,
  attachment_path VARCHAR(255) DEFAULT NULL,
  sent_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_msg_sender FOREIGN KEY (sender_id) REFERENCES users(id),
  CONSTRAINT fk_msg_receiver FOREIGN KEY (receiver_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS notifications (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  title VARCHAR(200) NOT NULL,
  body TEXT,
  is_read TINYINT(1) DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_notification_user FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS leave_requests (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  leave_type VARCHAR(50) DEFAULT 'casual',
  start_date DATE NOT NULL,
  end_date DATE NOT NULL,
  reason TEXT,
  status ENUM('pending','approved','rejected') DEFAULT 'pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_leave_user FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS complaints (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  complaint_type VARCHAR(100) DEFAULT NULL,
  message TEXT NOT NULL,
  status ENUM('new','in_progress','resolved') DEFAULT 'new',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_complaint_user FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS activity_logs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT DEFAULT NULL,
  action VARCHAR(150) NOT NULL,
  details TEXT,
  ip_address VARCHAR(45) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_activity_user FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS login_attempts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(150) NOT NULL,
  ip_address VARCHAR(45) DEFAULT NULL,
  attempted_at DATETIME DEFAULT CURRENT_TIMESTAMP
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

INSERT INTO users (role_id, name, email, password, phone, status) VALUES
(1, 'Super Admin', 'admin@school.com', '$2y$10$JZp0FvZvM3u35sB93VGkduwV7jU6n6Oy2ZfQ7x0m3p3jXbE6Yh2Yy', '9000000001', 'active'),
(2, 'School Admin', 'admin2@school.com', '$2y$10$JZp0FvZvM3u35sB93VGkduwV7jU6n6Oy2ZfQ7x0m3p3jXbE6Yh2Yy', '9000000002', 'active'),
(3, 'Principal Name', 'principal@school.com', '$2y$10$JZp0FvZvM3u35sB93VGkduwV7jU6n6Oy2ZfQ7x0m3p3jXbE6Yh2Yy', '9000000003', 'active'),
(4, 'Teacher One', 'teacher@school.com', '$2y$10$JZp0FvZvM3u35sB93VGkduwV7jU6n6Oy2ZfQ7x0m3p3jXbE6Yh2Yy', '9000000004', 'active'),
(5, 'Student One', 'student@school.com', '$2y$10$JZp0FvZvM3u35sB93VGkduwV7jU6n6Oy2ZfQ7x0m3p3jXbE6Yh2Yy', '9000000005', 'active'),
(6, 'Parent One', 'parent@school.com', '$2y$10$JZp0FvZvM3u35sB93VGkduwV7jU6n6Oy2ZfQ7x0m3p3jXbE6Yh2Yy', '9000000006', 'active'),
(7, 'Accountant One', 'accountant@school.com', '$2y$10$JZp0FvZvM3u35sB93VGkduwV7jU6n6Oy2ZfQ7x0m3p3jXbE6Yh2Yy', '9000000007', 'active'),
(8, 'Librarian One', 'librarian@school.com', '$2y$10$JZp0FvZvM3u35sB93VGkduwV7jU6n6Oy2ZfQ7x0m3p3jXbE6Yh2Yy', '9000000008', 'active'),
(9, 'Receptionist One', 'reception@school.com', '$2y$10$JZp0FvZvM3u35sB93VGkduwV7jU6n6Oy2ZfQ7x0m3p3jXbE6Yh2Yy', '9000000009', 'active');

INSERT INTO school_settings (key_name, key_value) VALUES
('school_name', 'Bettiah Excellence School'),
('school_address', 'Bettiah, West Champaran, Bihar'),
('school_phone', '+91 98765 43210'),
('school_email', 'info@bettiahschool.edu'),
('maintenance_mode', '0'),
('theme', 'light');

INSERT INTO academic_sessions (session_name, is_current, status) VALUES
('2024-25', 1, 'active'),
('2025-26', 0, 'active');

INSERT INTO classes (class_name, section_name) VALUES
('Nursery', 'A'),
('KG', 'A'),
('Class 1', 'A'),
('Class 2', 'A'),
('Class 6', 'A'),
('Class 9', 'A'),
('Class 12', 'Science');

INSERT INTO subjects (subject_name, code) VALUES
('Mathematics', 'MATH'),
('Science', 'SCI'),
('English', 'ENG'),
('Social Science', 'SOC'),
('Computer', 'COMP'),
('Hindi', 'HIN');

INSERT INTO students (user_id, admission_no, roll_no, student_name, father_name, mother_name, dob, gender, class_id, section_name, session_id, phone, email, address, status) VALUES
(5, 'ADM-2024-001', '01', 'Student One', 'Mr. One', 'Mrs. One', '2012-04-15', 'Male', 5, 'A', 1, '9876500001', 'student@school.com', 'Bettiah, Bihar', 'active');

INSERT INTO parents (user_id, parent_name, relation, phone, email, address) VALUES
(6, 'Parent One', 'Father', '9876500002', 'parent@school.com', 'Bettiah, Bihar');

INSERT INTO student_parent (student_id, parent_id) VALUES (1, 1);

INSERT INTO teachers (user_id, teacher_name, employee_code, designation, qualification, phone, email, joining_date) VALUES
(4, 'Teacher One', 'EMP-101', 'Senior Teacher', 'M.Sc. Mathematics', '9876500003', 'teacher@school.com', '2020-07-01');

INSERT INTO staff (user_id, staff_name, employee_code, role_name, department, phone, email) VALUES
(7, 'Accountant One', 'ACC-101', 'Accountant', 'Accounts', '9876500004', 'accountant@school.com'),
(8, 'Librarian One', 'LIB-101', 'Librarian', 'Library', '9876500005', 'librarian@school.com'),
(9, 'Receptionist One', 'REC-101', 'Receptionist', 'Front Office', '9876500006', 'reception@school.com');

INSERT INTO fee_heads (head_name, description) VALUES
('Tuition Fees', 'Monthly tuition'),
('Admission Fees', 'One-time admission fee'),
('Examination Fees', 'Exam charges');

INSERT INTO fee_structure (class_id, head_id, amount) VALUES
(5, 1, 2500.00),
(5, 2, 5000.00),
(5, 3, 800.00);

INSERT INTO fee_invoices (student_id, invoice_no, total_amount, due_amount, status) VALUES
(1, 'INV-2024-001', 8300.00, 2500.00, 'partially_paid');

INSERT INTO fee_payments (invoice_id, student_id, amount, payment_method, transaction_ref, payment_date) VALUES
(1, 1, 5800.00, 'upi', 'UPI-8812', NOW());

INSERT INTO notices (title, content, notice_type, published_at, created_by, is_active) VALUES
('Admissions Open', 'Admissions are open for the new session. Please contact the school office for details.', 'notice', NOW(), 1, 1),
('Parent Teacher Meeting', 'PTM will be held on Saturday at 10:00 AM.', 'announcement', NOW(), 1, 1);

INSERT INTO events (title, description, event_date, venue) VALUES
('Annual Sports Day', 'Inter-house sports competition', '2025-02-15', 'School Ground'),
('Science Exhibition', 'School science exhibition', '2025-03-05', 'Main Hall');

INSERT INTO holidays (title, holiday_date, description) VALUES
('Republic Day', '2025-01-26', 'National holiday'),
('Independence Day', '2025-08-15', 'National holiday');

INSERT INTO library_books (title, author, category, isbn, quantity, available_quantity) VALUES
('Science for Everyone', 'R. Sharma', 'Science', '978-1-234', 10, 9),
('English Grammar Mastery', 'A. Singh', 'English', '978-2-345', 8, 8);

INSERT INTO enquiries (name, email, phone, subject, message, status) VALUES
('New Prospect', 'prospect@example.com', '9999999999', 'Admission Query', 'I want to know fee structure.', 'new');

INSERT INTO admissions_applications (applicant_name, email, phone, class_applied, status, application_no, document_path) VALUES
('Demo Student', 'demoapplicant@example.com', '9000000010', 'Class 6', 'submitted', 'APP-2025-001', 'uploads/documents/demo.pdf');

INSERT INTO pages (slug, title, content, meta_title, meta_description) VALUES
('about', 'About Us', '<p>Welcome to our school.</p>', 'About Us', 'Learn about our school'),
('admission', 'Admission', '<p>Admission process and fees.</p>', 'Admission', 'Admission information');

INSERT INTO sliders (title, subtitle, image_url, link_url, is_active) VALUES
('Quality Education', 'Shaping bright futures in Bettiah.', 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b', '#', 1),
('Smart Learning', 'Modern classrooms with dedicated teachers.', 'https://images.unsplash.com/photo-1513258496099-48168024aec0', '#', 1);

INSERT INTO gallery_albums (title, description) VALUES
('Campus Life', 'A glimpse of school activities'),
('Annual Day', 'Celebrations and performances');

INSERT INTO testimonials (person_name, role, message, is_active) VALUES
('Parent of Student', 'Parent', 'The school has built confidence and discipline in my child.', 1),
('Student Alumni', 'Student', 'The teachers are supportive and the environment is wonderful.', 1);

INSERT INTO faqs (question, answer, is_active) VALUES
('What is the admission process?', 'Parents can apply online and submit the required documents.', 1),
('When is the school open?', 'School is open from 8:00 AM to 3:00 PM on working days.', 1);

INSERT INTO activity_logs (user_id, action, details, ip_address) VALUES
(1, 'login', 'System login', '127.0.0.1');

INSERT INTO login_attempts (email, ip_address, attempted_at) VALUES
('admin@school.com', '127.0.0.1', NOW());
