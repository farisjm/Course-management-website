# Course Management System

A simple Course Management System built with **PHP**, **MySQL**, **HTML**, and **CSS**. It supports full CRUD operations for courses.

## Features

- Add new courses
- View all courses
- Edit existing courses
- Delete courses with confirmation
- Input validation on server-side and basic HTML form constraints
- Prepared statements for safer database operations
- Responsive interface for desktop and mobile

## Project Structure

- `/home/runner/work/Course-management-website/Course-management-website/db.php` - Database connection
- `/home/runner/work/Course-management-website/Course-management-website/index.php` - Add and list courses
- `/home/runner/work/Course-management-website/Course-management-website/edit.php` - Update a course
- `/home/runner/work/Course-management-website/Course-management-website/delete.php` - Delete confirmation and deletion
- `/home/runner/work/Course-management-website/Course-management-website/style.css` - UI styling
- `/home/runner/work/Course-management-website/Course-management-website/university.sql` - Database schema and sample data

## Requirements

- XAMPP (Apache + MySQL + PHP)

## Local Setup (XAMPP)

1. Copy the project folder into XAMPP `htdocs` (for example: `C:\xampp\htdocs\Course-management-website`).
2. Start **Apache** and **MySQL** from XAMPP Control Panel.
3. Open `http://localhost/phpmyadmin`.
4. Import `university.sql` to create the `university` database and `Course` table.
5. Ensure `db.php` credentials match your local MySQL settings (default in XAMPP is usually `root` with empty password).
6. Open the app at `http://localhost/Course-management-website/index.php`.

## Notes

- The table name is `Course` as required.
- If MySQL runs on a non-default port or has different credentials, update `db.php` accordingly.
