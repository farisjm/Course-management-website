# Course Management System

A simple web application developed using PHP, MySQL, HTML, and CSS to manage university course records.

## Features

- Add new courses
- View all courses
- Edit course details
- Delete courses
- Responsive user interface
- MySQL database connectivity

## Technologies Used

- PHP
- MySQL
- HTML5
- CSS3
- XAMPP

## Database

**Database Name:** `university`

**Table Name:** `Course`

| Column | Description |
|---|---|
| id | Course ID (Primary Key, Auto Increment) |
| course | Course Name |
| credit | Number of Credits |

## Installation

1. Install XAMPP.
2. Start Apache and MySQL.
3. Copy the project folder to `C:\xampp\htdocs\course-management\`.
4. Open phpMyAdmin at `http://localhost/phpmyadmin`.
5. Execute the SQL commands from `university.sql`.
6. Open `http://localhost/course-management/` in your browser.

## CRUD Operations

- **Create:** Add a course.
- **Read:** Display course records.
- **Update:** Edit a course.
- **Delete:** Remove a course.

## Project Structure

- `db.php` — Database connection
- `index.php` — Add and display courses
- `edit.php` — Edit course details
- `delete.php` — Delete course records
- `style.css` — Website styling
- `university.sql` — Database setup
- `README.md` — Project documentation

## Purpose

This project demonstrates basic CRUD operations using PHP and MySQL as part of a practical exercise.
