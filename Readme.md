📘 College Attendance System – Full Explanation

1\. Overview



The College Attendance System is a web-based application built using PHP, MySQL, HTML, and CSS.

It enables teachers to manage student attendance efficiently and securely.



✅ Core Highlights:



Teachers can register and log in.



Add new students with class details.



Mark daily attendance for each student.



View past attendance records with color-coded status.



Session management \& cookies for secure login.



2\. Features



✅ Teacher account registration and login



✅ Session-based access control (unauthorized users restricted)



✅ Add students (with validation to avoid duplicate roll numbers)



✅ Mark daily attendance (Present/Absent)



✅ View attendance history with status indicators:



🟢 Present



🔴 Absent



✅ Logout functionality (secure session end)



✅ Responsive and visually appealing UI



3\. Database Structure



Database: college\_attendance



📄 Table 1: teachers

Column	Type	Notes

id	INT	Primary key, auto-increment

username	VARCHAR	Unique username

password	VARCHAR	Hashed password

📄 Table 2: students

Column	Type	Notes

id	INT	Primary key, auto-increment

roll\_no	VARCHAR	Unique roll number

name	VARCHAR	Student name

class	VARCHAR	Student class

📄 Table 3: attendance

Column	Type	Notes

id	INT	Primary key, auto-increment

student\_id	INT	Foreign key → students.id

date	DATE	Attendance date

status	VARCHAR	"Present" or "Absent"

4\. File Breakdown



db.php → Database connection



index.php → Teacher Login (with cookies “Remember Me”)



register.php → Teacher Registration (secure password hashing)



dashboard.php → Main navigation (Add Student / Mark / View Attendance / Logout)



add\_student.php → Add new students (duplicate roll\_no check)



mark\_attendance.php → Mark attendance for all students (prevents duplicate entries)



view\_attendance.php → View attendance records (color-coded)



logout.php → Secure logout (destroy session + cookies)



style.css → Styling (forms, buttons, tables, color codes)



5\. Usage Instructions



Install XAMPP/WAMP or any PHP server.



Create a database → college\_attendance.



Create the required tables (teachers, students, attendance).



Place project files in htdocs (or server root).



Open register.php → create a teacher account.



Login via index.php.



Use dashboard to:



Add students



Mark attendance



View past records



6\. Security Features



🔒 Passwords stored using password\_hash().



🔒 Session-based access control.

⚠️ Duplicate checks (username \& roll\_no).



🔒 Optional "Remember Me" with secure cookies.



7\. Conclusion



This project offers a simple, secure, and user-friendly way to manage attendance in colleges.



🚀 Future Extensions:



Multiple teacher roles.



Class-wise reports.



Export to Excel/PDF.



Mobile-friendly version.

