# Agent CRM System

A Laravel-based Customer Relationship Management (CRM) system to manage and assign leads efficiently.

---

## Features

- User Roles: Admin and Agent
- Lead Management (Create, View, Edit, Delete)
- Email Notification when a lead is assigned
- Dashboard with user-specific stats
- Role-based access using Laravel Policies
- Queue-based email sending via SMTP
- Beautiful HTML emails with lead details

---

### Tech Stack

- **Framework:** Laravel 12
- **Frontend:** Blade, HTML, CSS,Bootstrap
- **Database:** MySQL
- **Mail:** SMTP (Gmail-compatible)
- **Auth:** Laravel Sanctum
- **Queue Driver:** Database

---

## Installation Guide

### 1. Clone the Repository

git clone https://github.com/fahadmaqsooddev/crm-system-web-application.git
cd agent-crm


### 2. Install Dependencies

composer install
npm install
npm run dev

### 3. Configure Environment

Copy the .env.example to .env and update the values:

cp .env.example .env

APP_NAME="Agent CRM"
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=agent_crm
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"

QUEUE_CONNECTION=database

### 4. Generate Key and Run Migrations

php artisan key:generate
php artisan migrate
php artisan db:seed # (optional)

### 5.php artisan serve

Visit: http://127.0.0.1:8000

### 6.Queue for Email Notifications

php artisan queue:work




