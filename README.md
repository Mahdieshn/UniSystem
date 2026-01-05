# University Enrollment API

A RESTful API for managing a university course enrollment system built with Laravel.
This project focuses on clean data modeling, proper entity relationships, and backend best practices.

---

## System Requirements

### Docker Setup (Recommended)
- Docker
- Docker Compose (v2)
- Linux / macOS  
- **Windows: WSL2 required**

### Local Setup (Without Docker)
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

This project uses **Laravel Sail** and Docker Compose (`compose.yml`).

> **Windows users:**  
> Laravel Sail must be executed inside **WSL2**.  
> Running Sail directly from Git Bash (MINGW) or Windows shells is not supported.

#### Steps

1. Copy environment configuration:
   ```bash
   cp .env.example .env
   ```

2. Install PHP dependencies (required to generate `vendor/bin/sail`):
   ```bash
   composer install
   ```

3. Start Docker containers:
   ```bash
   ./vendor/bin/sail up -d
   ```

4. Run database migrations:
   ```bash
   ./vendor/bin/sail artisan migrate
   ```

5. Run automated tests:
   ```bash
   ./vendor/bin/sail artisan test
   ```

#### Notes
- No local PHP or database installation is required.
- Docker runs the application, database, and related services.
- Default HTTP port is **80**. If port 80 is already in use (Laragon / IIS / etc.), set:
  ```env
  APP_PORT=8080
  ```
  and re-run Sail.

---

### Windows (WSL2)

Run all Sail commands inside WSL2:

```bash
cd /mnt/c/laragon/www/UniSystem
./vendor/bin/sail up -d
```

Make sure:
- Docker Desktop is running
- WSL integration is enabled for your Linux distro

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

## Testing

Feature tests validate:
- Enrollment capacity limits
- Duplicate enrollment prevention
- Course uniqueness per term

Run tests with:
```bash
php artisan test
```
or (Docker):
```bash
./vendor/bin/sail test
```

---

## Project Structure

- **app/Models**  
  Eloquent models with clearly defined relationships

- **app/Http/Controllers**  
  Application logic and request handling

- **database/migrations**  
  Database schema definitions

- **tests/Feature**  
  Feature tests covering business rules

---

## Notes


- This project follows RESTful API design principles and clean separation of concerns.
- Business rules (capacity limits, duplicate enrollment prevention, course uniqueness per term) are enforced at the application level.
- Database integrity is supported through proper relationships and validation logic.
- The project is Dockerized using Laravel Sail and Docker Compose (`compose.yml`).
- On Windows, Laravel Sail must be executed inside WSL2.
- The codebase is structured to be easily extensible for future features such as prerequisites, grading, or role-based access control.
