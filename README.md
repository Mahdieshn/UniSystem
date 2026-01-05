# University Enrollment API

A RESTful API for managing a university course enrollment system built with Laravel.
The project focuses on clean data modeling, proper entity relationships, and backend best practices.

---

## System Requirements

### With Docker (Recommended)
- Docker
- Docker Compose

### Without Docker (Local Setup)
- PHP >= 8.1
- Composer
- Laravel 10+
- MySQL or SQLite

---

## Key Features

- Full CRUD operations for:
  - Courses
  - Professors
  - Students
- Course offering management per academic term
- Student enrollment with strict business rules:
  - Capacity control per offering
  - Prevention of duplicate enrollment in the same offering
  - Prevention of enrolling in the same course more than once per term (even with different professors)
- Database schema management using Laravel migrations
- Strict request validation
- Proper error handling with meaningful HTTP status codes
- Feature tests covering enrollment logic and capacity constraints

---

## Core Entities

1. **Course**
   - name
   - course_code
   - credits

2. **Professor**
   - identity information

3. **Student**
   - identity information
   - unique student number

4. **Offering**
   - course
   - professor
   - academic term
   - capacity

5. **Enrollment**
   - student
   - offering

---

## Installation & Setup

### Docker Setup (Recommended)

This project is fully Dockerized using **Laravel Sail**.

1. Copy environment configuration file:
   ```bash
   cp .env.example .env
   ```

2. Start containers:
   ```bash
   ./vendor/bin/sail up -d
   ```

3. Run database migrations:
   ```bash
   ./vendor/bin/sail artisan migrate
   ```

4. Run automated tests:
   ```bash
   ./vendor/bin/sail artisan test
   ```

#### Notes
- No local PHP or database installation is required.
- Docker runs the application, database, and related services.
- Recommended for development and team environments.

---

### Local Setup (Without Docker)

1. Clone the repository and navigate to the project directory.
2. Install dependencies:
   ```bash
   composer install
   ```

3. Create the `.env` file and configure database credentials.
4. Generate the application key:
   ```bash
   php artisan key:generate
   ```

5. Run database migrations:
   ```bash
   php artisan migrate
   ```

6. Run automated tests:
   ```bash
   php artisan test
   ```

---

## API Endpoints

| Method | Endpoint | Description |
|------|---------|------------|
| POST | /api/courses | Create a new course |
| POST | /api/professors | Create a new professor |
| POST | /api/students | Register a new student |
| POST | /api/offerings | Create a course offering |
| POST | /api/enrollments | Enroll a student in an offering |
| GET  | /api/enrollments?student_id={id} | Get enrollments of a student |

---

## Project Structure

- **app/Models**  
  Eloquent models with clearly defined relationships

- **app/Http/Controllers**  
  Application logic and request handling

- **database/migrations**  
  Database schema definitions

---

## Notes

- RESTful API design
- Business rules enforced at application level
- Suitable for academic systems and backend portfolio projects
