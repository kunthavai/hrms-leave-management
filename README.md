# HRMS - Employee & Leave Management System

## Overview

This project is a Human Resource Management System (HRMS) developed using Laravel. The application provides Employee Management and Leave Management functionalities with role-based access control.

The system allows administrators to manage employees, departments, leave requests, leave approvals, and leave balances while ensuring proper validation and business rules.

---

## Features

### Employee Management

* Add Employee
* Update Employee
* View Employee Details
* Delete Employee
* Employee Code Validation
* Department Assignment
* Pagination for Employee Listing

### Leave Management

* Apply Leave
* View Leave Details
* Delete Leave Request
* Leave Balance Management
* Leave Approval Workflow
* Leave Rejection Workflow
* Overlapping Leave Validation
* Sandwich Leave Rule Implementation

### Role-Based Access Control

* Admin Role
* Employee Role
* Dynamic Menu Management
* Role-Menu Mapping using Pivot Tables

---

## Technical Implementation

The project follows Laravel best practices and assignment requirements.

### Laravel Features Used

* Latest Laravel Version
* Eloquent ORM
* Form Request Validation
* Database Migrations
* Database Seeders
* Eloquent Relationships
* Pagination
* Middleware
* Service / Repository Pattern
* Route Model Binding
* Transactions

### Database Relationships

* User ↔ Roles (Many-to-Many)
* Role ↔ Menu (Many-to-Many)
* Department ↔ Employees (One-to-Many)
* Employee ↔ Leaves (One-to-Many)
* Leave Type ↔ Leave Balances (One-to-Many)

### Validation

Implemented using Laravel Form Request Validation.

Examples:

* Employee Code Validation
* Name Validation
* Email Validation
* Phone Validation
* Leave Date Validation
* Overlapping Leave Validation

### Transactions

Database transactions are used for critical operations such as:

* Employee Creation
* Employee Update
* Leave Approval
* Leave Rejection
* Leave Balance Updates

This ensures data consistency and rollback on failure.

### Performance Optimizations

* Eager Loading to avoid N+1 Query Problems
* Pagination for large datasets
* Repository Pattern for cleaner code structure

---

## Installation

Clone the repository:

```bash
git clone <repository-url>
```

Install dependencies:

```bash
composer install
```

Create environment file:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Configure database credentials in `.env`.

Run migrations and seeders:

```bash
php artisan migrate --seed
```

Start the development server:

```bash
php artisan serve
```

---

## Default Roles

* Admin
* Employee

---

## Assignment Requirements Covered

✔ Use Latest Laravel Version

✔ Use Migration & Seeder

✔ Use Eloquent Relationships

✔ Use Form Request Validation

✔ Use Pagination

✔ Avoid N+1 Queries

✔ Maintain Proper Code Structure

✔ Use Transactions Wherever Required

---

## Author

Developed as part of a Laravel Interview Assignment.
