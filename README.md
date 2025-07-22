# Employment Management System

The **Employment Management System** is a web-based application designed to streamline and manage employee-related data, including personal information, attendance, requests (e.g., vacations), approvals, and role-based access control.

## 🚀 Features

- Employee registration and management
- Role-based user authentication (Admin, HR, Employee, etc.)

## 🛠️ Tech Stack

- **Backend**: PHP (Laravel)
- **Database**: MySQL / MariaDB
- **Authentication**: Sanctum
- **Other Tools**: Docker, Redis, minio storage , nginx , phpmyadmin

## 📦 Installation

### Prerequisites

- Docker version 28.0.4

### Steps

```bash
# 1. Clone the repository
git clone https://github.com/M-0x4D/EmployeesManagementSystem-Task.git

# 2. Up docker container
 docker compose up --build -d

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. Run migrations
php artisan migrate --seed

# It Works now, good luck.