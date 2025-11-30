-- ======================================
-- SAMPLE DATA INSERTS
-- ======================================

-- Insert Users (base table for all roles)
INSERT INTO users (user_id, user_name, user_email, user_ph_no, password, role) VALUES
('U001', 'John Smith', 'admin1@email.com', '+66-123-4567', 'pass123', 'Admin'),
('U002', 'Sarah Johnson', 'admin2@email.com', '+66-234-5678', 'pass123', 'Admin'),
('U003', 'Michael Chen', 'admin3@email.com', '+66-345-6789', 'pass123', 'Admin'),
('U004', 'Emily Wilson', 'teacher1@email.com', '+66-456-7890', 'pass123', 'Teacher'),
('U005', 'David Lee', 'teacher2@email.com', '+66-567-8901', 'pass123', 'Teacher'),
('U006', 'Anna Martinez', 'teacher3@email.com', '+66-678-9012', 'pass123', 'Teacher'),
('U007', 'James Brown', 'visa1@email.com', '+66-789-0123', 'pass123', 'VisaSupportOfficer'),
('U008', 'Lisa Wang', 'visa2@email.com', '+66-890-1234', 'pass123', 'VisaSupportOfficer'),
('U009', 'Robert Taylor', 'visa3@email.com', '+66-901-2345', 'pass123', 'VisaSupportOfficer'),
('U010', 'Maria Garcia', 'student1@email.com', '+66-012-3456', 'pass123', 'Student'),
('U011', 'Thomas Anderson', 'student2@email.com', '+66-123-4568', 'pass123', 'Student'),
('U012', 'Jennifer Kim', 'student3@email.com', '+66-234-5679', 'pass123', 'Student');

-- Insert Admins
INSERT INTO admin (admin_id) VALUES
('U001'),
('U002'),
('U003');

-- Insert Teachers
INSERT INTO teacher (teacher_id, course_id) VALUES
('U004', 'C001'),
('U002', 'C002'),
('U003', 'C003');

-- Insert Visa Support Officers
INSERT INTO visa_support_officer (officer_id) VALUES
('U007'),
('U008'),
('U009');

-- Insert Topics
INSERT INTO topic (topic_id, topic_name, course_id) VALUES
('T001', 'Thai Grammar Fundamentals', 'C001'),
('T002', 'Thai Conversation Skills', 'C001'),
('T003', 'Thai Reading and Writing', 'C001'),
('T004', 'English Grammar Fundamentals', 'C002'),
('T005', 'English Conversation Skills', 'C002'),
('T006', 'English Reading and Writing', 'C002'),
('T007', 'Japanese Grammar Fundamentals', 'C003'),
('T008', 'Japanese Conversation Skills', 'C003'),
('T009', 'Japanese Reading and Writing', 'C003');

-- Insert Courses
INSERT INTO course (course_id, course_name, course_fees) VALUES
('C001', 'Thai Language Proficiency', 32000.00),
('C002', 'English Language Proficiency', 35000.00),
('C003', 'Japanese Language Proficiency', 38000.00);

-- Insert Batches
INSERT INTO batch (batch_id, batch_no, start_date, end_date, course_id) VALUES
('B001', '1', '2025-01-15', '2025-04-15', 'C001'),
('B002', '1', '2025-02-01', '2025-05-01', 'C002'),
('B003', '1', '2025-03-01', '2025-06-01', 'C003');

-- Insert Students
INSERT INTO student (student_id, batch_id) VALUES
('U010', 'B001'),
('U011', 'B001'),
('U012', 'B002');

-- Insert Lecture Notes
INSERT INTO lecture_note (lecture_note_id, lecture_note_name, upload_date, class_id) VALUES
('LN001', 'Introduction to Thai Alphabet', '2025-01-16', 'T001'),
('LN002', 'Thai Tones and Pronunciation', '2025-01-18', 'T001'),
('LN003', 'Basic Sentence Structure', '2025-01-20', 'T001');

-- Insert Video Lectures
INSERT INTO video_lecture (vid, v_name, v_date, class_id) VALUES
('VL001', 'Thai Language Overview', '2025-01-15', 'C001'),
('VL002', 'Conversational Thai Basics', '2025-02-01', 'C002'),
('VL003', 'Advanced Speaking Techniques', '2025-03-01', 'C003');

-- Insert Quizzes
INSERT INTO quiz (quiz_id, quiz_name, upload_date, class_id) VALUES
('Q001', 'Thai Alphabet Quiz', '2025-01-22', 'T001'),
('Q002', 'Grammar Assessment 1', '2025-01-25', 'T001'),
('Q003', 'Pronunciation Test', '2025-01-28', 'T002');

-- Insert Visa Applications
INSERT INTO visa_application (visa_application_id, visa_application_type, passport_number, visa_start_date, visa_end_date, officer_id, student_id, visa_status) VALUES
('VA001', 'Conversion', 'P123456789', '2025-01-01', '2026-01-01', 'U007', 'U010', 'Processing'),
('VA002', '1st Extension', 'P987654321', '2025-02-01', '2026-02-01', 'U008', 'U011', 'Completed'),
('VA006', '2nd Extension', 'P456789123', '2025-03-01', '2026-03-01', 'U009', 'U012', 'Processing');

-- Insert Documents
INSERT INTO document (document_id, document_type, received_date, visa_application_id) VALUES
('D001', 'Passport Copy', '2024-12-15', 'VA001'),
('D002', 'Enrollment Certificate', '2024-12-20', 'VA001'),
('D003', 'Financial Statement', '2024-12-22', 'VA001');

-- Insert Visa Status
INSERT INTO visa_status (status_id, status, status_date, visa_application_id) VALUES
('VS001', 'Submitted', '2024-12-25', 'VA001'),
('VS002', 'Under Review', '2025-01-05', 'VA001'),
('VS003', 'Approved', '2025-01-12', 'VA001');

-- Insert Admin Course Actions
INSERT INTO admin_course (admin_class_id, admin_id, course_id) VALUES
('AC001', 'U001', 'C001'),
('AC002', 'U001', 'C002'),
('AC003', 'U001', 'C003'),
('AC004', 'U002', 'C001'),
('AC005', 'U002', 'C002'),
('AC006', 'U002', 'C003'),
('AC007', 'U003', 'C001'),
('AC008', 'U003', 'C002'),
('AC009', 'U003', 'C003');

-- Insert Feedback
INSERT INTO feedback (feedback_id, student_id, class_id, rating, comment, date) VALUES
('F001', 'U010', 'C001', 5, 'Excellent course! Very helpful teacher.', '2025-02-15'),
('F002', 'U011', 'C001', 4, 'Good content but could use more practice exercises.', '2025-02-16'),
('F003', 'U012', 'C002', 5, 'Amazing experience. Learned so much!', '2025-03-20');

-- Insert Activity Log
INSERT INTO activity_log (log_id, user_id, action_type, action_date, description) VALUES
('AL001', 'U001', 'Login', '2025-01-15', 'Admin logged into system'),
('AL002', 'U010', 'Enrollment', '2025-01-15', 'Student enrolled in Basic Thai Language'),
('AL003', 'U004', 'Upload', '2025-01-16', 'Teacher uploaded lecture notes for Topic T001');
